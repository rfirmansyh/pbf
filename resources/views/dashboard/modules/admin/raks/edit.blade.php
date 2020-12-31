@extends('dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Ubah Rak')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Daftar Rak</a></div>
    <div class="breadcrumb-item">Ubah Rak</div>
@endsection
@section('content-header')
  <div class="row gutters-xs align-items-center">
        <div class="col-md"><h2 class="section-title">Form Ubah Rak</h2></div>
        <div class="col-md-auto">
            <a href="{{ url()->previous() }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Batal</a>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.admin.raks.index') }}" class="btn btn-block btn-lg btn-outline-primary"><i class="fas fa-th-list mr-2"></i> Semua Rak</a>
        </div>
  </div>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('dashboard.admin.raks.update', $rak) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        <div class="form-group">
                            <label for="">Foto Rak</label>
                            <div class="custom-file">
                                <input 
                                    name="photo"
                                    type="file" 
                                    class="custom-file-input" 
                                    id="customFile" onchange="openFile(event, '#img-rak')">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Nama Rak</label>
                            <input 
                                value="{{ old('name') ? old('name') : $rak->name }}"
                                name="name"
                                type="text"
                                class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Lokasi Rak</label>
                            <textarea 
                                name="location"
                                rows="3" 
                                class="form-control @error('location') is-invalid @enderror">{{ old('location') ? old('location') : $rak->location }}</textarea>
                            @error('location')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
                        @if ($rak->photo)
                            <img src="{{ asset('storage/'.$rak->photo) }}" alt="" id="img-rak">
                        @else
                            <img src="{{ asset('img/raks/default.png') }}" alt="" id="img-rak">
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection

@section('style')
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
@endsection