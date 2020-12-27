@extends('dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Tambah Pengembalian Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Peminjaman</a></div>
    <div class="breadcrumb-item">Tambah Peminjaman Buku</div>
@endsection
@section('content-header')
  <div class="row gutters-xs align-items-center">
        <div class="col-md"><h2 class="section-title">Form Tambah Peminjaman Buku</h2></div>
        <div class="col-md-auto">
            <a href="{{ url()->previous() }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Batal</a>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.admin.peminjamans.index') }}" class="btn btn-block btn-lg btn-outline-primary"><i class="fas fa-newspaper mr-2"></i> Semua Peminjaman</a>
        </div>
  </div>
@endsection

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form action="{{ route('dashboard.admin.peminjamans.store') }}" method="POST">
                @csrf
                <div class="card">
                    <div class="card-body">
                         <div class="form-group">
                            <label for="">Buku Yang Dipinjam</label>
                            <select 
                                name="book_id" 
                                id="book_id" 
                                class="selectpicker @error('book_id') is-invalid @enderror"
                                title="Pilih Buku" 
                                data-style="form-control" data-width="100%" data-live-search="true" data-live-search-placeholder="Cari Buku...">
                                    @foreach ($books as $book)
                                        <option value="{{ $book->id }}">[sisa: {{ $book->stock }}] {{ $book->title }}</option>
                                    @endforeach
                            </select>
                            @error('book_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Nama Peminjam</label>
                            
                            <select 
                                name="member_id" 
                                id="member_id" 
                                class="selectpicker @error('member_id') is-invalid @enderror" 
                                title="Pilih Peminjam"
                                data-style="form-control" data-width="100%" data-live-search="true" data-live-search-placeholder="Cari Member...">
                                    @foreach ($members as $member)
                                        <option {{ old('member_id') === $member->id ? 'selected' : '' }} value="{{ $member->id }}">{{ $member->name }}</option>
                                    @endforeach
                            </select>
                            @error('member_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Pinjam</label>
                            <input
                                value="{{ old('borrowed_at') }}"
                                name="borrowed_at"
                                type="text"
                                class="form-control @error('borrowed_at') is-invalid @enderror"
                                data-input="datetimepicker" autocomplete="off">
                            @error('borrowed_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="">Tanggal Kembali</label>
                            <input
                                value="{{ old('returned_at') }}"
                                name="returned_at"
                                type="text"
                                class="form-control @error('returned_at') is-invalid @enderror"
                                data-input="datetimepicker" autocomplete="off">
                            @error('returned_at')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-lg btn-primary ml-auto d-block">Tambahkan</button>                    
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-6 col-xl-4 col-xl-auto">
            <div class="row">
                <div class="col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h6>Foto Buku</h6>
                            <div id="img-card">
                                <img src="" class="img-fluid" id="img-book">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h6>Foto Member</h6>
                            <div id="img-card">
                                <img src="" class="img-fluid" id="img-member">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>

    
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <style>
        .img-table {
            width: 12px;
            height: 12px;
            overflow: hidden;
            border-radius: 5px;
        }
        .img-table img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        #img-card {
            width: 100%;
            height: 220px;
            overflow: hidden;
            border-radius: 5px;
            display: flex; align-items: center; justify-content: center;
            position: relative;
            border-radius: 5px;
            background-color: gainsboro;
        }
        #img-card::before {
            content: 'No Image Upload';
            display: inline-block;
            position: absolute;
        }
        #img-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border: none;
            position: relative;
        }
        .dropdown-item .text {
            display: block !important;
        }
    </style>
@endsection

@section('script')
    <script>
        $('#member_id').on('change', function() {
            $.ajax({
                url: `{{ route('ajax.getUserById') }}/${this.value}`,
                success: function(result) {
                    if (result.data.photo !== null) {
                        $('#img-member').attr('src', `{{ asset('storage/') }}/${result.data.photo}`);
                    } else {
                        $('#img-member').attr('src', '{{ asset("img/users/default.png") }}');
                    }
                }
            })
        });
        $('#book_id').on('change', function() {
            $.ajax({
                url: `{{ route('ajax.getBookById') }}/${this.value}`,
                success: function(result) {
                    if (result.data.photo !== null) {
                        $('#img-book').attr('src', `{{ asset('storage/') }}/${result.data.photo}`);
                    } else {
                        $('#img-book').attr('src', '{{ asset("img/books/default.png") }}');
                    }
                }
            })
        });
    </script>
@endsection