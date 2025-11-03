@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Otorisasi Pembayaran</h4>
                        </div>
                    </div>
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
                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="BookingKavlingList">
                                <thead class="thead-dark">
                                <tr>
                                    <th width="20"><input type="checkbox" id="select_all"></th>
                                    <th>No</th>
                                    <th hidden>ID</th>
                                    <th>Nomor Ref.</th>
                                    <th>Tanggal Pembayaran</th>
                                    <th>Total</th>
                                    <th>Kustomer</th>
                                    <th>Di Debit/Kredit Pada</th>
                                    <th>Catatan</th>
                                    <th>Disetujui Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            {{-- <a href="{{ Route('bookingkavling/add/new') }}"
                                class="btn btn-primary float-left veiwbutton"><i class="fas fa-plus mr-2"></i>Tambah</a> --}}
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
            var table = $('#BookingKavlingList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-pembayaran-konsumen-data') }}",
                    // data: function(d) {
                    //     d.nama_cluster = $('input[name=nama_cluster]').val(),
                    //     d.cluster_id = $('select[name=cluster_id]').val(),
                    //     d.blok_fasum = $('select[name=blok_fasum]').val();
                    // }
                },
                dom: "<'row'<'col-sm-12'B>>" +
                    "<'row'<'col-sm-12 mt-3'tr>>" + 
                    "<'row'<'col-sm-12 col-md-6 mt-2'l><'col-sm-12 col-md-6'p>>", 
                buttons: [
                    {
                        extend: 'copyHtml5',
                        text: '<i class="fa fa-copy"></i> <span class="btn_text_align font-weight-bold">Copy</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Booking',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                        className: 'btn btn-primary veiwbutton',
                        titleAttr: 'Export to Excel',
                        title: 'Daftar Booking',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Booking',
                        exportOptions: {
                            columns: ':not(:first-child):not(:nth-child(2))'
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                        className: 'btn btn-primary veiwbutton',
                        title: 'Daftar Booking',
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
                    {   data: 'nomor_referensi',
                        name:'nomor_referensi',
                        orderable:true,  
                        searchable:true  
                    },
                    {   data: 'tanggal_pembayaran', 
                        name:'tanggal_pembayaran', 
                        orderable:true, 
                        searchable:false 
                    },
                    {   data: 'nominal_pembayaran',   
                        name:'nominal_pembayaran',   
                        orderable:false, 
                        searchable:false 
                    },
                    {   data: 'konsumen', 
                        name:'konsumen', 
                        orderable:false, 
                        searchable:false 
                    },
                    {   data: 'nama_akun', 
                        name:'nama_akun', 
                        orderable:false, 
                        searchable:false 
                    },
                    {   data: 'catatan_pembayaran', 
                        name:'catatan_pembayaran', 
                        orderable:false, 
                        searchable:false 
                    },
                    {   data: 'is_approved', 
                        name:'is_approved', 
                        orderable:false, 
                        searchable:false 
                    },
                    {   data: 'modify', 
                        name:'modify', 
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
                $('.datapembayaran_checkbox').prop('checked', this.checked);
            });

            $('#BookingKavlingList tbody').on('mouseenter', 'tr', function() {
                $(this).css('cursor', 'pointer');
            });

            $('#deleteSelected').on('click', function() {
                var selectedIds = $('.datapembayaran_checkbox:checked').map(function() {
                    return $(this).val();
                }).get();

                if (selectedIds.length > 0) {
                    if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                        $.ajax({
                            url: "{{ route('booking/delete') }}",
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

            $('#BookingKavlingList tbody').on('click', 'tr', function(e) {
                // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
                if ($(e.target).is('input[type="checkbox"], label, .konsumen-btn')) {
                    return; // Jika iya, hentikan eksekusi supaya tidak redirect
                }

                var data = table.row(this).data();
                    if (data) {
                        window.location.href = "/pembayaran-konsumen/edit/" + data.id;
                    }
            });

            // $('#BookingKavlingList tbody').on('click', 'tr', function(e) {
            //     if ($(e.target).closest('button, a, .konsumen-btn, .btn, input[type="checkbox"], label, .dt-button, .dropdown-menu').length) {
            //         return;
            //     }

            //     var data = table.row(this).data();
            //     if (data) {
            //         window.location.href = "/booking/edit/" + data.id;
            //     }

            //     const dt = $('#BookingKavlingList').DataTable();
            //     const data = dt.row(this).data();
            //     if (!data) return;

                
            // });

            // $('#BookingKavlingList').on('click', '.konsumen-btn', function(e) {
            //     // e.preventDefault();
            //     // e.stopPropagation();
            //     // e.stopImmediatePropagation();

            //     // const id = $(this).data('id');

            //     // Swal.fire({
            //     //     title: 'Setujui SPK ini?',
            //     //     text: 'Nama Anda akan tercatat sebagai penyetuju.',
            //     //     icon: 'question',
            //     //     showCancelButton: true,
            //     //     confirmButtonText: 'Ya, Setujui',
            //     //     cancelButtonText: 'Batal',
            //     // }).then((result) => {
            //     //     if (!result.isConfirmed) return;

            //     //     $.ajax({
            //     //     url: '/spkmandorpekerja/' + id + '/approve',
            //     //     type: 'POST',
            //     //     data: { _token: '{{ csrf_token() }}' },
            //     //     success: function(res) {
            //     //         Swal.fire({ icon: res.status, title: res.title, text: res.message });

            //     //         const dt = $('#SpkList').DataTable();
            //     //         const rowIdx = dt.rows().eq(0).filter(function(idx){
            //     //         return dt.row(idx).data().id == res.id;
            //     //         });

            //     //         if (rowIdx.length) {
            //     //         const rowData = dt.row(rowIdx[0]).data();
            //     //         rowData.disetujui_oleh = res.disetujui_oleh;
            //     //         rowData.aksi = '<h5><strong><span class="badge badge-secondary m-1">Disetujui</span></strong></h5>';
            //     //         dt.row(rowIdx[0]).data(rowData).draw(false);
            //     //         } else {
            //     //         dt.ajax.reload(null, false);
            //     //         }
            //     //     },
            //     //     error: function(err) {
            //     //         Swal.fire({
            //     //         icon: 'error',
            //     //         title: 'Oops!',
            //     //         text: err.responseJSON?.message || 'Terjadi kesalahan'
            //     //         });
            //     //     }
            //     //     });
            //     // });
            // });
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
