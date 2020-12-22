@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Tempat Budidaya Saya')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Tempat Budidaya</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection
@section('content-header')
  <div class="row align-items-center">
		<div class="col-md"><h2 class="section-title">Daftar Tempat Budidaya Saya</h2></div>
		<div class="col-md-auto">
        	<a href="{{ url('ui/dashboard/mitra/budidaya/create') }}" class="btn btn-block btn-lg btn-primary"><i class="fas fa-plus mr-2"></i> Tambah Tempat Budidaya</a>
        </div>
  </div>
@endsection

@section('content')

    {{-- if widget added --}}
    {{-- end of if widget added --}}

    {{-- filter --}}
    <div class="card card-primary">
        <div class="card-body">
            <div class="row align-items-end gutters-xs border-bottom pb-4 mb-5"> 
                <div class="col-md">
                    <div class="form-group mb-md-0">
                        <label for="">Cari Buku</label>
                        <input type="text" class="form-control" placeholder="Masukan Nama Untuk Dicari">
                    </div>
                </div>
                <div class="col-md-auto">
                    <button class="btn btn-block btn-lg btn-outline-primary">Proses Filter</button>
                </div>
            </div>

            <div class="row">
                @for ($i = 0; $i < 2; $i++)
                <div class="col-lg-6">
                    <div class="card card-success border-bottom">
                        <div class="card-header tx-18 font-weight-bold"> Budidaya Sumber Maju Jember </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-auto">
                                    <div id="img-card">
                                        <img src="{{ asset('img/budidaya/'.($i+1).'.jpg') }}" alt="">
									</div>
                                </div>
                                <div class="col-lg">
                                    <div class="d-flex align-items-center border-bottom mb-1 pb-2">Status:
										<div class="badge badge-success  ml-2">Aktif</div>
                                    </div>
                                    <div class="border-bottom mb-1 pb-1">Detail Lokasi :
                                        <div class="font-weight-bold">Desa Kemiri Kecamatan Panti, Jember, Jawa Timur</div>
                                    </div>
                                    <div class="border-bottom mb-1 pb-1">Luas Tempat :
                                        <div class="font-weight-bold">10 M2</div>
                                    </div>
                                    <div class="">Tanggal Dibuat :
                                        <div class="font-weight-bold">8 Januari 2020</div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="card-footer border-top border-light d-flex justify-content-end">
							<a href="{{ url('ui/dashboard/mitra/budidaya/edit') }}" class="btn btn-sm btn-warning mr-1">Ubah</a>
							<a href="{{ url('ui/dashboard/mitra/budidaya/show') }}" class="btn btn-sm btn-primary">Detail</a>
						</div>
                    </div>
                </div>    
                @endfor
            </div>
        </div>
    </div>
    {{-- end of filter --}}

    
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <style>
        #img-card {
            border-radius: 5px;
            width: 140px;
            height: 150px;
            overflow: hidden;
        }
        #img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        @media screen and (max-width: 991.98px) {
            #img-card {
                width: 220px;
                margin-bottom: 25px;
            }
        }
        @media screen and (max-width: 575.98px) {
            #img-card {
				width: 100%;
				height: 240px;
                margin-bottom: 25px;
            }
        }
    </style>
@endsection

@section('script')
@endsection