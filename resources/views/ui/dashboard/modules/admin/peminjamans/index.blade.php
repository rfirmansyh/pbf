@extends('ui.dashboard._layouts.app-dashboard')

@section('title', 'Dashboard')

@section('header', 'Peminjaman Buku')
@section('breadcrumb')
    <div class="breadcrumb-item active"><a href="#">Peminjaman</a></div>
    {{-- <div class="breadcrumb-item">Activities</div> --}}
@endsection
@section('content-header')
  <div class="row align-items-center">
		<div class="col-md"><h2 class="section-title">Daftar Peminjaman</h2></div>
		<div class="col-md-auto">
        	<a href="{{ url('ui/dashboard/admin/peminjamans/create') }}" class="btn btn-block btn-lg btn-primary"><i class="fas fa-plus mr-2"></i> Tambah Data Peminjaman</a>
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
						<h4>Total Buku Dipinjam</h4>
					</div>
					<div class="card-body">
						8
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
						<h4>Total Buku Terlambat</h4>
					</div>
					<div class="card-body">
						20
					</div>
                </div>
            </div>
        </div>
    </div>
    {{-- end of widget --}}

    {{-- Export --}}
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md">Export Data</div>
                <div class="col-md-auto" id="col-export-table"></div>
            </div>
        </div>
    </div>


    {{-- Datatable --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-datatable" width="100%">
                    <thead>
                        <tr>
                            <th width="30px">Foto Buku</th>
                            <th>Judul Buku</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Petugas</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Sisa Hari</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 3; $i++)
                        <tr>
                            <td>
                                <div class="img-table">
                                    <img src="{{ asset('img/laravel.jpg') }}" alt="">
                                </div>
                            </td>
                            <td><a href="">Belajar Laravel</a></td>
                            <td><a href="{{ url('ui/dashboard/admin/users/show/') }}">Chelsea Olivier<a></td>
                            <td><a href="{{ url('ui/dashboard/admin/users/show/') }}">Mamat sueb<a></td>
                            <td>20 Oct 2020</td>
                            <td>20 Oct 2020</td>
                            <td>2 Hari</td>
                            <td><span class="badge badge-danger">Terlambat</span></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <a href="{{ url('ui/unitkerja/show') }}" class="btn btn-sm btn-danger mr-1"><i class="fas fa-trash"></i></a>
                                    <a href="{{ url('ui/dashboard/admin/users/edit') }}" class="btn btn-sm btn-warning mr-1"><i class="fas fa-edit"></i></a>
                                    <a href="{{ url('ui/dashboard/admin/users/edit') }}" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                                </div>
                            </td>
                        </tr>
                        @endfor
                        {{-- @for ($i = 0; $i < 3; $i++)
                        <tr>
                            <td class="align-middle">
                                <div class="img-table">
                                    <img src="{{ asset('img/laravel.jpg') }}" alt="">
                                </div>
                            </td>
                            <td class="align-middle">
                                Belajar Laravel
                            </td>
                            <td class="align-middle"><a href="{{ url('ui/dashboard/admin/users/show/') }}">Chelsea Olivier<a></td>
                            <td class="align-middle"><a href="{{ url('ui/dashboard/admin/users/show/') }}">Mamat sueb<a></td>
                            <td class="align-middle">
                                20 Oct 2020
                            </td>
                            <td class="align-middle">
                                20 Sept 2020
                            </td>
                            <td class="align-middle">2 Hari lagi</td>
                            <td class="align-middle"><span class="badge badge-secondary">Dipinjam</span></td>
                            <td class="align-middle">
                                <a href="{{ url('ui/unitkerja/show') }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                <a href="{{ url('ui/dashboard/admin/users/edit') }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="{{ url('ui/dashboard/admin/users/edit') }}" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                            </td>
                        <tr>
                        @endfor --}}
                        {{-- <tr>
                            <td>
                                <div class="img-table">
                                <img src="{{ asset('img/laravel.jpg') }}" alt="">
                                </div>
                            </td>
                            <td class="align-middle">
                                Belajar Laravel
                            </td>
                            <td class="align-middle"><a href="{{ url('ui/dashboard/admin/users/show/') }}">Chelsea Olivier<a></td>
                            <td class="align-middle"><a href="{{ url('ui/dashboard/admin/users/show/') }}">Mamat sueb<a></td>
                            <td class="align-middle">
                                20 Oct 2020
                            </td>
                            <td class="align-middle">
                                20 Sept 2020
                            </td>
                            <td class="align-middle">2 Hari lagi</td>
                            <td class="align-middle"><span class="badge badge-danger">Terlambat</span></td>
                            <td class="align-middle">
                                <a href="{{ url('ui/unitkerja/show') }}" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                <a href="{{ url('ui/dashboard/admin/users/edit') }}" class="btn btn-sm btn-warning"><i class="fas fa-edit"></i></a>
                                <a href="{{ url('ui/dashboard/admin/users/edit') }}" class="btn btn-sm btn-success"><i class="fas fa-check"></i></a>
                            </td>
                        </tr> --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('vendors/datatable/datatable.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css"/>
    <link rel="stylesheet" href="{{ asset('vendors/bs-datetimepicker/bootstrap-datetimepicker.min.css') }}">
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
        .dataTables_wrapper .dataTables_length .custom-select {
            padding-right: 45px !important;
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>
    <script src="{{ asset('vendors/datatable/datatable-bs.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                'dom': `<'row no-gutters'<'col-md'l><'col-md-auto'f>>
                        <'row'<'col-12't>>
                        <'row no-gutters justify-content-center'<'col-md'i><'col-md-auto'p>>`,
                buttons: [
                    {
                        extend: 'colvis',
                        text: '<i class="fas fa-table mr-2"></i>Pilih Kolom',
                        className: 'btn-primary',
                        prefixButtons: [ 
                            {
                                extend: 'colvisRestore',
                                text: 'Tampilkan Semua Kolom'
                            }
                        ]
                    },
                    {
                        extend: 'excel',
                        text: '<i class="fas fa-file-excel mr-2"></i>Export Excel',
                        className: 'btn-success',
                        title: 'Test Data export',
                        exportOptions: {
                            columns: ":visible"
                        }
                    }, 
                ],
                "pagingType": "numbers",
                "language": {
                    "lengthMenu": "Tampilkan _MENU_",
                    "zeroRecords": "Tidak Ada Data",
                    "info": "Menampilkan _PAGE_ dari _PAGES_ page",
                    "infoEmpty": "Tidak Ada Data",
                    "infoFiltered": "(filtered from _MAX_ total records)",
                    "search": "Cari Data Mitra:"
                },
            });

            table.buttons().container().appendTo('#col-export-table');

        } );
    </script>
@endsection