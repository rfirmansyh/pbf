@extends('_layouts.app-auth')

@section('title', 'Masuk Sebagai Member')
@section('content')
    <div class="card card-primary">
        <div class="card-header tx-18 font-weight-bold">Selamat Datang Kembali</div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group mb-2">
                    <label for="email" class="text-md-right">Email Kamu</label>
                    <input 
                        type="email"
                        name="email" 
                        value="{{ old('email') }}"
                        id="email" 
                        class="form-control @error('email') is-invalid @enderror"  placeholder="Ex: johndoe@gmail.com"
                        required autocomplete="username" autofocus>
                    
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
                </div>

                @error('email')
                    <div class="text-danger tx-12 my-3" role="alert">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror

                <div class="d-flex align-items-center justify-content-between  mb-3">
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input 
                            {{ old('remember') ? 'checked' : '' }}
                            type="checkbox" 
                            name="remember"
                            class="custom-control-input" 
                            id="remember">
                        <label class="custom-control-label" for="remember">Ingat Saya ?</label>
                    </div>
                    @if (Route::has('password.request'))
                    <a class="ml-auto" data-toggle="modal" data-target="#m-forget"> Lupa Password ? </a>
                    @endif
                </div>

                <button type="submit" class="btn btn-lg btn-block btn-primary mb-2 mt-5">Masuk Sekarang</button>
            </form>
            <a href="{{ route('register') }}" class="btn btn-lg btn-block btn-outline-secondary">Belum Punya Akun</a>
        </div>
    </div>
@endsection

@section('modal')
<div class="modal fade" id="m-forget" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Lupa Password ?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="alert alert-info py-4">
              Silahkan Menuju atau Menemui atau Menghubungi salah satu Admin PERPUS ID
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection
