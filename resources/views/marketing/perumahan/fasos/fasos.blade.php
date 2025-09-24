@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Fasos</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card rounded-default p-3 filterBox text-white">
                        <form method="GET" action="{{ route('fasos/list/page') }}">
                            <div class="form-group mb-1">
                                <label>Pencarian</label>
                                <input type="text" name="nama_cluster" class="form-control form-control-sm" onchange="this.form.submit()" placeholder="" value="{{ request('nama_cluster') }}">
                            </div>
                            <div class="form-group mb-1">
                                <label>Cluster/Perumahan</label>
                                <select class="form-control form-control-sm" name="cluster_id" onchange="this.form.submit()">
                                <option value="" {{ request('cluster_id') ? '' : 'selected' }}>-- Cluster Perumahan</option>
                                @foreach ($cluster as $items)
                                    <option value="{{ $items->id }}" {{ (string)request('cluster_id') === (string)$items->id ? 'selected' : '' }}>
                                    {{ $items->nama_cluster }}
                                    </option>
                                @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label>Blok</label>
                                <select class="form-control form-control-sm" name="blok_fasos" onchange="this.form.submit()">
                                    <option value="" {{ request('blok_fasos') ? '' : 'selected' }}>-- Blok Fasos</option>
                                    @foreach ($fasos as $items)
                                        <option value="{{ $items->blok_fasos }}" {{ request('blok_fasos') === $items->blok_fasos ? 'selected' : '' }}>
                                        {{ $items->blok_fasos }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label>Status Pembangunan</label>
                                <select class="form-control form-control-sm" name="status_pembangunan" onchange="this.form.submit()">
                                    <option value="" selected>-- Status Pembangunan --</option>
                                </select>
                            </div>
                            <div class="form-group mb-1">
                                <label>Status Penjualan</label>
                                <select class="form-control form-control-sm" name="status_penjualan" onchange="this.form.submit()">
                                    <option value="" selected>-- Status Penjualan --</option>
                                </select>
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
                                            <th>Nama Kluster</th>
                                            <th>Blok</th>
                                            <th>Nomor Unit</th>
                                            <th>Jumlah Lantai</th>
                                            <th>Luas Tanah (m2)</th>
                                            <th>Luas Bangunan (m2)</th>
                                            <th>Status Pembangunan</th>
                                            {{-- <th>Status Penjualan</th> --}}
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="page-header">
                        <div class="mb-15 row align-items-center">
                            <div class="col">
                                <a href="{{ Route('fasos/add/new') }}" class="btn btn-primary float-left veiwbutton"><i
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
            var table = $('#DepartemenList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-fasos-data') }}",
                    data: function(d) {
                        d.nama_cluster = $('input[name=nama_cluster]').val(),
                        d.blok_fasos = $('select[name=blok_fasos]').val(),
                        d.cluster_id = $('select[name=cluster_id]').val();
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
                        title: 'Daftar RAP & RAB',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                        className: 'btn btn-primary veiwbutton',
                        titleAttr: 'Export to Excel',
                        title: 'Daftar RAP & RAB',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar RAP & RAB',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar RAP & RAB',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                ],
                columns:  [{
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
                        data: 'cluster_id',
                        name: 'cluster_id',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'blok_fasos',
                        name: 'blok_fasos',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nomor_unit_fasos',
                        name: 'nomor_unit_fasos',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'jumlah_lantai',
                        name: 'jumlah_lantai',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'luas_tanah',
                        name: 'luas_tanah',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'luas_bangunan',
                        name: 'luas_bangunan',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'status_pembangunan',
                        name: 'status_pembangunan',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('form').on('submit', function(e) {
                e.preventDefault();
                table.draw();
            });

            $('#select_all').on('click', function() {
                $('.fasos_checkbox').prop('checked', this.checked);
            });

            $('#DepartemenList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
            });

            $('#deleteSelected').on('click', function() {
                var selectedIds = $('.fasos_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                        $.ajax({
                            url: "{{ route('fasos/delete') }}",
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
                        window.location.href = "/fasos/edit/" + data.id;
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
