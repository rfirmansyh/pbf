@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Tambah Tempat Budidaya Saya')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Tempat Budidaya</a></div>
    <div class="breadcrumb-item">Ubah Tempat Budidaya</div>
@endsection
@section('content-header')
  <div class="row align-items-center">
        <div class="col-md"><h2 class="section-title">Form Ubah Tempat Budidaya</h2></div>
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
                        <label for="">Foto Tempat</label>
                        <div class="custom-file">
                            <input 
                                type="file"
                                name="photo"
                                id="photo" 
                                onchange="openFile(event, '#img-budidaya')"
                                class="custom-file-input">
                            <label class="custom-file-label" for="photo">Choose file</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name">Nama Tempat</label>
                        <input 
                            type="text" 
                            name="name" 
                            value=""
                            placeholder="Contoh : Budidaya Jamur Sumber Jaya Jember" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Luas</label>
                        <div class="input-group mb-3">
                            <input 
                                type="number" 
                                name="large"
                                value=""
                                class="form-control" placeholder="Masukan Luas">
                            <div class="input-group-append">
                              <span class="input-group-text" id="basic-addon2">M2</span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Status Tempat</label>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="aktif" name="status" class="custom-control-input">
                            <label class="custom-control-label text-success font-weight-bold" for="aktif">Aktif</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input type="radio" id="nonaktif" name="status" class="custom-control-input">
                            <label class="custom-control-label text-gray font-weight-bold" for="nonaktif">Nonaktif</label>
                        </div>
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
                        <textarea 
                            name="detail"
                            class="form-control" style="min-height: 100px"></textarea>
                    </div>
                    <button class="btn btn-lg btn-warning ml-auto d-block">Ubah</button>                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="img-card">
                        <img src="{{ asset('img/budidaya/2.jpg') }}" class="img-fluid" id="img-budidaya">
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
            position: relative;
            width: 100%;
            height: 100%;
            object-fit: cover;
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
                const output =  document.querySelector('#img-card > img');
                output.src = dataURL;
                console.log(output.src)
            }
            reader.readAsDataURL(input.files[0])
        }
    </script>
@endsection