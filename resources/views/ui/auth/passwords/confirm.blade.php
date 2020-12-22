@extends('ui._layouts.app-auth')

@section('content')
<div class="card card-warning">
    <div class="card-header tx-18 font-weight-bold">Konfirmasi Password</div>

    <div class="card-body">
        Pastikan Konfirmasi Password terlebih dahulu sebelum lanjut ke proses berikutnya

        <form method="POST" action="">
            @csrf

            <div class="form-group mb-2">
                <label for="password" class="text-md-right">Password</label>
                <input id="password" type="password" class="form-control" name="password" value="" required  autofocus>
            </div>
            <button type="submit" class="btn btn-lg btn-block btn-primary mb-3 mt-4">Konfirmasi Password</button>
            <a class="d-block text-center" href=""> Lupa Password ? </a>
        </form>
    </div>
</div>
@endsection
