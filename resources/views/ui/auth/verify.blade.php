@extends('ui._layouts.app-auth')

@section('content')
<div class="container">
    <div class="card card-success">
        <div class="card-header tx-18 font-weight-bold">Verifkasi Akun Email Kamu</div>

        <div class="card-body">
            <div class="alert alert-success" role="alert">
                Link verifikasi email sudah dikirim pada email kamu, check sekarang !
            </div>

            Sebelum Melanjutkan ke proses selanjutnya, cek email kamu terlebih dahulu untuk memverifikasi.
            Jika kamu belum mendapatkan email verifikasi,
            <form class="d-inline" method="POST" action="">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Request link verifikasi email baru</button>.
            </form>
        </div>
    </div>
</div>
@endsection
