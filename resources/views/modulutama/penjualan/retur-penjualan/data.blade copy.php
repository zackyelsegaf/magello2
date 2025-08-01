<x-layout.main>
    <x-slot:title>
        {{ ucfirst($title) }}
    </x-slot>
    <div class="page-wrapper position-relative" style="padding-bottom: 80px;"> {{-- padding bawah agar konten tidak tertutup footer --}}
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Data {{ ucfirst($title) }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="filterBox" class="col-md-2" style="display: block;">
                    <x-form.filter-form>
                        <x-slot:submodul>{{ $title }}</x-slot:submodul>
                    </x-form.filter-form>
                </div>
                <div id="tableContainer" class="col-md-10" style="transition: width 0.3s;">
                    <div class="table-responsive" style="width: 100%;">
                        <table class="table table-striped table-bordered table-hover table-center mb-0"
                            id="PermintaanList">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th class="text-center">No</th>
                                    <th>No. Retur</th>
                                    <th>Tgl Retur</th>
                                    <th>No. Faktur</th>
                                    <th>Status</th>
                                    <th>No. Pelanggan</th>
                                    <th>Nama Pelanggan</th>
                                    <th class="text-end">Nilai Faktur</th>
                                    <th>Deskripsi</th>
                                    <th>Tercetak</th>
                                    <th>Catatan Pemeriksaan</th>
                                    <th>Tindak Lanjut</th>
                                    <th>Disetujui</th>
                                    <th>No. Persetujuan</th>
                                    <th>Sumber</th>
                                    <th>Pengguna</th>
                                    <th>Cabang</th>
                                    <th>Catatan Pemeriksaan (2)</th>
                                    <th>Tindak Lanjut (2)</th>
                                    <th>Disetujui (2)</th>
                                    <th>Urgensi</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>

            </div>
        </div>
        <x-form.modul.penjualan.footer-action>
            <x-slot:routeCreate>
                {{ $createRoute }}
            </x-slot:routeCreate>
        </x-form.modul.penjualan.footer-action>
        <x-slot:scripts>

            <link rel="stylesheet"
                href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
            <script>
                $(document).ready(function() {
                    var table = $('#PermintaanList').DataTable({
                        processing: true,
                        serverSide: true,
                        ordering: true,
                        searching: false,
                        ajax: {
                            url: '{{ $fetchRoute }}',
                            // data: function(d) {
                            //     d.nama_barang = $('input[name=nama_barang]').val(),
                            //     d.no_barang = $('input[name=no_barang]').val(),
                            //     d.kategori_barang = $('select[name=kategori_barang]').val(),
                            //     d.tipe_barang = $('select[name=tipe_barang]').val(),
                            //     d.tipe_persediaan = $('select[name=tipe_persediaan]').val(),
                            //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                            // }
                        },
                        dom: "<'row'<'col-sm-12'B>>" +
                            "<'row'<'col-sm-12 mt-3'tr>>" +
                            "<'row'<'col-sm-12 col-md-6 mt-2'l><'col-sm-12 col-md-6'p>>",
                        buttons: [{
                                extend: 'copyHtml5',
                                text: '<i class="fa fa-copy"></i> <span class="btn_text_align font-weight-bold">Copy</span>',
                                className: 'btn btn-primary veiwbutton',
                                title: 'Daftar Permintaan Pembelian',
                                exportOptions: {
                                    columns: ':not(:first-child):not(:nth-child(2))'
                                }
                            },
                            {
                                extend: 'excelHtml5',
                                text: '<i class="fa fa-file-excel"></i> <span class="btn_text_align font-weight-bold">Excel</span>',
                                className: 'btn btn-primary veiwbutton',
                                titleAttr: 'Export to Excel',
                                title: 'Daftar Permintaan Pembelian',
                                exportOptions: {
                                    columns: ':not(:first-child):not(:nth-child(2))'
                                }
                            },
                            {
                                extend: 'pdfHtml5',
                                text: '<i class="fa fa-file-pdf"></i> <span class="btn_text_align font-weight-bold">PDF</span>',
                                className: 'btn btn-primary veiwbutton',
                                title: 'Daftar Permintaan Pembelian',
                                exportOptions: {
                                    columns: ':not(:first-child):not(:nth-child(2))'
                                }
                            },
                            {
                                extend: 'print',
                                text: '<i class="fa fa-print"></i> <span class="btn_text_align font-weight-bold">Print</span>',
                                className: 'btn btn-primary veiwbutton',
                                title: 'Daftar Permintaan Pembelian',
                                exportOptions: {
                                    columns: ':not(:first-child):not(:nth-child(2))'
                                }
                            },
                        ],
                        columns: [{
                                data: 'checkbox',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'no',
                                orderable: false,
                                searchable: false
                            },
                            {
                                data: 'no_retur',
                                name: 'no_retur'
                            },
                            {
                                data: 'tgl_retur',
                                name: 'tgl_retur'
                            },
                            {
                                data: 'no_faktur',
                                name: 'no_faktur'
                            },
                            {
                                data: 'status',
                                name: 'status'
                            },
                            {
                                data: 'no_pelanggan',
                                name: 'no_pelanggan'
                            },
                            {
                                data: 'nama_pelanggan',
                                name: 'nama_pelanggan'
                            },
                            {
                                data: 'nilai_faktur',
                                name: 'nilai_faktur',
                                className: 'text-end'
                            },
                            {
                                data: 'deskripsi',
                                name: 'deskripsi'
                            },
                            {
                                data: 'tercetak',
                                name: 'tercetak',
                                render: data => data ? '<input type="checkbox" checked disabled>' :
                                    '<input type="checkbox" disabled>'
                            },
                            {
                                data: 'catatan_pemeriksaan',
                                name: 'catatan_pemeriksaan',
                                render: data => data ? '<input type="checkbox" checked disabled>' :
                                    '<input type="checkbox" disabled>'
                            },
                            {
                                data: 'tindak_lanjut',
                                name: 'tindak_lanjut',
                                render: data => data ? '<input type="checkbox" checked disabled>' :
                                    '<input type="checkbox" disabled>'
                            },
                            {
                                data: 'disetujui',
                                name: 'disetujui',
                                render: data => data ? '<input type="checkbox" checked disabled>' :
                                    '<input type="checkbox" disabled>'
                            },
                            {
                                data: 'no_persetujuan',
                                name: 'no_persetujuan'
                            },
                            {
                                data: 'sumber',
                                name: 'sumber'
                            },
                            {
                                data: 'pengguna',
                                name: 'pengguna'
                            },
                            {
                                data: 'cabang',
                                name: 'cabang'
                            },
                            {
                                data: 'catatan_pemeriksaan_2',
                                name: 'catatan_pemeriksaan_2',
                                render: data => data ? '<input type="checkbox" checked disabled>' :
                                    '<input type="checkbox" disabled>'
                            },
                            {
                                data: 'tindak_lanjut_2',
                                name: 'tindak_lanjut_2',
                                render: data => data ? '<input type="checkbox" checked disabled>' :
                                    '<input type="checkbox" disabled>'
                            },
                            {
                                data: 'disetujui_2',
                                name: 'disetujui_2',
                                render: data => data ? '<input type="checkbox" checked disabled>' :
                                    '<input type="checkbox" disabled>'
                            },
                            {
                                data: 'urgensi',
                                name: 'urgensi'
                            }
                        ]
                    });

                    $('#filterBox').on('change', 'input, select', function() {
                        $('#PermintaanList').DataTable().draw();
                    });

                    // $('form').on('submit', function(e) {
                    //     e.preventDefault();
                    //     table.draw();
                    // });


                    $('#select_all').on('click', function() {
                        $('.permintaan_checkbox').prop('checked', this.checked);
                    });

                    $('#PermintaanList tbody').on('mouseenter', 'tr', function() {
                        $(this).css('cursor', 'pointer');
                    });

                    $('#deleteSelected').on('click', function() {
                        var selectedIds = $('.permintaan_checkbox:checked').map(function() {
                            return $(this).val();
                        }).get();

                        if (selectedIds.length > 0) {
                            if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
                                $.ajax({
                                    url: "{{ route('pembelian/permintaan/delete') }}",
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

                    $('#PermintaanList tbody').on('click', 'tr', function(e) {
                        if ($(e.target).is('input[type="checkbox"], label')) return;
                        const data = $('#PermintaanList').DataTable().row(this).data();
                        if (data) {
                            const url = "{{ route('penjualan.penawaran.edit', ['id' => '__ID__']) }}".replace(
                                '__ID__', data.id);
                            window.location.href = url;
                        }
                    });
                });
            </script>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const filterBox = document.getElementById("filterBox");
                    const tableContainer = document.getElementById("tableContainer");
                    const toggleText = document.getElementById("filterToggleText");
                    const filterStatus = localStorage.getItem("filterStatus");

                    if (filterStatus === "closed") {
                        filterBox.style.display = "none";
                        tableContainer.className = "col-md-12";
                        toggleText.textContent = "Tampilkan Filter";
                    } else {
                        filterBox.style.display = "block";
                        tableContainer.className = "col-md-10";
                        toggleText.textContent = "Sembunyikan Filter";
                    }
                });

                function toggleFilter() {
                    const filterBox = document.getElementById("filterBox");
                    const tableContainer = document.getElementById("tableContainer");
                    const toggleText = document.getElementById("filterToggleText");
                    const isVisible = filterBox.style.display === "block";

                    if (isVisible) {
                        filterBox.style.display = "none";
                        tableContainer.className = "col-md-12";
                        toggleText.textContent = "Tampilkan Filter";
                        localStorage.setItem("filterStatus", "closed");
                    } else {
                        filterBox.style.display = "block";
                        tableContainer.className = "col-md-10";
                        toggleText.textContent = "Sembunyikan Filter";
                        localStorage.setItem("filterStatus", "open");
                    }
                }
            </script>
        </x-slot:scripts>
</x-layout.main>
