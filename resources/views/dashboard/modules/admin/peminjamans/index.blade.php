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
        	<div class="col-md-auto">
                <a href="{{ route('dashboard.admin.peminjamans.create') }}" class="btn btn-block btn-lg btn-primary"><i class="fas fa-plus mr-2"></i> Tambah Data Peminjaman</a>
            </div>
        </div>
  </div>
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="row align-items-center gutters-xs">
                <div class="col-lg"><h5 class="text-dark mb-0">Opsi Data</h5></div>
                <div class="col-md-auto">
                    <form action="{{ route('dashboard.admin.peminjamans.deletewhere') }}" id="form-delete" method="POST">
                        @csrf @method('DELETE')
                        {{-- just a wrapper for item to be deleted --}}
                        <div id="delete-id-wrapper"></div> 
                        <button type="submit" id="btn-delete" class="btn btn-lg btn-danger" disabled>
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                <div class="col-md-auto">
                    <form action="{{ route('dashboard.admin.peminjamans.returnwhere') }}" id="form-return" method="POST">
                        @csrf @method('PUT')
                        {{-- just a wrapper for item to be deleted --}}
                        <div id="return-id-wrapper"></div> 
                        <button type="submit" id="btn-return" class="btn btn-lg btn-success" disabled>
                            <i class="fas fa-check mr-3"></i> Tandai Dikembalikan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>


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
                            <th></th>
                            <th>Judul Buku</th>
                            <th>Nama Peminjam</th>
                            <th>Nama Petugas</th>
                            <th>Tanggal Pinjam</th>
                            <th>Tanggal Kembali</th>
                            <th>Sisa Hari</th>
                            <th>Status</th>
                            <th>Aksi</th>
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
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css"/> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.22/b-1.6.5/b-colvis-1.6.5/b-flash-1.6.5/b-html5-1.6.5/b-print-1.6.5/datatables.min.css"/> --}}
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
        const ajax_url = '{{ route('ajax.getPeminjamans') }}';
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
                'columnDefs': [
                    {
                        'targets': 0,
                        'checkboxes': {
                            'selectRow': true,
                            'selectCallback': function(nodes, selected) {
                                // let selected_rows = [];
                                // selected_rows = [...selected_rows, table.rows( { selected: true } ).data()];
                                let selected_rows = $.map(table.rows( { selected: true } ).data(), function(item) {
                                    console.log(item);
                                    return {
                                        'id': item.id,
                                        'length': item.status === 0 ? item.status : 1
                                    };
                                });
                                
                                hasrow_returned_book = false;
                                selected_rows.map((v) => {
                                    if ( v.length === 1 ) {
                                        hasrow_returned_book = true;
                                    }
                                });
                                // console.log(selected_rows, hasrow_returned_book);
                                if (table.column(0).checkboxes.selected().length > 0) {
                                    $('#btn-delete').removeAttr('disabled');
                                    if ( hasrow_returned_book === false && selected_rows.length > 0 ) {
                                        $('#btn-return').removeAttr('disabled');
                                    } else {
                                        $('#btn-return').attr('disabled', true);
                                    }
                                } else {
                                    $('#btn-delete').attr('disabled', true);
                                    $('#btn-return').attr('disabled', true);
                                }
                            }
                        }
                    }
                ],
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
                            <a href="{{ url('dashboard/admin/books') }}/${data.id}" data-toggle="tooltip" data-placement="top" title="${data.title_full}">
                                ${data.title}
                            </a>`;
                        }
                    },
                    {
                        data: 'member', name: 'member',
                        render: function(data, type, row) {
                            return `<a href="{{ url('dashboard/admin/users') }}/${data.id}"> ${data.name} </a>`;
                        }
                    },
                    {
                        data: 'admin', name: 'admin',
                        render: function(data, type, row) {
                            return `<a href="{{ url('dashboard/admin/users') }}/${data.id}"> ${data.name} </a>`;
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
                    {
                        data: 'action', name: 'action',
                        render: function(data, type, row) {
                            return `
                                <div class="d-flex align-items-center"> 
                                    <a href="{{ url('dashboard/admin/peminjamans/') }}/${data}/edit" class="btn btn-sm btn-warning mr-1"><i class="fas fa-edit"></i></a>
                                    <a href="{{ url('dashboard/admin/peminjamans/') }}/${data}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                </div>
                            `;
                        }
                    },
                ],
                drawCallback: () => {
                    $('[data-toggle="tooltip"]').tooltip({
                        container: 'body' 
                    });
                    $('#datatable').loader(false);
                },
            });
            table.buttons().container().appendTo('#col-export-table');


            // DELETE MULTIPLE
            $('#form-delete').on('submit', function(e){
                e.preventDefault();
                var form = this;
                var rows_selected = table.column(0).checkboxes.selected();

                Swal.fire({
                    title: 'Hapus Data ?',
                    text: "Dengan Menghapus data ini, anda tidak dapat mengembalikannya",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, Hapus!',
                    cancelButtonText: 'Batal'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $(form).find('#deleted-id-wrapper').html('');
                        // Iterate over all selected checkboxes
                        $.each(rows_selected, function(index, rowId){
                            // Create a hidden element
                            $(form).find('#delete-id-wrapper').append(
                                $('<input>')
                                    .attr('type', 'hidden')
                                    .attr('name', 'id[]')
                                    .val(rowId)
                            );
                        });

                        form.submit();         
                    }
                })

            });

            // RETURN MULTIPLE
            $('#form-return').on('submit', function(e){
                e.preventDefault();
                var form = this;
                var rows_selected = table.column(0).checkboxes.selected();

                Swal.fire({
                    title: 'Masukan ke Pengembalian ?',
                    text: "Dengan Memindahkan data ini ke Pengembalian, anda tidak dapat Memasukan kembali ke Peminjaman",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, Masukan Ke Pengembalian!',
                    cancelButtonText: 'Batal'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        $(form).find('#returnd-id-wrapper').html('');
                        // Iterate over all selected checkboxes
                        $.each(rows_selected, function(index, rowId){
                            // Create a hidden element
                            $(form).find('#return-id-wrapper').append(
                                $('<input>')
                                    .attr('type', 'hidden')
                                    .attr('name', 'id[]')
                                    .val(rowId)
                            );
                        });

                        form.submit();         
                    }
                })

            });
        } );
    </script>
@endsection