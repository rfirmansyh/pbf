@extends('frontpage._layouts.app-frontpage')

@section('title', 'DOKUMENTASI')

@section('content')

    <header style="background-image: linear-gradient(94.27deg, #000000 -7.43%, rgba(6, 6, 6, 0) 175.99%), url({{ asset('img/frontpage/4.png') }}); min-height: 300px">
        <div class="container text-white py-10">
            <div class="row justify-content-center">
                <div class="col-xl-10 mb-6">
                    <h3 class="font-weight-semibold mb-5">Cara Penggunaan Perpus ID</h3>
                    <h6 class="font-weight-light">Gunakan Akun untuk Testing Berikut</h6>
                    <hr class="border-white">
                    <div class="row mb-3">
                        <div class="col-sm-3 col-md-2 col-xl-1"><h6 class="font-weight-light">Admin</h6></div>
                        <div class="col pl-sm-5">
                            <h6 class="font-weight-bold">admintest@gmail.com</h6>
                            <h6 class="font-weight-bold">123</h6>
                        </div>
                    </div>
                    <div class="row mb-5">
                        <div class="col-sm-3 col-md-2 col-xl-1"><h6 class="font-weight-light">Member</h6></div>
                        <div class="col pl-sm-5">
                            <h6 class="font-weight-bold">membertest@gmail.com</h6>
                            <h6 class="font-weight-bold">123</h6>
                        </div>
                    </div>
                    <a href="#title-docs" class="page-scroll btn btn-outline-white">Lihat Selanjutnya</a>
                </div>
            </div>
        </div>
    </header>
    
    <section id="section1">
        <div class="container py-10">
            <div class="card bg-light py-10">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <h4 class="mb-5" id="title-docs">Penjelasan Fitur Utama Perpus ID <b>Peminjaman</b></h4>

                            <h5 class="text-dark mb-5">1. Masuk Dengan Akun Testing Admin email <b>admintest@gmail.com</b>, password <b>123</b></h5>
                            <img src="{{ asset('img/frontpage/docs/2.png') }}" alt="" class="img-fluid mb-5">

                            <h5 class="text-dark mb-5">2. Kemudian akan diarahkan ke Dashboard Admin, buka menu Peminjaman pada Sidebar</h5>
                            <img src="{{ asset('img/frontpage/docs/4.png') }}" alt="" class="img-fluid mb-5">

                            <h5 class="text-dark mb-5">3. Klik Button Tambah Data Peminjama, kemudian isi data dan peminjaman pada akun member test, <b>membertest@gmail.com</b></h5>
                            <img src="{{ asset('img/frontpage/docs/5.png') }}" alt="" class="img-fluid mb-5">

                            <h5 class="text-dark mb-5">4. Klik menu peminjaman pada sidebar lagi, atau button semua peminjaman di pojok kanan atas pada form tambah data peminjaman, kemudian data baru sudah ditambahkan dengan status masih dipinjam</h5>
                            <img src="{{ asset('img/frontpage/docs/6.png') }}" alt="" class="img-fluid mb-5">

                            <h5 class="text-dark mb-5">5. Simulasi Pengembalian Buku, dengan pilih salah satu baris yang memiliki status masih dipinjam, kemudian button "Tandai Pengembalian" otomatis dapat di tekan</h5>
                            <img src="{{ asset('img/frontpage/docs/7.png') }}" alt="" class="img-fluid mb-5">

                            <h5 class="text-dark mb-5">6. Terdapat alert dialog konfirmasi Pengembalian buku, klik "Iya"</h5>
                            <img src="{{ asset('img/frontpage/docs/8.png') }}" alt="" class="img-fluid mb-5">

                            <h5 class="text-dark mb-5">7. Kemudian terdapat flash message bahwa buku berhasil dikembalikan, dan status peminjmanan berubah, jika telat "terlambat" jika tidak "dikembalikan"</h5>
                            <img src="{{ asset('img/frontpage/docs/9.png') }}" alt="" class="img-fluid mb-5">

                            <h5 class="text-dark mb-5">8. Masuk pada akun member dengan email "membertest@gmail.com" password "123"</h5>
                            <img src="{{ asset('img/frontpage/docs/11.png') }}" alt="" class="img-fluid mb-5">

                            <h5 class="text-dark mb-5">9. Masuk ke menu "peminjaman" maka akan ada data yang sudah dipinjam tersebut</h5>
                            <img src="{{ asset('img/frontpage/docs/10.png') }}" alt="" class="img-fluid mb-5">

                            <h5 class="text-dark mb-5">10. Terimakasih</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('style')
@endsection

@section('script')
    <script>
        $('.page-scroll').on('click', function (e) {
            let dec = $(this).attr('href');
            let getEl = $(dec);
            $('html,body').animate({
            scrollTop: getEl.offset().top - 10  
            }, 1000);
            e.preventDefault();
        })
    </script>
@endsection