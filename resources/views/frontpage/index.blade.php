@extends('frontpage._layouts.app-frontpage')

@section('title', 'CARI BUKU')

@section('content')
    <header style="background-image: linear-gradient(94.27deg, #000000 -7.43%, rgba(6, 6, 6, 0) 175.99%), url({{ asset('img/frontpage/1.png') }});">
        <div class="container text-center text-white py-10">
            <div class="row justify-content-center">
                <div class="col-xl-10 mb-6">
                    <h2 class="font-weight-semibold mb-5">PERPUS.ID tempat Untuk Mencari Buku yang mudah dan flexible</h2>
                    <h5 class="font-weight-light">Perpus.id hadir di indonesia untuk membantu semua kalangan dalam mempermudah pencarian buku yang ingi dipinjam</h5>
                </div>
                <div class="col-10 col-xl-6">
                    <form action="{{ url()->current() }}#section1">
                        <input
                            value="{{ $search ? $search : '' }}" 
                            name="search"
                            type="text" 
                            class="form-control" 
                            placeholder="Cari Buku Sekarang...">
                    </form>
                </div>
            </div>
        </div>
    </header>

    <section id="section1" class="mt-5">
        <div class="container">
            @if(Session::has('alert-message'))
                <div class="alert alert-{{ Session::get('alert-type') }} my-5">
                {{ Session::get('alert-message') }}
                </div>
            @endif
            <div class="row">
                @foreach ($books as $book)
                <div class="col-lg-6 mb-5">
                    <div class="card card-success border-bottom h-100">
                        <div class="card-header tx-18 font-weight-bold">{{ $book->title }}</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-auto">
                                    <div class="img-card">
                                        @if ($book->photo)
                                            <img src="{{ asset('storage/'.$book->photo) }}" alt="">
                                        @else
                                            <img src="{{ asset('img/books/default.png') }}" alt="">
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg">
                                    <div class="border-bottom mb-3 pb-3"> Kode Buku: 
                                        <div class="font-weight-bold"> {{ $book->code }} </div>
                                    </div>
                                    <div class="border-bottom mb-3 pb-3">Penulis :
                                        <div class="font-weight-bold"> {{ $book->writer }} </div>
                                    </div>
                                    <div class="border-bottom mb-3 pb-3"> Stok Buku : <br>
                                        @if ($book->stock > 30)
                                        <span class="badge badge-primary">{{ $book->stock }}</span>
                                        @elseif ($book->stock > 3)
                                        <span class="badge badge-info">{{ $book->stock }}</span>
                                        @else 
                                        <span class="badge badge-warning">{{ $book->stock }}</span>
                                        @endif
                                    </div>
                                    <div class="">Deskripsi Buku :
                                        <div class= "font-weight-bold"> {{ substr($book->description, 0, 80).( (strlen($book->description) > 80) ? '...' : ''  )  }} </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-top border-light d-flex justify-content-end">
                            <button data-detail-id="{{ $book->id }}" class="btn btn-sm btn-primary">Detail</button>
                        </div>
                    </div>
                </div> 
                @endforeach
            </div>
            <div class="row justify-content-center justify-content-md-end">
                <div class="col-auto">{{$books->appends(Request::all())->links()}}</div>
            </div>   
            
        </div>
    </section>
@endsection

@section('modal')
<div class="modal fade" id="m-detail" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="title-detail"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="img-card mb-5">
                <img src="" alt="" id="photo-detail">
            </div>
            <div class="border-bottom mb-3 pb-3"> Kode Buku: 
                <div class="font-weight-bold" id="code-detail">  </div>
            </div>
            <div class="border-bottom mb-3 pb-3">Penulis :
                <div class="font-weight-bold" id="writer-detail"> </div>
            </div>
            <div class="border-bottom mb-3 pb-3"> Stok Buku : <br>
                <div id="stock-detail"></div>
            </div>
            <div class="">Deskripsi Buku :
                <div class= "font-weight-bold" id="description-detail">  </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('style')
<style>
    .img-card {
        border-radius: 5px;
        width: 140px;
        height: 150px;
        overflow: hidden;
    }
    .img-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    @media screen and (max-width: 991.98px) {
        .img-card {
            width: 220px;
            margin-bottom: 25px;
        }
    }
    @media screen and (max-width: 575.98px) {
        .img-card {
            width: 100%;
            height: 440px;
            margin-bottom: 25px;
        }
    }
</style>
@endsection

@section('script')
    <script>
        $(function() {
            $('button[data-detail-id]').on('click', function(e) {
                $.ajax({
                    url: `{{ route('ajax.getBookById') }}/${$(this).data('detail-id')}`,
                    success: function(result) {
                        $('#m-detail').find('#title-detail').html(result.data.title);
                        if (result.data.photo === null) {
                            $('#m-detail').find('#photo-detail').attr('src', `{{ asset('img/books/default.png') }}`);
                        } else {
                            $('#m-detail').find('#photo-detail').attr('src', `{{ asset('storage/') }}/${result.data.photo}`);
                        }
                        $('#m-detail').find('#code-detail').html(result.data.code);
                        $('#m-detail').find('#writer-detail').html(result.data.writer);
                        if (result.data.stock > 30) {
                            $('#m-detail').find('#stock-detail').html(`<span class="badge badge-primary"> ${result.data.stock} </span>`);
                        } else if (result.data.stock > 3) {
                            $('#m-detail').find('#stock-detail').html(`<span class="badge badge-info"> ${result.data.stock} </span>`);
                        } else {
                            $('#m-detail').find('#stock-detail').html(`<span class="badge badge-warning"> ${result.data.stock} </span>`);
                        }
                        $('#m-detail').find('#description-detail').html(result.data.description);
                        $('#m-detail').modal('show');
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            })
        })
    </script>
@endsection