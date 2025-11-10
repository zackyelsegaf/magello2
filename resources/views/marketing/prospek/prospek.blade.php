@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Prospek</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card rounded-default p-3 filterBox text-white">
                        <div class="form-group mb-1">
                            <label>Pencarian</label>
                            <input type="text" name="nama" class="form-control form-control-sm key-filter" placeholder="Calon Kostumer">
                        </div>

                        <div class="form-group mb-1">
                            <label for="">Tanggal</label>
                            <div class="form-check">
                                <input class="form-check-input click-filter" type="checkbox" id="filterTanggal" name="filterTanggal" value="1">
                                <label class="form-check-label" for="filterTanggal">Filter Tanggal</label>

                                <div class="form-group mb-1 mt-2" id="tanggalInputs" style="display: none;">
                                    <input type="date" class="form-control click-filter mb-1" name="tanggal_awal">
                                    <input type="date" class="form-control click-filter" name="tanggal_akhir">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-1 flex-column">
                            <label>Klaster/Perumahan</label>
                            <select class="form-control form-control-sm mb-2 click-filter" name="cluster">
                                <option value="" selected>--Klaster/Perumahan--</option>
                                @foreach ($cluster_id as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_cluster }}</option>
                                @endforeach
                            </select>
                        </div>

                        <script>
                            // Fungsi toggle
                            document.getElementById('filterTanggal').addEventListener('change', function() {
                                document.getElementById('tanggalInputs').style.display = this.checked ? 'block' : 'none';
                            });
                        </script>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-center mb-0"
                                    id="ProyekList">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="20"><input type="checkbox" id="select_all"></th>
                                            <th>No</th>
                                            <th hidden>ID</th>
                                            <th>Calon Kostumer</th>
                                            <th>Marketing</th>
                                            <th>Status</th>
                                            <th>Sumber</th>
                                            <th>Klaster</th>
                                            <th>Dibuat Pada</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="page-header">
                        <div class="mb-15 row align-items-center">
                            <div class="col">
                                <a href="{{ Route('prospek/add/new') }}" class="btn btn-primary float-left veiwbutton"><i
                                        class="fas fa-plus mr-2"></i>Tambah</a>
                                <button id="deleteSelected" class="btn btn-primary float-left veiwbutton ml-3"><i
                                        class="fas fa-trash mr-2"></i>Hapus</button>
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
                var table = $('#ProyekList').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searching: false,
                    ajax: {
                        url: "{{ route('get-prospek-data') }}",
                        data: function(d) {
                            d.nama = $('input[name=nama]').val();
                            d.cluster = $('select[name=cluster]').val();
                            d.tanggal_awal = $('input[name=tanggal_awal]').val();
                            d.tanggal_akhir = $('input[name=tanggal_akhir]').val();
                            d.filter_tanggal = $('input[name=filterTanggal]:checked').val();
                            console.log(d);
                            
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
                            title: 'Daftar Prospek',
                            exportOptions: {
                                columns: ':not(:first-child):not(:nth-child(2))'
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                            className: 'btn btn-primary veiwbutton',
                            titleAttr: 'Export to Excel',
                            title: 'Daftar Prospek',
                            exportOptions: {
                                columns: ':not(:first-child):not(:nth-child(2))'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                            className: 'btn btn-primary veiwbutton',
                            title: 'Daftar Prospek',
                            exportOptions: {
                                columns: ':not(:first-child):not(:nth-child(2))'
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                            className: 'btn btn-primary veiwbutton',
                            title: 'Daftar Prospek',
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
                            data: 'calon_kustomer',
                            name: 'calon_kustomer',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'marketing',
                            name: 'marketing',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'status',
                            name: 'status',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'sumber',
                            name: 'sumber',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'nama_cluster',
                            name: 'nama_cluster',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'dibuat_pada',
                            name: 'dibuat_pada',
                            orderable: false,
                            searchable: false
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
                    $('.prospek_checkbox').prop('checked', this.checked);
                });

                $('#ProyekList tbody').on('mouseenter', 'tr', function() {
                    $(this).css('cursor', 'pointer');
                });

                $('#deleteSelected').on('click', function() {
                    var selectedIds = $('.prospek_checkbox:checked').map(function() {
                        return $(this).val();
                    }).get();

                    if (selectedIds.length > 0) {
                        if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                            $.ajax({
                                url: "{{ route('prospek/delete') }}",
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

                $('#ProyekList tbody').on('click', 'tr', function(e) {
                    // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
                    if ($(e.target).is('input[type="checkbox"], label')) {
                        return; // Jika iya, hentikan eksekusi supaya tidak redirect
                    }

                    var data = table.row(this).data();
                        if (data) {
                            window.location.href = "/prospek/edit/" + data.id;
                        }
                });
            });
        </script>
    @endsection
@endsection