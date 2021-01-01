@extends('dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Daftar Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Daftar Buku</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection
@section('content-header')
  <div class="row align-items-center">
		<div class="col-md"><h2 class="section-title">Daftar Buku</h2></div>
		<div class="col-md-auto">
        	<a href="{{ route('dashboard.admin.books.create') }}" class="btn btn-block btn-lg btn-primary"><i class="fas fa-plus mr-2"></i> Tambah Buku Baru</a>
        </div>
  </div>
@endsection

@if ($books)
@section('content')

{{-- if widget added --}}
{{-- end of if widget added --}}

{{-- filter --}}
<div class="card card-primary">
    <div class="card-body">
        <form action="{{ Request::url() }}" method="get">
        <div class="row align-items-end gutters-xs border-bottom pb-4 mb-5"> 
            <div class="col-md">
                <div class="form-group mb-md-0">
                    <label for="">Cari Buku</label>
                    <input 
                        name="search"
                        type="text" 
                        class="form-control" placeholder="Masukan Nama Untuk Dicari" autofocus>
                </div>
            </div>
            <div class="col-md-auto">
                <button type="submit" class="btn btn-block btn-lg btn-outline-primary">Proses Filter</button>
            </div>
        </div>
        </form>

        <div class="row">
            @foreach ($books as $book)
            <div class="col-lg-6 mb-5">
                <div class="card card-success border-bottom h-100">
                    <div class="card-header tx-18 font-weight-bold">{{ $book->title }}</div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-auto">
                                <div id="img-card">
                                    @if ($book->photo)
                                        <img src="{{ asset('storage/'.$book->photo) }}" alt="">
                                    @else
                                        <img src="{{ asset('img/books/default.png') }}" alt="">
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg">
                                <div class="border-bottom mb-1 pb-1"> Kode Buku: 
                                    <div class="font-weight-bold"> {{ $book->code }} </div>
                                </div>
                                <div class="border-bottom mb-1 pb-1">Penulis :
                                    <div class="font-weight-bold"> {{ $book->writer }} </div>
                                </div>
                                <div class="border-bottom mb-1 pb-1"> Stok Buku : <br>
                                    @if ($book->stock > 30)
                                    <span class="badge badge-primary">{{ $book->stock }}</span>
                                    @elseif ($book->stock > 3)
                                    <span class="badge badge-info">{{ $book->stock }}</span>
                                    @else 
                                    <span class="badge badge-warning">{{ $book->stock }}</span>
                                    @endif
                                </div>
                                <div class="">Deskripsi Buku :
                                    <div class= "font-weight-bold"> {{ substr($book->description, 0, 80).( (strlen($book->description) > 80) ? '...' : ''  )  }} </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-top border-light d-flex justify-content-end">
                        <a href="{{ route('dashboard.admin.books.edit', $book) }}" class="btn btn-sm btn-warning mr-1">Ubah</a>
                        <a href="{{ route('dashboard.admin.books.show', $book) }}" class="btn btn-sm btn-primary">Detail</a>
                    </div>
                </div>
            </div> 
            @endforeach
        </div>
    </div>
</div>
{{-- end of filter --}}

<div class="row justify-content-center justify-content-md-end">
    <div class="col-auto">{{$books->appends(Request::all())->links()}}</div>
</div>   

@endsection
@else
@section('content')
<div class="container py-5 text-center">
    Tidak ada buku
</div>
@endsection
@endif



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