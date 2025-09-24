@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Konsumen</h3>
                    </div>
                </div>
            </div>
            <form method="POST" action="{{ route('form/konsumen/save') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cluster_id" class="">Nama Cluster</label>
                            <select class="tomselect @error('cluster_id') is-invalid @enderror" name="cluster_id" id="cluster_id" data-placeholder="Pilih cluster...">
                                <option {{ old('cluster_id') ? '' : 'selected' }} disabled></option>
                                @foreach ($data_cluster as $items )
                                <option value="{{ $items->id }}" {{ old('cluster_id') == $items->id ? 'selected' : '' }}>{{ $items->nama_cluster }}</option>
                                @endforeach
                            </select>
                            @error('cluster_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status_pengajuan_id" class=""><strong class="text-danger align-middle">*</strong>&nbsp;Status Pengajuan</label>
                            <select class="tomselect" name="status_pengajuan_id" id="status_pengajuan_id">
                                <option {{ old('status_pengajuan_id') ? '' : 'selected' }} disabled>--Status Pengajuan--</option>
                                @foreach ($data_status_pengajuan as $items )
                                    <option value="{{ $items->id }}" {{ old('status_pengajuan_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nik_konsumen" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;NIK</label>
                            <input type="number" id="nik_konsumen" name="nik_konsumen" class="form-control form-control-sm @error('nik_konsumen') is-invalid @enderror" value="{{ old('nik_konsumen') }}">
                            @error('nik_konsumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_konsumen" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Nama</label>
                            <input type="text" id="nama_konsumen" name="nama_konsumen" class="form-control form-control-sm @error('nama_konsumen') is-invalid @enderror" value="{{ old('nama_konsumen') }}">
                            @error('nama_konsumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_hp" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Nomor HP</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-control form-control-sm @error('no_hp') is-invalid @enderror" value="{{ old('no_hp') }}">
                            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jenis_kelamin_id" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Jenis Kelamin</label>
                            <select class="tomselect @error('jenis_kelamin_id') is-invalid @enderror" name="jenis_kelamin_id" id="jenis_kelamin_id">
                                <option {{ old('jenis_kelamin_id') ? '' : 'selected' }} disabled>--Jenis Kelamin--</option>
                                @foreach ($data_jenis_kelamin as $items )
                                    <option value="{{ $items->id }}" {{ old('jenis_kelamin_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                            @error('jenis_kelamin_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi_code" class="form-label fw-bold">Provinsi KTP</label>
                            <select id="provinsi_code" name="provinsi_code" class="@error('provinsi_code') is-invalid @enderror">
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
                            <label for="kota_code" class="form-label fw-bold">Kota KTP</label>
                            <select id="kota_code" name="kota_code" class="@error('kota_code') is-invalid @enderror">
                                <option value="" {{ old('kota_code') ? '' : 'selected' }}> --Pilih Kota-- </option>
                            </select>
                            @error('kota_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan_code">Kecamatan</label>
                            <select id="kecamatan_code" name="kecamatan_code" class="@error('kecamatan_code') is-invalid @enderror">
                                <option value="" {{ old('kecamatan_code') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>                                     
                            @error('kecamatan_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelurahan_code">Kelurahan</label>
                            <select id="kelurahan_code" name="kelurahan_code" class="@error('kelurahan_code') is-invalid @enderror">
                                <option value="" {{ old('kelurahan_code') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>                                     
                            @error('kelurahan_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat_konsumen" class="form-label">Alamat</label>
                            <textarea id="alamat_konsumen" name="alamat_konsumen" class="form-control form-control-sm @error('alamat_konsumen') is-invalid @enderror" rows="2">{{ old('alamat_konsumen') }}</textarea>
                            @error('alamat_konsumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pekerjaan_id" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Pekerjaan
                            </label>
                            <select class="tomselect @error('pekerjaan_id') is-invalid @enderror" name="pekerjaan_id" id="pekerjaan_id">
                                <option {{ old('pekerjaan_id') ? '' : 'selected' }} disabled>--Pekerjaan--</option>
                                @foreach ($data_pekerjaan as $items )
                                    <option value="{{ $items->id }}" {{ old('pekerjaan_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                            @error('pekerjaan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label mb-3">Marketing</label>
                            <input type="text" class="form-control form-control-sm  @error('marketing') is-invalid @enderror" name="marketing" value="{{ old('marketing', Auth::user()->name) }}" readonly>
                            @error('marketing')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a id="tab-data" class="nav-link active" data-toggle="tab" href="#data">Data Suami/Istri</a>
                            </li>
                            <li class="nav-item">
                                <a id="tab-booking" class="nav-link" data-bs-toggle="tab" href="#booking">Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#link">Link dengan EA7</a>
                            </li>
                        </ul>
                    </div>
                    <div id="data" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">NIK Pasangan</label>
                                        <input type="number" name="nik_pasangan" class="form-control form-control-sm" value="{{ old('nik_pasangan') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Nama Pasangan</label>
                                        <input type="text" name="nama_pasangan" class="form-control form-control-sm" value="{{ old('nama_pasangan') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Nomor HP Pasangan</label>
                                        <input type="number" name="no_hp_pasangan" class="form-control form-control-sm" value="{{ old('no_hp_pasangan') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="booking" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4">      
                                        <label for="pilih_unit76uyh" class="form-label fw-bold">Pilih Unit</label>
                                        <select class="tomselect" name="pilih_unit" id="pilih_unit">
                                            <option value="" disabled {{ old('pilih_unit') ? '' : 'selected' }}> --Pilih Unit-- </option>
                                            @foreach ($kapling as $items )   
                                                <option value="{{ $items->id }}" {{ old('pilih_unit') == $items->id ? 'selected' : '' }}>{{ $items->blok_kapling . " - " . $items->nomor_unit_kapling }}</option>
                                            @endforeach                                        
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="booking_fee" class="form-label fw-bold">Booking Fee</label>
                                        <input type="number" id="booking_fee" name="booking_fee" class="form-control form-control-sm" value="{{ old('booking_fee') }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Tanggal Booking</label>
                                        <input type="text" class="form-control form-control-sm datetimepicker" name="tanggal_booking" value="{{ old('tanggal_booking') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="link" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">     
                                    <div class="col-md-4">
                                        <label for="link_email" class="form-label fw-bold">Email</label>
                                        <input type="text" name="link_email" class="form-control form-control-sm" value="{{ old('link_email') }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary buttonedit">
                            <i class="fa fa-check mr-2"></i>Simpan
                        </button>
                        <a href="{{ route('konsumen/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3">
                            <i class="fas fa-chevron-left mr-2"></i>Batal
                        </a>
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
@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabBooking = document.getElementById('tab-booking');
            const clusterSelect = document.getElementById('cluster_id');
            const tabDataLink = document.querySelector('a[href="#data"]');
            const tabBookingLink = document.querySelector('a[href="#booking"]');

        tabBooking.addEventListener('click', function (e) {
            const clusterValue = clusterSelect.value;

            if (!clusterValue) {
                e.preventDefault();

                Swal.fire({
                    icon: 'error',
                    text: 'Silakan pilih Nama cluster terlebih dahulu!',
                    confirmButtonColor: '#8c54ff',
                    timer: 2500,
                    showConfirmButton: true
                });

                document.querySelectorAll('.nav-link, .tab-pane').forEach(el => {
                    el.classList.remove('active', 'show');
                });
                    const tabData = new bootstrap.Tab(tabDataLink);
                    tabData.show();
                } else {
                    const tabBookingTab = new bootstrap.Tab(tabBookingLink);
                    tabBookingTab.show();
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const oldProv       = "{{ old('provinsi_code') }}";
            const oldKota       = "{{ old('kota_code') }}";
            const oldKecamatan  = "{{ old('kecamatan_code') }}";
            const oldKelurahan  = "{{ old('kelurahan_code') }}";  
            const kelurahanText = document.querySelector('input[name="kelurahan"]'); 

            const provTS = new TomSelect('#provinsi_code', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });

            const kotaTS = new TomSelect('#kota_code', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kotaTS.disable();

            const kecamatanTS = new TomSelect('#kecamatan_code', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kecamatanTS.disable();

            const kelurahanTS = new TomSelect('#kelurahan_code', {  
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