@extends('_layouts.app-auth')
@section('title', 'Gabung Menjadi Mitra')

@section('content')
    <div class="card card-primary">
        <div class="card-header tx-18 font-weight-bold">Daftar Akun</div>

        <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group mb-2">
                    <label for="email" class="text-md-right">Email Kamu</label>
                    <input 
                        id="email" 
                        type="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        name="email" value="{{ old('email') }}" 
                        required autocomplete="email" autofocus>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="name" class="text-md-right">Nama Lengkap</label>
                    <input 
                        id="name" 
                        type="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        name="name" value="{{ old('name') }}" required autocomplete="name">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="username" class="text-md-right">Nomor Hp</label>
                    <input 
                        id="phone" 
                        type="phone" 
                        class="form-control @error('phone') is-invalid @enderror" 
                        name="phone" value="{{ old('phone') }}" required>
                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="password" class="text-md-right">Password</label>
                    <div class="input-group input-group-password">
                        <input 
                            type="password" 
                            name="password"
                            class="form-control @error('password') is-invalid @enderror">
                        <div class="input-group-append">
                            <span class="input-group-text text-secondary csr-pointer" id="basic-addon2"><i class="fa fa-eye"></i></span>
                        </div>
                    </div>
                    @error('password')
                        <span class="text-danger text-sm" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group mb-2">
                    <label for="password" class="text-md-right">Konfirmasi Password</label>
                    <input 
                        id="password" 
                        type="password" 
                        class="form-control" 
                        name="password_confirmation" autocomplete="new-password" required>
                </div>

                <button type="submit" class="btn btn-lg btn-block btn-primary mb-2 mt-5">Daftar Sekarang</button>
            </form>
            <a href="{{ route('login') }}" class="btn btn-lg btn-block btn-outline-primary">Sudah Punya Akun ?</a>
        </div>
    </div>
@endsection
