@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Cluster</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/cluster/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4 mb-2">
                        <label>Nama Cluster</label>
                        <input type="text" class="form-control form-control-sm @error('nama_cluster') is-invalid @enderror" name="nama_cluster" value="{{ old('nama_cluster') }}">
                        @error('nama_cluster')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>No. HP</label>
                        <input type="text" class="form-control form-control-sm @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}">
                        @error('no_hp')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Luas Tanah M2</label>
                        <input type="text" class="form-control form-control-sm @error('luas_tanah') is-invalid @enderror" name="luas_tanah" value="{{ old('luas_tanah') }}">
                        @error('luas_tanah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Total Unit</label>
                        <input type="text" class="form-control form-control-sm @error('total_unit') is-invalid @enderror" name="total_unit" value="{{ old('total_unit') }}">
                        @error('total_unit')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Provinsi</label>
                        <select id="provinsi_code" name="provinsi_code" class="@error('provinsi_code') is-invalid @enderror">
                            <option value="" disabled {{ old('provinsi_code') ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                            @foreach ($provinces as $p)
                            <option value="{{ $p->code }}" {{ old('provinsi_code') === $p->code ? 'selected' : '' }}>
                                {{ $p->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('provinsi_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Kota</label>
                        <select id="kota_code" name="kota_code" class="@error('kota_code') is-invalid @enderror" disabled>
                            <option value="" disabled {{ old('kota_code') ? '' : 'selected' }}> --Pilih Kota-- </option>
                        </select>
                        @error('kota_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Kecamatan</label>
                        <select id="kecamatan_code" name="kecamatan_code" class="" disabled>
                            <option value="" disabled {{ old('kecamatan_code') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Kelurahan</label>
                        <select id="kelurahan_code" name="kelurahan_code" class="" disabled>
                            <option value="" disabled {{ old('kelurahan_code') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label>Alamat</label>
                        <textarea class="form-control form-control-sm @error('alamat_cluster') is-invalid @enderror" name="alamat_cluster">{{ old('alamat_cluster') }}</textarea>
                        @error('alamat_cluster')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <a href="{{ url()->previous() }}" class="btn btn-primary float-left veiwbutton mr-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
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
