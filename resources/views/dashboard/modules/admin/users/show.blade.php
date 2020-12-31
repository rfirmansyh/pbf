@extends('dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Detail Member Baru')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Anggota</a></div>
    <div class="breadcrumb-item">Detail Data Anggota</div>
@endsection
@section('content-header')
  <div class="row gutters-xs align-items-center">
        <div class="col-md"><h2 class="section-title">Detail Data Anggota</h2></div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.admin.users.edit', $user) }}" class="btn btn-block btn-lg btn-outline-warning"><i class="fas fa-pen mr-2"></i> Ubah</a>
        </div>
        <div class="col-md-auto">
            <a href="{{ url()->previous() }}" class="btn btn-block btn-lg btn-outline-secondary"><i class="fas fa-arrow-left mr-2"></i> Batal</a>
        </div>
        <div class="col-md-auto">
            <a href="{{ route('dashboard.admin.users.index') }}" class="btn btn-block btn-lg btn-outline-primary"><i class="fas fa-user mr-2"></i> Semua Anggota</a>
        </div>
  </div>
@endsection

@section('content')
    
    <div class="row justify-content-center">
        <div class="col-md-auto">
            <div class="card">
                <div class="card-body">
                    <div id="img-card">
                        @if ($user->photo)
                            <img src="{{ asset('storage/'.$user->photo) }}" alt=" " id="img-user">
                        @else
                            <img src="{{ asset('img/users/default.png') }}" alt=" " id="img-user">
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input
                            value="{{ $user->name }}" 
                            type="text" 
                            class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Email</label>
                        <input
                            value="{{ $user->email }}"  
                            type="text"
                            class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Nomor Hp</label>
                        <input
                            value="{{ $user->phone }}" 
                            type="tel" 
                            class="form-control" disabled>
                    </div>

                    <div class="form-group">
                        <label for="">Alamat</label>
                        <textarea 
                            rows="3" 
                            class="form-control" disabled>{{ $user->address }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="">Status</label>
                        <div class="custom-control custom-radio">
                            <input
                                {{ $user->status === '1' ? 'checked' : '' }} 
                                name="status"
                                type="radio" 
                                class="custom-control-input" value="1" disabled>
                            <label class="custom-control-label text-success font-weight-bold" for="aktif">Aktif</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input
                                {{ $user->status === '0' ? 'checked' : '' }}  
                                name="status"
                                type="radio" 
                                class="custom-control-input" value="0" disabled> 
                            <label class="custom-control-label text-gray font-weight-bold" for="nonaktif">Nonaktif</label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="">Role Anggota</label>
                        <select 
                            disabled
                            class="selectpicker"
                            data-style="form-control" data-width="100%" data-live-search="true" data-live-search-placeholder="Cari Buku...">
                                @foreach ($roles as $role)
                                    <option {{ $user->role_id === $role->id ? 'selected' : '' }} value="{{ $role->id }}">{{ $role->name }}</option>
                                @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('style')
    <style>
        #img-card {
            width: 180px;
            height: 180px;
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
    </style>
@endsection

@section('script')
@endsection