@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Dashboard')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection

@section('content')
{{-- widget --}}
    <div class="row">
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary"><i class="far fa-newspaper"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Buku Dipinjam</h4></div>
                    <div class="card-body">10</div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success"><i class="fas fa-shopping-basket"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Buku Dikembalikan</h4></div>
                    <div class="card-body">42</div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger"><i class="fas fa-exclamation-circle"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Buku Terlambat</h4></div>
                    <div class="card-body">1,201</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 mb-4">
            <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="{{ asset('img/perpustakaan.jpg') }}">
                <div class="hero-inner">
                    <h2>Selamat Datang, Jhon Doe!</h2>
                    <p class="lead">Tidak ada yang lebih menyenangkan daripada menjelajahi perpustakaan</p>
                    <p>~Walter Savage Landor</p>
                    <div class="mt-4">
                    <a href="{{ url('ui/dashboard/member/books') }}" class="btn btn-outline-white btn-lg btn-icon icon-left"><i class="fas fa-search"></i>Cari Buku Sekarang!</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
