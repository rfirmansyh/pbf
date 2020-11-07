@extends('layouts.app')

@section('content')
    
<div class="container py-5">
    <div class="row mb-5">
        @for ($startPage; $startPage < $endPage; $startPage++)
        <div class="col-md-6 mb-3">
            <div class="card">
                <img src="{{ asset('storage/'.$posts[$startPage]->img) }}" alt="" class="img-fluid">
                <div class="card-body">
                    <h5 class="card-title mb-4">{{ $posts[$startPage]->title }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">
                        <i class="far fa-calendar tx-12"></i> {{ (isset($posts[$startPage]->created)) ? date('F n, Y - g:iA', strtotime($posts[$startPage]->created)) : '-' }}
                    </h6>
                    <p class="card-text">
                        {{-- {!! $post->body !!} --}}
                        {!! substr($posts[$startPage]->body, 0, 250).( (strlen($posts[$startPage]->body) > 50) ? '...' : ''  ) !!}
                    </p>
                    <div class="text-secondary tx-12 mb-3"><i class="fas fa-user mr-2"></i>{{ $posts[$startPage]->author }}</div>
                    <a href="{{ route('home.show', $posts[$startPage]->id) }}" class="card-link text-right d-block">Detail <i class="fas fa-arrow-right  tx-12"></i></a>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <div class="row justify-content-center justify-content-md-end">
        <div class="col-auto">
            {{ $posts->links() }}
        </div>
    </div>
</div>

@endsection