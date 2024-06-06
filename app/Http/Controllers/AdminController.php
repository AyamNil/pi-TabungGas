<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $orders = Post::with('user')->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateStatus(Request $request, Post $order)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $order->update(['status' => $request->status]);

        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully!');
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function getAllUser()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }
}

