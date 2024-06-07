<!-- resources/views/admin/dashboard.blade.php -->

@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
    <div class="container" style="background: rgba(255, 255, 255, 0.13);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(7.5px);
-webkit-backdrop-filter: blur(7.5px);"">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>

                    <div class="card-body">
                        <p>Welcome, {{ Auth::user()->name }}!</p>
                        <p>This is your admin dashboard.</p>
                        <p>Customize this dashboard according to your needs.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
