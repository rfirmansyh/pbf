@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Daftar Buku')

@section('header', 'Daftar Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Buku Perpustakaan</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection
@section('content-header')
  <div class="row align-items-center">
		<div class="col-md"><h2 class="section-title">Daftar Buku Perpus ID</h2></div>
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
                        <div class="card-header tx-18 font-weight-bold"> Belajar Laravel  </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-auto">
                                    <div id="img-card">
                                        <img src="{{ asset('img/laravel.jpg') }}" alt="">
									</div>
                                </div>
                                <div class="col-lg">
                                    <div class="border-bottom mb-1 pb-1"> Kode Buku: 
                                    <div class="font-weight-bold"> 01234 </div>
                                    </div>
                                    <div class="border-bottom mb-1 pb-1">Penulis :
                                        <div class="font-weight-bold"> SomePeople </div>
                                    </div>
                                    <div class="border-bottom mb-1 pb-1"> Stok Buku :
                                        <div class="font-weight-bold">010</div>
                                    </div>
                                    <div class="">Deskripsi Buku :
                                        <div class= "font-weight-bold">Buku dengan judul Belajar Laravel ini merupakan buku 
                                        dasar dalam...</div>
                                    </div>
                                </div>
                            </div>
						</div>
						<div class="card-footer border-top border-light d-flex justify-content-end">
							<a href="{{ url('ui/dashboard/member/books/show') }}" class="btn btn-sm btn-primary">Detail</a>
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