<x-layout.main>
    <x-slot:title>
        Penawaran Penjualan
    </x-slot>
    <div class="page-wrapper position-relative" style="padding-bottom: 80px;"> {{-- padding bawah agar konten tidak tertutup footer --}}
        <div class="content container-fluid">
            <div class="page-header">
                <div class="d-flex justify-content-between align-items-start w-100">
                    {{-- Kolom kiri --}}
                    <div class="d-flex flex-column">
                        <h4 class="card-title mb-2">Data Penawaran Penjualan</h4>
                        <x-select2.search placeholder="Nama Pelanggan..." name="pelanggan" label="Pelanggan"
                            :options="[
                                '001' => 'Ahmad Faiz',
                                '002' => 'Rina Lestari',
                                '003' => 'Bagus Pratama',
                                '004' => 'Siti Aminah',
                            ]" />
                    </div>

                    {{-- Kolom kanan --}}
                    <div class="d-flex flex-column">
                        <div class="d-flex justify-content-end">
                            <div class="form-check me-3">
                                <input type="checkbox" class="form-check-input" name="status[]" value="diproses"
                                    id="statusDiproses">
                                <label class="form-check-label" for="statusDiproses">Diproses</label>
                            </div>
                            &nbsp;
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" name="status[]" value="menunggu"
                                    id="statusMenunggu">
                                <label class="form-check-label" for="statusMenunggu">Menunggu</label>
                            </div>
                            &nbsp;
                            <x-select2.search placeholder="Metode Kegiatan" name="pelanggan" label=""
                                :options="[
                                    '001' => 'Simpan Transaksi',
                                    '002' => 'Salin Transaksi',
                                ]" />

                        </div>

                        <div class="d-flex justify-content-between gap-3">
                            {{-- Input 1 --}}
                            <div class="d-flex flex-column me-2" style="min-width: 0; flex: 1;">
                                <label for="inputGmp1" class="form-label mb-1">No. GMP</label>
                                <div class="input-group input-group-sm">
                                    <input id="inputGmp1" type="text" class="form-control"
                                        placeholder="Ketik sesuatu..." aria-label="No. GMP 1">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                        onclick="location.reload()">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>

                            &nbsp;
                            {{-- Input 2 --}}
                            <div class="d-flex flex-column" style="min-width: 0; flex: 1;">
                                <label for="inputGmp2" class="form-label mb-1">No. GMP</label>
                                <div class="input-group input-group-sm">
                                    <input id="inputGmp2" type="text" class="form-control"
                                        placeholder="Ketik sesuatu..." aria-label="No. GMP 2">
                                    <button class="btn btn-outline-secondary btn-sm" type="button"
                                        onclick="location.reload()">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div id="tableContainer" class="col-md-12" style="transition: width 0.3s;">
                    <div class="table-responsive" style="width: 100%;">
                        <div class="tab-content profile-tab-cont">
                            <div class="profile-menu">
                                <ul class="nav nav-tabs nav-tabs-solid">
                                    <li class="nav-item">
                                        <a class="nav-link active font-weight-bold" data-toggle="tab"
                                            href="#rincian">Rincian</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#ricape">Rincian Catatan
                                            Pemeriksaan</a>
                                    </li>
                                </ul>
                            </div>
                            <div id="rincian" class="tab-pane fade show active">
                                <div class="row float-right mr-0">
                                    {{-- <button type="button" class="btn btn-primary buttonedit mb-3" id="tambahBarangBtn">
                                        <strong><i class="fas fa-cube mr-3 ml-1"></i>Tambah</strong>
                                    </button> --}}
                                    <button type="button" class="btn btn-primary buttonedit mb-3" data-toggle="modal"
                                        data-target="#modalBarang">
                                        <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                                    </button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog"
                                    aria-labelledby="modalBarangLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Pilih Barang</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table
                                                        class="table table-striped table-bordered table-hover table-center mb-0"
                                                        id="tabelPilihBarang"
                                                        style="margin: 0; border-collapse: collapse; width: 100%;">
                                                        <thead class="thead-dark">
                                                            <tr style="padding: 0; margin: 0;">
                                                                <th style="padding: 4px; text-align: center;">
                                                                    <input type="checkbox" id="checkAll">
                                                                </th>
                                                                <th style="padding: 4px;">No. Barang</th>
                                                                <th style="padding: 4px;">Nama Barang</th>
                                                                <th style="padding: 4px;">Satuan</th>
                                                                <th style="padding: 4px;">Kuantitas</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($nama_barang as $item)
                                                                <tr style="padding: 0; margin: 0;">
                                                                    <td style="padding: 4px; text-align: center;">
                                                                        <input type="checkbox" class="check-barang"
                                                                            data-id="{{ $item->no_barang }}"
                                                                            data-nama="{{ $item->nama_barang }}"
                                                                            data-satuan="{{ $item->satuan }}"
                                                                            data-kuantitas="{{ $item->kuantitas_saldo_awal }}">
                                                                    </td>
                                                                    <td style="padding: 4px;">
                                                                        {{ $item->no_barang }}</td>
                                                                    <td style="padding: 4px;">
                                                                        {{ $item->nama_barang }}</td>
                                                                    <td style="padding: 4px;">
                                                                        {{ $item->satuan }}</td>
                                                                    <td style="padding: 4px;">
                                                                        {{ $item->kuantitas_saldo_awal }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-success"
                                                    id="tambahBarangTerpilih">Tambah ke Form</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                {{-- <table class="table table-striped table-bordered table-hover table-center mb-0" id="tabelPermintaan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Barang</th>
                                                <th>Deskripsi Barang</th>
                                                <th>Kts Permintaan</th>
                                                <th>Satuan</th>
                                                <th>Catatan</th>
                                                <th>Tgl. Diminta</th>
                                                <th>Kts Dipesan</th>
                                                <th>Kts Diterima</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="permintaanBody">
                                            <tr>
                                                <td>
                                                    <select style="width: 150px;" name="no_barang[]" class="form-control nama-barang">
                                                        <option disabled selected></option>
                                                        @foreach ($nama_barang as $items)
                                                            <option value="{{ $items->no_barang }}" 
                                                                data-nama="{{ $items->nama_barang }}"
                                                                data-satuan="{{ $items->satuan }}">
                                                                {{ $items->no_barang . ' - ' . $items->nama_barang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input style="width: 150px;" name="deskripsi_barang[]" class="form-control deskripsi-barang" readonly></td>
                                                <td><input style="width: 150px;" name="kts_permintaan[]" class="form-control" value="{{ old('kts_permintaan[]',0) }}"></td>
                                                <td>
                                                    <select style="width: 160px; cursor: pointer;" class="form-control satuan-permintaan" name="satuan[]">
                                                        <option disabled {{ old('satuan[]') ? '' : 'selected' }}></option>
                                                        @foreach ($satuan as $item)
                                                            <option value="{{ $item->nama }}" {{ $item->nama }}>
                                                                {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input style="width: 150px;" name="catatan[]" class="form-control"></td>
                                                <td>
                                                    <div class="cal-icon">
                                                        <input style="width: 150px;" type="text" class="form-control datetimepicker @error('tgl_diminta[]') is-invalid @enderror" name="tgl_diminta[]" value="{{ old('tgl_diminta[]') }}"> 
                                                    </div>
                                                </td>
                                                <td><input style="width: 150px;" name="kts_dipesan[]" class="form-control" readonly></td>
                                                <td><input style="width: 150px;" name="kts_diterima[]" class="form-control" readonly></td>
                                                <td><button type="button" class="btn btn-danger btn-sm removeRow">Hapus</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button type="button" class="btn btn-success" id="tambahBaris">+ Tambah Baris</button>                                     --}}
                                <table class="table table-striped table-bordered table-hover table-center mb-0"
                                    id="DataBarangAddSatuan">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No. Barang</th>
                                            <th>Deskripsi Barang</th>
                                            <th>Kts Permintaan</th>
                                            <th>Satuan</th>
                                            <th>Catatan</th>
                                            <th>Tgl. Diminta</th>
                                            <th>Kts Dipesan</th>
                                            <th>Kts Diterima</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody id="barangTableBody">
                                        {{-- @php
                                                $noBarangList = old('no_barang', ['']);
                                                $deskripsiList = old('deskripsi_barang', ['']);
                                                $ktsPermintaanList = old('kts_permintaan', ['']);
                                                $satuanList = old('satuan', ['']);
                                                $catatanPermintaanList = old('catatan', ['']);
                                                $tanggalPermintaanList = old('tgl_diminta', ['']);
                                                $ktsDipesanList = old('kts_dipesan', ['']);
                                                $ktsDiterimaList = old('kts_diterima', ['']);
                                            @endphp

                                            @foreach ($noBarangList as $i => $noBarang)
                                            <tr class="barang-row">
                                                <td>
                                                    <select id="namaBarangSelect" style="width: 150px;" class="form-control no-barang-select" name="no_barang[]">
                                                        <option {{ $noBarang ? '' : 'selected' }} disabled></option>
                                                        @foreach ($nama_barang as $items)
                                                            <option value="{{ $items->no_barang }}" 
                                                                data-nama="{{ $items->nama_barang }}"
                                                                data-satuan="{{ $items->satuan }}"
                                                                {{ $items->no_barang == $noBarang ? 'selected' : '' }}>
                                                                {{ $items->no_barang  . " - " . $items->nama_barang }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="width: 150px;" class="form-control deskripsi-barang-input" name="deskripsi_barang[]" value="{{ $deskripsiList[$i] ?? '' }}">
                                                </td>                                            
                                                <td>
                                                    <input style="width: 150px;" type="text" class="form-control" name="kts_permintaan[]" value="{{ $ktsPermintaanList[$i] ?? '' }}">
                                                </td>
                                                <td>
                                                    <select style="width: 150px; cursor: pointer;" class="form-control" name="satuan[]">
                                                        <option disabled {{ old('satuan[]') ? '' : 'selected' }}></option>
                                                        @foreach ($satuan as $item)
                                                            <option value="{{ $item->nama }}" {{ $item->nama == ($satuanList[$i] ?? '') ? 'selected' : '' }}> 
                                                                {{ $item->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input style="width: 200px;" type="text" class="form-control" name="catatan[]" value="{{ $catatanPermintaanList[$i] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input style="width: 150px;" type="date" class="form-control" name="tgl_diminta[]" value="{{ $tanggalPermintaanList[$i] ?? '' }}">
                                                </td>
                                                <td>
                                                    <input style="width: 150px;" type="text" class="form-control" name="kts_dipesan[]" value="{{ $ktsDipesanList[$i] ?? '' }}">
                                                </td><td>
                                                    <input style="width: 150px;" type="text" class="form-control" name="kts_diterima[]" value="{{ $ktsDiterimaList[$i] ?? '' }}">
                                                </td>
                                                <td>
                                                    <button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row">
                                                        <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach --}}
                                    </tbody>
                                </table>


                            </div>
                            <div id="ricape" class="tab-pane fade">


                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="tindak_lanjut_check"
                                                            value="0">
                                                        <input class="inp-cbx" name="tindak_lanjut_check"
                                                            id="tindak_lanjut_check" type="checkbox" value="1"
                                                            {{ old('tindak_lanjut_check') ? 'checked' : '' }}>
                                                        <label class="cbx" for="tindak_lanjut_check">
                                                            <span><svg width="12px" height="10px">
                                                                    <use xlink:href="#check-4"></use>
                                                                </svg></span>
                                                            <span><strong>Tindak Lanjut</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1">
                                                                </polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="urgent_check" value="0">
                                                        <input class="inp-cbx" name="urgent_check" id="urgent_check"
                                                            type="checkbox" value="1"
                                                            {{ old('urgent_check') ? 'checked' : '' }}>
                                                        <label class="cbx" for="urgent_check">
                                                            <span><svg width="12px" height="10px">
                                                                    <use xlink:href="#check-4"></use>
                                                                </svg></span>
                                                            <span><strong>Urgent</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1">
                                                                </polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_1" placeholder="Deskripsi">{{ old('deskripsi_1') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="catatan_pemeriksaan_check"
                                                            value="0">
                                                        <input class="inp-cbx" name="catatan_pemeriksaan_check"
                                                            id="catatan_pemeriksaan_check" type="checkbox"
                                                            value="1"
                                                            {{ old('catatan_pemeriksaan_check') ? 'checked' : '' }}>
                                                        <label class="cbx" for="catatan_pemeriksaan_check">
                                                            <span><svg width="12px" height="10px">
                                                                    <use xlink:href="#check-4"></use>
                                                                </svg></span>
                                                            <span><strong>Catatan Pemeriksaan</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1">
                                                                </polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_2"
                                                        value="{{ old('deskripsi_2') }}" placeholder="Deskripsi">{{ old('deskripsi_2') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <x-slot:scripts>

        </x-slot:scripts>
</x-layout.main>
