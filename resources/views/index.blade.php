@extends('layouts.main')

@section('content')
    <!-- Masthead-->
    <header class="masthead">
        <div class="container d-flex h-100 align-items-center">
            <div class="mx-auto text-center">
                <h1 class="mx-auto my-0 text-uppercase">Grayscale</h1>
                <h2 class="text-white-50 mx-auto mt-2 mb-5">In here you can share your interesting travel experiences</h2>
                <a class="btn btn-primary js-scroll-trigger" href="{{ route('articles.create') }}">Write Now</a>
                <a class="btn btn-primary js-scroll-trigger" href="#blog">Read Now</a>
            </div>
        </div>
    </header>
    <!-- About-->
    <section class="about-section text-center" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-white mb-4">Ujian Tengah Semester</h2>
                    <p class="text-white-50">
                        Halo, Blog Website ini adalah tugas Ujian Tengah Semester mata kuliah Pemrograman Berbasis Framework. Disini kalian bisa
                        menulis cerita pengalaman kalian selama berwisata atau travelling 
                    </p>
                </div>
            </div>
            <img class="img-fluid" src="{{ asset('img/ipad.png') }}" alt="" />
        </div>
    </section>
    <!-- Projects-->
    <section class="projects-section bg-light" id="blog">
        <div class="container">
            @if(Session::has('message'))
                <div class="alert alert-{{ Session::get('type') }} mb-4">
                    {{ Session::get('message') }}
                </div>
            @endif
            <!-- Featured Project Row-->
            @foreach ($articles as $article)
            <div class="row no-gutters mb-4 mb-lg-5">
                <div class="col-xl-6 col-lg-7"><img class="img-fluid mb-3 mb-lg-0" src="{{ asset('storage/'.$article->img) }}" alt="" /></div>
                <div class="col-xl-6 col-lg-5">
                    <div class="featured-text text-center text-lg-left pt-5">
                        <h4>{{ $article->title }}</h4>
                        <p class="text-black-50 mb-0">{!! substr(strip_tags($article->content), 0, 150) !!}</p>
                        <a class="btn btn-secondary" style="margin: 20px 0px;" href="{{ route('articles.show', $article->id) }}">detail</a>
                        <a class="btn btn-warning" href="{{ route('articles.edit', $article->id) }}">Ubah</a>
                        <a class="btn btn-danger" href="{{ route('articles.destroy', $article->id) }}"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
@endsection