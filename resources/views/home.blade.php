@extends('layouts.app')

@section('content')
<div class="container" style="padding: 20px; background-color: #FDFFE2; border-radius: 5px;">
    <div class="row justify-content-center">
        @auth
        @if(Auth::user()->role === 'admin')
        <div class="col-md-8">
            <div class="container pb-5">
                @if(Auth::check())
                <h2>Welcome, <b style="color: #025fa4;">{{ Auth::user()->name }}</b></h2>
                @else
                <h2>Welcome, Guest!</h2>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="orders" style="text-decoration: none;">
                        <div class="card" style="width: 100%;">
                            <img src="{{ asset('storage/Assets/LPG.jpeg') }}" class="card-img-top card-img-uniform" alt="Pemesanan">
                            <div class="card-body" style="color: brown;">
                                <h5 class="card-title fw-bolder">Pemesanan</h5>
                                <p class="card-text">Pemesanan Tabung Gas.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="admin/products" style="text-decoration: none;">
                        <div class="card" style="width: 100%;">
                            <img src="{{ asset('storage/Assets/DELIVERY.png') }}" class="card-img-top card-img-uniform" alt="Track Pemesanan">
                            <div class="card-body" style="color: brown;">
                                <h5 class="card-title fw-bolder">Manage Products</h5>
                                <p class="card-text">Management Produk.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="admin/orders" style="text-decoration: none;">
                        <div class="card" style="width: 100%;">
                            <img src="{{ asset('storage/Assets/DELIVERY.png') }}" class="card-img-top card-img-uniform" alt="Manage Order">
                            <div class="card-body" style="color: brown;">
                                <h5 class="card-title fw-bolder">Manage Order</h5>
                                <p class="card-text">Management Orders.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="admin/users" style="text-decoration: none;">
                        <div class="card" style="width: 100%;">
                            <img src="{{ asset('storage/Assets/DELIVERY.png') }}" class="card-img-top card-img-uniform" alt="Manage Users">
                            <div class="card-body" style="color: brown;">
                                <h5 class="card-title fw-bolder">Manage Users</h5>
                                <p class="card-text">Management User.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="col-md-8">
            <div class="container pb-5">
                @if(Auth::check())
                <h2>Welcome, <b style="color: #025fa4;">{{ Auth::user()->name }}</b></h2>
                @else
                <h2>Welcome, Guest!</h2>
                @endif
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <a href="orders" style="text-decoration: none;">
                        <div class="card" style="width: 100%;">
                            <img src="{{ asset('storage/Assets/LPG.jpeg') }}" class="card-img-top card-img-uniform" alt="Pemesanan">
                            <div class="card-body" style="color: brown;">
                                <h5 class="card-title fw-bolder">Pemesanan</h5>
                                <p class="card-text">Pemesanan Tabung Gas.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-6 mb-3">
                    <a href="orders/track" style="text-decoration: none;">
                        <div class="card" style="width: 100%;">
                            <img src="{{ asset('storage/Assets/DELIVERY.png') }}" class="card-img-top card-img-uniform" alt="Track Pemesanan">
                            <div class="card-body">
                                <h5 class="card-title fw-bolder">Track Pemesanan</h5>
                                <p class="card-text">Lacak Pesanan Tabung Gas Anda.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
            @endif
        </div>
        @endauth
    </div>
</div>
@endsection

<style>
.card-img-uniform {
    height: 200px;
    object-fit: cover;
}
</style>
