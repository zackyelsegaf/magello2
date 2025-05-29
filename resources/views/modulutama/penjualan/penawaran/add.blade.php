<x-layout.main>
    <x-slot:title>
        Penawaran Penjualan
    </x-slot>
    <div class="page-wrapper position-relative" style="padding-bottom: 80px;"> {{-- padding bawah agar konten tidak tertutup footer --}}
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-start">
                        
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="mt-5">
                                    <h4 class="card-title float-left mt-2">Data Penawaran Penjualan</h4>
                                </div>
                            </div>
                        </div>
                        <x-select2.search placeholder="Nama Pelanggan..." name="pelanggan" label="Pelanggan"
                            :options="[
                                '001' => 'Ahmad Faiz',
                                '002' => 'Rina Lestari',
                                '003' => 'Bagus Pratama',
                                '004' => 'Siti Aminah',
                            ]" />
                    </div>
                    <div class="d-flex justify-content-end">
                        sss
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="tableContainer" class="col-md-12" style="transition: width 0.3s;">
                    <div class="table-responsive" style="width: 100%;">
                        <table class="table table-striped table-bordered table-hover table-center mb-0"
                            id="PermintaanList">
                            <thead class="thead-dark">
                                <tr>
                                    <th><input type="checkbox" id="select_all"></th>
                                    <th>No</th>
                                    <th hidden>ID</th>
                                    <th>No. Penawaran</th>
                                    <th>Tanggal Penawaran</th>
                                    <th>No. Pelanggan</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Status</th>
                                    <th>Nilai Diskon</th>
                                    <th>Total Pajak</th>
                                    <th>Nilai Pajak 1</th>
                                    <th>Nilai Pajak 2</th>
                                    <th>Nilai Penawaran</th>
                                    <th>Deskripsi</th>
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
        </div>
        <x-slot:scripts>

        </x-slot:scripts>
</x-layout.main>
