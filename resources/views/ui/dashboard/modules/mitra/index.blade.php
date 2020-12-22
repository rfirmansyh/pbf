@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Dashboard')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item">Activities</div>
@endsection
@section('content-header')
  <h2 class="section-title">Rincian Data Terbaru</h2>
@endsection

@section('content')
    {{-- widget --}}
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Jumlah Pekerja</h4>
                </div>
                <div class="card-body">
                    10
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Unit Kerja</h4>
                </div>
                <div class="card-body">
                    20
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                    <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                <div class="card-header">
                    <h4>Kertas Kerja</h4>
                </div>
                <div class="card-body">
                    80
                </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
            <div class="card-icon bg-success">
                <i class="far fa-file-alt"></i>
            </div>
            <div class="card-wrap">
            <div class="card-header">
                <h4>DTM</h4>
            </div>
            <div class="card-body">
                12
            </div>
            </div>
        </div>
        </div>
    </div>
    {{-- end of widget --}}

    {{-- statistic chart --}}
    <div class="row">
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Statistikk Banyaknya Unit Kerja Audit</h4>
            </div>
            <div class="card-body">
              <div class="chart-container">
                <canvas id="dashboard-chart" height="182"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
          <div class="card">
            <div class="card-header">
              <h4>Recent Activities</h4>
            </div>
            <div class="card-body">
              <ul class="list-unstyled list-unstyled-border">
                <li class="media">
                  <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-1.png" alt="avatar">
                  <div class="media-body">
                    <div class="float-right text-primary">Now</div>
                    <div class="media-title">Farhan A Mujib</div>
                    <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                  </div>
                </li>
                <li class="media">
                  <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-2.png" alt="avatar">
                  <div class="media-body">
                    <div class="float-right">12m</div>
                    <div class="media-title">Ujang Maman</div>
                    <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                  </div>
                </li>
                <li class="media">
                  <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-3.png" alt="avatar">
                  <div class="media-body">
                    <div class="float-right">17m</div>
                    <div class="media-title">Rizal Fakhri</div>
                    <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                  </div>
                </li>
                <li class="media">
                  <img class="mr-3 rounded-circle" width="50" src="../assets/img/avatar/avatar-4.png" alt="avatar">
                  <div class="media-body">
                    <div class="float-right">21m</div>
                    <div class="media-title">Alfa Zulkarnain</div>
                    <span class="text-small text-muted">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin.</span>
                  </div>
                </li>
              </ul>
              <div class="text-center pt-1 pb-1">
                <a href="#" class="btn btn-primary btn-lg btn-round">
                  View All
                </a>
              </div>
            </div>
          </div>
        </div>
    </div>
    {{-- end of statistic chart --}}
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endsection