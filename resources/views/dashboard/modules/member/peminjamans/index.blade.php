@extends('dashboard._layouts.app-dashboard')

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
            <a href="" class="btn btn-outline-primary"><i class="fas fa-undo"></i></a>
        </div>
  </div>
@endsection

@section('content')

    {{-- Datatable --}}
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table id="datatable" class="table table-datatable" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Judul Buku</th>
                            <th>Nama Petugas</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Sisa Hari</th>
                            <th>Status</th>
                            <th>Denda</th>
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
        const ajax_url = '{{ route('ajax.getPeminjamansByMemberId', Auth::user()->id) }}';
        $(document).ready(function() {
            var table = $('#datatable').DataTable({
                'dom': `<'row no-gutters'<'col-md'l><'col-md-auto'f>>
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
                ajax: ajax_url,
                serverSide: true,
                processing: true,
                preDrawCallback: () => {
                    $('#datatable').loader(true);
                },
                'select': {
                    'style': 'multi',
                    'selector': 'td:first-child'
                },
                'order': [[1, 'asc']],
                columns: [
                    { data: 'id', name: 'id' },
                    {
                        data: 'title', name: 'title',
                        render: function(data, type, row) {
                            if (type === 'export') {
                                return data.title_full;
                            }
                            return `
                            <a href="{{ url('dashboard/admin/books') }}/${data.id}" target="_blank" data-toggle="tooltip" data-placement="top" title="${data.title_full}">
                                ${data.title}
                            </a>`;
                        }
                    },
                    {
                        data: 'admin', name: 'admin',
                        render: function(data, type, row) {
                            return data.name;
                        }
                    },
                    {data: 'borrowed_at', name: 'borrowed_at'},
                    {data: 'returned_at', name: 'returned_at'},
                    {data: 'date_remaining', name: 'date_remaining'},
                    {
                        data: 'status', name: 'status',
                        render: function(data, type, row) {
                            if ( data !== 0 ){
                                if (data.pengembalian_returned_at <= data.peminjaman_returned_at) {
                                    return '<span class="badge badge-success">Dikembalikan</span>';
                                } else {
                                    return '<span class="badge badge-danger">terlambat</span>';
                                }
                            }
                            return '<span class="badge badge-secondary">Dipinjam</span>';
                        }
                    },
                    {data: 'denda', name: 'denda'},
                ],
                drawCallback: () => {
                    $('[data-toggle="tooltip"]').tooltip({
                        container: 'body' 
                    });
                    $('#datatable').loader(false);
                },
            });

        } );
    </script>
@endsection