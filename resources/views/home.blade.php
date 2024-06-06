@extends('layouts.app')

@section('content')
<div class="container" style=" padding: 20px;background-color: #FDFFE2;border-radius:5px; ">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container pb-5">
                @if(Auth::check())
                <h2>Selamat Datang, <b>{{ Auth::user()->name }}</b></h2>
                @else
                <h2>Welcome, Guest!</h2>
                @endif
            </div>
            <div class="row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <a href="orders" style="text-decoration: none; ">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('storage/Assets/LPG.jpeg') }}" class="card-img-top" alt="...">
                            <div class="card-body " style="color:brown;">
                                <h5 class="card-title fw-bolder">Pemesanan</h5>
                                <p class="card-text">Pemesanan Tabung Gas.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="orders/track" style="text-decoration: none;">
                        <div class="card" style="width: 18rem;">
                            <img src="{{ asset('storage/Assets/DELIVERY.png') }}" class="card-img-top" alt="...">
                            <div class="card-body " style="color:brown;">
                                <h5 class="card-title fw-bolder">Pemesanan</h5>
                                <p class="card-text">Pemesanan Tabung Gas.</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection