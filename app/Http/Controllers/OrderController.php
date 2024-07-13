<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;


class OrderController extends Controller
{

    public function index()
    {
        $products = Product::all();
        return view('order.index', compact('products'));
    }

    public function orders()
    {
        $orders = Post::all();
        return view('admin.orders', compact('orders'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'delivery_vehicle' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $product = Product::find($request->product_id);

        // Check if there's enough stock
        if ($product->stock < $request->qty) {
            return redirect()->back()->with('error', 'Not enough stock available. Maximum available: ' . $product->stock);
        }

        $total_price = $product->price * $request->qty;

        Post::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'total_price' => $total_price,
            'delivery_vehicle' => $request->delivery_vehicle,
            'status' => 'pending',
            'address' => $request->address,
        ]);

        // Reduce the stock
        $product->decrement('stock', $request->qty);

        return redirect()->route('orders.track')->with('success', 'Order placed successfully!');
    }

    public function track()
    {
        $orders = Post::where('user_id', Auth::id())->get();
        return view('order.track', compact('orders'));
    }

    public function updateStatus(Post $order)
    {
        $user = auth()->user();
        $order = Post::find($order->id);
        $data = request()->validate([
            'status' => 'required|string'
        ]);
        $order->update($data);
        return redirect()->back()->with('success', 'Order status updated successfully!');
    }

    public function uploadBuktiPembayaran(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:posts,id',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $order = Post::findOrFail($request->order_id);

        if ($request->hasFile('bukti_pembayaran')) {
            // Delete old image if exists
            if ($order->bukti_pembayaran) {
                Storage::disk('public')->delete($order->bukti_pembayaran);
            }

            // Store the new image
            $imagePath = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

            // Resize and save the image
            $image = Image::make(public_path("storage/{$imagePath}"));
            $image->save();

            // Update the order with the new image path
            $order->update([
                'bukti_pembayaran' => $imagePath,
                'status' => 'processing' // Update status to processing after payment proof is uploaded
            ]);

            return redirect()->route('orders.track')->with('success', 'Bukti pembayaran berhasil diupload!');
        }

        return redirect()->back()->with('error', 'Terjadi kesalahan saat mengupload bukti pembayaran.');
    }

    public function viewBukti(Post $order)
{
    if (!$order->bukti_pembayaran) {
        abort(404);
    }

    $path = Storage::disk('public')->path($order->bukti_pembayaran);
    return response()->file($path);
}

    public function destroy(Post $order)
    {
        $order->delete();
        return redirect()->back()->with('success', 'Order deleted successfully!');
    }
}
