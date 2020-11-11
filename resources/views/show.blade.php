@extends('layouts.main')

@section('content')
<div class="page-wrapper bg-white bg-gra-01 p-t-130 p-b-100 font-poppins">
    <div class="wrapper wrapper--w680">
        <div class="card card-4">
            <div class="card-body">
                <h2 class="title">{{ $article->title }}</h2>
                <div><img src="{{ asset('storage/'.$article->img) }}" alt="" class="img-fluid mb-4"></div>
                <p>{!! $article->content !!}</p>
                <div class="mt-3" style="font-size: 12px"><i class="fas fa-user mr-2"></i>{{ $article->author }}</div>
            </div>
        </div>
    </div>
</div>
@endsection