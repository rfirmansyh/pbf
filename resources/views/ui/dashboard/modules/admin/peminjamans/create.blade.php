@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Tambah Peminjaman Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Peminjaman</a></div>
    <div class="breadcrumb-item">Tambah Peminjaman Buku</div>
@endsection
@section('content-header')
  <div class="row align-items-center">
        <div class="col-md"><h2 class="section-title">Form Tambah Peminjaman Buku</h2></div>
        <div class="col-md-auto">
            <a href="{{ url('ui/dashboard/admin/peminjamans/') }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Batal</a>
        </div>
  </div>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
<<<<<<< Updated upstream
                     <div class="form-group">
                        <label for="">Buku Yang Dipinjam</label>
=======
                    <div class="form-group">
                        <label for="">Nama Buku</label>
>>>>>>> Stashed changes
                        <select name="" id="" class="selectpicker" data-style="form-control" data-width="100%" data-live-search="true">
                            <option value="">Buku Laravel</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Nama Peminjam</label>
                        <select name="" id="" class="selectpicker" data-style="form-control" data-width="100%" data-live-search="true">
                            <option value="">Chelsea Olivier</option>
                        </select>
                    </div>
                    <div class="form-group">
<<<<<<< Updated upstream
                        <label for="">Tanggal Peminjaman</label>
                        <input data-input="datetimepicker" type="text" class="form-control" name="name" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="">Tanggal Kembali</label>
                        <input data-input="datetimepicker" type="text" class="form-control" name="name" autocomplete="off">
=======
                        <label class="control-label" for="date">Tanggal Peminjaman</label>
                        <input class="form-control" id="date" name="date"  type="date"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label" for="date">Tanggal Pengembalian</label>
                        <input class="form-control" id="date" name="date"  type="date"/>
>>>>>>> Stashed changes
                    </div>
                    <button class="btn btn-lg btn-primary ml-auto d-block">Tambahkan</button>                    
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
                                <img src="" class="img-fluid" id="img-user">
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
    </style>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
@endsection