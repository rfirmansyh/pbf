@extends('layouts.main')

@section('content')
<div class="page-wrapper bg-white bg-gra-01 p-t-130 p-b-100 font-poppins">
    <div class="wrapper wrapper--w680">
        <div class="card card-4">
            <div class="card-body">
                <h2 class="title">Tambah Ceritamu</h2>

                @if(Session::has('message'))
                    <div class="alert alert-{{ Session::get('type') }} mb-4">
                        {{ Session::get('message') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="" class="label">Gambar Artikel</label> 
                            <div class="custom-file">
                                <input type="file" name="img" class="custom-file-input" id="inputGroupFile01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col">
                            <div class="input-group">
                                <label class="label">Judul</label>
                                <input class="input--style-4" type="text" name="title">
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col">
                            <div class="input-group">
                                <div class="input-group">
                                    <label class="label">Author</label>
                                    <input class="input--style-4" type="text" name="author">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-space">
                        <div class="col">
                            <div class="input-group">
                                <label class="label">Konten</label>
                            </div>
                            <textarea name="content" class="input--style-4 border-0" id="" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="p-t-15">
                        <button class="btn btn--radius-2 btn--blue" type="submit">Simpan</button>
                        <a class="btn btn--radius-2 btn--red" href="{{ route('index') }}#blog">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection