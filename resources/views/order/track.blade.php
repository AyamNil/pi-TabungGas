{{-- resources/views/order/track.blade.php --}}

@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Track Orders</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="container d-flex ">
    @foreach($orders as $order)
        <div class="card mx-3">
            <div class="card-body">
                <h5 class="card-title">Order ID: {{ $order->id }}</h5>
                <p class="card-text">Product ID: {{ $order->product_id }}</p>
                <p class="card-text">Quantity: {{ $order->qty }}</p>
                <p class="card-text">Total Price: Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
                <p class="card-text">Status: {{ $order->status }}</p>
                <p class="card-text">Address: {{ $order->address }}</p>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection
