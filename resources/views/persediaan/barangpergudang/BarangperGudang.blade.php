@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Barang per Gudang</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card rounded-default p-3 filterBox text-white">
                        <form method="GET" action="{{ route('barangpergudang/list/page') }}">
                            <div class="form-group mb-1">
                                <label>Pencarian</label>
                                <input type="text" name="no_barang" class="form-control form-control-sm" onchange="this.form.submit()" placeholder="No Barang" value="{{ request('no_barang') }}">
                            </div>
                            <div class="form-group mb-1">
                                <input type="text" name="nama_barang" class="form-control form-control-sm" onchange="this.form.submit()" placeholder="Nama Barang" value="{{ request('nama_barang') }}">
                            </div>

                            <div class="form-group mb-1">
                                <button type="button" class="btn bg-white text-dark w-100">Pilih Barang</button>
                            </div>
                            <div class="form-group mb-3">
                                <button type="button" class="btn bg-white text-dark w-100">Pilih Gudang</button>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="tampilkanSatuan" checked>
                                <label class="form-check-label" for="tampilkanSatuan">
                                    Tampilkan Satuan
                                </label>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="datatable table table-striped table-bordered table-hover table-center mb-0" id="DepartemenList">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No Barang</th>
                                            <th>Deskripsi Barang</th>
                                            @foreach ($gudangs as $gudang)
                                                <th>{{ $gudang->nama_gudang }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($barangs as $barang)
                                            <tr>
                                                <td>{{ $barang->no_barang }}</td>
                                                <td>{{ $barang->nama_barang }}</td>
                                                @foreach ($gudangs as $gudang)
                                                    <td>
                                                        {{ $stok[$barang->id][$gudang->id] ?? 0 }}
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="page-header">
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#DepartemenList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: true,
                paging: true,
                lengthChange: true,
                ajax: {
                    url: "{{ route('get-barang-per-gudang') }}",
                    data: function(d) {
                        d.no_barang = $('input[name=no_barang]').val(),
                        d.nama_barang = $('input[name=nama_barang]').val();
                    }
                },
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-copy"></i> <span class="btn_text_align font-weight-bold">Copy</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                        className: 'btn btn-primary veiwbutton',
                        titleAttr: 'Export to Excel',
                        title: 'Daftar Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Barang',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    }
                ],
                columns: [{ 
                        data: 'no_barang', 
                        name: 'no_barang',
                        orderable: false,
                        searchable: false,
                    },
                    {   data: 'nama_barang',
                        name: 'nama_barang',
                        orderable: false,
                        searchable: false, 
                    },
                    @foreach ($gudangs as $gudang)
                    { data: '{{ $gudang->nama_gudang }}', 
                        name: '{{ $gudang->nama_gudang }}', 
                        searchable: false, 
                        orderable: false 
                    },
                    @endforeach
                ]
            });

            $('form#filterForm').on('submit', function(e) {
                e.preventDefault();
                table.draw();
            });

            $('#DepartemenList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
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
