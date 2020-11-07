@extends('layouts.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-md">
            <h3 class="font-weight-bold text-dark">Detail Blog</h3>
            <h6 class="text-secondary">{{ $post->title }}</h6>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('posts.index') }}" class="btn btn-outline-primary"><i class="fas fa-arrow-left mr-2"></i> Semua Data Blog</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="font-weight-bold"> {{ $post->title }}</h2> 
                    <img src="{{ asset('storage/'.$post->img) }}" alt="" class="card-img">
                    <p>
                        {!! $post->body !!}
                    </p>
                    <span class="text-secondary"><i class="fas fa-user mr-2"></i>{{ $post->author }}</span>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">Dibuat Pada :
                        <h6>{{ isset($post->created_at) ? date('F n, Y - g:iA', strtotime($post->created_at)) : '-' }}</h6>
                    </div>
                    <div class="mb-3">Terakhir Diupdate Pada :
                        <h6>{{ isset($post->updated_at) ? date('F n, Y - g:iA', strtotime($post->updated_at)) : '-' }}</h6>
                    </div>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-block btn-warning mb-1 text-white"><i class="fas fa-edit mr-3"></i>Edit Blog</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-block btn-danger"><i class="fas fa-trash mr-3"></i>Hapus Blog</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection