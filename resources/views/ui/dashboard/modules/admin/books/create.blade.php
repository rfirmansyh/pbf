@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Tambah Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Daftar Buku</a></div>
    <div class="breadcrumb-item">Tambah Buku</div>
@endsection
@section('content-header')
  <div class="row align-items-center">
        <div class="col-md"><h2 class="section-title">Form Tambah Buku</h2></div>
        <div class="col-md-auto">
            <a href="{{ url('ui/dashboard/mitra/budidaya/') }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Batal</a>
        </div>
  </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Foto Buku</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" onchange="openFile(event, '#img-budidaya')">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Judul Buku</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Kode Buku</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Penulis</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Penerbit</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Tahun Terbit</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Jumlah Stok</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Tempat Rak</label>
                        <input type="text" class="form-control" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Deskripsi Buku</label>
                        <textarea class="form-control" style="min-height: 100px"></textarea>
                    </div>
                    <button class="btn btn-lg btn-primary ml-auto d-block">Tambahkan</button>                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="img-card">
                        <img src="" class="img-fluid" id="img-budidaya">
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
            height: 320px;
            overflow: hidden;
            border-radius: 5px;
            display: flex; align-items: center; justify-content: center;
            position: relative;
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
            position: relative;
        }
    </style>
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
    <script>
        var openFile = function(event) {
            const input = event.target;
            const reader = new FileReader();
            reader.onload = function() {
                const dataURL = reader.result;
                const output = document.querySelector('#img-card > img');
                output.src = dataURL;
            }
            reader.readAsDataURL(input.files[0])
        }
    </script>
@endsection