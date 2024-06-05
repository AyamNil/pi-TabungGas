<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('is.admin')->except(['index', 'store', 'track']);
    // }

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
            'address' => 'required|string|max:255',
        ]);

        $product = Product::find($request->product_id);
        $total_price = $product->price * $request->qty;

        Post::create([
            'user_id' => Auth::id(),
            'product_id' => $request->product_id,
            'qty' => $request->qty,
            'total_price' => $total_price,
            'status' => 'pending',
            'address' => $request->address,
        ]);

        return redirect()->route('orders.track')->with('success', 'Order placed successfully!');
    }

    public function track()
    {
        $orders = Post::where('user_id', Auth::id())->get();
        return view('order.track', compact('orders'));
    }

    public function updateStatus(Request $request, Post $order)
    {
        $request->validate([
            'status' => 'required|in:pending,processed,completed,delivered', // Add 'delivered' option
        ]);

        $order->update([
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
        echo ("Clicked");
    }
}