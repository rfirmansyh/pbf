@extends('dashboard._layouts.app-dashboard')

@section('title', 'Detail Buku')

@section('header', 'Detail Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Detail Buku</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection 
@section('content-header')
  <div class="row gutters-xs align-items-center">
        <div class="col-md"><h2 class="section-title">Baca Detail </h2></div>
        <div class="col-md-auto">
            <a href="{{ url()->previous() }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Kembali</a>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.member.books.index') }}" class="btn btn-block btn-lg btn-outline-primary"><i class="fas fa-book mr-2"></i> Semua Buku</a>
        </div>
  </div>
@endsection

@section('content')

    <div class="card card-body mb-0 rounded-lg">
        <div class="row justify-content-center">
            <div class="col-lg-auto mb-md-0">
                <div id="img-card" class="shadow-light p-3 rounded">
                    @if ($book->photo)
                        <img src="{{ asset('storage/'.$book->photo) }}" alt="">
                    @else
                        <img src="{{ asset('img/books/default.png') }}" alt="">
                    @endif
                </div>
            </div>
            <div class="col-lg-7 pt-3">
                <div class="row mb-3">
                    <div class="col">
                        <h4 class="mb-0">{{ $book->title }}</h4>
                    </div>

                </div>
                <div class="d-flex align-items-center mb-3">Jumlah Stok:
                    <div class="badge badge-warning  ml-2">{{ $book->stock }}</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Penulis :
                    <div class="font-weight-bold">{{ $book->writer }}</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Penerbit :
                    <div class="font-weight-bold">{{ $book->publisher }}</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Tahun Terbit :
                    <div class="font-weight-bold">{{ $book->year_published }}</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Kode Buku :
                    <div class="font-weight-bold">{{ $book->code }}</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Posisi Rak :
                    <div class="font-weight-bold"><strong>{{ $book->rak->name }}</strong> | {{ $book->rak->location }}</div>
                </div>
                <div class="border-bottom mb-3 pb-1">Deskripsi Buku :
                    <div class="font-weight-bold">{{ $book->description }}</div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('style')
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <style>
        #img-card {
            width: 240px;
            height: 240;
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
				height: auto;
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