@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Profile')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Profile</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection
@section('content-header')
  <div class="row align-items-center">
		<div class="col-md"><h2 class="section-title">Hi, Rahmad Firmansyah!</h2></div>
  </div>
@endsection

@section('content')

      <!-- Main Content -->
            <div class="row mt-sm-4">
              <div class="col-md">
                <div class="card profile-widget">
                  <div class="profile-widget-header">
                    <img alt="image" src="{{ asset('img/users/avatar-1.png') }}" class="rounded-circle profile-widget-picture">
                    
              <div class="col-md">
                <div class="card">
                  <form method="post" class="needs-validation" novalidate="">
                    <div class="card-header">
                      <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Nama</label>
                            <input type="text" class="form-control" value="Rahmad Firmansyah" required="">
                            <div class="invalid-feedback">
                              Please fill in the first name
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Status</label>
                            <input type="text" class="form-control" value="Aktif" readonly/>
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Email</label>
                            <input type="email" class="form-control" value="rfirmansyh@gmail.com" required="">
                            <div class="invalid-feedback">
                              Please fill in the email
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>Password</label>
                            <input type="pass" class="form-control" value="">
                          </div>
                        </div>
                        <div class="row">
                          <div class="form-group col-md-6 col-12">
                            <label>Alamat</label>
                            <input type="text" class="form-control" value="Jalan PB Sudirman no. 42 Jember" required="">
                            <div class="invalid-feedback">
                              Please fill in the email
                            </div>
                          </div>
                          <div class="form-group col-md-6 col-12">
                            <label>No Handphone</label>
                            <input type="tel" class="form-control" value="0895388878454">
                          </div>
                        </div>
                            <div class="card-footer border-top border-light d-flex justify-content-end">
                                <a href="{{ url('ui/dashboard/mitra/budidaya/show') }}" class="btn btn-sm btn-primary">Ubah Profile</a>
                            </div>
                        </div>

@endsection