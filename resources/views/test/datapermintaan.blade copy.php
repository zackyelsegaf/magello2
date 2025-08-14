<x-layout.main>
    <x-slot:title>
        Penawaran
    </x-slot>
    <div class="page-wrapper position-relative" style="padding-bottom: 80px;"> {{-- padding bawah agar konten tidak tertutup footer --}}
        <div class="content container-fluid">
            {{-- Header Atas --}}
            <div class="page-header mb-4">
                <div class="row align-items-center">
                    <div class="col">
                        <h4 class="card-title float-left mt-2">Data Barang</h4>

                        <div x-data="{ open: false }">
                            <button @click="open = ! open" class="btn btn-sm btn-outline-secondary ml-3">Toggle
                                Content</button>
                            <div x-show="open" class="mt-2">
                                Content...
                            </div>
                        </div>

                        <x-select2.search name="pelanggan" label="Nama Pelanggan" :options="[
                            '001' => 'Ahmad Faiz',
                            '002' => 'Rina Lestari',
                            '003' => 'Bagus Pratama',
                            '004' => 'Siti Aminah',
                        ]" />
                    </div>
                </div>
            </div>

            {{-- Filter & Konten --}}
            <div x-data="{ showFilter: true }">
                <div class="row">
                    <template x-if="showFilter">
                        <x-form.filter-form class="col-md-2">
                            <x-slot:submodul>
                                Penawaran
                            </x-slot:submodul>
                        </x-form.filter-form>
                    </template>

                    <div :class="showFilter ? 'col-md-9' : 'col-md-12'">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-center mb-0"
                                id="PermintaanList">
                                <thead class="thead-dark">
                                    <tr>
                                        <th width="20"><input type="checkbox" id="select_all"></th>
                                        <th>No</th>
                                        <th hidden>ID</th>
                                        <th>No. Permintaan</th>
                                        <th>Tanggal Permintaan</th>
                                        <th>Deskripsi</th>
                                        {{-- <th>Status</th> --}}
                                        <th>Pengguna</th>
                                        {{-- <th>Cabang</th> --}}
                                        {{-- <th>No. Persetujuan</th> --}}
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
                <div class="page-header mt-4">
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('pembelian/permintaan/add/new') }}" class="btn btn-primary">
                                <i class="fas fa-plus mr-2"></i>Tambah
                            </a>
                            <button class="btn btn-secondary" @click="showFilter = !showFilter">
                                <i class="fas fa-filter mr-1"></i>
                                <span x-text="showFilter ? 'Sembunyikan Filter' : 'Tampilkan Filter'"></span>
                            </button>
                            <button id="deleteSelected" class="btn btn-danger ml-2">
                                <i class="fas fa-trash mr-2"></i>Hapus
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Action Bar Fixed --}}
            {{-- <div class="page-footer-fixed bg-white border-top py-3 px-4 d-flex justify-content-between align-items-center"
                style="position: fixed; bottom: 0; left: 240px; right: 0; z-index: 1050; background: #fff; border-top: 1px solid #dee2e6;">
                <div>
                    <a href="{{ route('barang/add/new') }}" class="btn btn-primary mr-2">
                        <i class="fas fa-plus mr-1"></i>Tambah
                    </a>
                    <button class="btn btn-outline-secondary mr-2" onclick="toggleFilter()">
                        <i class="fas fa-filter mr-1"></i>Filter
                    </button>
                    <button id="deleteSelected" class="btn btn-danger">
                        <i class="fas fa-trash mr-1"></i>Hapus
                    </button>
                </div>
            </div> --}}

        </div>
    </div>
    <x-slot:scripts>
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
        {{--
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script> --}}
    </x-slot:scripts>
    @push('script')
        <script type="text/javascript">
            $(document).ready(function() {
                var table = $('#PermintaanList').DataTable({
                    processing: true,
                    serverSide: true,
                    ordering: true,
                    searching: false,
                    ajax: {
                        url: "{{ route('get-permintaan-data') }}",
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
                            data: 'no_permintaan',
                            name: 'no_permintaan',
                            orderable: true,
                            searchable: false
                        },
                        {
                            data: 'tgl_permintaan',
                            name: 'tgl_permintaan',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'deskripsi_permintaan',
                            name: 'deskripsi_permintaan',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'pengguna_permintaan',
                            name: 'pengguna_permintaan',
                            orderable: false,
                            searchable: false
                        },
                        // {
                        //     data: 'no_persetujuan',
                        //     name: 'no_persetujuan',
                        //     orderable: false,
                        //     searchable: false
                        // },
                        {
                            data: 'catatan_pemeriksaan_check',
                            name: 'catatan_pemeriksaan_check',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return data == 1 ?
                                    '<input type="checkbox" checked>' :
                                    '<input type="checkbox">';
                            }
                        },
                        {
                            data: 'tindak_lanjut_check',
                            name: 'tindak_lanjut_check',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return data == 1 ?
                                    '<input type="checkbox" checked>' :
                                    '<input type="checkbox">';
                            }
                        },
                        {
                            data: 'checkbox',
                            name: 'checkbox',
                            orderable: false,
                            searchable: false,
                        },
                        {
                            data: 'urgent_check',
                            name: 'urgent_check',
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return data == 1 ?
                                    '<input type="checkbox" checked>' :
                                    '<input type="checkbox">';
                            }
                        },
                    ]
                });

                $('form').on('submit', function(e) {
                    e.preventDefault();
                    table.draw();
                });

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
                    // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
                    if ($(e.target).is('input[type="checkbox"], label')) {
                        return; // Jika iya, hentikan eksekusi supaya tidak redirect
                    }

                    var data = table.row(this).data();
                    if (data) {
                        window.location.href = "/pembelian/permintaan/edit/" + data.id + "/" + data
                            .no_permintaan;
                    }
                });
            });
        </script>
    @endpush
</x-layout.main>
