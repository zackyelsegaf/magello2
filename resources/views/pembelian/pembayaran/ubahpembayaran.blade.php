@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Pembayaran Pembelian - <strong>{{ $pembayaranPembelian->no_pembayaran }}</strong> - <span id="statusBadge"></span></h3> 
                    </div>
                </div>
            </div>
            <form action="{{ route('pembelian/pembayaran/update', $pembayaranPembelian->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row checkbox-row-mobile-horizontal">
                                <div class="col-md-3 p-2">
                                    <div class="form-group">
                                        <div class="dd"></div>
                                        <div class="checkbox-wrapper-4">
                                            <input type="hidden" name="cek_kosong_check" value="0">
                                            <input class="inp-cbx" name="cek_kosong_check" id="cek_kosong_check" type="checkbox" value="1" {{ old('cek_kosong_check', $pembayaranPembelian->cek_kosong_check) ? 'checked' : '' }}>
                                            <label class="cbx" for="cek_kosong_check">
                                                <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                <span><strong>Cek Kosong</strong></span>
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
                                            <input type="hidden" name="pajak_check" value="0">
                                            <input class="inp-cbx" name="pajak_check" id="pajak_check" type="checkbox" value="1" {{ old('pajak_check', $pembayaranPembelian->pajak_check) ? 'checked' : '' }} disabled>
                                            <label class="cbx" for="pajak_check">
                                                <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                <span><strong>Pembayaran Pajak</strong></span>
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
                                            <input type="hidden" name="disetujui_check" value="0">
                                            <input class="inp-cbx" name="disetujui_check" id="disetujui_check" type="checkbox" value="1" {{ old('disetujui_check', $pembayaranPembelian->disetujui_check) ? 'checked' : '' }}>
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
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Pembayaran</label>
                                                <input type="text" class="form-control" id="no_pembayaran" name="no_pembayaran" value="{{ $pembayaranPembelian->no_pembayaran }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Formulir</label>
                                                <input type="text" class="form-control" name="no_formulir" value="{{ $pembayaranPembelian->no_formulir }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="persetujuan-field" style="display: none;">
                                            <div class="form-group">
                                                <label>No. Persetujuan</label>
                                                <input type="text" class="form-control" name="no_persetujuan" value="{{ $pembayaranPembelian->no_persetujuan }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Pengguna</label>
                                            <input type="text" class="form-control" name="pengguna_pembayaran" value="{{ $pembayaranPembelian->pengguna_pembayaran }}">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Status</label>
                                            <input type="text" class="form-control" name="status_pembayaran" id="status_pembayaran" value="{{ $pembayaranPembelian->status_pembayaran }}">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tanggal Faktur</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker @error('tgl_pembayaran') is-invalid @enderror" name="tgl_pembayaran" value="{{ $pembayaranPembelian->tgl_pembayaran }}"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Pemasok</label>
                                                <select id="namaBarangSelect" class="form-control" name="pemasok_pembayaran">
                                                    <option {{ old('pemasok_pembayaran', $pembayaranPembelian->pemasok_pembayaran) ? '' : 'selected' }} disabled> -- Pilih Pemasok</option>
                                                    @foreach ($pemasok as $items )
                                                        <option value="{{ $items->nama }}"
                                                            data-no-pemasok="{{ $items->pemasok_id }}"
                                                            data-syarat="{{ $items->syarat }}"
                                                            data-alamat-1="{{ $items->alamat_1 }}"
                                                            data-nilai-tukar="{{ $items->nilai_tukar }}"
                                                            data-pajak="{{ $items->pajak_1_check }}"
                                                            {{ old('pemasok_pembayaran', $pembayaranPembelian->pemasok_pembayaran) == $items->nama ? 'selected' : '' }}>
                                                            {{ $items->pemasok_id . " - " . $items->nama . " - " . $items->mata_uang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <select id="noPemasokSelect" class="form-control"  name="no_pemasok" style="display: none">
                                                    <option {{ old('no_pemasok', $pembayaranPembelian->no_pemasok) ? '' : 'selected' }} disabled></option>
                                                    @foreach ($pemasok as $items )
                                                    <option value="{{ $items->pemasok_id }}" {{ old('no_pemasok', $pembayaranPembelian->no_pemasok) == $items->pemasok_id ? 'selected' : '' }}>
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
                                                        <option value="{{ $items->nama_proyek }}" {{ old('proyek', $pembayaranPembelian->proyek) == $items->nama_proyek ? 'selected' : '' }}>
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
                                                    <option value="{{ $items->nama_gudang }}" {{ old('gudang', $pembayaranPembelian->gudang) == $items->nama_gudang ? 'selected' : '' }}>{{ $items->nama_gudang }}</option>
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
                                                    <option value="{{ $items->nama_departemen }}" {{ old('departemen', $pembayaranPembelian->departemen) == $items->nama_departemen ? 'selected' : '' }}>{{ $items->nama_departemen }}</option>
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
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#rincian">Rincian Data</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Attachment Document</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#ricape">Rincian Catatan Pemeriksaan</a> 
                            </li>
                        </ul>
                    </div>
                    <div style="padding-bottom: 15px;" id="rincian" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Bank</strong></label>
                                                <select id="bankSelect" class="form-control form-control-sm" name="akun_bank">
                                                    <option {{ old('akun_bank', $pembayaranPembelian->detail2->akun_bank) ? '' : 'selected' }}  selected disabled> --Pilih Sub-- </option>
                                                    @foreach ($nama_akun as $items )
                                                        <option value="{{ $items->no_akun }}"
                                                            data-saldo_akun="{{ $items->saldo_akun }}"
                                                            {{ old('akun_bank', $pembayaranPembelian->detail2->akun_bank) == $items->no_akun ? 'selected' : '' }}>
                                                            {{ $items->nama_akun_indonesia }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Tgl. Cek</strong></label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control form-control-sm datetimepicker" name="tgl_cek" value="{{ old('tgl_cek', $pembayaranPembelian->detail2->tgl_cek) }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <label><strong>Nilai Tukar</strong></label>
                                                <input id="nilaiTukarInput" type="text" class="form-control form-control-sm" name="nilai_tukar" value="{{ old('nilai_tukar', $pembayaranPembelian->detail2->nilai_tukar) }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>No. Cek</strong></label>
                                                <input type="text" class="form-control form-control-sm" name="no_cek" value="{{ old('no_cek', $pembayaranPembelian->detail2->no_cek) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-1" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Jumlah Cek</strong></label>
                                                <input type="text" class="form-control form-control-sm" name="jumlah_check" value="{{ old('jumlah_check', $pembayaranPembelian->detail2->jumlah_check) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-1" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Saldo</strong></label>
                                                <input type="text" id="saldoAkunInput" class="form-control form-control-sm" name="saldo_bank" value="{{ old('saldo_bank', $pembayaranPembelian->detail2->saldo_bank) }}">
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
                                        @while (!empty($pembayaranPembelian["fileupload_$i"]))
                                            <div class="row formtype mb-2" id="fieldRow_{{ $i }}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fileupload_{{ $i }}">File {{ $i }}</label>
                                                        <p><a class="link-opacity-10-hover" href="{{ $pembayaranPembelian["fileupload_$i"] }}">{{ $pembayaranPembelian["fileupload_$i"] }}</a></p>
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
                                                        <input class="inp-cbx" name="tindak_lanjut_check" id="tindak_lanjut_check" type="checkbox" value="1" {{ old('tindak_lanjut_check', $pembayaranPembelian->tindak_lanjut_check) ? 'checked' : '' }}>
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
                                                        <input class="inp-cbx" name="urgent_check" id="urgent_check" type="checkbox" value="1" {{ old('urgent_check', $pembayaranPembelian->urgent_check) ? 'checked' : '' }}>
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
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_1" placeholder="Deskripsi">{{ old('deskripsi_1', $pembayaranPembelian->deskripsi_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="catatan_pemeriksaan_check" value="0">
                                                        <input class="inp-cbx" name="catatan_pemeriksaan_check" id="catatan_pemeriksaan_check" type="checkbox" value="1" {{ old('catatan_pemeriksaan_check', $pembayaranPembelian->catatan_pemeriksaan_check) ? 'checked' : '' }}>
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
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_2" placeholder="Deskripsi">{{ old('deskripsi_2', $pembayaranPembelian->deskripsi_2) }}
                                                    </textarea>                                                                                                    
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
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#informasi">Informasi Lainnya</a> 
                            </li>
                        </ul>
                    </div>
                    <div style="padding-bottom: 15px;" id="deskripsi" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="datatable table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Faktur</th>
                                                <th>Tgl. Faktur</th>
                                                <th>Jatuh Tempo</th>
                                                <th>PPh Ps. 23</th>
                                                <th>Diskon</th>
                                                <th>Jumlah</th>
                                                <th>Terhutang</th>
                                                <th>Jumlah Pembayaran</th>
                                                <th>Deskripsi</th>
                                                <th>Bayar</th>
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
                                            @foreach ($pembayaranPembelian->detail as $index => $detail)
                                                <tr class="barang-row">
                                                    <td><input style="width: 150px;" type="text" name="no_faktur[]" value="{{ $detail->no_faktur }}" class="form-control form-control-sm" readonly></td>
                                                    <td><input style="width: 150px;" type="text" name="tgl_faktur[]" value="{{ $detail->tgl_faktur }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="jatuh_tempo[]" value="{{ $detail->jatuh_tempo }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="pph_23[]" value="{{ $detail->pph_23 }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="diskon[]" value="{{ $detail->diskon }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="jumlah[]" value="{{ $detail->jumlah }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="terhutang[]" value="{{ $detail->terhutang }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="jumlah_pembayaran[]" value="{{ $detail->jumlah_pembayaran }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="deskripsi_rincian[]" value="{{ $detail->deskripsi_rincian }}" class="form-control form-control-sm"></td>
                                                    <td>
                                                        <div class="checkbox-wrapper-4">
                                                            <input type="hidden" name="bayar_check[{{ $index }}]" value="0">
                                                            <input class="inp-cbx" name="bayar_check[{{ $index }}]" id="bayar_check_{{ $index }}" type="checkbox" value="1" 
                                                                {{ old("bayar_check.$index", $detail->bayar_check) ? 'checked' : '' }}>
                                                            <label class="cbx" for="bayar_check_{{ $index }}">
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
                    <div style="padding-bottom: 15px;" id="informasi" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label><strong>Alamat Pemasok</strong></label>
                                                <textarea id="alamatPemasokInput" class="form-control form-control-sm" name="alamat_pemasok" placeholder="Alamat Pemasok">{{ $pembayaranPembelian->detail2->alamat_pemasok }}</textarea>
                                            </div> 
                                            <div class="form-group">
                                                <textarea class="form-control form-control-sm" name="deskripsi" placeholder="Deskripsi">{{ old('deskripsi', $pembayaranPembelian->detail2->deskripsi) }}</textarea>
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
                                <a href="{{ route('pembelian/pembayaran/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3 mb-5"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
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
            const statusInput = document.getElementById("status_pembayaran");
            const statusBadge = document.getElementById("statusBadge");
            const checkboxTutup = document.querySelectorAll('input[id^="bayar_check_"]');

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
            $('#checkAllFaktur').click(function () {
                $('.check-faktur').prop('checked', this.checked);
            });

            $('#tambahFakturTerpilih').click(function () {
                let selectedFaktur = $('.check-faktur:checked');
                if (selectedFaktur.length === 0) {
                    alert("Pilih minimal satu pesanan terlebih dahulu.");
                    return;
                }

                selectedFaktur.each(function () {
                    let no_faktur = $(this).data('id');

                    $.ajax({
                        url: '/get-detail-pembayaran',
                        method: 'GET',
                        data: { no_faktur: no_faktur },
                        success: function (data) {
                            data.forEach(item => {
                                let newRow = `
                                <tr class="faktur-row">
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_faktur[]" value="${item.no_faktur}" readonly></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="tgl_faktur[]" value="${item.tgl_faktur || ''}"></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="jatuh_tempo[]" value="${item.tgl_faktur || ''}"></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="pph_23[]" value=""></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="diskon[]" value="${item.diskon_barang || ''}"></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm jumlah-field" name="jumlah[]" value="${item.jumlah || ''}"></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="terhutang[]" value=""></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="jumlah_pembayaran[]" value=""></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="deskripsi_rincian[]" value=""></td>
                                    <td>
                                        <div class="checkbox-wrapper-4">
                                            <input type="checkbox" class="inp-cbx bayar-check" name="bayar_check[]" value="0" id="bayar_check_${item.no_faktur}">
                                            <label class="cbx" for="bayar_check_${item.no_faktur}">
                                                <span>
                                                    <svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg>
                                                </span>
                                            </label>
                                            <svg class="inline-svg">
                                                <symbol id="check-4" viewBox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </symbol>
                                            </svg>
                                        </div>
                                    </td>
                                    <td><button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                                </tr>`;
                                $('#barangTableBody').append(newRow);
                            });

                            hitungJumlahCheck();
                        },
                        error: function () {
                            alert("Gagal mengambil data detail pesanan.");
                        }
                    });
                });

                $('#modalFaktur').modal('hide');
            });

            $('#modalFaktur').on('show.bs.modal', function () {
                $('#checkAllFaktur').prop('checked', false);
                $('.check-faktur').prop('checked', false);
            });

            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
                hitungJumlahCheck();
            });

            $(document).on('input', 'input[name="jumlah[]"], .bayar-check', function () {
                hitungJumlahCheck();
            });

            $(document).on('change', '.bayar-check', function () {
                hitungJumlahCheck();
            });

            function hitungJumlahCheck() {
                let total = 0;

                $('#barangTableBody tr').each(function () {
                    let checkbox = $(this).find('.bayar-check');
                    if (checkbox.prop('checked')) {
                        let jumlah = parseFloat($(this).find('input[name="jumlah_pembayaran[]"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                        total += jumlah;
                    }
                });

                $('input[name="jumlah_check"]').val(total);
                kurangiSaldoBank(total);
            }

            let saldoAwal = 0;

            $(document).ready(function () {
                $('#bankSelect').on('change', function () {
                    saldoAwal = parseFloat($(this).find(':selected').data('saldo_akun')) || 0;
                    $('#saldoAkunInput').val(formatRupiah(saldoAwal));
                    hitungJumlahPembayaran();
                    hitungJumlahCheck();
                });

                $(document).on('input', 'input[name="jumlah_pembayaran[]"], input[name="jumlah[]"]', function () {
                    hitungJumlahPembayaran();
                    hitungJumlahCheck();
                });

                $(document).on('change', '.bayar-check', function () {
                    hitungJumlahCheck();
                });
            });

            function hitungJumlahPembayaran() {
                $('#barangTableBody tr').each(function () {
                    let jumlah = parseFloat(toAngka($(this).find('input[name="jumlah[]"]').val())) || 0;
                    let bayar = parseFloat(toAngka($(this).find('input[name="jumlah_pembayaran[]"]').val())) || 0;

                    if (bayar > jumlah) {
                        bayar = jumlah;
                        $(this).find('input[name="jumlah_pembayaran[]"]').val(formatRupiah(bayar));
                    }

                    let hutang = jumlah - bayar;
                    $(this).find('input[name="terhutang[]"]').val(formatRupiah(hutang));
                });
            }

            function hitungJumlahCheck() {
                let totalCheck = 0;

                $('#barangTableBody tr').each(function () {
                    let checkbox = $(this).find('.bayar-check');
                    if (checkbox.prop('checked')) {
                        let bayar = parseFloat(toAngka($(this).find('input[name="jumlah_pembayaran[]"]').val())) || 0;
                        totalCheck += bayar;
                    }
                });

                $('input[name="jumlah_check"]').val(formatRupiah(totalCheck));

                let sisa = saldoAwal - totalCheck;
                $('#saldoAkunInput').val(formatRupiah(sisa));
            }

            function toAngka(rp) {
                if (!rp) return "0";
                return rp.replace(/\./g, '').replace(',', '.');
            }

            function formatRupiah(angka) {
                angka = parseFloat(angka).toFixed(2);
                let parts = angka.split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return parts.join(',');
            }

            $('#formPembayaran').on('submit', function () {
                $('input.bayar-check').each(function () {
                    $(this).val($(this).prop('checked') ? '1' : '0');
                });

                $('input[name="jumlah[]"], input[name="jumlah_pembayaran[]"], input[name="terhutang[]"], input[name="jumlah_check"], input[name="saldo_bank"]').each(function () {
                    let val = $(this).val();
                    val = val.replace(/\./g, '').split(',')[0].replace(/[^0-9]/g, '');
                    $(this).val(val);
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('bayar_check');
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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('tutup_check_detail');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }
    
            updateStatusText();
    
            checkbox.addEventListener('change', updateStatusText);
        });
    </script> --}}
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