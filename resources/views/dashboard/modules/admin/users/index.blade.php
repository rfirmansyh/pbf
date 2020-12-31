@extends('dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Peminjaman Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Anggota</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection
@section('content-header')
  <div class="row align-items-center">
		<div class="col-md"><h2 class="section-title">Daftar Anggota</h2></div>
		<div class="col-md-auto">
            <a href="{{ route('dashboard.admin.users.create') }}" class="btn btn-block btn-lg btn-primary"><i class="fas fa-plus mr-2"></i> Tambah Data Peminjaman</a>
        </div>
  </div>
@endsection

@section('content')
    
    {{-- widget --}}
    <div class="row">
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                	<i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
					<div class="card-header">
						<h4>Total Anggota</h4>
					</div>
					<div class="card-body">
                        {{ $total_user }}
					</div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                	<i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
					<div class="card-header">
						<h4>Total Admin</h4>
					</div>
					<div class="card-body">
						{{ $total_user_admin }}
					</div>
                </div>
            </div>
        </div>
        <div class="col-md">
            <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                	<i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
					<div class="card-header">
						<h4>Total Member</h4>
					</div>
					<div class="card-body">
						{{ $total_user_member }}
					</div>
                </div>
            </div>
        </div>
    </div>
    {{-- end of widget --}

    {{-- Datatable --}}
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center border-bottom pb-3 mb-3">
                <div class="col-md">Export Data</div>
                <div class="col-md-auto" id="col-export-table"></div>
            </div>
            <div class="table-responsive">
                <table id="datatable" class="table table-datatable" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


@endsection


@section('style')
    <link rel="stylesheet" href="{{ asset('vendors/datatable/datatable.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatable/datatable-button-group.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/datatable-checkbox/dataTables.checkboxes.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/bs-datetimepicker/bootstrap-datetimepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/sweetalert2/sweetalert2.min.css') }}">
    <style>
        .img-table {
            width: 30px;
            height: 30px;
            overflow: hidden;
            border-radius: 5px;
        }
        .img-table img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        input[type="date"].is-invalid {
          padding-right: 25px !important;
        }
        .dt-checkboxes-cell th, .dt-checkboxes-cell td {
            width: 50px !important;
        }
        .dt-checkboxes-cell, .dt-checkboxes-cell {
            width: 50px !important;
            white-space: nowrap !important;
        }
        .dataTables_wrapper .dataTables_length .custom-select {
            padding-right: 45px !important;
        }
        .dataTables_wrapper .select-info {
            margin-left: 10px;
            color: rgb(255, 115, 0);
            font-weight: bold;
        }
        .dataTables_wrapper tr.selected {
            background-color: rgba(63, 63, 63, 0.09);
        }
        .dataTables_wrapper .dataTables_length .custom-select, .dataTables_wrapper .dataTables_filter .form-control {
            margin-left: 20px;
        }
        .dataTables_wrapper .dataTables_length label, .dataTables_wrapper .dataTables_filter label {
            display: flex;
            align-items: center;
        }
        @media screen and (max-width: 768px) {
            .dataTables_wrapper .dataTables_length .custom-select, .dataTables_wrapper .dataTables_filter .form-control {
                margin-left: 0;
            }
            .dataTables_wrapper .dataTables_length label, .dataTables_wrapper .dataTables_filter label {
                display: flex;
                flex-direction: column;
                align-items: stretch;
            }
        }
    </style>
@endsection

@section('script')
    <script src="{{ asset('vendors/datatable/datatable.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/datatable-colvis.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/datatable-bs-button.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/datatable-select.min.js') }}"></script>
    <script src="{{ asset('vendors/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable-checkbox/dataTables.checkboxes.min.js') }}"></script>
    <script src="{{ asset('vendors/datatable/datatable-bs.min.js') }}"></script>
    <script src="{{ asset('vendors/bs-datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        // DATATABLE
        const ajax_url = '{{ route('ajax.getUsers') }}';
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                'dom': `<'row no-gutters'<'col-md'l><'col-md-auto'f><'col-md-auto'B>>
                        <'row'<'col-12't>>
                        <'row no-gutters justify-content-center'<'col-md'i><'col-md-auto'p>>`,
                "pagingType": "numbers",
                "language": {
                    "lengthMenu": "Tampilkan _MENU_",
                    "zeroRecords": "Tidak Ada Data",
                    "info": "Menampilkan _PAGE_ dari _PAGES_ page",
                    "infoEmpty": "Tidak Ada Data",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": "Cari Data Peminjaman:"
                },
                responsive: true,
                buttons: [
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel mr-2"></i>Export Excel',
                        className: 'btn-success',
                        title: 'Test Data export',
                        exportOptions: {
                            orthogonal: 'export',
                            columns: ":visible :not(:last-child):not(:first-child)"
                        }
                    }, 
                ],
                ajax: ajax_url,
                serverSide: true,
                processing: true,
                preDrawCallback: () => {
                    $('#datatable').loader(true);
                },
                columns: [
                    { data: 'id', name: 'id' },
                    { data: 'photo', name: 'photo' },
                    { data: 'name', name: 'name' },
                    { data: 'email', name: 'email' },
                    { data: 'phone', name: 'phone' },
                    { data: 'role', name: 'role' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action' },
                ],
                drawCallback: () => {
                    $('[data-toggle="tooltip"]').tooltip({
                        container: 'body' 
                    });
                    $('#datatable').loader(false);
                },
            });
            table.buttons().container().appendTo('#col-export-table');
        } );
    </script>
@endsection