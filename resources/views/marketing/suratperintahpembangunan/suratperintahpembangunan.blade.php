@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Data Surat Perintah Pembangunan</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="modalEditSPP" tabindex="-1">
                <div class="modal-dialog model-lg" role="document">
                    <form id="editSPPForm" method="POST" action="{{ route('suratperintahpembangunan/update') }}">
                        @csrf
                        <input type="hidden" name="id" id="edit_id">
                        <div class="modal-content my-rounded-2">   
                            <div class="modal-header">
                                <h5 class="modal-title">Edit Surat Perintah Pembangunan</h5>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>          
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Nomor SPP</label>
                                    <input type="text" name="nomor_spp" id="edit_nomor_spp" class="form-control" readonly>
                                </div>
                                <div class="mb-3">
                                    <label>Tanggal</label>
                                    <input type="text" name="tanggal_spp" id="edit_tanggal_spp" class="form-control datetimepicker">
                                </div>
                                <div class="mb-3">
                                    <label>Catatan</label>
                                    <textarea name="catatan" id="edit_catatan" class="form-control"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Instruksi</label><br>
                                    <label><input type="radio" name="instruksi" value="konsumen" id="edit_radio_konsumen"> Konsumen</label>
                                    <label><input type="radio" name="instruksi" value="stok" id="edit_radio_stok"> Stok</label>
                                </div>
                                <div class="mb-3">
                                    <label>Pilih Kapling</label>
                                    <select name="kapling_id[]" id="select-tags" multiple placeholder=" ">
                                    @foreach($cluster as $clusterId => $items)
                                        <optgroup label="{{ $items->first()->nama_cluster }}">
                                        @foreach($items as $k)
                                            <option value="{{ $k->kapling_id }}">{{ $k->blok_kapling }} - {{ $k->nomor_unit_kapling }} \ {{ $k->nama_cluster }}</option>
                                        @endforeach
                                        </optgroup>
                                    @endforeach
                                    </select>
                                </div>
                            </div>                     
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </div>  
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <div class="card rounded-default p-3 filterBox text-white">
                        <form method="GET" action="">
                            <div class="form-group mb-1">
                                <label>Pencarian</label>
                                <input type="text" name="" class="form-control form-control-sm"
                                    onchange="this.form.submit()" placeholder="" value="">
                            </div>
                            <div class="form-group mb-1">
                                <label>Cluster/Perumahan</label>
                                <select class="form-control form-control-sm" name="mata_uang_pelanggan"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Cluster/Perumahan--</option>
                                </select>
                            </div>

                            <div class="form-group mb-1 flex-column ">
                                <label>Blok</label>
                                <select class="form-control form-control-sm mb-2" name="mata_uang_pelanggan"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Blok--</option>
                            </div>
                            </select>
                            <div class="form-group mb-1 flex-column ">
                                <label>Status</label>
                                <select class="form-control form-control-sm" name="mata_uang_pelanggan"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Status--</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="SppList">
                                <thead class="thead-dark">
                                <tr>
                                    <th width="20"><input type="checkbox" id="select_all"></th>
                                    <th>No</th>
                                    <th hidden>ID</th>
                                    <th>Nomor SPP</th>
                                    <th>Tanggal</th>
                                    <th>Instruksi</th>
                                    <th>Kavling</th>
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
                            <a href="{{ Route('suratperintahpembangunan/add/new') }}"
                                class="btn btn-primary float-left veiwbutton"><i class="fas fa-plus mr-2"></i>Tambah</a>
                            <button id="deleteSelected" class="btn btn-primary float-left veiwbutton ml-3"><i
                                    class="fas fa-trash mr-2"></i>Hapus</button>
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
            var table = $('#SppList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-surat-perintah-pembangunan-data') }}",
                    data: function(d) {
                        d.nama_cluster = $('input[name=nama_cluster]').val(),
                        d.cluster_id = $('select[name=cluster_id]').val(),
                        d.blok_fasum = $('select[name=blok_fasum]').val();
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
                        name:'checkbox', 
                        orderable:false, 
                        searchable:false 
                    },
                    {   data: 'no',       
                        name:'no',       
                        orderable:false, 
                        searchable:false 
                    },
                    {   data: 'id',       
                        name:'id',       
                        visible:false 
                    },
                    {   data: 'nomor_spp',
                        name:'nomor_spp',
                        orderable:true,  
                        searchable:true  
                    },
                    {   data: 'tanggal_spp', 
                        name:'tanggal_spp', 
                        orderable:true, 
                        searchable:false 
                    },
                    {   data: 'instruksi',   
                        name:'instruksi',   
                        orderable:false, 
                        searchable:false 
                    },
                    {   data: 'kapling_badges', 
                        name:'kapling_badges', 
                        orderable:false, 
                        searchable:false 
                    },
                    {   data: 'status', 
                        name:'status', 
                        orderable:false, 
                        searchable:false 
                    }
                ]
            });

            $('#filterForm').on('submit', function(e) {
                e.preventDefault();
                table.draw();
            });

            $('#select_all').on('click', function() {
                $('.suratperintahpembangunan_checkbox').prop('checked', this.checked);
            });

            $('#SppList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
            });

            $('#deleteSelected').on('click', function() {
                var selectedIds = $('.suratperintahpembangunan_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                        $.ajax({
                            url: "{{ route('suratperintahpembangunan/delete') }}",
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

            $('#SppList tbody').on('click', 'tr', function(e) {
                if ($(e.target).is('input[type="checkbox"], label')) return;

                var data = table.row(this).data();
                if (!data) return;

                $.get("/suratperintahpembangunan/" + data.id + "/json", function(res) {
                    $('#edit_id').val(res.id);
                    $('#edit_nomor_spp').val(res.nomor_spp);
                    $('#edit_tanggal_spp').val(res.tanggal_spp);
                    $('#edit_catatan').val(res.catatan);

                    if (res.konsumen == 1) {
                        $('#edit_radio_konsumen').prop('checked', true);
                    } else {
                        $('#edit_radio_stok').prop('checked', true);
                    }

                    const el = document.getElementById('select-tags');
                    const ts = el && el.tomselect ? el.tomselect : null;
                    if (ts) {
                        ts.clear(true);
                        ts.setValue((res.kapling_ids || []).map(String));
                    } else {
                        $('#select-tags').val(res.kapling_ids).trigger('change');
                    }

                    $('#modalEditSPP').modal('show');
                });
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
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            new TomSelect("#select-tags", {
                plugins: ['remove_button'],
                create: false,
                searchField: ['text']
            });
        });
    </script>
@endpush
@endsection
