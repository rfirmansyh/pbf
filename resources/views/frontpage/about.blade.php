@extends('frontpage._layouts.app-frontpage')

@section('title', 'TENTANG')

@section('content')
    <header style="background-image: linear-gradient(94.27deg, #000000 -7.43%, rgba(6, 6, 6, 0) 175.99%), url({{ asset('img/frontpage/2.png') }});">
        <div class="container text-center text-white py-10">
            <div class="row justify-content-center">
                <div class="col-xl-10 mb-6">
                    <h2 class="font-weight-semibold mb-5">Web PERPUS.ID dibuat untuk Memenuhi UAS Pemrogaman Berbasis Framework</h2>
                    <h5 class="font-weight-light">Dengan tema bebas kami berinisiatif membuat web perpustakaan karena mudah, serta tidak memakan banyak waktu, kami juga menyediakan dokumentasi dari web kami</h5>
                </div>
                <div class="col-lg-10 col-xl-6">
                    <a href="{{ route('frontpage.documentation') }}" class="btn btn-outline-white">Lihat Dokumentasi</a>
                </div>
            </div>
        </div>
    </header>

    <section id="section1">
        <div class="container py-10">
            <div class="row justify-content-between">
                <div class="col-lg-5">
                    <img src="{{ asset('img/frontpage/3.png') }}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 pt-5">
                    <h4 class="text-dark font-weight-bold mb-5">Latar Belakang</h4>
                    <h5 class="text-grey font-weight-normal">Web ini terinspirasi dari perpustakaan keliling dimana dapat meminjam buku jika stock buku tersebut ada, akan tetapi semuanya dioperasikan oleh admin</h5>
                </div>
            </div>
        </div>
    </section>

    <section id="section2">
        <div class="container py-10">
            <h4 class="text-dark text-center font-weight-bold mb-6">Anggota Kelompok</h4>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-0 text-center">
                    <img src="{{ asset('img/frontpage/3.png') }}" alt="" class="img-fluid mb-5">
                    <h5 class="text-dark font-weight-bold mb-5">Rahmad Firmansyah</h5>
                    <h6 class="text-grey font-weight-normal">182410102024</h6>
                </div>
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-0 text-center">
                    <img src="{{ asset('img/frontpage/3.png') }}" alt="" class="img-fluid mb-5">
                    <h5 class="text-dark font-weight-bold mb-5">Febria Erliana</h5>
                    <h6 class="text-grey font-weight-normal">182410102003</h6>
                </div>
                <div class="col-md-6 col-lg-4 mb-5 mb-lg-0 text-center">
                    <img src="{{ asset('img/frontpage/3.png') }}" alt="" class="img-fluid mb-5">
                    <h5 class="text-dark font-weight-bold mb-5">Melina CW</h5>
                    <h6 class="text-grey font-weight-normal">182410102001</h6>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('style')
<style>
    #img-card {
        border-radius: 5px;
        width: 140px;
        height: 150px;
        overflow: hidden;
    }
    #img-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    @media screen and (max-width: 991.98px) {
        #img-card {
            width: 220px;
            margin-bottom: 25px;
        }
    }
    @media screen and (max-width: 575.98px) {
        #img-card {
            width: 100%;
            height: 440px;
            margin-bottom: 25px;
        }
    }
</style>
@endsection