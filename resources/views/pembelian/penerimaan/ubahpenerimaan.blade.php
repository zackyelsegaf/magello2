@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Penerimaan Pembelian - <strong>{{ $penerimaanPembelian->no_penerimaan }}</strong> - <span id="statusBadge"></span></h3> 
                    </div>
                </div>
            </div>
            <form action="{{ route('pembelian/penerimaan/update', $penerimaanPembelian->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row checkbox-row-mobile-horizontal">
                                <div class="col-md-2 p-2">
                                    <div class="form-group">
                                        <div class="dd"></div>
                                        <div class="checkbox-wrapper-4">
                                            <input type="hidden" name="disetujui_check" value="0">
                                            <input class="inp-cbx" name="disetujui_check" id="disetujui_check" type="checkbox" value="1" {{ old('disetujui_check', $penerimaanPembelian->disetujui_check) ? 'checked' : '' }}>
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
                                                <label>No. Pesanan</label>
                                                <input type="text" class="form-control" id="no_penerimaan" name="no_penerimaan" value="{{ $penerimaanPembelian->no_penerimaan }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="persetujuan-field" style="display: none;">
                                            <div class="form-group">
                                                <label>No. Persetujuan</label>
                                                <input type="text" class="form-control" name="no_persetujuan" value="{{ $penerimaanPembelian->no_persetujuan }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Formulir</label>
                                                <input type="text" class="form-control" id="no_formulir" name="no_formulir" value="{{ $penerimaanPembelian->no_formulir }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Pengguna</label>
                                            <input type="text" class="form-control" name="pengguna_penerimaan" value="{{ $penerimaanPembelian->pengguna_penerimaan }}">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Status</label>
                                            <input type="text" class="form-control" name="status_penerimaan" id="status_penerimaan" value="{{ $penerimaanPembelian->status_penerimaan }}">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Tanggal Pesanan</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker @error('tgl_penerimaan') is-invalid @enderror" name="tgl_penerimaan" value="{{ $penerimaanPembelian->tgl_penerimaan }}"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pemasok</label>
                                                <select id="namaBarangSelect" class="form-control" name="pemasok_penerimaan">
                                                    <option {{ old('pemasok_penerimaan', $penerimaanPembelian->pemasok_penerimaan) ? '' : 'selected' }} disabled> -- Pilih Pemasok</option>
                                                    @foreach ($pemasok as $items )
                                                        <option value="{{ $items->nama }}"
                                                            data-no-pemasok="{{ $items->pemasok_id }}"
                                                            data-syarat="{{ $items->syarat }}"
                                                            data-alamat-1="{{ $items->alamat_1 }}"
                                                            data-nilai-tukar="{{ $items->nilai_tukar }}"
                                                            data-pajak="{{ $items->pajak_1_check }}"
                                                            {{ old('pemasok_penerimaan', $penerimaanPembelian->pemasok_penerimaan) == $items->nama ? 'selected' : '' }}>
                                                            {{ $items->pemasok_id . " - " . $items->nama . " - " . $items->mata_uang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <select id="noPemasokSelect" class="form-control"  name="no_pemasok" style="display: none">
                                                    <option {{ old('no_pemasok', $penerimaanPembelian->no_pemasok) ? '' : 'selected' }} disabled></option>
                                                    @foreach ($pemasok as $items )
                                                    <option value="{{ $items->pemasok_id }}" {{ old('no_pemasok', $penerimaanPembelian->no_pemasok) == $items->pemasok_id ? 'selected' : '' }}>
                                                        {{ $items->pemasok_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Proyek</label>
                                                <select class="form-control" name="proyek">
                                                    <option disabled selected>Pilih Proyek</option>
                                                    @foreach ($proyek as $items)
                                                        <option value="{{ $items->nama_proyek }}" {{ old('proyek', $penerimaanPembelian->proyek) == $items->nama_proyek ? 'selected' : '' }}>
                                                            {{ $items->proyek_id . ' - ' . $items->nama_proyek }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Gudang</label>
                                                <select class="form-control"  name="gudang">
                                                    <option disabled selected></option>
                                                    @foreach ($gudang as $items)
                                                    <option value="{{ $items->nama_gudang }}" {{ old('gudang', $penerimaanPembelian->gudang) == $items->nama_gudang ? 'selected' : '' }}>{{ $items->nama_gudang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi_penerimaan" placeholder="Deskripsi">{{ old('deskripsi_penerimaan', $penerimaanPembelian->deskripsi_penerimaan) }}</textarea> 
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Departemen</label>
                                                <select class="form-control"  name="departemen">
                                                    <option disabled selected></option>
                                                    @foreach ($departemen as $items )
                                                    <option value="{{ $items->nama_departemen }}" {{ old('departemen', $penerimaanPembelian->departemen) == $items->nama_departemen ? 'selected' : '' }}>{{ $items->nama_departemen }}</option>
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
                                <a class="nav-link" data-toggle="tab" href="#informasi">Informasi Lainnya</a> 
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
                                    <table class="datatable table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                {{-- <th>Dari</th> --}}
                                                <th>No. Barang</th>
                                                <th>Deskripsi Barang</th>
                                                <th>Kts</th>
                                                <th>Satuan</th>
                                                <th hidden>Harga Satuan</th>
                                                <th hidden>Diskon Barang</th>
                                                <th hidden>Kode Pajak</th>
                                                <th hidden>Jumlah</th>
                                                <th>No. Pesanan</th>
                                                <th>No. Permintaan</th>
                                                <th>Kts Faktur</th>
                                                <th>Serial Number</th>
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
                                            @endphp --}}
                                            @foreach ($penerimaanPembelian->detail as $index => $detail)
                                                <tr class="barang-row">
                                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_barang[]" value="{{ $detail->no_barang }}" readonly></td>
                                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="deskripsi_barang[]" value="{{ $detail->deskripsi_barang }}"></td>
                                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kts_penerimaan[]" value="{{ $detail->kts_penerimaan }}"></td>
                                                    <td style="display: none;"><input style="width: 150px;" type="text" class="form-control form-control-sm" name="harga_satuan[]" value="{{ $detail->harga_satuan }}"></td>
                                                    <td style="display: none;"><input style="width: 150px;" type="text" class="form-control form-control-sm" name="diskon_barang[]" value="{{ $detail->diskon_barang }}"></td>
                                                    <td style="display: none;"><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kode_pajak[]" value="{{ $detail->kode_pajak }}"></td>
                                                    <td style="display: none;"><input style="width: 150px;" type="text" class="form-control form-control-sm" name="jumlah_total_harga[]" value="{{ $detail->jumlah_total_harga }}"></td>
                                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="satuan[]" value="{{ $detail->satuan }}"></td>
                                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_pesanan[]" value="{{ $detail->no_pesanan }}"></td>
                                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_permintaan[]" value="{{ $detail->no_permintaan }}"></td>
                                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kts_faktur[]" value="{{ $detail->kts_faktur }}"></td>
                                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="serial_number[]" value="{{ $detail->serial_number }}"></td>
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
                                                <textarea id="alamatPemasokInput" class="form-control" name="alamat_pemasok" placeholder="Alamat Pemasok">{{ old('alamat_pemasok', $penerimaanPembelian->detail2->alamat_pemasok  ?? null) }}</textarea>
                                            </div>                                       
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Tgl. Kirim</strong></label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker" name="tgl_kirim" value="{{ $penerimaanPembelian->detail2->tgl_kirim  ?? null}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <label><strong>FOB</strong></label>
                                                <select name="fob" class="form-control">
                                                    <option {{ old('fob', $penerimaanPembelian->detail2->fob  ?? null) ? '' : 'selected' }} disabled>-- Pilih FOB --</option>
                                                    <option value="Shipping Point" {{ old('fob', $penerimaanPembelian->detail2->fob  ?? null) == 'Shipping Point' ? 'selected' : '' }}>Shipping Point</option>
                                                    <option value="Destination" {{ old('fob', $penerimaanPembelian->detail2->fob  ?? null) == 'Destination' ? 'selected' : '' }}>Destination</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mt-3">
                                                <label><strong>Kirim Melalui</strong></label>
                                                <select name="kirim_melalui" id="kirim_melalui" class="form-control">
                                                    <option value="0">0</option>
                                                    <option value="Tidak ada data" disabled>Tidak ada data</option>
                                                </select>
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
                                        @while (!empty($penerimaanPembelian["fileupload_$i"]))
                                            <div class="row formtype mb-2" id="fieldRow_{{ $i }}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fileupload_{{ $i }}">File {{ $i }}</label>
                                                        <p><a class="link-opacity-10-hover" href="{{ $penerimaanPembelian["fileupload_$i"] }}">{{ $penerimaanPembelian["fileupload_$i"] }}</a></p>
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
                                                        <input class="inp-cbx" name="tindak_lanjut_check" id="tindak_lanjut_check" type="checkbox" value="1" {{ old('tindak_lanjut_check', $penerimaanPembelian->tindak_lanjut_check) ? 'checked' : '' }}>
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
                                                        <input class="inp-cbx" name="urgent_check" id="urgent_check" type="checkbox" value="1" {{ old('urgent_check', $penerimaanPembelian->urgent_check) ? 'checked' : '' }}>
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
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_1" placeholder="Deskripsi">{{ old('deskripsi_1', $penerimaanPembelian->deskripsi_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="catatan_pemeriksaan_check" value="0">
                                                        <input class="inp-cbx" name="catatan_pemeriksaan_check" id="catatan_pemeriksaan_check" type="checkbox" value="1" {{ old('catatan_pemeriksaan_check', $penerimaanPembelian->catatan_pemeriksaan_check) ? 'checked' : '' }}>
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
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_2" placeholder="Deskripsi">{{ old('deskripsi_2', $penerimaanPembelian->deskripsi_2) }}</textarea>
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
                                                    <textarea class="form-control" name="deskripsi_penerimaan" placeholder="Deskripsi">{{ old('deskripsi_penerimaan', $penerimaanPembelian->deskripsi_penerimaan) }}</textarea> 
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
                                <a href="{{ route('pembelian/penerimaan/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3 mb-5"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
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
            const statusInput = document.getElementById("status_penerimaan");
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
            $('#checkAllPermintaan').click(function () {
                $('.check-permintaan').prop('checked', this.checked);
            });
    
            $('#tambahPermintaanTerpilih').click(function () {
                let selectedPermintaan = $('.check-permintaan:checked').first();
                if (selectedPermintaan.length === 0) {
                    alert("Pilih minimal satu permintaan terlebih dahulu.");
                    return;
                }

                let no_permintaan = selectedPermintaan.data('id');

                $.ajax({
                    url: '/get-detail-permintaan',
                    method: 'GET',
                    data: { no_permintaan: no_permintaan },
                    success: function (data) {
                        data.forEach(item => {
                            let newRow = `
                            <tr class="permintaan-row">
                                <td style="background-color: #F76303;"><h7 class="font-weight-bold text-white">Permintaan</h7></td>
                                <td><input style="width: 150px;" type="text" class="form-control" name="no_barang[]" value="${item.no_barang}" readonly></td>
                                <td><input style="width: 150px;" type="text" class="form-control" name="deskripsi_barang[]" value="${item.deskripsi_barang}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control" name="kts_pesanan[]" value="${item.kts_permintaan}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control" name="satuan[]" value="${item.satuan}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control" name="harga_satuan[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control" name="diskon_barang[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control" name="pajak[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control" name="jumlah_total_harga[]" value="" readonly></td>
                                <td><input style="width: 150px;" type="text" class="form-control" name="kts_diterima[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control" name="no_permintaan[]" value="${item.no_permintaan}"></td>
                                <td><button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                            </tr>`;

                            $('#barangTableBody').append(newRow);
                        });

                        $('#modalPermintaan').modal('hide');
                    },
                    error: function () {
                        alert("Gagal mengambil data detail permintaan.");
                    }
                });
            });
    
            $(document).ready(function () {
            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
                hitungSemuaJumlahDanSubTotal();
            });

            $(document).on('input', 'input[name="kts_pesanan[]"], input[name="harga_satuan[]"], input[name="diskon_barang[]"], input[name="diskon_left"], #estimasi_biaya, #aktif_ppn', function () {
                hitungSemuaJumlahDanSubTotal();
            });

            function hitungSemuaJumlahDanSubTotal() {
                let subTotal = 0;

                $('#barangTableBody tr').each(function () {
                    let kts = parseFloat($(this).find('input[name="kts_pesanan[]"]').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
                    let harga = parseFloat($(this).find('input[name="harga_satuan[]"]').val().replace(/\./g, '').replace(/,/g, '.')) || 0;
                    let diskon = parseFloat($(this).find('input[name="diskon_barang[]"]').val().replace('%', '').replace(',', '.')) || 0;

                    let jumlah = kts * harga * (1 - (diskon / 100));
                    jumlah = parseFloat(jumlah//.toFixed(2)
                );

                    $(this).find('input[name="jumlah_total_harga[]"]').val(jumlah);
                    subTotal += jumlah;
                });

                // Update subtotal
                $('input[name="sub_total"]').val(subTotal//.toFixed(2)
            );
                // $('#sub_total').val(formatRupiah(subTotal));

                let diskonPersen = parseFloat($('input[name="diskon_left"]').val().replace(',', '.')) || 0;

                // Hitung total diskon dari subtotal
                let totalDiskon = subTotal * (diskonPersen / 100);
                $('input[name="total_diskon_right"]').val(totalDiskon//.toFixed(2)
            );

                // Hitung PPN
                let pajakCheckbox = document.getElementById('pajak_check');
                let ppn = 0;

                if (pajakCheckbox && pajakCheckbox.checked) {
                    ppn = (subTotal - totalDiskon) * 0.11;
                }

                $('input[name="ppn_11_persen"]').val(ppn//.toFixed(2)
            );
                // $('#ppn_11_persen').val(formatRupiah(ppn));

                // Ambil estimasi biaya
                let estimasiBiaya = parseFloat($('#estimasi_biaya').val().replace(/\./g, '').replace(/,/g, '.')) || 0;

                // Hitung total
                let jumlahTotal = subTotal - totalDiskon + ppn + estimasiBiaya;

                $('input[name="jumlah"]').val(jumlahTotal//.toFixed(2)
            );
                // $('#jumlah').val(formatRupiah(jumlahTotal));
            }

            // Format ke Rupiah
            function formatRupiah(angka) {
                return angka.toLocaleString('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
            }
        });

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