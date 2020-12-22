@extends('ui._layouts.app-auth')

@section('content')
<div class="card">
    <div class="card-header tx-18 font-weight-bold">Atur Ulang Password</div>

    <div class="card-body">
        <form method="POST" action="">
            @csrf
            {{-- <input type="hidden" name="token" value="{{ $token }}"> --}}

            <div class="form-group mb-2">
                <label for="email" class="text-md-right">Email Kamu</label>
                <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus>
            </div>
            <div class="form-group mb-2">
                <label for="password" class="text-md-right">Password Baru</label>
                <input id="password" type="password" class="form-control" name="password" value="" required  autofocus>
            </div>
            <div class="form-group mb-2">
                <label for="password2" class="text-md-right">Konfirmasi Password</label>
                <input id="password2" type="password2" class="form-control" name="password2" value="" required  autofocus>
            </div>
            <button type="submit" class="btn btn-lg btn-block btn-primary mb-2 mt-3">Atur Ulang Password</button>
        </form>
    </div>
</div>
@endsection
