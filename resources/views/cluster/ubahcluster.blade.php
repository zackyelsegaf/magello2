@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                    </div>
                </div>
            </div>
            <form action="{{ route('cluster/update', $Cluster->id) }}" method="POST" enctype="multipart/form-data">
                <!-- Section 1: Form Header -->
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4 mb-2">
                        <label>Nama Cluster</label>
                        <input type="text" class="form-control form-control-sm" name="nama_cluster" value="{{ $Cluster->nama_cluster }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>No. HP</label>
                        <input type="text" class="form-control form-control-sm" name="no_hp" value="{{ $Cluster->no_hp }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Luas Tanah M2</label>
                        <input type="text" class="form-control form-control-sm" name="luas_tanah" value="{{ $Cluster->luas_tanah }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Total Unit</label>
                        <input type="text" class="form-control form-control-sm" name="total_unit" value="{{ $Cluster->total_unit }}">
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Provinsi</label>
                        <select id="provinsi_code" name="provinsi_code">
                            <option value="" disabled {{ old('provinsi_code', $Cluster->provinsi_code) ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                            @foreach ($provinces as $p)
                            <option value="{{ $p->code }}" {{ old('provinsi_code', $Cluster->provinsi_code) == $p->code ? 'selected' : '' }}>
                                {{ $p->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Kota</label>
                        <select id="kota_code" name="kota_code">
                            @if(!empty($citySelected))
                            <option value="{{ $citySelected->code }}" selected>{{ $citySelected->name }}</option>
                            @else
                            <option value="" disabled selected> --Pilih Kota-- </option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Kecamatan</label>
                        <select id="kecamatan" name="kecamatan">
                            @if(!empty($districtSelected))
                            <option value="{{ $districtSelected->code }}" selected>{{ $districtSelected->name }}</option>
                            @else
                            <option value="" disabled selected> --Pilih Kecamatan-- </option>
                            @endif
                        </select>
                    </div>
                    <div class="col-md-4 mb-2">
                        <label>Kelurahan</label>
                        <select id="kelurahan" name="kelurahan">
                            @if(!empty($villageSelected))
                            <option value="{{ $villageSelected->code }}" selected>{{ $villageSelected->name }}</option>
                            @else
                            <option value="" disabled selected> --Pilih Kelurahan-- </option>
                            @endif
                        </select>
                    </div>
                    <div class="col-12">
                        <label>Alamat</label>
                        <textarea class="form-control form-control-sm" name="alamat_cluster">{{ $Cluster->alamat_cluster }}</textarea>
                    </div>
                </div>
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-check mr-2"></i>Simpan</button>
                            <a href="{{ route('cluster/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const oldProv      = "{{ old('provinsi_code', $Cluster->provinsi_code ?? '') }}";
            const oldKota      = "{{ old('kota_code', $Cluster->kota_code ?? '') }}";
            const oldKecamatan = "{{ old('kecamatan', $Cluster->kecamatan ?? '') }}";
            const oldKelurahan = "{{ old('kelurahan', $Cluster->kelurahan ?? '') }}";

            const provTS = new TomSelect('#provinsi_code',{create:false,maxItems:1,sortField:{field:'text',direction:'asc'}});
            const kotaTS = new TomSelect('#kota_code',    {create:false,maxItems:1,sortField:{field:'text',direction:'asc'}});
            const kecTS  = new TomSelect('#kecamatan',    {create:false,maxItems:1,sortField:{field:'text',direction:'asc'}});
            const kelTS  = new TomSelect('#kelurahan',    {create:false,maxItems:1,sortField:{field:'text',direction:'asc'}});

            const disableAll = ts => { ts.clear(true); ts.clearOptions(); ts.addOption({value:'',text:'--'}); ts.refreshOptions(false); ts.disable(); }
            [kotaTS,kecTS,kelTS].forEach(disableAll);

            const api = async (url, params) => {
                const q = new URLSearchParams(params||{}).toString();
                const res = await fetch(url + (q?`?${q}`:''), {headers:{'Accept':'application/json'}});
                if(!res.ok) return [];
                const data = await res.json();
                return Array.isArray(data) ? data : (Array.isArray(data.data)?data.data:[]);
            };

            const fill = (ts, list, placeholder) => {
                ts.clear(true); ts.clearOptions();
                ts.addOption({value:'', text: placeholder});
                ts.addOptions(list.map(i => ({value:i.code, text:i.name})));
                ts.enable(); ts.refreshOptions(false);
            };

            async function loadCities(provCode, selectedCode){
                [kecTS,kelTS].forEach(disableAll);
                if(!provCode) return disableAll(kotaTS);
                const list = await api("{{ route('ajax.cities.by-province') }}", {provinsi_code: provCode});
                fill(kotaTS, list, '--Pilih Kota--');
                if(selectedCode) kotaTS.setValue(selectedCode, true);
            }

            async function loadDistricts(cityCode, selectedCode){
                disableAll(kecTS); disableAll(kelTS);
                if(!cityCode) return;
                const list = await api("{{ route('ajax.districts.by-city') }}", {kota_code: cityCode});
                fill(kecTS, list, '--Pilih Kecamatan--');
                if(selectedCode) kecTS.setValue(selectedCode, true);
                return kecTS.getValue();
            }

            async function loadVillages(districtCode, selectedCode){
                disableAll(kelTS);
                if(!districtCode || String(districtCode).length !== 6) return;
                const list = await api("{{ route('ajax.villages.by-district') }}", {kecamatan: districtCode});
                fill(kelTS, list, '--Pilih Kelurahan--');
                if(selectedCode) kelTS.setValue(selectedCode, true);
            }

            if (oldProv){
                provTS.setValue(oldProv, true);
                await loadCities(oldProv, oldKota);
                const pickedKec = await loadDistricts(oldKota, oldKecamatan);
                if (pickedKec) await loadVillages(pickedKec, oldKelurahan);
            }

            provTS.on('change', async (prov) => {
                kotaTS.clear(true);
                await loadCities(prov || null, null);
            });

            kotaTS.on('change', async (kota) => {
                await loadDistricts(kota || null, null);
            });

            kecTS.on('change', async (kec) => {
                await loadVillages(kec || null, null);
            });
        });
    </script>

@endpush
@endsection
