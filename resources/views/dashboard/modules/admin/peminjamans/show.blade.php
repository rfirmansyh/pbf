@extends('dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Detail Pengembalian Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Peminjaman</a></div>
    <div class="breadcrumb-item">Detail Peminjaman Buku</div>
@endsection
@section('content-header')
  <div class="row gutters-xs align-items-center">
        <div class="col-md"><h2 class="section-title">Detail Peminjaman Buku</h2></div>
        <div class="col-md-auto">
            <a href="{{ url()->previous() }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.admin.peminjamans.index') }}" class="btn btn-block btn-lg btn-outline-primary"><i class="fas fa-newspaper mr-2"></i> Semua Peminjaman</a>
        </div>
  </div>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">DI Peminjaman</label>
                        <input type="text" class="form-control" value="{{ $peminjaman->id }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Buku Yang Dipinjam</label>
                        <input type="text" class="form-control" value="{{ $peminjaman->book->title }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Peminjam</label>
                        <input type="text" class="form-control" value="{{ $peminjaman->member->name }}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Pinjam</label>
                        <input
                            value="{{ \Carbon\Carbon::parse($peminjaman->borrowed_at)->format('m/d/Y h:i A') }}"
                            type="text"
                            class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Kembali</label>
                        <input
                            value="{{ \Carbon\Carbon::parse($peminjaman->returned_at)->format('m/d/Y h:i A') }}"
                            type="text"
                            class="form-control" disabled>
                    </div>
                    @php
                        $remaining = \Carbon\Carbon::parse($peminjaman->returned_at)->diffInDays(\Carbon\Carbon::now()).' Hari ';
                    @endphp
                    <div class="form-group">
                        <label for="">Sisa Hari</label>
                        @if ( \Carbon\Carbon::now()->diffInDays() < \Carbon\Carbon::parse($peminjaman->returned_at)->diffInDays() )
                            <div class="d-block badge badge-primary">{{ $remaining }}</div>
                        @elseif ( \Carbon\Carbon::now()->diffInDays() == \Carbon\Carbon::parse($peminjaman->returned_at)->diffInDays() )
                            <div class="d-block badge badge-warning">Hari ini</div>
                        @else
                            <div class="d-block badge badge-secondary">Habis</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="">Status Pengembalian</label>
                        @if ( $peminjaman->pengembalian && $peminjaman->pengembalian->returned_at < $peminjaman->returned_at )
                            <div class="d-block badge badge-success">Dikembalikan</div>
                        @elseif ( $peminjaman->pengembalian )
                            <div class="d-block badge badge-danger">Terlambat</div>
                        @else
                            <div class="d-block badge badge-secondary">Dipinjam</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xl-4 col-xl-auto">
            <div class="row">
                <div class="col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h6>Foto Buku</h6>
                            <div id="img-card">
                                @if ($peminjaman->book->photo)
                                    <img src="{{ asset('storage/'.$peminjaman->book->photo) }}" alt="">
                                @else
                                    <img src="{{ asset('img/books/default.png') }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h6>Foto Member</h6>
                            <div id="img-card">
                                @if ($peminjaman->member->photo)
                                    <img src="{{ asset('storage/'.$peminjaman->member->photo) }}" alt="">
                                @else
                                    <img src="{{ asset('img/users/default.png') }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <style>
        .img-table {
            width: 12px;
            height: 12px;
            overflow: hidden;
            border-radius: 5px;
        }
        .img-table img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #img-card {
            width: 100%;
            height: 220px;
            overflow: hidden;
            border-radius: 5px;
            display: flex; align-items: center; justify-content: center;
            position: relative;
            border-radius: 5px;
            background-color: gainsboro;
        }
        #img-card::before {
            content: 'No Image Upload';
            display: inline-block;
            position: absolute;
        }
        #img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: none;
            position: relative;
        }
        .dropdown-item .text {
            display: block !important;
        }
    </style>
@endsection

@section('script')
@endsection