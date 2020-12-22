@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Detail Tempat Budidaya Saya')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Tempat Budidaya</a></div>
    <div class="breadcrumb-item">Budidaya Sumber Maju Jember</div>
@endsection
@section('content-header')
	<div class="row align-items-center">
		<div class="col-md"><h2 class="section-title">Detain Rincian Data</h2></div>
		<div class="col-md-auto">
			<a href="{{ url('ui/dashboard/mitra/budidaya/') }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Tampilkan Semua Tempat</a>
		</div>
	</div>
@endsection

@section('content')

	<div class="row mb-5">
		<div class="col-md-auto mb-3 mb-md-0">
			<div id="img-card" class="shadow-light">
				<img src="{{ asset('img/budidaya/1.jpg') }}" alt="">
			</div>
		</div>
		<div class="col-md">
			<div class="card card-body mb-0">
				<div class="row">
					<div class="col"><h5>Budidaya Sumber Maju Jember</h5></div>
					<div class="col-auto"><a href="{{ url('ui/dashboard/mitra/budidaya/edit') }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a></div>
				</div>
				<div class="d-flex align-items-center mb-3">Status:
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

	{{-- widget --}}
    <div class="row">
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
					<i class="fas fa-warehouse"></i>
				</div>
				<div class="card-wrap">
					<div class="card-header">
						<h4>Total Kumbung</h4>
					</div>
					<div class="card-body">
						10
					</div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                	<i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
					<div class="card-header">
						<h4>Pekerja</h4>
					</div>
					<div class="card-body">
						20
					</div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="card-wrap">
					<div class="card-header">
						<h4>Total Pemasukan</h4>
					</div>
					<div class="card-body text-success">
						200.000.000
					</div>
                </div>
            </div>
        </div>
    </div>
	{{-- end of widget --}}
	
	{{-- chart --}}
	<div class="card">
		<div class="card-body">
			<div class="row align-items-center mb-4">
				<div class="col-md"><h4>Rincian Produksi Bulanan</h4></div>
				<div class="col-md-auto">
					<div class="d-flex align-items-center mb-0">
						<label for="" class="flex-shrink-0 mr-3 mt-1 font-weight-bolder">Pilih Tahun :</label>
						<select class="custom-select">
							<option selected>{{ date('Y') }}</option>
							@for ($i = 2018; $i < date('Y'); $i++)
								<option value="1">{{ $i }}</option>
							@endfor
						</select>
					</div>
				</div>
			</div>
			<div class="chart-container">
				<canvas id="dashboard-chart" height="182"></canvas>
			</div>
		</div>
	</div>


@endsection

@section('style')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <style>
        #img-card {
            width: 320px;
            height: 100%;
            overflow: hidden;
            border-radius: 5px;
        }
        #img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
		}
		@media screen and (max-width: 575.98px) {
            #img-card {
				width: 100%;
				height: 240px;
            }
        }
    </style>
@endsection

@section('script')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
	<script src="{{ asset('js/page/index-0.js') }}"></script>
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