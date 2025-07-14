@extends('layouts.master')
@section('content')
<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <div class="mt-5">
                        <h4 class="card-title float-left mt-2">Data Retur Pembelian</h4>
                        {{-- <span class="loader"></span> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="filterBox" class="col-md-3" style="{{ request('filter') == '1' ? '' : 'display: none;' }}">
                <div class="card rounded-default p-3 filterBox  text-white">
                    <form method="GET" action="{{ route('pembelian/retur/list/page') }}">
                        <input type="hidden" name="filter" value="1">
                        <div class="form-group mb-1">
                            <label>Pencarian</label>
                            <input type="text" name="no_retur" class="form-control form-control-sm" onchange="this.form.submit()" placeholder="Cari berdasarkan ID" value="{{ request('no_retur') }}">
                        </div>
                        <div class="form-group mb-1">
                            <input type="text" name="deskripsi" class="form-control form-control-sm" onchange="this.form.submit()" placeholder="Deskripsi" value="{{ request('deskripsi') }}">
                        </div>   
                        <div class="form-group mb-1">
                            <label>Pemasok</label>
                            <select class="form-control form-control-sm" name="" onchange="this.form.submit()">
                                <option value="" selected>-- Pemasok</option>
                                @foreach ($pemasok as $items)
                                    <option value="{{ $items->nama }}" {{ request('pemasok_retur') == $items->nama ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label for="status_retur">Status</label>
                            <select class="form-control form-control-sm" id="status_retur" name="status_retur" onchange="this.form.submit()">
                                <option value="">-- Semua Status --</option>
                                <option value="Menunggu" {{ request('status_retur') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                                <option value="Diproses" {{ request('status_retur') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                <option value="Ditutup" {{ request('status_retur') == 'Ditutup' ? 'selected' : '' }}>Ditutup</option>
                                <option value="Diterima" {{ request('status_retur') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            </select>
                        </div>
                        <div class="form-group mb-1">
                            <label>Catatan Audit</label><br>
                            <div class="form-group mb-0">
                                <div class="checkbox-wrapper-4 mb-0">
                                    <input class="inp-cbx" name="catatan_pemeriksaan_check" id="catatan_pemeriksaan_check_1" type="checkbox" value="1" onchange="this.form.submit()" {{ request('catatan_pemeriksaan_check') === '1' ? 'checked' : '' }}>
                                    <label class="cbx" for="catatan_pemeriksaan_check_1">
                                        <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                        <span><small><strong>Catatan Pemeriksaan</strong></small></span>
                                    </label>
                                    <svg class="inline-svg">
                                        <symbol id="check-4" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </symbol>
                                    </svg>
                                </div>
                                <div class="checkbox-wrapper-4 mb-0">
                                    <input class="inp-cbx" name="catatan_pemeriksaan_check" id="catatan_pemeriksaan_check_0" type="checkbox" value="0" onchange="this.form.submit()" {{ request('catatan_pemeriksaan_check') === '0' ? 'checked' : '' }}>
                                    <label class="cbx" for="catatan_pemeriksaan_check_0">
                                        <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                        <span><small><strong>Belum Catatan Pemeriksaan</strong></small></span>
                                    </label>
                                    <svg class="inline-svg">
                                        <symbol id="check-4" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </symbol>
                                    </svg>
                                </div>
                                <div class="checkbox-wrapper-4 mb-0">
                                    <input class="inp-cbx" name="disetujui_check" id="disetujui_check_1" type="checkbox" value="1" onchange="this.form.submit()" {{ request('disetujui_check') === '1' ? 'checked' : '' }}>
                                    <label class="cbx" for="disetujui_check_1">
                                        <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                        <span><small><strong>Disetujui</strong></small></span>
                                    </label>
                                    <svg class="inline-svg">
                                        <symbol id="check-4" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </symbol>
                                    </svg>
                                </div>
                                <div class="checkbox-wrapper-4">
                                    <input class="inp-cbx" name="disetujui_check" id="disetujui_check_0" type="checkbox" value="0" onchange="this.form.submit()" {{ request('disetujui_check') === '0' ? 'checked' : '' }}>
                                    <label class="cbx" for="disetujui_check_0">
                                        <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                        <span><small><strong>Belum Disetujui</strong></small></span>
                                    </label>
                                    <svg class="inline-svg">
                                        <symbol id="check-4" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </symbol>
                                    </svg>
                                </div>
                                <div class="checkbox-wrapper-4 mb-0">
                                    <input class="inp-cbx" name="tindak_lanjut_check" id="tindak_lanjut_check_1" type="checkbox" value="1" onchange="this.form.submit()" {{ request('tindak_lanjut_check') === '1' ? 'checked' : '' }}>
                                    <label class="cbx" for="tindak_lanjut_check_1">
                                        <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                        <span><small><strong>Tindak Lanjut</strong></small></span>
                                    </label>
                                    <svg class="inline-svg">
                                        <symbol id="check-4" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </symbol>
                                    </svg>
                                </div>
                                <div class="checkbox-wrapper-4">
                                    <input class="inp-cbx" name="tindak_lanjut_check" id="tindak_lanjut_check_0" type="checkbox" value="0" onchange="this.form.submit()" {{ request('tindak_lanjut_check') === '0' ? 'checked' : '' }}>
                                    <label class="cbx" for="tindak_lanjut_check_0">
                                        <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                        <span><small><strong>Belum Tindak Lanjut</strong></small></span>
                                    </label>
                                    <svg class="inline-svg">
                                        <symbol id="check-4" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </symbol>
                                    </svg>
                                </div>
                                <div class="checkbox-wrapper-4 mb-0">
                                    <input class="inp-cbx" name="urgent_check" id="urgent_check_1" type="checkbox" value="1" onchange="this.form.submit()" {{ request('urgent_check') === '1' ? 'checked' : '' }}>
                                    <label class="cbx" for="urgent_check_1">
                                        <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                        <span><small><strong>Urgent</strong></small></span>
                                    </label>
                                    <svg class="inline-svg">
                                        <symbol id="check-4" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </symbol>
                                    </svg>
                                </div>
                                <div class="checkbox-wrapper-4">
                                    <input class="inp-cbx" name="urgent_check" id="urgent_check_0" type="checkbox" value="0" onchange="this.form.submit()" {{ request('urgent_check') === '0' ? 'checked' : '' }}>
                                    <label class="cbx" for="urgent_check_0">
                                        <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                        <span><small><strong>Tidak Urgent</strong></small></span>
                                    </label>
                                    <svg class="inline-svg">
                                        <symbol id="check-4" viewbox="0 0 12 10">
                                            <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                        </symbol>
                                    </svg>
                                </div>
                            </div>
                        </div>    
                        <div class="form-group mb-1">
                            <label>Pengguna</label>
                            <select class="form-control form-control-sm" name="pengguna_retur" onchange="this.form.submit()">
                                <option value="" selected>-- Pengguna</option>
                                @foreach ($pengguna_retur as $items)
                                    <option value="{{ $items->pengguna_retur }}" {{ request('pengguna_retur') == $items->pengguna_retur ? 'selected' : '' }}>
                                        {{ $items->pengguna_retur }}
                                    </option>
                                @endforeach
                            </select>
                        </div> 
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="ReturList">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="20"><input type="checkbox" id="select_all"></th>
                                        <th>No</th>
                                        <th hidden>ID</th>
                                        <th>No. Retur</th>
                                        <th>Tgl. Retur</th>
                                        <th>No. Faktur</th>
                                        <th>No. Pemasok</th>
                                        <th>Nama Pemasok</th>
                                        <th>Deskripsi</th>
                                        <th>Jumlah</th>
                                        <th>Nilai Pajak 1</th>
                                        <th>Nilai Pajak 2</th>
                                        <th>Status</th>
                                        <th hidden>Sumber</th>
                                        <th>Pengguna</th>
                                        {{-- <th>Cabang</th> --}}
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
                    <div class="mb-15 row">
                        <div class="col">
                            {{-- @if(Auth::user() && Auth::user()->email === 'user.zacky@gmail.com') --}}
                                <a href="{{ route('pembelian/retur/add/new') }}" class="btn btn-primary float-left veiwbutton"><i class="fas fa-plus mr-2"></i>Tambah</a>
                                <button class="btn btn-primary float-left veiwbutton ml-3" onclick="toggleFilter()"><i class="fas fa-filter mr-2"></i>Filter</button>
                                <button id="deleteSelected" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-trash mr-2"></i>Hapus</button>
                            {{-- @else
                                <a href="javascript:void(0)" class="btn btn-primary float-left veiwbutton disabled" style="pointer-events: none; cursor: default; background-color:gray;"><i class="fas fa-plus mr-2"></i>Tambah (ON PRODUCTION)</a>
                                <button class="btn btn-primary float-left veiwbutton ml-3" onclick="toggleFilter()"><i class="fas fa-filter mr-2"></i>Filter</button>
                                <button id="deleteSelected" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-trash mr-2"></i>Hapus</button>
                            @endif --}}
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
            var table = $('#ReturList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-retur-data') }}",
                    data: function(d) {
                        d.no_retur = $('input[name=no_retur]').val(),
                        d.deskripsi = $('input[name=deskripsi]').val(),
                        d.pengguna_retur = $('select[name=pengguna_retur]').val(),
                        d.pemasok_retur = $('select[name=pemasok_retur]').val(),
                        d.catatan_pemeriksaan_check = $('input[name=catatan_pemeriksaan_check]:checked').val(),
                        d.disetujui_check = $('input[name=disetujui_check]:checked').val(),
                        d.urgent_check = $('input[name=urgent_check]:checked').val(),
                        d.tindak_lanjut_check = $('input[name=tindak_lanjut_check]:checked').val(),
                        d.status_retur = $('select[name=status_retur]').val();
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
                        title: 'Daftar Retur Pembelian',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                        className: 'btn btn-primary veiwbutton',
                        titleAttr: 'Export to Excel',
                        title: 'Daftar Retur Pembelian',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Retur Pembelian',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Retur Pembelian',
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
                        data: 'no_retur',
                        name: 'no_retur',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'tgl_retur',
                        name: 'tgl_retur',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'no_faktur',
                        name: 'no_faktur',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'no_pemasok',
                        name: 'no_pemasok',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'pemasok_retur',
                        name: 'pemasok_retur',
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
                        data: 'jumlah',
                        name: 'jumlah',
                        orderable: false,
                        searchable: false
                    },
                    // {
                    //     data: 'nilai_pajak_2',
                    //     name: 'nilai_pajak_2',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    // {
                    //     data: 'nilai_pajak_1',
                    //     name: 'nilai_pajak_1',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    {
                        data: 'status_retur',
                        name: 'status_retur',
                        orderable: false,
                        searchable: false
                    },
                    // {
                    //     data: 'sumber',
                    //     name: 'sumber',
                    //     orderable: false,
                    //     searchable: false
                    // },
                    {
                        data: 'pengguna_retur',
                        name: 'pengguna_retur',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'no_persetujuan',
                        name: 'no_persetujuan',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pemeriksaan_check',
                        name: 'catatan_pemeriksaan_check',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data == 1
                                ? '<input type="checkbox" checked>'
                                : '<input type="checkbox">';
                        }
                    },
                    {
                        data: 'tindak_lanjut_check',
                        name: 'tindak_lanjut_check',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data == 1
                                ? '<input type="checkbox" checked>'
                                : '<input type="checkbox">';
                        }
                    },
                    {
                        data: 'disetujui_check',
                        name: 'disetujui_check',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data == 1
                                ? '<input type="checkbox" checked>'
                                : '<input type="checkbox">';
                        }
                    },
                    {
                        data: 'urgent_check',
                        name: 'urgent_check',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return data == 1
                                ? '<input type="checkbox" checked>'
                                : '<input type="checkbox">';
                        }
                    },
                ]
            });

            $('form').on('submit', function(e) {
                e.preventDefault();
                table.draw();
            });

            $('#select_all').on('click', function() {
                $('.retur_checkbox').prop('checked', this.checked);
            });

            $('#ReturList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
            });

            $('#deleteSelected').on('click', function() {
                var selectedIds = $('.retur_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                        $.ajax({
                            url: "{{ route('pembelian/retur/delete') }}",
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

            $('#ReturList tbody').on('click', 'tr', function(e) {
                // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
                if ($(e.target).is('input[type="checkbox"], label')) {
                    return; // Jika iya, hentikan eksekusi supaya tidak redirect
                }

                var data = table.row(this).data();
                    if (data) {
                        window.location.href = "/pembelian/retur/edit/" + data.id + "/" + data.no_retur;
                    }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const filterBox = document.getElementById("filterBox");
            const filterStatus = localStorage.getItem("filterStatus");
    
            if (filterStatus === "open") {
                filterBox.style.display = "block";
            } else {
                filterBox.style.display = "none";
            }
        });
    
        function toggleFilter() {
            const filterBox = document.getElementById("filterBox");
            const isVisible = filterBox.style.display === "block";
    
            if (isVisible) {
                filterBox.style.display = "none";
                localStorage.setItem("filterStatus", "closed");
            } else {
                filterBox.style.display = "block";
                localStorage.setItem("filterStatus", "open");
            }
        }
    </script>    
@endsection
@endsection
