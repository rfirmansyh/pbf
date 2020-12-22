@extends('ui._layouts._app-global')

@section('content-extends')
<section class="section">
    <div class="container mt-3 pt-4">
        <h4 class="text-center my-3">ABJA MITRA</h4>
        <div class="row justify-content-center">
            <div class="col-12 col-sm-8 col-lg-5">

            @yield('content')

            <div class="simple-footer">
                <a href="" class="d-block">Kembali Ke Halaman Utama</a>
                Copyright &copy; {{ env('APP_NAME') }} {{ date('Y') }}
            </div>
            </div>
        </div>
    </div>
</section>    
@endsection