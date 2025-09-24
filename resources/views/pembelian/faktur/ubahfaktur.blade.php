@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Faktur Pembelian - <strong>{{ $fakturPembelian->no_faktur }}</strong> - <span id="statusBadge"></span></h3> 
                    </div>
                </div>
            </div>
            <form action="{{ route('pembelian/faktur/update', $fakturPembelian->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row checkbox-row-mobile-horizontal">
                                <div class="col-md-2 p-2">
                                    <div class="form-group">
                                        <div class="dd"></div>
                                        <div class="checkbox-wrapper-4">
                                            <input type="hidden" name="pajak_check" value="0">
                                            <input class="inp-cbx" name="pajak_check" id="pajak_check" type="checkbox" value="1" {{ old('pajak_check', $fakturPembelian->pajak_check) ? 'checked' : '' }}>
                                            <label class="cbx" for="pajak_check">
                                                <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                <span><strong>Pajak</strong></span>
                                            </label>
                                            <svg class="inline-svg">
                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </symbol>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 p-2">
                                    <div class="form-group">
                                        <div class="dd"></div>
                                        <div class="checkbox-wrapper-4">
                                            <input type="hidden" name="termasuk_pajak_check" value="0">
                                            <input class="inp-cbx" name="termasuk_pajak_check" id="termasuk_pajak_check" type="checkbox" value="1" {{ old('termasuk_pajak_check', $fakturPembelian->termasuk_pajak_check) ? 'checked' : '' }} disabled>
                                            <label class="cbx" for="termasuk_pajak_check">
                                                <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                <span><strong>Termasuk Pajak</strong></span>
                                            </label>
                                            <svg class="inline-svg">
                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </symbol>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-2 p-2">
                                    <div class="form-group">
                                        <div class="dd"></div>
                                        <div class="checkbox-wrapper-4">
                                            <input type="hidden" name="tutup_check" value="0">
                                            <input class="inp-cbx" name="tutup_check" id="tutup_check" type="checkbox" value="1" {{ old('tutup_check', $fakturPembelian->tutup_check) ? 'checked' : '' }}>
                                            <label class="cbx" for="tutup_check">
                                                <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                <span><strong>Tutup</strong></span>
                                            </label>
                                            <svg class="inline-svg">
                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </symbol>
                                            </svg>
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-md-2 p-2">
                                    <div class="form-group">
                                        <div class="dd"></div>
                                        <div class="checkbox-wrapper-4">
                                            <input type="hidden" name="disetujui_check" value="0">
                                            <input class="inp-cbx" name="disetujui_check" id="disetujui_check" type="checkbox" value="1" {{ old('disetujui_check', $fakturPembelian->disetujui_check) ? 'checked' : '' }}>
                                            <label class="cbx" for="disetujui_check">
                                                <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                <span><strong>Disetujui</strong></span>
                                            </label>
                                            <svg class="inline-svg">
                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </symbol>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-3 p-2">
                                    <div class="form-group">
                                        <div class="dd"></div>
                                        <div class="checkbox-wrapper-4">
                                            <input type="hidden" name="uang_muka_check" value="0">
                                            <input class="inp-cbx" name="uang_muka_check" id="uang_muka_check" type="checkbox" value="1" {{ old('uang_muka_check', $fakturPembelian->detail2->uang_muka_check) ? 'checked' : '' }}>
                                            <label class="cbx" for="uang_muka_check">
                                                <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                <span><strong>Uang Muka</strong></span>
                                            </label>
                                            <svg class="inline-svg">
                                                <symbol id="check-4" viewbox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </symbol>
                                            </svg>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Faktur</label>
                                                <input type="text" class="form-control" id="no_faktur" name="no_faktur" value="{{ $fakturPembelian->no_faktur }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Formulir</label>
                                                <input type="text" class="form-control" name="no_formulir" value="{{ $fakturPembelian->no_formulir }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="persetujuan-field" style="display: none;">
                                            <div class="form-group">
                                                <label>No. Persetujuan</label>
                                                <input type="text" class="form-control" name="no_persetujuan" value="{{ $fakturPembelian->no_persetujuan }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Pengguna</label>
                                            <input type="text" class="form-control" name="pengguna_faktur" value="{{ $fakturPembelian->pengguna_faktur }}">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Status</label>
                                            <input type="text" class="form-control" name="status_faktur" id="status_faktur" value="{{ $fakturPembelian->status_faktur }}">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tanggal Faktur</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker @error('tgl_faktur') is-invalid @enderror" name="tgl_faktur" value="{{ $fakturPembelian->tgl_faktur }}"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Pemasok</label>
                                                <select id="namaBarangSelect" class="form-control" name="pemasok_faktur">
                                                    <option {{ old('pemasok_faktur', $fakturPembelian->pemasok_faktur) ? '' : 'selected' }} disabled> -- Pilih Pemasok</option>
                                                    @foreach ($pemasok as $items )
                                                        <option value="{{ $items->nama }}"
                                                            data-no-pemasok="{{ $items->pemasok_id }}"
                                                            data-syarat="{{ $items->syarat_id }}"
                                                            data-alamat-1="{{ $items->alamat_1 }}"
                                                            data-nilai-tukar="{{ $items->nilai_tukar }}"
                                                            data-pajak="{{ $items->pajak_1_check }}"
                                                            {{ old('pemasok_faktur', $fakturPembelian->pemasok_faktur) == $items->nama ? 'selected' : '' }}>
                                                            {{ $items->pemasok_id . " - " . $items->nama . " - " . $items->mata_uang_nama }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <select id="noPemasokSelect" class="form-control"  name="no_pemasok" style="display: none">
                                                    <option {{ old('no_pemasok', $fakturPembelian->no_pemasok) ? '' : 'selected' }} disabled></option>
                                                    @foreach ($pemasok as $items )
                                                    <option value="{{ $items->pemasok_id }}" {{ old('no_pemasok', $fakturPembelian->no_pemasok) == $items->pemasok_id ? 'selected' : '' }}>
                                                        {{ $items->pemasok_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Proyek</label>
                                                <select class="form-control" name="proyek">
                                                    <option disabled selected>Pilih Proyek</option>
                                                    @foreach ($proyek as $items)
                                                        <option value="{{ $items->nama_proyek }}" {{ old('proyek', $fakturPembelian->proyek) == $items->nama_proyek ? 'selected' : '' }}>
                                                            {{ $items->proyek_id . ' - ' . $items->nama_proyek }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Gudang</label>
                                                <select class="form-control"  name="gudang">
                                                    <option disabled selected></option>
                                                    @foreach ($gudang as $items)
                                                    <option value="{{ $items->nama_gudang }}" {{ old('gudang', $fakturPembelian->gudang) == $items->nama_gudang ? 'selected' : '' }}>{{ $items->nama_gudang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Departemen</label>
                                                <select class="form-control"  name="departemen">
                                                    <option disabled selected></option>
                                                    @foreach ($departemen as $items )
                                                    <option value="{{ $items->nama_departemen }}" {{ old('departemen', $fakturPembelian->departemen) == $items->nama_departemen ? 'selected' : '' }}>{{ $items->nama_departemen }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#rincian">Rincian Barang</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#rincianbiaya">Rincian Biaya</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#informasi">Informasi</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#ricape">Rincian Catatan Pemeriksaan</a> 
                            </li>
                        </ul>
                    </div>
                    <div style="padding-bottom: 15px;" id="rincian" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                {{-- <th>Dari</th> --}}
                                                <th>No. Barang</th>
                                                <th>Deskripsi Barang</th>
                                                <th>Kts</th>
                                                <th>Satuan</th>
                                                <th>Harga Satuan</th>
                                                <th>Diskon %</th>
                                                <th>Pajak</th>
                                                <th>Jumlah</th>
                                                <th>Reserve 1</th>
                                                <th>Reserve 2</th>
                                                <th>Reserve 3</th>
                                                <th>No. Penerimaan</th>
                                                <th>No. Pesanan</th>
                                                <th>No. Permintaan</th>
                                                <th>Tutup</th>
                                            </tr>
                                        </thead>
                                        <tbody id="barangTableBody">
                                            @php
                                                $noBarangList = old('no_barang', ['']);
                                                $deskripsiList = old('deskripsi_barang', ['']);
                                                $ktsPermintaanList = old('kts_permintaan', ['']);
                                                $satuanList = old('satuan', ['']);
                                                $catatanPermintaanList = old('catatan', ['']);
                                                $tanggalPermintaanList = old('tgl_diminta', ['']);
                                                $ktsDipesanList = old('kts_dipesan', ['']);
                                                $ktsDiterimaList = old('kts_diterima', ['']);
                                            @endphp
                                            @foreach ($fakturPembelian->detail as $index => $detail)
                                                <tr class="barang-row">
                                                    <td><input style="width: 150px;" type="text" name="no_barang[]" value="{{ $detail->no_barang }}" class="form-control form-control-sm" readonly></td>
                                                    <td><input style="width: 150px;" type="text" name="deskripsi_barang[]" value="{{ $detail->deskripsi_barang }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="kts_faktur[]" value="{{ $detail->kts_faktur }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="satuan[]" value="{{ $detail->satuan }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="harga_satuan[]" value="{{ $detail->harga_satuan }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="diskon_barang[]" value="{{ $detail->diskon_barang }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="kode_pajak[]" value="{{ $detail->kode_pajak }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="jumlah_total_harga[]" value="{{ $detail->jumlah_total_harga }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="reserve_1[]" value="{{ $detail->reserve_1 }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="reserve_2[]" value="{{ $detail->reserve_2 }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="reserve_3[]" value="{{ $detail->reserve_3 }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="no_penerimaan[]" value="{{ $detail->no_penerimaan }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="no_pesanan[]" value="{{ $detail->no_pesanan }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="no_permintaan[]" value="{{ $detail->no_permintaan }}" class="form-control form-control-sm"></td>
                                                    <td>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="tutup_check_detail[{{ $index }}]" value="0">
                                                        <input class="inp-cbx" name="tutup_check_detail[{{ $index }}]" id="tutup_check_detail_{{ $index }}" type="checkbox" value="1" 
                                                            {{ old("tutup_check_detail.$index", $detail->tutup_check_detail) ? 'checked' : '' }}>
                                                        <label class="cbx" for="tutup_check_detail_{{ $index }}">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewBox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 15px;" id="rincianbiaya" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Akun</th>
                                                <th>Nama Akun</th>
                                                <th>Jumlah</th>
                                                <th>Catatan</th>
                                                <th>Alokasi ke Barang</th>
                                                <th>Alokasi ke Pemasok</th>
                                                <th>Beban ke Tagihan</th>
                                                <th>Nama Pemasok</th>
                                                <th>No. Faktur</th>
                                                <th>Nama Akun</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="barangTableBody">
                                            <tr>
                                                {{-- <td style="background-color: {{ $isPesanan ? '#27548A' : '#333' }};">
                                                    <h7 class="font-weight-bold text-white">{{ $isPesanan ? 'Pesanan' : 'Barang' }}</h7>
                                                </td> --}}
                                                <td><input style="width: 150px;" type="text" name="no_akun" value="{{ old('no_akun') }}" class="form-control form-control-sm" readonly></td>
                                                <td><input style="width: 150px;" type="text" name="nama_akun" value="{{ old('nama_akun') }}" class="form-control form-control-sm"></td>
                                                <td><input style="width: 150px;" type="text" name="jumlah" value="{{ old('jumlah') }}" class="form-control form-control-sm"></td>
                                                <td><input style="width: 150px;" type="text" name="catatan" value="{{ old('catatan') }}" class="form-control form-control-sm"></td>
                                                <td>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="alokasi_barang_check" value="0">
                                                        <input class="inp-cbx" name="alokasi_barang_check" id="alokasi_barang_check" type="checkbox" value="1"
                                                            {{ old("alokasi_barang_check") ? 'checked' : '' }}>
                                                        <label class="cbx" for="alokasi_barang_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="alokasi_pemasok_check" value="0">
                                                        <input class="inp-cbx" name="alokasi_pemasok_check" id="alokasi_pemasok_check" type="checkbox" value="1"
                                                            {{ old("alokasi_pemasok_check") ? 'checked' : '' }}>
                                                        <label class="cbx" for="alokasi_pemasok_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="beban_tagihan_check" value="0">
                                                        <input class="inp-cbx" name="beban_tagihan_check" id="beban_tagihan_check" type="checkbox" value="1"
                                                            {{ old("beban_tagihan_check") ? 'checked' : '' }}>
                                                        <label class="cbx" for="beban_tagihan_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </td>
                                                <td><input style="width: 150px;" type="text" name="nama_pemasok_detail" value="{{ old('nama_pemasok_detail') }}" class="form-control form-control-sm"></td>
                                                <td><input style="width: 150px;" type="text" name="no_faktur_detail" value="{{ old('no_faktur_detail') }}" class="form-control form-control-sm"></td>
                                                <td><input style="width: 150px;" type="text" name="nama_akun" value="{{ old('nama_akun') }}" class="form-control form-control-sm"></td>
                                                <td><input style="width: 150px;" type="date" name="tanggal_detail" value="{{ old('tanggal_detail') }}" class="form-control form-control-sm"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 15px;" id="informasi" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label><strong>Alamat Pemasok</strong></label>
                                                <textarea id="alamatPemasokInput" class="form-control @error('alamat_pemasok') is-invalid @enderror" name="alamat_pemasok" placeholder="Alamat Pemasok">{{ $fakturPembelian->detail2->alamat_pemasok }}</textarea>
                                            </div>                                       
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Tgl. Kirim</strong></label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker" name="tgl_kirim" value="{{ $fakturPembelian->detail2->tgl_kirim }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <label><strong>Nilai Tukar</strong></label>
                                                <input id="nilaiTukarInput" type="text" class="form-control" name="nilai_tukar" value="{{ $fakturPembelian->detail2->nilai_tukar }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <label><strong>Nilai Tukar Pajak</strong></label>
                                                <input id="nilaiTukarPajak" type="text" class="form-control" name="nilai_tukar_pajak" value="{{ $fakturPembelian->detail2->nilai_tukar_pajak }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Kirim Melalui</strong></label>
                                                <select name="kirim_melalui" id="kirim_melalui" class="form-control">
                                                    <option value="0">0</option>
                                                    <option value="Tidak ada data" disabled>Tidak ada data</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Tgl. Pajak</strong></label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker" name="tgl_pajak" value="{{ $fakturPembelian->detail2->tgl_pajak }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <label><strong>FOB</strong></label>
                                                <select name="fob" class="form-control">
                                                    <option {{ old('fob', $fakturPembelian->detail2->fob) ? '' : 'selected' }} disabled>-- Pilih FOB --</option>
                                                    <option value="Shipping Point" {{ old('fob', $fakturPembelian->detail2->fob) == 'Shipping Point' ? 'selected' : '' }}>Shipping Point</option>
                                                    <option value="Destination" {{ old('fob', $fakturPembelian->detail2->fob) == 'Destination' ? 'selected' : '' }}>Destination</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>No. Faktur Pajak</strong></label>
                                                <input type="text" class="form-control" name="no_faktur_pajak" value="{{ $fakturPembelian->detail2->no_faktur_pajak }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 15px;" id="dokumen" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="page-header">
                                    <div class="row float-right">
                                        <button type="button" id="fileuploads_btn_update" class="btn btn-primary buttonedit float-right"><i class="fa fa-plus mr-2"></i>Tambah Field</button>
                                    </div>
                                </div>
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12" id="fileuploads_loop">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @while (!empty($fakturPembelian["fileupload_$i"]))
                                            <div class="row formtype mb-2" id="fieldRow_{{ $i }}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fileupload_{{ $i }}">File {{ $i }}</label>
                                                        <p><a class="link-opacity-10-hover" href="{{ $fakturPembelian["fileupload_$i"] }}">{{ $fakturPembelian["fileupload_$i"] }}</a></p>
                                                    </div>
                                                </div>
                                                {{-- <div class="col-md-1 d-flex align-items-end">
                                                    <button type="button" class="btn btn-danger btn-sm removeField" data-id="{{ $i }}">Hapus</button>
                                                </div> --}}
                                            </div>
                                            @php $i++; @endphp
                                        @endwhile
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 15px;" id="ricape" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="tindak_lanjut_check" value="0">
                                                        <input class="inp-cbx" name="tindak_lanjut_check" id="tindak_lanjut_check" type="checkbox" value="1" {{ old('tindak_lanjut_check', $fakturPembelian->tindak_lanjut_check) ? 'checked' : '' }}>
                                                        <label class="cbx" for="tindak_lanjut_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                            <span><strong>Tindak Lanjut</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
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
                                                        <input class="inp-cbx" name="urgent_check" id="urgent_check" type="checkbox" value="1" {{ old('urgent_check', $fakturPembelian->urgent_check) ? 'checked' : '' }}>
                                                        <label class="cbx" for="urgent_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                            <span><strong>Urgent</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_1" placeholder="Deskripsi">{{ old('deskripsi_1', $fakturPembelian->deskripsi_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="catatan_pemeriksaan_check" value="0">
                                                        <input class="inp-cbx" name="catatan_pemeriksaan_check" id="catatan_pemeriksaan_check" type="checkbox" value="1" {{ old('catatan_pemeriksaan_check', $fakturPembelian->catatan_pemeriksaan_check) ? 'checked' : '' }}>
                                                        <label class="cbx" for="catatan_pemeriksaan_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                            <span><strong>Catatan Pemeriksaan</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_2" placeholder="Deskripsi">{{ old('deskripsi_2', $fakturPembelian->deskripsi_2) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#deskripsi">Deskripsi</a> 
                            </li>
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="deskripsi" class="tab-pane fade show active">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control" name="deskripsi_faktur" placeholder="Deskripsi">{{ old('deskripsi_faktur', $fakturPembelian->deskripsi_faktur) }}</textarea> 
                                                </div>
                                            </div>
                                        </div>
                                        <div id="uang_muka_form" style="display: none;">
                                            <div class="form-group">
                                                <label>Akun Piutang</label>
                                                <select class="form-control form-control-sm" name="akun_uang_muka">
                                                    <option {{ old('akun_uang_muka', $fakturPembelian->detail2->akun_uang_muka) ? '' : 'selected' }} disabled> --Pilih Sub-- </option>
                                                    @foreach ($nama_akun as $items )
                                                        <option value="{{ $items->no_akun }}" {{ old('akun_uang_muka', $fakturPembelian->detail2->akun_uang_muka) == $items->no_akun ? 'selected' : '' }}>{{ $items->no_akun .' '. $items->nama_akun_indonesia }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Uang Muka</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm" name="uang_muka" value="{{ $fakturPembelian->detail2->uang_muka }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Uang Muka Terpakai</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm" name="uang_muka_terpakai" value="{{ $fakturPembelian->detail2->uang_muka_terpakai }}">
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
                        <div class="col-md-6">
                            <div style="padding-bottom: 400px;" id="deskripsi" class="tab-pane fade show active">
                                <div class="card float-right">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label><strong>Sub Total</strong></label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="sub_total" value="{{ $fakturPembelian->sub_total }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label>Diskon</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="input-group input-group-sm mb-4" style="width: 120px;">
                                                    <input type="number" class="form-control" name="diskon_left" value="{{ $fakturPembelian->diskon_left }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="total_diskon_right" value="{{ $fakturPembelian->total_diskon_right }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="ppnRow" style="display: none;">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label>PPN 11%</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="ppn_11_persen" id="ppn_11_persen" value="{{ $fakturPembelian->ppn_11_persen }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="pajak2Row" style="display: none;">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label>Pajak 2</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="pajak_2" value="{{ $fakturPembelian->pajak_2 }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label>Est. Biaya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="estimasi_biaya" id="estimasi_biaya" value="{{ $fakturPembelian->estimasi_biaya }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label><strong>Jumlah</strong></label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="jumlah" id="jumlah" value="{{ $fakturPembelian->jumlah }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit">Update</button>
                                <a href="{{ route('pembelian/faktur/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3 mb-5"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')   
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.querySelector('input[name="disetujui_check"]');
            const persetujuanField = document.getElementById('persetujuan-field');

            function toggleField() {
                if (checkbox.checked) {
                    persetujuanField.style.display = 'block';
                } else {
                    persetujuanField.style.display = 'none';
                }
            }

            checkbox.addEventListener('change', toggleField);
            toggleField(); // Jalankan sekali waktu load
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const disetujuiCheck = document.getElementById("disetujui_check");
            const statusInput = document.getElementById("status_faktur");
            const statusBadge = document.getElementById("statusBadge");
            const checkboxTutup = document.querySelectorAll('input[id^="tutup_check_detail_"]');

            function updateStatus() {
                let jumlahCheckbox = checkboxTutup.length;
                let checkedCount = 0;
                let statusText = '';
                let badgeHTML = '';

                checkboxTutup.forEach(cb => {
                    if (cb.checked && cb.value === "1") {
                        checkedCount++;
                    }
                });

                if (disetujuiCheck.checked && disetujuiCheck.value === "1") {
                    statusText = 'Diterima';
                    badgeHTML = '<span class="badge bg-success"><i class="fas fa-check"> </i> Diterima</span>';
                } else if (checkedCount === jumlahCheckbox && jumlahCheckbox > 0) {
                    statusText = 'Diproses';
                    badgeHTML = '<span class="badge bg-info"><i class="fas fa-tasks"> </i> Diproses</span>';
                } else if (checkedCount > 0) {
                    statusText = 'Diproses';
                    badgeHTML = '<span class="badge bg-info"><i class="fas fa-tasks"> </i> Diproses</span>';
                } else {
                    statusText = 'Menunggu';
                    badgeHTML = '<span class="badge bg-warning"><i class="fas fa-spinner"> </i> Menunggu</span>';
                }

                statusInput.value = statusText;

                statusBadge.innerHTML = badgeHTML;
            }

            updateStatus();

            disetujuiCheck.addEventListener('change', updateStatus);
            checkboxTutup.forEach(cb => {
                cb.addEventListener('change', updateStatus);
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#checkAllPesanan').click(function () {
                $('.check-pesanan').prop('checked', this.checked);
            });

            $('#tambahPesananTerpilih').click(function () {
                let selectedPesanan = $('.check-pesanan:checked').first();
                if (selectedPesanan.length === 0) {
                    alert("Pilih minimal satu pesanan terlebih dahulu.");
                    return;
                }

                let no_pesanan = selectedPesanan.data('id');

                $.ajax({
                    url: '/get-detail-faktur',
                    method: 'GET',
                    data: { no_pesanan: no_pesanan },
                    success: function (data) {
                        data.forEach(item => {
                            let newRow = `
                            <tr class="pesanan-row">
                                <td style="background-color: #27548A;"><h7 class="font-weight-bold text-white">Pesanan</h7></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_barang[]" value="${item.no_barang}" readonly></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="deskripsi_barang[]" value="${item.deskripsi_barang}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kts_faktur[]" value="${item.kts_pesanan || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="satuan[]" value="${item.satuan}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="harga_satuan[]" value="${item.harga_satuan || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="diskon_barang[]" value="${item.diskon_barang || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kode_pajak[]" value="${item.pajak || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="jumlah_total_harga[]" value="${item.jumlah_total_harga || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_1[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_2[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_3[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_penerimaan[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_pesanan[]" value="${item.no_pesanan || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_permintaan[]" value="${item.no_permintaan || ''}"></td>
                                <td><button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                            </tr>`;
                            $('#barangTableBody').append(newRow);
                        });

                        $('#modalPesanan').modal('hide');
                        hitungSemuaJumlahDanSubTotal();
                    },
                    error: function () {
                        alert("Gagal mengambil data detail pesanan.");
                    }
                });
            });

            $('#modalPesanan').on('show.bs.modal', function () {
                $('#checkAllPesanan').prop('checked', false);
                $('.check-pesanan').prop('checked', false);
            });

            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
                hitungSemuaJumlahDanSubTotal();
            });

            $(document).on('input', 'input[name="kts_pesanan[]"], input[name="kts_faktur[]"], input[name="harga_satuan[]"], input[name="diskon_barang[]"], input[name="diskon_left"], #estimasi_biaya, #aktif_ppn', function () {
                hitungSemuaJumlahDanSubTotal();
            });

            function hitungSemuaJumlahDanSubTotal() {
                let subTotal = 0;

                $('#barangTableBody tr').each(function () {
                    let kts = parseFloat($(this).find('input[name="kts_pesanan[]"], input[name="kts_faktur[]"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    let harga = parseFloat($(this).find('input[name="harga_satuan[]"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    let diskon = parseFloat($(this).find('input[name="diskon_barang[]"]').val()?.replace('%', '').replace(',', '.')) || 0;

                    let jumlah = kts * harga * (1 - (diskon / 100));
                    jumlah = parseFloat(jumlah);

                    $(this).find('input[name="jumlah_total_harga[]"]').val(jumlah);
                    subTotal += jumlah;
                });

                $('input[name="sub_total"]').val(subTotal);

                let diskonPersen = parseFloat($('input[name="diskon_left"]').val()?.replace(',', '.')) || 0;
                let totalDiskon = subTotal * (diskonPersen / 100);
                $('input[name="total_diskon_right"]').val(totalDiskon);

                let pajakCheckbox = document.getElementById('pajak_check');
                let ppn = (pajakCheckbox && pajakCheckbox.checked) ? (subTotal - totalDiskon) * 0.11 : 0;
                $('input[name="ppn_11_persen"]').val(ppn);

                let estimasiBiaya = parseFloat($('input[name="estimasi_biaya"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                let jumlahTotal = subTotal - totalDiskon + ppn + estimasiBiaya;
                $('input[name="jumlah"]').val(jumlahTotal);
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('tindak_lanjut_check');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('catatan_pemeriksaan_check');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>     
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('urgent_check');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>      
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('tutup_check');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script> 
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('disetujui_check');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('tutup_check_detail');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('uang_muka_check');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("uang_muka_check");
            const tipeAkunForm = document.getElementById("uang_muka_form");
    
            function toggleTipeAkunForm() {
                if (checkbox.checked) {
                    tipeAkunForm.style.display = "block";
                } else {
                    tipeAkunForm.style.display = "none";
                }
            }
    
            toggleTipeAkunForm();
    
            checkbox.addEventListener("change", toggleTipeAkunForm);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const namaBarangSelect = document.getElementById('namaBarangSelect');
            const noPemasokSelect = document.getElementById('noPemasokSelect');
            const syaratSelect = document.getElementById('syaratSelect');
            const alamatPemasokInput = document.getElementById('alamatPemasokInput');
            const nilaiTukarInput = document.getElementById('nilaiTukarInput');
            const pajakCheckbox = document.getElementById('pajak_check');
            const disetujuiCheck = document.getElementById('disetujui_check');
            const termasukPajakCheckbox = document.getElementById('termasuk_pajak_check');
            const satuanSelect = document.getElementById('satuanSelect');
            const ppnRow = document.getElementById('ppnRow');
            const pajak2Row = document.getElementById('pajak2Row');


            // Tak set gini pas awal mau isi form
            termasukPajakCheckbox.disabled = false;
            disetujuiCheck.disabled = false;
            pajakCheckbox.disabled = false;

            function togglePPNDisplay() {
                if (pajakCheckbox.checked) {
                    ppnRow.style.display = 'flex';
                } else {
                    ppnRow.style.display = 'none';
                }
            }

            function togglePajak2Display() {
                if (pajakCheckbox.checked) {
                    pajak2Row.style.display = 'flex';
                } else {
                    pajak2Row.style.display = 'none';
                }
            }

            togglePPNDisplay();
            togglePajak2Display();

            pajakCheckbox.addEventListener('change', togglePPNDisplay);
            pajakCheckbox.addEventListener('change', togglePajak2Display);

            namaBarangSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const pajakValue = selectedOption.getAttribute('data-pajak');

                // Ini buat nek pas kosong nilainya
                if (selectedOption.value === "") {
                    termasukPajakCheckbox.disabled = true;
                    termasukPajakCheckbox.checked = false;

                    pajakCheckbox.disabled = true;
                    pajakCheckbox.checked = false;
                } else {
                    // pajak_1_check = 1
                    if (pajakValue === "1") {
                        pajakCheckbox.disabled = false;
                        pajakCheckbox.checked = true;

                        termasukPajakCheckbox.disabled = false;
                    } else {
                    // pajak_1_check = 0
                        pajakCheckbox.checked = false;
                        pajakCheckbox.disabled = true;

                        termasukPajakCheckbox.checked = false;
                        termasukPajakCheckbox.disabled = true;
                    }
                }

                togglePPNDisplay();
                togglePajak2Display();

                noPemasokSelect.value = selectedOption.getAttribute('data-no-pemasok') || '';
                syaratSelect.value = selectedOption.getAttribute('data-syarat') || '';
                alamatPemasokInput.value = selectedOption.getAttribute('data-alamat-1') || '';
                nilaiTukarInput.value = selectedOption.getAttribute('data-nilai-tukar') || '';
                satuanSelect.value = selectedOption.getAttribute('data-satuan') || '';
            });
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const namaBarangSelect = document.getElementById('namaBarangSelect');
            const deskripsiBarangInput = document.getElementById('deskripsiBarangInput');
            const departemenSelect = document.getElementById('departemenSelect');
            const proyekSelect = document.getElementById('proyekSelect');
            const gudangSelect = document.getElementById('gudangSelect');
            const ktsSaatIniInput = document.getElementById('ktsSaatIniInput');
            const nilaiSaatIniInput = document.getElementById('nilaiSaatIniInput');
        
        namaBarangSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            deskripsiBarangInput.value = selectedOption.getAttribute('data-nama') || '';
            departemenSelect.value = selectedOption.getAttribute('data-departemen') || '';
            proyekSelect.value = selectedOption.getAttribute('data-proyek') || '';
            gudangSelect.value = selectedOption.getAttribute('data-gudang') || '';
            ktsSaatIniInput.value = selectedOption.getAttribute('data-ktssaatini') || '';
            nilaiSaatIniInput.value = selectedOption.getAttribute('data-nilaisaatini') || '';
        });
    });
    </script>         --}}
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    <script>
        let fieldCount = {{ $i - 1 }};
        const maxFields = 7;
    
        document.getElementById('fileuploads_btn_update').addEventListener('click', function () {
            if (fieldCount >= maxFields) {
                alert('Maksimal hanya boleh 7 file.');
                return;
            }
            
            fieldCount++;
    
            const fieldRow = `
                <div class="row formtype mb-2" id="fieldRow_${fieldCount}">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fileupload_${fieldCount}">File ${fieldCount}</label>
                            <input type="text" class="form-control" name="fileupload_${fieldCount}" placeholder="Link dokumen Anda">
                        </div>
                    </div>
                </div>
            `;
    
            document.getElementById('fileuploads_loop').insertAdjacentHTML('beforeend', fieldRow);
        });
    
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('removeField')) {
                const id = e.target.dataset.id;
                document.getElementById('fieldRow_' + id).remove();
            }
        });
    </script>    
    @endsection
@endsection