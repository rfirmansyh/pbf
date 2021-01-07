@extends('dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Edit Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Daftar Buku</a></div>
    <div class="breadcrumb-item">Edit Buku</div>
@endsection
@section('content-header')
  <div class="row gutters-xs align-items-center">
        <div class="col-md"><h2 class="section-title">Form Edit Buku</h2></div>
        <div class="col-md-auto">
            <a href="{{ url()->previous() }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Batal</a>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.admin.books.index') }}" class="btn btn-block btn-lg btn-outline-primary"><i class="fas fa-book mr-2"></i> Semua Buku</a>
        </div>
  </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.admin.books.update', $book) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="">Foto Buku</label>
                            <div class="custom-file">
                                <input 
                                    name="photo"
                                    type="file" 
                                    class="custom-file-input" 
                                    id="customFile" onchange="openFile(event, '#img-book')">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Judul Buku</label>
                            <input 
                                value="{{ old('title') ? old('title') : $book->title }}"
                                name="title"
                                type="text"
                                class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Kode Buku</label>
                            <input 
                                value="{{ old('code') ? old('code') : $book->code }}"
                                name="code"
                                type="text" 
                                class="form-control @error('code') is-invalid @enderror">
                            @error('code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penulis</label>
                            <input 
                                value="{{ old('writer') ? old('writer') : $book->writer }}"
                                name="writer"
                                type="text" 
                                class="form-control @error('writer') is-invalid @enderror">
                            @error('writer')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Penerbit</label>
                            <input
                                value="{{ old('publisher') ? old('publisher') : $book->publisher }}"
                                name="publisher" 
                                type="text" 
                                class="form-control @error('publisher') is-invalid @enderror">
                            @error('publisher')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tahun Terbit</label>
                            <input
                                value="{{ old('year_published') ? old('year_published') : $book->year_published }}"
                                name="year_published"
                                type="text" 
                                class="yearpicker form-control @error('year_published') is-invalid @enderror">
                            @error('year_published')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Jumlah Stok</label>
                            <input
                                value="{{ old('stock') ? old('stock') : $book->stock }}"
                                name="stock" 
                                type="number" 
                                class="form-control @error('stock') is-invalid @enderror">
                            @error('stock')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tempat Rak</label>
                            <select
                                name="rak_id" 
                                class="selectpicker @error('rak_id') is-invalid @enderror"
                                title="Pilih Rak" 
                                data-live-search="true"
                                data-live-search-placeholder="Cari Rak..."
                                data-style="form-control" data-width="100%">
                                    @foreach ($raks as $rak)
                                        <option {{ $book->rak_id === $rak->id ? 'selected' : '' }} value="{{ $rak->id }}">{{ $rak->name }}</option>
                                    @endforeach
                            </select>
                            @error('rak_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Deskripsi Buku</label>
                            <textarea 
                                name="description"
                                class="form-control" style="min-height: 100px">{{ $book->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary ml-auto d-block">Ubah</button>
                    </form>                    
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div id="img-card">
                        @if ($book->photo)
                            <img src="{{ asset('storage/'.$book->photo) }}" alt=" " id="img-book">
                        @else
                            <img src="{{ asset('img/books/default.png') }}" alt=" " id="img-book">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('vendors/jquery-yearpicker/yearpicker.css') }}">
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
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: relative;
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('vendors/jquery-yearpicker/yearpicker.js') }}"></script>
    <script>
        $(function() {
            $(".yearpicker").yearpicker({
                year: null,
                startYear: 1980,
                endYear: 2050,
            });
        })
    </script>
@endsection