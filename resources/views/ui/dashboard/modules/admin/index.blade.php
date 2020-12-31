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
        <div class="col-12 mb-4">
            <div class="hero text-white hero-bg-image hero-bg-parallax" data-background="{{ asset('img/perpustakaan.jpg') }}">
                <div class="hero-inner">
                    <h2>Selamat Datang, Admin!</h2>
                    <p class="lead">Mulai harimu dengan semangat. Jangan berhenti saat Anda lelah, tapi berhentilah saat Anda selesai.</p>
                    <p>Berikut Rekap Data Perpustakaan hari ini</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger"><i class="fas fa-users"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Admin</h4></div>
                    <div class="card-body">10</div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning"><i class="fas fa-book"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Buku</h4></div>
                    <div class="card-body">42</div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success"><i class="fas fa-users"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Anggota</h4></div>
                    <div class="card-body">1,201</div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info"><i class="fas fa-newspaper"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Peminjaman</h4></div>
                    <div class="card-body">10</div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary"><i class="fas fa-shopping-basket"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Pengembalian</h4></div>
                    <div class="card-body">42</div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-dark"><i class="fas fa-th-list"></i></div>
                <div class="card-wrap">
                    <div class="card-header"><h4>Total Rak</h4></div>
                    <div class="card-body">1,201</div>
                </div>
            </div>
        </div>
    </div>
    
@endsection
