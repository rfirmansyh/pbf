@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Profile')

@section('header', 'Profile')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Profile</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection
@section('content-header')
	<div class="row align-items-center">
		<div class="col-md"><h2 class="section-title">Hai, John Doe</h2></div>
	</div>
@endsection

@section('content')

    <div class="card card-body mb-0 rounded-lg">
        <div class="row justify-content-center">
            <div class="col-auto mb-md-0">
                <div class="img-profile img-profile-md shadow-light p-3">
                    <img src="{{ asset('img/users/2.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-7 pt-3">
                <div class="row mb-3">
                    <div class="col">
                        <h3 class="mb-0">John Doe</h3>
                    </div>
                    <div class="col-auto"><a href="{{ url('ui/dashboard/member/profile/edit') }}" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a></div>
                </div>
                <div class="d-flex align-items-center mb-3">Status:
                    <div class="badge badge-success  ml-2">Aktif</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Email :
                    <div class="font-weight-bold">johndoe@mail.com</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Password :
                    <div class="font-weight-bold">johndoe123</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Nomor Hp :
                    <div class="font-weight-bold">085748572354</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Alamat :
                    <div class="font-weight-bold">Jalan PB Sudirman no.42</div>
                </div>
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