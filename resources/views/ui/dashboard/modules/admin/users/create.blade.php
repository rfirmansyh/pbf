@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Tambah Mitra Manual')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Mitra</a></div>
    <div class="breadcrumb-item">Tambah Mitra Manual</div>
@endsection
@section('content-header')
  <div class="row align-items-center">
        <div class="col-md"><h2 class="section-title">Form Tambah Mitra</h2></div>
        <div class="col-md-auto">
            <a href="{{ url('ui/dashboard/admin/users/') }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Batal</a>
        </div>
  </div>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body">
                    <div id="img-card">
                        <img src="" class="img-fluid" id="img-user">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" class="form-control" name="name" placeholder="johndoe">
                    </div>
                    <div class="form-group">
                        <label for="">Foto Profil</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile" onchange="openFile(event, '#img-user')">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="name" placeholder="johndoe">
                    </div>
                    <div class="form-group">
                        <label for="" class="d-flex align-items-center justify-content-between">Nomor Hp
                            <small id="emailHelp" class="form-text text-muted tx-10">Ex. 85748572354 (Tanpa awalan 0)</small>
                        </label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text" id="basic-addon2">+62</span>
                            </div>
                            <input type="tel" class="form-control" placeholder="Masukan Nomor">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Bio</label>
                        <textarea class="form-control" style="min-height: 100px"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <select class="custom-select mb-2">
                            <option selected>Pilih Provinsi</option>
                        </select>
                        <select class="custom-select mb-2">
                            <option selected>Pilih Kota/Kabupaten</option>
                        </select>
                        <select class="custom-select mb-2">
                            <option selected>Pilih Kecamatan</option>
                        </select>
                        <select class="custom-select mb-2">
                            <option selected>Pilih Desa</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Detail Alamat</label>
                        <textarea class="form-control" style="min-height: 100px"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="">Status Mitra</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="aktif" name="status" class="custom-control-input" value="0">
                            <label class="custom-control-label text-success font-weight-bold" for="aktif">Aktif</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="nonaktif" name="status" class="custom-control-input" value="1">
                            <label class="custom-control-label text-gray font-weight-bold" for="nonaktif">Nonaktif</label>
                        </div>
                    </div>
                    <button class="btn btn-lg btn-primary ml-auto d-block">Tambahkan</button>                    
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