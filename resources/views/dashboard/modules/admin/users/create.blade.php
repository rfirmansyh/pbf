@extends('dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Tambah Member Baru')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Anggota</a></div>
    <div class="breadcrumb-item">Tambah Anggota Baru</div>
@endsection
@section('content-header')
  <div class="row gutters-xs align-items-center">
        <div class="col-md"><h2 class="section-title">Form Tambah Anggota Baru</h2></div>
        <div class="col-md-auto">
            <a href="{{ url()->previous() }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Batal</a>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.admin.users.index') }}" class="btn btn-block btn-lg btn-outline-primary"><i class="fas fa-user mr-2"></i> Semua Anggota</a>
        </div>
  </div>
@endsection

@if (\Auth::user()->email !== 'fsyah7052@gmail.com')
@section('content')
    <div class="alert alert-danger p-3 p-md-5">
        <strong>Akun ini tidak memiliki Akses untuk menambah data Pengguna</strong>
    </div>
@endsection
@else
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body">
                    <div id="img-card">
                        <img src="" class="img-fluid" id="img-user">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('dashboard.admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Foto Anggota</label>
                            <div class="custom-file">
                                <input 
                                    name="photo"
                                    type="file" 
                                    class="custom-file-input" 
                                    id="customFile" onchange="openFile(event, '#img-user')">
                                <label class="custom-file-label" for="customFile">Choose file</label>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="">Nama Lengkap</label>
                            <input
                                value="{{ old('name') }}" 
                                name="name" 
                                type="text" 
                                class="form-control @error('name') is-invalid @enderror" 
                                placeholder="johndoe">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="">Email</label>
                            <input 
                                value="{{ old('email') }}" 
                                name="email"
                                type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                placeholder="johndoe123@gmail.com">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="">Password</label>
                            <input
                                name="password"
                                type="password" 
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="">Nomor Hp</label>
                            <input
                                value="{{ old('phone') }}" 
                                name="phone" 
                                type="tel" 
                                class="form-control @error('phone') is-invalid @enderror" 
                                placeholder="Masukan Nomor">
                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea 
                                name="address"
                                rows="3" 
                                class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
    
                        <div class="form-group">
                            <label for="">Status</label>
                            <div class="custom-control custom-radio">
                                <input
                                    {{ old('status') === '1' ? 'checked' : '' }} 
                                    name="status"
                                    id="aktif"
                                    type="radio" 
                                    class="custom-control-input @error('status') is-invalid @enderror" value="1">
                                <label class="custom-control-label text-success font-weight-bold" for="aktif">Aktif</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input
                                    {{ old('status') === '0' ? 'checked' : '' }}  
                                    name="status"
                                    id="nonaktif"
                                    type="radio" 
                                    class="custom-control-input @error('status') is-invalid @enderror" value="0">
                                <label class="custom-control-label text-gray font-weight-bold" for="nonaktif">Nonaktif</label>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="">Role Anggota</label>
                            <select 
                                name="role_id" 
                                id="role_id" 
                                class="selectpicker @error('role_id') is-invalid @enderror"
                                data-style="form-control" data-width="100%" data-live-search="true" data-live-search-placeholder="Cari Buku...">
                                    @foreach ($roles as $role)
                                        <option {{ old('role_id') === $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-lg btn-primary ml-auto d-block">Tambahkan</button>                    
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@endif

@section('style')
    <style>
        #img-card {
            width: 180px;
            height: 180px;
            overflow: hidden;
            border-radius: 5px;
            display: flex; align-items: center; justify-content: center;
            position: relative;
            border-radius: 5px;
            background-color: gainsboro;
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
            border: none;
            position: relative;
        }
    </style>
@endsection

@section('script')
@endsection