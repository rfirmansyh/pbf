@extends('layouts.app')

@section('content')
    <div class="row align-items-center mb-4">
        <div class="col-md">
            <h3 class="font-weight-bold text-dark">Ubah Blog</h3>
            <h6 class="text-secondary">Ubah Postingan Ini</h6>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('posts.index') }}" class="btn btn-outline-primary"><i class="fas fa-arrow-left mr-2"></i> Semua Data Blog</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 order-2 order-md-1">
            <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="form-group">
                    <div class="card mb-2">
                        <div class="card-body bg-light position-relative d-flex align-items-center justify-content-center" style="min-height: 5rem">
                            <span class="position-absolute">Belum Ada Gambar</span>
                            <img id="img-card" src="{{ asset('storage/'.$post->img) }}" alt="" class="img-fluid position-relative">
                        </div>
                    </div>
                    <label for="">Banner Image</label>
                    <div class="custom-file">
                        <input 
                            type="file" 
                            name="img" 
                            class="custom-file-input" 
                            id="inputGroupFile01" 
                            onchange="openFile(event, '#img-card')">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">Judul</label>
                    <input 
                        type="text" 
                        name="title" 
                        value="{{ $post->title }}" 
                        class="form-control @error('title') is-invalid @enderror" 
                        id="title" aria-describedby="emailHelp">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Body</label>
                    <textarea name="body" id="" cols="30" rows="10">{{ $post->body }}</textarea>
                </div>
                <div class="form-group">
                    <label for="crated_by">Author</label>
                    <input 
                        type="text" 
                        name="author" 
                        value="{{ $post->author }}" 
                        class="form-control @error('author') is-invalid @enderror" 
                        id="author">
                    @error('created')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-6 order-1 order-md-2">
            <img src="{{ asset('img/illustration/edit.svg') }}" alt="" class="img-fluid">
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdn.ckeditor.com/4.15.0/basic/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'body' );
    </script>
@endsection