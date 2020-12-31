@extends('dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Daftar Rak')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Daftar Rak</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection
@section('content-header')
  <div class="row align-items-center">
		<div class="col-md"><h2 class="section-title">Daftar Rak</h2></div>
		<div class="col-md-auto">
        	<a href="{{ route('dashboard.admin.raks.create') }}" class="btn btn-block btn-lg btn-primary"><i class="fas fa-plus mr-2"></i> Tambah Rak Baru</a>
        </div>
  </div>
@endsection

@if ($raks)
@section('content')

{{-- if widget added --}}
{{-- end of if widget added --}}

{{-- filter --}}
<div class="card card-primary">
    <div class="card-body">
        <form action="{{ url()->current() }}" method="get">
        <div class="row align-items-end gutters-xs border-bottom pb-4 mb-5"> 
            <div class="col-md">
                <div class="form-group mb-md-0">
                    <label for="">Cari Rak</label>
                    <input 
                        name="search"
                        type="text" 
                        class="form-control" placeholder="Masukan Nama atau Lokasi Rak Untuk Dicari" autofocus>
                </div>
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-block btn-lg btn-outline-primary">Proses Filter</button>
            </div>
        </div>
        </form>

        <div class="row">
            @foreach ($raks as $rak)
            <div class="col-lg-4 mb-5">
                <div class="card card-secondary">
                    <div class="card-body">
                        <div id="img-card" class="mb-4">
                            @if ($rak->photo)
                                <img src="{{ asset('storage/'.$rak->photo) }}" alt="">
                            @else
                                <img src="{{ asset('img/raks/default.png') }}" alt="">
                            @endif
                        </div>
                        <div class="border-bottom mb-1 pb-1"> Nama Rak: 
                            <div class="font-weight-bold"> {{ $rak->name }} </div>
                        </div>
                        <div class="border-bottom mb-1 pb-1"> Lokasi Rak: 
                            <div class="font-weight-bold"> {{ $rak->location }} </div>
                        </div>
                    </div>
                    <div class="card-footer border-top border-light d-flex justify-content-end">
                        <a href="{{ route('dashboard.admin.raks.edit', $rak) }}" class="btn btn-sm btn-warning mr-1">Ubah</a>
                        <a href="{{ route('dashboard.admin.raks.show', $rak) }}" class="btn btn-sm btn-primary">Detail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
{{-- end of filter --}}

<div class="row justify-content-center justify-content-md-end">
    <div class="col-auto">{{$raks->appends(Request::all())->links()}}</div>
</div>   

@endsection
@else
@section('content')
<div class="container py-5 text-center">
    Tidak ada Rak
</div>
@endsection
@endif



@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <style>
        #img-card {
            border-radius: 5px;
            width: 100%;
            height: 150px;
            overflow: hidden;
        }
        #img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        @media screen and (max-width: 575.98px) {
            #img-card {
				height: 240px;
                margin-bottom: 25px;
            }
        }
    </style>
@endsection

@section('script')
@endsection