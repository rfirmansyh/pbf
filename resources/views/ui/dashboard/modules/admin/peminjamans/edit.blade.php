@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Edit Peminjaman Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Peminjaman</a></div>
    <div class="breadcrumb-item">Edit Peminjam Buku</div>
@endsection
@section('content-header')
  <div class="row align-items-center">
        <div class="col-md"><h2 class="section-title">Form Edit Peminjam Buku</h2></div>
        <div class="col-md-auto">
            <a href="{{ url('ui/dashboard/admin/peminjamans/') }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Batal</a>
        </div>
  </div>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-auto">
        <div class="card">
                <div class="card-body">
                     <h6>Foto Buku</h6>
                    <div id="img-card">
                        <img src="{{ asset('img/laravel.jpg') }}" class="img-fluid" id="img-user">
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                     <h6>Foto Member</h6>
                    <div id="img-card">
                        <img src="{{ asset('img/users/2.jpg') }}" class="img-fluid" id="img-user">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                <div class="form-group">
                        <label for="">Buku Yang Dipinjam</label>
                        <input 
                            type="text" 
                            name="name"
                            value="Belajar Laravel"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Nama Peminjam</label>
                        <input 
                            type="text" 
                            name="name"
                            value="Chelsea Olivier"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Peminjaman</label>
                        <input 
                            data-input="datetimepicker"
                            type="text" 
                            name="name"
                            value="12/25/2020 5:54 PM"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Kembali</label>
                        <input 
                            data-input="datetimepicker"
                            type="text" 
                            name="name"
                            value="01/02/2020 5:54 PM"
                            class="form-control">
                    </div>
                    <button class="btn btn-lg btn-warning ml-auto d-block">Ubah Peminjaman</button>                    
                </div>
            </div>
        </div>
    </div>

    
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <style>
        #img-card {
            width: 180px;
            height: 180px;
            overflow: hidden;
            border-radius: 5px;
            display: flex; align-items: center; justify-content: center;
            position: relative;
            border-radius: 50%;
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
    </style>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
@endsection