@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-5">Order Gas Tubes</h1>
   <div class="container d-flex">
   @foreach($products as $product)
        <div class="card mx-3">
            <div class="card-body">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">Price: ${{ $product->price }}</p>
                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="form-group">
                        <label for="qty">Quantity</label>
                        <input type="number" class="form-control" id="qty" name="qty" min="1" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Order</button>
                </form>
            </div>
        </div>
    @endforeach
   </div>
    
</div>
@endsection
