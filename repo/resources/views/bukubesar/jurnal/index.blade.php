@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Data Jurnal Umum</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="card rounded-default p-3 bg-dark text-white">
                    <div class="form-group">
                        <label>Pencarian</label>
                        <input type="text" name="no_jurnal" class="form-control key-filter" placeholder="No. Jurnal">
                    </div> 
                    <div class="form-group">
                        <input type="text" name="deskripsi" class="form-control key-filter" placeholder="Deskripsi">
                    </div>
                    <div class="form-group">
                        <label>Filter Tanggal</label>
                        <input type="date" name="tanggal_awal" class="form-control click-filter" placeholder="Dari">
                    </div>
                    <div class="form-group">
                        <input type="date" name="tanggal_akhir" class="form-control click-filter" placeholder="Sampai">
                    </div>
                    <div class="form-group">
                        <label>Tipe</label><br>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="tipe" id="JurnalUmum" value="Jurnal Umum">
                            <label for="JurnalUmum" class="form-check-label">Jurnal Umum</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="tipe" id="BarangRollOver" value="Barang Roll Over">
                            <label for="BarangRollOver" class="form-check-label">Barang Roll Over</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="tipe" id="AkhirPeriode" value="Akhir Periode">
                            <label for="AkhirPeriode" class="form-check-label">Akhir Periode</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="tipe" id="AkhirPeriodeProduksi" value="Akhir Periode Produksi">
                            <label for="AkhirPeriodeProduksi" class="form-check-label">Akhir Periode Produksi</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="tipe" id="Diapresiasi" value="Diapresiasi">
                            <label for="Diapresiasi" class="form-check-label">Diapresiasi</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Catatan Audit</label><br>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="catatan_pemeriksaan" id="CatatanPemeriksaan" value="1">
                            <label for="CatatanPemeriksaan" class="form-check-label">Catatan Pemeriksaan</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="catatan_pemeriksaan" id="BelumCatatan" value="0">
                            <label for="BelumCatatan" class="form-check-label">Belum Catatan</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Pemeriksaan</label><br>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="disetujui" id="Disetujui" value="1">
                            <label for="Disetujui" class="form-check-label">Disetujui</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="disetujui" id="BelumDisetujui" value="0">
                            <label for="BelumDisetujui" class="form-check-label">Belum Disetujui</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="tindak_lanjut" id="TindakLanjut" value="1">
                            <label for="TindakLanjut" class="form-check-label">Tindak Lanjut</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="tindak_lanjut" id="BelumTindakLanjut" value="0">
                            <label for="BelumTindakLanjut" class="form-check-label">Belum Tindak Lanjut</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="urgent" id="Urgent" value="1">
                            <label for="Urgent" class="form-check-label">Urgent</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input click-filter" type="checkbox" name="urgent" id="TidakUrgent" value="0">
                            <label for="TidakUrgent" class="form-check-label">Tidak Urgent</label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-9">
                <div class="card card-table">
                    <div class="card-body booking_card">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered table-center mb-0" id="AkunList">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="20"><input type="checkbox" id="select_all"></th>
                                        <th>No</th>
                                        <th hidden>ID</th>
                                        <th>No. Jurnal</th>
                                        <th>Sumber</th>
                                        <th>Tanggal</th>
                                        <th>Deskripsi</th>
                                        <th>Nilai</th>
                                        <th>Pengguna</th>
                                        <th>Cabang</th>
                                        <th>No. Persetujuan</th>
                                        <th>Catatan Pemeriksaan</th>
                                        <th>Tindak Lanjut</th>
                                        <th>Disetujui</th>
                                        <th>Urgensi</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <a href="{{ route('jurnal/add/new') }}" class="btn btn-primary float-left veiwbutton"><i class="fas fa-plus mr-2"></i>Tambah</a>
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
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#AkunList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-jurnal-data') }}",
                    data: function(d) {
                        d.no_jurnal = $('input[name=no_jurnal]').val();
                        d.deskripsi = $('input[name=deskripsi]').val();
                        d.tanggal_awal = $('input[name=tanggal_awal]').val();
                        d.tanggal_akhir = $('input[name=tanggal_akhir]').val();
                        
                        d.tipe = $('input[name=tipe]:checked').map(function(i, e){
                            return $(e).val();
                        }).get();
                        d.catatan_pemeriksaan = $('input[name=catatan_pemeriksaan]:checked').map(function(i, e){
                            return $(e).val();
                        }).get();
                        d.disetujui = $('input[name=disetujui]:checked').map(function(i, e){
                            return $(e).val();
                        }).get();
                        d.tindak_lanjut = $('input[name=tindak_lanjut]:checked').map(function(i, e){
                            return $(e).val();
                        }).get();
                        d.urgent = $('input[name=urgent]:checked').map(function(i, e){
                            return $(e).val();
                        }).get();
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
                        title: 'Daftar Jurnal',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                        className: 'btn btn-primary veiwbutton',
                        titleAttr: 'Export to Excel',
                        title: 'Daftar Jurnal',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Jurnal',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Jurnal',
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
                        data: 'no_jurnal',
                        name: 'no_jurnal',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'sumber',
                        name: 'sumber',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'deskripsi',
                        name: 'deskripsi',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'nilai',
                        name: 'nilai',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'user',
                        name: 'user',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'cabang',
                        name: 'cabang',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'no_persetujuan',
                        name: 'no_persetujuan',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'catatan_pemeriksaan',
                        name: 'catatan_pemeriksaan',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data == 1
                                ? '<h3 class="badge badge-pill text-white badge-secondary">Ya</h3>'
                                : '<h3 class="badge badge-pill text-white badge-success">Tidak</h3>';
                        }
                    },
                    {
                        data: 'tindak_lanjut',
                        name: 'tindak_lanjut',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data == 1
                                ? '<h3 class="badge badge-pill text-white badge-secondary">Ya</h3>'
                                : '<h3 class="badge badge-pill text-white badge-success">Tidak</h3>';
                        }
                    },
                    {
                        data: 'disetujui',
                        name: 'disetujui',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data == 1
                                ? '<h3 class="badge badge-pill text-white badge-secondary">Ya</h3>'
                                : '<h3 class="badge badge-pill text-white badge-success">Tidak</h3>';
                        }
                    },
                    {
                        data: 'urgensi',
                        name: 'urgensi',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data == 1
                                ? '<h3 class="badge badge-pill text-white badge-secondary">Ya</h3>'
                                : '<h3 class="badge badge-pill text-white badge-success">Tidak</h3>';
                        }
                    },
                ]
            });

            $('.key-filter').on('keyup', function(e){
                table.draw()
            });
            $('.click-filter').on('change', function(e){
                table.draw()
            });

            $('#select_all').on('click', function() {
                $('.jurnal_checkbox').prop('checked', this.checked);
            });

            $('#AkunList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
            });

            $('#deleteSelected').on('click', function() {
                var selectedIds = $('.jurnal_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                        $.ajax({
                            url: "{{ route('jurnal/delete') }}",
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

            $('#AkunList tbody').on('click', 'tr', function(e) {
                // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
                if ($(e.target).is('input[type="checkbox"], label')) {
                    return; // Jika iya, hentikan eksekusi supaya tidak redirect
                }

                var data = table.row(this).data();
                    if (data) {
                        window.location.href = "/jurnal/edit/" + data.id;
                    }
            });
        });
    </script>
@endsection
@endsection
