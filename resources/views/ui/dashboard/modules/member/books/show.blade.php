@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Detail Buku')

@section('header', 'Detail Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Detail Buku</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection 

@section('content')

    <div class="card card-body mb-0 rounded-lg">
        <div class="row justify-content-center">
            <div class="col-auto mb-md-0">
                <div class="shadow-light p-3 rounded">
                    <img src="{{ asset('img/laravel.jpg') }}" alt="">
                </div>
            </div>
            <div class="col-lg-7 pt-3">
                <div class="row mb-3">
                    <div class="col">
                        <h3 class="mb-0">Belajar Laravel</h3>
                    </div>

                </div>
                <div class="d-flex align-items-center mb-3">Jumlah Stok:
                    <div class="badge badge-warning  ml-2">04</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Penulis :
                    <div class="font-weight-bold">johndoe@mail.com</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Penerbit :
                    <div class="font-weight-bold">PT Elex Media Komputindo</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Tahun Terbit :
                    <div class="font-weight-bold">2012</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Kode Buku :
                    <div class="font-weight-bold">01234</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Posisi Rak :
                    <div class="font-weight-bold">23</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Deskripsi Buku :
                    <div class="font-weight-bold">Buku dengan judul Belajar Laravel ini merupakan buku 
                    dasar dalam mempelajari framework PHP dengan Laravel yang saat ini sedang populer. 
                    Dengan buku ini, tandanya Anda sudah belajar sampai tingkat menengah.</div>
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