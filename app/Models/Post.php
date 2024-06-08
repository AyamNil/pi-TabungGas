<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function index()
    {
        $orders = Post::all(); // Fetch orders from the database

        return view('orders.index', compact('orders'));
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    protected $fillable = [
        'user_id',
        'product_id',
        'qty',
        'total_price',
        'delivery_vehicle',
        'status',
        'address',
    ];
}
