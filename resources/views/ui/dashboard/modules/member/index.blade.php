@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Selamat Datang, di Perpus ID!')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection
@section('content-header')
  <div class="row align-items-center">
		<div class="col-md"><h2 class="section-title">Dashboard</h2></div>
  </div>
@endsection


@section('content')

    {{-- widget --}}
    <div class="row">
                <div class="col-md">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                    <i class="far fa-newspaper"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Buku Dipinjam</h4>
                    </div>
                    <div class="card-body">
                        10
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-md">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                    <i class="fas fa-shopping-basket"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Buku Dikembalikan</h4>
                    </div>
                    <div class="card-body">
                        42
                    </div>
                    </div>
                </div>
                </div>
                <div class="col-md">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                    <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Buku Terlambat</h4>
                    </div>
                    <div class="card-body">
                        1,201
                    </div>
                    </div>
                </div>
                </div>
@endsection