@extends('dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Ubah Member Baru')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Anggota</a></div>
    <div class="breadcrumb-item">Ubah Data Anggota</div>
@endsection
@section('content-header')
  <div class="row gutters-xs align-items-center">
        <div class="col-md"><h2 class="section-title">Form Ubah Data Anggota</h2></div>
        <div class="col-md-auto">
            <a href="{{ url()->previous() }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Batal</a>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.member.index') }}" class="btn btn-block btn-lg btn-outline-primary"><i class="fas fa-compass mr-2"></i> Dashboard</a>
        </div>
  </div>
@endsection

@if (\Auth::user()->email === 'membertest@gmail.com')
@section('content')
<div class="alert alert-danger p-3 p-md-5">
    <strong>Akun ini tidak untuk di edit", kalau mau edit silahkah daftar dengan akun anda sendiri</strong>
</div>
@endsection
@else
@section('content')
    
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body">
                    <div id="img-card">
                        @if ($user->photo)
                            <img src="{{ asset('storage/'.$user->photo) }}" alt=" " id="img-user">
                        @else
                            <img src="{{ asset('img/users/default.png') }}" alt=" " id="img-user">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <form action="{{ route('dashboard.member.profile.update', $user) }}" method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')
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
                                value="{{ old('name') ? old('name') : $user->name }}" 
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
                                value="{{ $user->email }}"  
                                type="text"
                                class="form-control" disabled>
                        </div>

                        <div class="form-group">
                            <label for="">Nomor Hp</label>
                            <input
                                value="{{ old('phone') ? old('phone') : $user->phone }}" 
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
                                class="form-control @error('address') is-invalid @enderror">{{ old('address') ? old('address') : $user->address }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button class="btn btn-lg btn-primary ml-auto d-block">Ubah</button>                    
                    </div>
                </div>
            </form>

            <a data-toggle="collapse" href="#c-password" class="tx-12 font-weight-bold" style="color: rgb(157, 157, 157);">Ganti Password ?</a>

            <div class="collapse @error('password') show @enderror" id="c-password">
                <div class="card mt-5">
                    <div class="card-body">
                        <form action="{{ route('dashboard.member.profile.changepassword', $user) }}" method="POST">
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label for="">Password Baru</label>
                                <div class="input-group input-group-password">
                                    <input 
                                        type="password" 
                                        name="password"
                                        class="form-control @error('password') is-invalid @enderror">
                                    <div class="input-group-append">
                                        <span class="input-group-text text-secondary csr-pointer" id="basic-addon2"><i class="fa fa-eye"></i></span>
                                    </div>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-lg btn-warning ml-auto d-block">Ubah Passsword</button>
                        </form>
                    </div>
                </div>
            </div>
            
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