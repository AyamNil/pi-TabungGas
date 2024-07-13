@extends('layouts.app')

@section('content')
<div class="container" style="background: rgba(255, 255, 255, 0.13);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(7.5px);
-webkit-backdrop-filter: blur(7.5px);">
    <h1>Order Gas Tubes</h1>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        @foreach($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="/storage/{{ $product->image }}" class="img-fluid">
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Price: Rp.{{ $product->price }}</p>
                    <p class="card-text">Stock: <span id="stock-{{ $product->id }}">{{ $product->stock }}</span></p>
                    <form action="{{ route('orders.store') }}" method="POST" onsubmit="return validateStock({{ $product->id }})">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="form-group">
                            <label for="qty-{{ $product->id }}">Quantity</label>
                            <input type="number" class="form-control" id="qty-{{ $product->id }}" name="qty" min="1" max="{{ $product->stock }}" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group">
                            <label for="delivery_vehicle">Delivery Vehicle</label>
                            <select class="form-control" id="delivery_vehicle" name="delivery_vehicle" required>
                                <option value="Mobil">Mobil</option>
                                <option value="Sepeda Motor">Sepeda Motor</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Order</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
function validateStock(productId) {
    var qtyInput = document.getElementById('qty-' + productId);
    var stockSpan = document.getElementById('stock-' + productId);
    var availableStock = parseInt(stockSpan.innerText);
    var orderedQty = parseInt(qtyInput.value);

    if (orderedQty > availableStock) {
        alert('Not enough stock available. Maximum available: ' + availableStock);
        return false;
    }
    return true;
}
</script>
@endsection
