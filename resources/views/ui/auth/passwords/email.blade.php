@extends('ui._layouts.app-auth')

@section('content')
<div class="card card-secondary">
    <div class="card-header tx-18 font-weight-bold">Atur Ulang Password</div>

    <div class="card-body">
        {{-- <div class="alert alert-success" role="alert"> Sukses </div> --}}

        <form method="POST" action="">

            <div class="form-group mb-2">
                <label for="email" class="text-md-right">Email Kamu</label>
                <input id="email" type="email" class="form-control" name="email" value="" required autocomplete="email" autofocus>
            </div>
            <button type="submit" class="btn btn-lg btn-block btn-primary mb-2 mt-3">Kirim Link Reset Password</button>
        </form>
    </div>
</div>
@endsection
