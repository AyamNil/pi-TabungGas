@extends('layouts.app')

@section('content')
<div class="container" style="background: rgba(255, 255, 255, 0.13);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(7.5px);
-webkit-backdrop-filter: blur(7.5px);"">
    <h1>Track Orders</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="card p-3 border-radius-25">
        @foreach($orders as $order)
            <div class="list-group-item mb-3">
                <h5 class="mb-1">Order ID: {{ $order->id }}</h5>
                <p class="mb-1"><strong>Product ID:</strong> {{ $order->product_id }}</p>
                <p class="mb-1"><strong>Quantity:</strong> {{ $order->qty }}</p>
                <p class="mb-1"><strong>Kendaraan Pengiriman:</strong> {{ $order->delivery_vehicle }}</p>
                <p class="mb-1"><strong>Total Price:</strong> Rp. {{ number_format($order->total_price, 0, ',', '.') }}</p>
                <p class="mb-1">
                    <strong>Status:</strong>
                    <span class="
                        @if($order->status === 'pending') text-danger fw-bold
                        @elseif($order->status === 'processing') text-warning fw-bold
                        @elseif($order->status === 'completed') text-success fw-bold
                        @endif
                    ">
                        {{ $order->status }}
                    </span>
                </p>
                <p class="mb-1"><strong>Address:</strong> {{ $order->address }}</p>
                @if($order->status === 'pending')
                    <button class="btn btn-primary mt-2" data-bs-toggle="modal" data-bs-target="#orderModal" data-order-id="{{ $order->id }}">View Order</button>
                @endif
            </div>
        @endforeach
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="orderDetails" class="text-center mb-3">
                <img src="{{ asset('storage/Assets/qris.jpg') }}" class="card-img-top card-img-uniform" alt="Track Pemesanan">
                </div>
                <div class="text-center">
                    <p>Lakukan Pembayaran VIA QRis Diatas</p>
                    <p>Klik Tombol Konfirmasi</p>
                    <p>Kirim Bukti pembayaran ke whatsapp yang nantinya terbuka</p>
                    <!-- <p>Jangan Lupa Lampirkan Order Id Anda</p> -->
                </div>
                <button class="btn btn-primary mt-3 w-100" id="orderActionButton">Konfirmasi Pembayaran</button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var orderModal = document.getElementById('orderModal');
        orderModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var orderId = button.getAttribute('data-order-id');
            var modalTitle = orderModal.querySelector('.modal-title');
            var modalBody = orderModal.querySelector('.modal-body #orderDetails');

            modalTitle.textContent = 'Order ID: ' + orderId;


            var orderActionButton = document.getElementById('orderActionButton');
            orderActionButton.onclick = function () {
                var whatsappMessage = `Order ID: ${orderId} - Konfirmasi pembayaran untuk pesanan ini.`;
                var whatsappURL = `https://wa.me/6285719043233?text=${encodeURIComponent(whatsappMessage)}`;
                window.open(whatsappURL, '_blank');
            };
        });
    });
</script>
@endsection
