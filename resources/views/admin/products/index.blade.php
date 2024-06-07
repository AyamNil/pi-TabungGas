@extends('layouts.app')

@section('content')
<div class="container" style="background: rgba(255, 255, 255, 0.13);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(7.5px);
-webkit-backdrop-filter: blur(7.5px);"">
    <h1>Product Management</h1>
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createProductModal">Add Product</button>
    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Price: Rp.{{ $product->price }}</p>
                    <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editProductModal_{{ $product->id }}">Edit</button>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@include('admin.products.create_modal')

@foreach($products as $product)
@include('admin.products.edit_modal', ['product' => $product])
@endforeach

@endsection
