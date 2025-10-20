@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Data Departemen</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card rounded-default p-3 filterBox text-white">
                    <form method="GET" action="{{ route('departemen/list/page') }}">
                        <div class="form-group mb-1">
                            <label>Pencarian</label>
                            <input type="text" name="departemen_id" class="form-control form-control-sm" onchange="this.form.submit()" placeholder="Cari berdasarkan ID" value="{{ request('departemen_id') }}">
                        </div> 
                        <div class="form-group mb-1">
                            <input type="text" name="nama_departemen" class="form-control form-control-sm" onchange="this.form.submit()" placeholder="Nama Departemen" value="{{ request('nama_departemen') }}">
                        </div>
                        <div class="form-group mb-1">
                            <label>Dihentikan</label><br>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" onchange="this.form.submit()" name="dihentikan" value="" {{ request('dihentikan') === null ? 'checked' : '' }}>
                                <label class="form-check-label">Semua</label>
                            </div>
                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" onchange="this.form.submit()" name="dihentikan" value="1" {{ request('dihentikan') === '1' ? 'checked' : '' }}>
                                <label class="form-check-label">Ya</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" onchange="this.form.submit()" name="dihentikan" value="0" {{ request('dihentikan') === '0' ? 'checked' : '' }}>
                                <label class="form-check-label">Tidak</label>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="DepartemenList">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="20"><input type="checkbox" id="select_all"></th>
                                        <th>No</th>
                                        <th hidden>ID</th>
                                        <th>No. Departemen</th>
                                        <th>Nama Departemen</th>
                                        <th>Nama Kontak</th>
                                        <th>Deskripsi</th>
                                        <th>Tipe</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <a href="{{ route('departemen/add/new') }}" class="btn btn-primary float-left veiwbutton"><i class="fas fa-plus mr-2"></i>Tambah</a>
                            <button id="deleteSelected" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-trash mr-2"></i>Hapus</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@section('script')
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#DepartemenList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-departemen-data') }}",
                    data: function(d) {
                        d.nama_departemen = $('input[name=nama_departemen]').val(),
                        d.departemen_id = $('input[name=departemen_id]').val(),
                        d.dihentikan = $('input[name=dihentikan]:checked').val();
                    }
                },
                dom: "<'row'<'col-sm-12'B>>" +
                    "<'row'<'col-sm-12 mt-3'tr>>" + 
                    "<'row'<'col-sm-12 col-md-6 mt-2'l><'col-sm-12 col-md-6'p>>", 
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-copy"></i> <span class="btn_text_align font-weight-bold">Copy</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Departemen',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                        className: 'btn btn-primary veiwbutton',
                        titleAttr: 'Export to Excel',
                        title: 'Daftar Departemen',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Departemen',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Departemen',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                ],
                columns: [{
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        searchable: false,
                    },
                    {
                        data: 'no',
                        name: 'no',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'departemen_id',
                        name: 'departemen_id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_departemen',
                        name: 'nama_departemen',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_kontak',
                        name: 'nama_kontak',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tipe_departemen',
                        name: 'tipe_departemen',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'dihentikan',
                        name: 'dihentikan',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data == 1
                                ? '<h3 class="badge badge-pill text-white badge-secondary">Ya</h3>'
                                : '<h3 class="badge badge-pill text-white badge-success">Tidak</h3>';
                        }
                    }
                ]
            });

            $('form').on('submit', function(e) {
                e.preventDefault();
                table.draw();
            });

            $('#select_all').on('click', function() {
                $('.departemen_checkbox').prop('checked', this.checked);
            });

            $('#DepartemenList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
            });

            $('#deleteSelected').on('click', function() {
                var selectedIds = $('.departemen_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                        $.ajax({
                            url: "{{ route('departemen/delete') }}",
                            type: "POST",
                            data: {
                                ids: selectedIds,
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                location.reload();
                            },
                        });
                    }
                } else {
                    alert('Pilih setidaknya satu data untuk dihapus!');
                }
            });

            $('#DepartemenList tbody').on('click', 'tr', function(e) {
                // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
                if ($(e.target).is('input[type="checkbox"], label')) {
                    return; // Jika iya, hentikan eksekusi supaya tidak redirect
                }

                var data = table.row(this).data();
                    if (data) {
                        window.location.href = "/departemen/edit/" + data.id + "/" + data.departemen_id;
                    }
            });
        });
    </script>
@endsection
@endsection
