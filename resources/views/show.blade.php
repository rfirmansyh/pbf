@extends('layouts.app')

@section('content')
    
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-10">
            <div class="card mb-5">
                <div class="card-body">
                    <img src="{{ asset('storage/'.$post->img) }}" alt="" class="card-img mb-4">
                    <h2 class="font-weight-bold mb-3"> {{ $post->title }}</h2> 
                    <h6 class="card-subtitle mb-2 text-muted">
                        <i class="far fa-calendar tx-12"></i> {{ (isset($post->created)) ? date('F n, Y - g:iA', strtotime($post->created)) : '-' }}
                    </h6>
                    <hr>
                    <p>
                        {!! $post->body !!}
                    </p>
                    <span class="text-secondary"><i class="fas fa-user mr-2"></i>{{ $post->author }}</span>
                </div>
            </div>

                
            <div class="row justify-content-sm-end">
                <div class="col-sm-auto">
                    <a href="{{ route('home.index') }}" class="btn btn-outline-secondary"><i class="fas fa-newspaper mr-2"></i>Lihat Semua Blog</a>
                </div>
            </div>
        </div>
    </div>

    
@endsection