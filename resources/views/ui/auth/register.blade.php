@extends('ui._layouts.app-auth')

@section('title', 'Registrasi Mitra')
@section('content')
    <div class="card card-primary">
        <div class="card-header tx-18 font-weight-bold">Daftar Akun</div>

        <div class="card-body">
            <form method="POST" action="">
                @csrf

                <div class="form-group mb-2">
                    <label for="email" class="text-md-right">Email Kamu</label>
                    <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus>
                </div>
                <div class="form-group mb-2">
                    <label for="username" class="text-md-right">Nama Lengkap</label>
                    <input id="username" type="username" class="form-control" name="username" value="" required autocomplete="username" autofocus>
                </div>
                <div class="form-group mb-2">
                    <label for="password" class="text-md-right">Password</label>
                    <input id="password" type="password" class="form-control" name="password" value="" required  autofocus>
                </div>
                <div class="form-group mb-2">
                    <label for="password" class="text-md-right">Konfirmasi Password</label>
                    <input id="password" type="password" class="form-control" name="password" value="" required  autofocus>
                </div>

                <button type="submit" class="btn btn-lg btn-block btn-primary mb-2 mt-5">Daftar Sekarang</button>
            </form>
            <a href="{{ route('login') }}" class="btn btn-lg btn-block btn-outline-primary">Sudah Punya Akun ?</a>
        </div>
    </div>
@endsection
