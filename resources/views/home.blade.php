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
                    <a href="orders">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Pemesanan Tabung Gas</h5>
                                <p class="card-text">Lakukan Pemesanan Gas Disini.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-6">
                    <a href="orders/track">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Tracking Order</h5>
                                <p class="card-text">Lacak Pemesanan mu lewat tabung ini.</p>
                                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
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