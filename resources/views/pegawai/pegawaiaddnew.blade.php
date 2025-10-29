@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Pegawai</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pegawai/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h6 class="font-weight-bold">Data Pribadi</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control form-control-sm  @error('nik_pegawai') is-invalid @enderror" name="nik_pegawai" value="{{ old('nik_pegawai') }}">
                            @error('nik_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control form-control-sm  @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ old('nama_pegawai') }}">
                            @error('nama_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control form-control-sm  datetimepicker @error('tanggal_lahir_pegawai') is-invalid @enderror" name="tanggal_lahir_pegawai" value="{{ old('tanggal_lahir_pegawai') }}">
                                @error('tanggal_lahir_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kota Kelahiran</label>
                            <select id="tempat_lahir_pegawai" name="tempat_lahir_pegawai" class="tomselect @error('tempat_lahir_pegawai') is-invalid @enderror" placeholder="Ketik untuk cari!">
                                <option value="" disabled {{ old('tempat_lahir_pegawai', '') === '' ? 'selected' : '' }}>--Pilih Kota Lahir--</option>
                                @foreach ($kota as $k)
                                    <option value="{{ $k->id }}" {{ old('tempat_lahir_pegawai') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('tempat_lahir_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select class="tomselect  @error('jenis_kelamin_pegawai_id') is-invalid @enderror"  name="jenis_kelamin_pegawai_id">
                                <option disabled {{ old('jenis_kelamin_pegawai_id') ? '' : 'selected' }}> --Pilih Gender-- </option>
                                @foreach ($gender as $items )
                                    <option value="{{ $items->id }}" {{ old('jenis_kelamin_pegawai_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                                @error('jenis_kelamin_pegawai_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Agama</label>
                            <select class="tomselect  @error('agama_pegawai_id') is-invalid @enderror"  name="agama_pegawai_id">
                                <option {{ old('agama_pegawai_id') ? '' : 'selected' }} disabled> --Pilih Agama-- </option>
                                @foreach ($agama as $items )
                                    <option value="{{ $items->id }}" {{ old('agama_pegawai_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                                @error('agama_pegawai_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status Pernikahan</label>
                            <select class="tomselect @error('status_pernikahan_pegawai_id') is-invalid @enderror"  name="status_pernikahan_pegawai_id">
                                <option {{ old('status_pernikahan_pegawai_id') ? '' : 'selected' }} disabled> --Pilih Status Pernikahan-- </option>
                                @foreach ($data as $items )
                                <option value="{{ $items->id }}" {{ old('status_pernikahan_pegawai_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                                @error('status_pernikahan_pegawai_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <select class="tomselect"  name="golongan_darah_id">
                                <option {{ old('golongan_darah_id') ? '' : 'selected' }} disabled> --Pilih Golongan Darah-- </option>
                                @foreach ($golongan_darah as $items )
                                <option value="{{ $items->id }}" {{ old('golongan_darah_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Informasi Bank</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Bank</label>
                            <input type="text" class="form-control form-control-sm" name="nama_bank_pegawai" value="{{ old('nama_bank_pegawai') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nomor Rekening</label>
                            <input type="text" class="form-control form-control-sm" name="nomor_rekening_pegawai" value="{{ old('nomor_rekening_pegawai') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Atas Nama No. Rekening</label>
                            <input type="text" class="form-control form-control-sm" name="atas_nama_pegawai" value="{{ old('atas_nama_pegawai') }}">
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Data Orang Tua</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" class="form-control form-control-sm  @error('nama_ayah_pegawai') is-invalid @enderror" name="nama_ayah_pegawai" value="{{ old('nama_ayah_pegawai') }}">
                                @error('nama_ayah_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" class="form-control form-control-sm  @error('nama_ibu_pegawai') is-invalid @enderror" name="nama_ibu_pegawai" value="{{ old('nama_ibu_pegawai') }}">
                                @error('nama_ibu_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Data Pekerjaan</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="tomselect"  name="status_pekerjaan_pegawai_id">
                                <option {{ old('status_pekerjaan_pegawai_id') ? '' : 'selected' }} disabled> --Pilih Status-- </option>
                                @foreach ($status_pekerjaan as $items )
                                    <option value="{{ $items->id }}" {{ old('status_pekerjaan_pegawai_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="foto_pegawai" value="{{ old('foto_pegawai') }}">
                                <label class="custom-file-label" for="customFile">Pilih Foto</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label>Tanggal Terima</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control form-control-sm" name="tanggal_masuk_pegawai" value="{{ old('tanggal_masuk_pegawai') }}">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Keluar</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control form-control-sm  datetimepicker" name="tanggal_keluar_pegawai" value="{{ old('tanggal_keluar_pegawai') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Kontak</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control form-control-sm  @error('email_pegawai') is-invalid @enderror" name="email_pegawai" value="{{ old('email_pegawai') }}">
                                @error('email_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" class="form-control form-control-sm  @error('no_telp_pegawai') is-invalid @enderror" name="no_telp_pegawai" value="{{ old('no_telp_pegawai') }}">
                                @error('no_telp_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Data Alamat</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Provinsi</label>
                            <select id="provinsi" name="provinsi_code" class="@error('provinsi_code') is-invalid @enderror">
                                <option value="" disabled {{ old('provinsi_code') ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                @foreach ($provinces as $p)
                                <option value="{{ $p->code }}" {{ old('provinsi_code') === $p->code ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('provinsi_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kota</label>
                            <select id="kota" name="kota_code" class="@error('kota_code') is-invalid @enderror">
                                <option value="" {{ old('kota_code') ? '' : 'selected' }}> --Pilih Kota-- </option>
                            </select>
                            @error('kota_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kecamatan</label>
                            <select id="kecamatan" name="kecamatan_code" class="@error('kecamatan_code') is-invalid @enderror">
                                <option value="" {{ old('kecamatan_code') ? '' : 'selected' }}> --Pilih Kecamatan-- </option>
                            </select>
                            @error('kecamatan_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kelurahan</label>
                            <select id="kelurahan" name="kelurahan_code" class="@error('kelurahan_code') is-invalid @enderror">
                                <option value="" {{ old('kelurahan_code') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>
                            @error('kelurahan_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>RT</label>
                            <input type="text" class="form-control form-control-sm  @error('rt_pegawai') is-invalid @enderror" name="rt_pegawai" value="{{ old('rt_pegawai') }}">
                                @error('rt_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>RW</label>
                            <input type="text" class="form-control form-control-sm  @error('rw_pegawai') is-invalid @enderror" name="rw_pegawai" value="{{ old('rw_pegawai') }}">
                                @error('rw_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jalan</label>
                            <textarea class="form-control form-control-sm  @error('alamat_pegawai') is-invalid @enderror" name="alamat_pegawai" value="{{ old('alamat_pegawai') }}">{{ old('alamat_pegawai') }}</textarea>
                                @error('alamat_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Nomor Identitas</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jenis Identitas</label>
                            <select class="tomselect"  name="jenis_identitas_pegawai_id">
                                <option {{ old('jenis_identitas_pegawai_id') ? '' : 'selected' }} disabled> --Pilih Kartu Pengenal-- </option>
                                @foreach ($kartu_identitas as $items )
                                    <option value="{{ $items->id }}" {{ old('jenis_identitas_pegawai_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nomor Identitas</label>
                            <input type="text" class="form-control form-control-sm" name="nomor_identitas_pegawai" value="{{ old('nomor_identitas_pegawai') }}">
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Kontak Darurat</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control form-control-sm  @error('nama_kontak_darurat_pegawai') is-invalid @enderror" name="nama_kontak_darurat_pegawai" value="{{ old('nama_kontak_darurat_pegawai') }}">
                                @error('nama_kontak_darurat_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" class="form-control form-control-sm  @error('no_telp_darurat_pegawai') is-invalid @enderror" name="no_telp_darurat_pegawai" value="{{ old('no_telp_darurat_pegawai') }}">
                                @error('no_telp_darurat_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Hubungan</label>
                            <select class="tomselect @error('hubungan_pegawai') is-invalid @enderror"  name="hubungan_pegawai">
                                <option {{ old('hubungan_pegawai') ? '' : 'selected' }} disabled> --Pilih Hubungan-- </option>
                                @foreach ($hubungan_pegawai as $items )
                                    <option value="{{ $items->id }}" {{ old('hubungan_pegawai') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                                @error('hubungan_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Sosial Media</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Twitter</label>
                            <input type="text" class="form-control form-control-sm" name="twitter" value="{{ old('twitter') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" class="form-control form-control-sm" name="instagram" value="{{ old('instagram') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" class="form-control form-control-sm" name="youtube" value="{{ old('youtube') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control form-control-sm" name="facebook" value="{{ old('facebook') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Linkedin</label>
                            <input type="text" class="form-control form-control-sm" name="linkedin" value="{{ old('linkedin') }}">
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <a href="{{ route('pegawai/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2">
                                    <i class="fas fa-chevron-left mr-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary buttonedit">
                                    <i class="fas fa-save mr-2"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('select.tomselect').forEach(function (el) {
                new TomSelect(el,{
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    },
                    maxOptions: null,
                    maxItems: 1
                });
            });
        });
    </script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const oldProv       = "{{ old('provinsi_code') }}";
            const oldKota       = "{{ old('kota_code') }}";
            const oldKecamatan  = "{{ old('kecamatan_code') }}";
            const oldKelurahan  = "{{ old('kelurahan_code') }}";
            const kelurahanText = document.querySelector('input[name="kelurahan_code"]');

            const provTS = new TomSelect('#provinsi', {
                create: false,
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });

            const kotaTS = new TomSelect('#kota', {
                create: false,
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kotaTS.disable();

            const kecamatanTS = new TomSelect('#kecamatan', {
                create: false,
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kecamatanTS.disable();

            const kelurahanTS = new TomSelect('#kelurahan', {
                create: false,
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kelurahanTS.disable();

            async function loadCities(provCode, selectedCity = null) {
                kotaTS.disable();
                kotaTS.clear(true);
                kotaTS.clearOptions();
                kotaTS.addOption({ value: '', text: '--Pilih Kota--' });
                kotaTS.refreshOptions(false);

                resetDistrict();
                resetVillage();

                try {
                const url = "{{ route('ajax.cities.by-province') }}" + '?provinsi_code=' + encodeURIComponent(provCode);
                const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                const list = await res.json();

                const options = list.map(item => ({ value: item.code, text: item.name }));
                kotaTS.addOptions(options);
                kotaTS.enable();
                kotaTS.refreshOptions(false);

                if (selectedCity) {
                    kotaTS.setValue(selectedCity, true);
                }
                } catch (e) {
                console.error(e);
                kotaTS.clearOptions();
                kotaTS.addOption({ value: '', text: 'Gagal memuat kota' });
                kotaTS.refreshOptions(false);
                kotaTS.disable();
                }
            }

            async function loadDistricts(cityCode, selectedDistrict = null) {
                kecamatanTS.disable();
                kecamatanTS.clear(true);
                kecamatanTS.clearOptions();
                kecamatanTS.addOption({ value: '', text: '--Pilih Kecamatan--' });
                kecamatanTS.refreshOptions(false);

                resetVillage();

                try {
                const url = "{{ route('ajax.districts.by-city') }}" + '?kota_code=' + encodeURIComponent(cityCode);
                const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
                const list = await res.json();

                const options = list.map(item => ({ value: item.code, text: item.name }));
                kecamatanTS.addOptions(options);
                kecamatanTS.enable();
                kecamatanTS.refreshOptions(false);

                if (selectedDistrict) {
                    kecamatanTS.setValue(selectedDistrict, true);
                }
                } catch (e) {
                console.error(e);
                kecamatanTS.clearOptions();
                kecamatanTS.addOption({ value: '', text: 'Gagal memuat kecamatan' });
                kecamatanTS.refreshOptions(false);
                kecamatanTS.disable();
                }
            }

            async function loadVillages(districtCode, selectedVillage = null) {
                if (!districtCode || String(districtCode).length !== 6) {
                    console.warn('kecamatan invalid:', districtCode);
                    kelurahanTS.clear(true);
                    kelurahanTS.clearOptions();
                    kelurahanTS.addOption({ value: '', text: '--Pilih Kelurahan--' });
                    kelurahanTS.refreshOptions(false);
                    kelurahanTS.disable();
                    return;
                }

                kelurahanTS.disable();
                kelurahanTS.clear(true);
                kelurahanTS.clearOptions();
                kelurahanTS.addOption({ value: '', text: '--Pilih Kelurahan--' });
                kelurahanTS.refreshOptions(false);

                try {
                    const url = "{{ route('ajax.villages.by-district') }}" + '?kecamatan_code=' + encodeURIComponent(districtCode);
                    const res = await fetch(url, { headers: { 'Accept': 'application/json' }});

                    if (!res.ok) {
                        const txt = await res.text();
                        console.error('HTTP', res.status, txt);
                        throw new Error('Gagal ambil kelurahan');
                    }

                    const data = await res.json();
                    const list = Array.isArray(data) ? data : (Array.isArray(data.data) ? data.data : []);
                    console.log('Kelurahan list:', list);

                    const options = list.map(item => ({ value: item.code, text: item.name }));
                    kelurahanTS.addOptions(options);
                    kelurahanTS.enable();
                    kelurahanTS.refreshOptions(false);

                    if (selectedVillage) {
                        kelurahanTS.setValue(selectedVillage, true);
                    }
                } catch (e) {
                    console.error('loadVillages error:', e);
                    kelurahanTS.clearOptions();
                    kelurahanTS.addOption({ value: '', text: 'Gagal memuat kelurahan' });
                    kelurahanTS.refreshOptions(false);
                    kelurahanTS.disable();
                }
            }

            function resetDistrict() {
                kecamatanTS.clear(true);
                kecamatanTS.clearOptions();
                kecamatanTS.addOption({ value: '', text: '--Pilih Kecamatan--' });
                kecamatanTS.refreshOptions(false);
                kecamatanTS.disable();
            }

            function resetVillage() {
                kelurahanTS.clear(true);
                kelurahanTS.clearOptions();
                kelurahanTS.addOption({ value: '', text: '--Pilih Kelurahan--' });
                kelurahanTS.refreshOptions(false);
                kelurahanTS.disable();
                if (kelurahanText) kelurahanText.value = '';
            }

            if (oldProv) {
                provTS.setValue(oldProv, true);
                await loadCities(oldProv, oldKota);

                if (oldKota && oldKecamatan) {
                    await loadDistricts(oldKota, oldKecamatan);

                    if (oldKelurahan) {
                    await loadVillages(oldKecamatan, oldKelurahan);
                    }
                }
            }

            provTS.on('change', async (prov) => {
                if (prov) {
                await loadCities(prov);
                } else {
                kotaTS.clear(true);
                kotaTS.clearOptions();
                kotaTS.addOption({ value: '', text: '--Pilih Kota--' });
                kotaTS.refreshOptions(false);
                kotaTS.disable();
                resetDistrict();
                resetVillage();
                }
            });

            kotaTS.on('change', async (kota) => {
                if (kota) {
                await loadDistricts(kota);
                } else {
                resetDistrict();
                resetVillage();
                }
            });

            kecamatanTS.on('change', async (kec) => {
                if (kec) {
                await loadVillages(kec);
                } else {
                resetVillage();
                }
            });

            kelurahanTS.on('change', (kel) => {
                if (kelurahanText) {
                const opt = kelurahanTS.options[kel];
                kelurahanText.value = opt ? opt.text : '';
                }
            });
        });
    </script>
@endpush
@endsection
