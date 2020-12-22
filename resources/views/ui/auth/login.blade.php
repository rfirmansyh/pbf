@extends('ui._layouts.app-auth')

@section('title', 'Masuk Sebagai Mitra')
@section('content')
    <div class="card card-primary">
        <div class="card-header tx-18 font-weight-bold">Selamat Datang Kembali</div>

        <div class="card-body">
            <form method="POST" action="">
                @csrf

                <div class="form-group mb-2">
                    <label for="email" class="text-md-right">Email Kamu</label>
                    <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="username" autofocus>
                </div>
                <div class="form-group mb-2">
                    <label for="password" class="text-md-right">Password</label>
                    <input id="password" type="password" class="form-control" name="password" value="" required  autofocus>
                </div>

                <div class="d-flex align-items-center justify-content-between  mb-3">
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" class="custom-control-input" id="customCheckDisabled1">
                        <label class="custom-control-label" for="customCheckDisabled1">Ingat Saya ?</label>
                    </div>
                    <a class="ml-auto" href="">Lupa Password ?</a>
                </div>

                <button type="submit" class="btn btn-lg btn-block btn-primary mb-2 mt-5">Masuk Sekarang</button>
            </form>
            <a href="{{ url('ui/register') }}" class="btn btn-lg btn-block btn-outline-secondary">Belum Punya Akun</a>
        </div>
    </div>
@endsection
