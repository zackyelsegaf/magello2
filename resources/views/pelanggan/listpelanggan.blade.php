@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Data Pelanggan</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="card rounded-default p-3 bg-dark text-white">
                    <div class="form-group">
                        <label>Pencarian</label>
                        <input type="text" name="kode_pelanggan" class="form-control key-filter" placeholder="Cari berdasarkan ID">
                    </div>
                    <div class="form-group">
                        <input type="text" name="nama_pelanggan" class="form-control key-filter" placeholder="Nama Pelanggan">
                    </div>     
                    <div class="form-group">
                        <label>Mata Uang</label>
                        <select class="form-control click-filter" name="mata_uang_id">
                            <option value="" selected>Mata Uang</option>
                            @foreach ($mata_uang as $items)
                                <option value="{{ $items->id }}">
                                    {{ $items->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tipe Pelanggan</label>
                        <select class="form-control click-filter" name="tipe_pelanggan_id">
                            <option value="" selected> Tipe Pelanggan </option>
                            @foreach ($tipe_pelanggan as $items)
                                <option value="{{ $items->id }}">
                                    {{ $items->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>     
                    <div class="form-group">
                        <label>Dihentikan</label><br>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="radio" name="dihentikan" value="" checked>
                            <label class="form-check-label">Semua</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="radio" name="dihentikan" value="1">
                            <label class="form-check-label">Ya</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="radio" name="dihentikan" value="0">
                            <label class="form-check-label">Tidak</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="PelangganList">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="20"><input type="checkbox" id="select_all"></th>
                                        <th>No</th>
                                        <th hidden>ID</th>
                                        <th>No. Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Alamat 1</th>
                                        <th>Alamat 2</th>
                                        <th>Kontak</th>
                                        <th>Telp</th>
                                        <th>Mata Uang</th>
                                        <th>Tipe Pelanggan</th>
                                        <th>Dihentikan</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <a href="{{ route('pelanggan/add/new') }}" class="btn btn-primary float-left veiwbutton"><i class="fas fa-plus mr-2"></i>Tambah</a>
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
            var table = $('#PelangganList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-pelanggan-data') }}",
                    data: function(d) {
                        d.nama_pelanggan = $('input[name=nama_pelanggan]').val(),
                        d.kode_pelanggan = $('input[name=kode_pelanggan]').val(),
                        d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                        d.tipe_pelanggan_id = $('select[name=tipe_pelanggan_id]').val(),
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
                        title: 'Daftar Pelanggan',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                        className: 'btn btn-primary veiwbutton',
                        titleAttr: 'Export to Excel',
                        title: 'Daftar Pelanggan',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Pelanggan',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Pelanggan',
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
                        data: 'kode_pelanggan',
                        name: 'kode_pelanggan',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'nama',
                        name: 'nama',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'alamat_1',
                        name: 'alamat_1',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'alamat_2',
                        name: 'alamat_2',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'kontak',
                        name: 'kontak',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'no_telp',
                        name: 'no_telp',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'mata_uang_pelanggan',
                        name: 'mata_uang_pelanggan',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'tipe_pelanggan',
                        name: 'tipe_pelanggan',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'dihentikan',
                        name: 'dihentikan',
                        orderable: true,
                        searchable: true,
                        render: function(data, type, row) {
                            return data == 1
                                ? '<h3 class="badge badge-pill text-white badge-secondary">Ya</h3>'
                                : '<h3 class="badge badge-pill text-white badge-success">Tidak</h3>';
                        }
                    }
                ]
            });

            $('.key-filter').on('keyup', function(e){
                table.draw()
            });
            $('.click-filter').on('change', function(e){
                table.draw()
            });

            $('#select_all').on('click', function() {
                $('.pelanggan_checkbox').prop('checked', this.checked);
            });

            $('#PelangganList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
            });

            $('#deleteSelected').on('click', function() {
                var selectedIds = $('.pelanggan_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                        $.ajax({
                            url: "{{ route('pelanggan/delete') }}",
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

            $('#PelangganList tbody').on('click', 'tr', function(e) {
                // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
                if ($(e.target).is('input[type="checkbox"], label')) {
                    return; // Jika iya, hentikan eksekusi supaya tidak redirect
                }

                var data = table.row(this).data();
                    if (data) {
                        window.location.href = "/pelanggan/edit/" + data.id + "/" + data.pelanggan_id;
                    }
            });
        });
    </script>
@endsection
@endsection
