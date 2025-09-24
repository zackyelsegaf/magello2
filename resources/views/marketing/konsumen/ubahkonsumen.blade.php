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
            <form action="{{ route('konsumen/update', $Konsumen->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cluster_id" class="">Nama Cluster</label>
                            <select class="tomselect @error('cluster_id') is-invalid @enderror" name="cluster_id" id="cluster_id" data-placeholder="Pilih cluster...">
                                <option selected disabled {{ old('cluster_id', $Konsumen->cluster_id) ? '' : 'selected' }}> --Pilih Perumahan-- </option>
                                @foreach ($data_cluster as $items )
                                    <option value="{{ $items->id }}" {{ old('cluster_id', $Konsumen->cluster_id) == $items->id ? 'selected' : '' }}>
                                        {{ $items->nama_cluster }}
                                    </option>
                                @endforeach
                            </select>
                            @error('cluster_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status_pengajuan_id" class=""><strong class="text-danger align-middle">*</strong>&nbsp;Status Pengajuan</label>
                            <select class="tomselect" name="status_pengajuan_id" id="status_pengajuan_id">
                                <option selected disabled {{ old('status_pengajuan_id', $Konsumen->status_pengajuan_id) ? '' : 'selected' }}> --Pilih Status Pengajuan-- </option>
                                @foreach ($data_status_pengajuan as $items )
                                    <option value="{{ $items->id }}" {{ old('status_pengajuan_id', $Konsumen->status_pengajuan_id) == $items->id ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nik_konsumen" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;NIK</label>
                            <input type="number" id="nik_konsumen" name="nik_konsumen" class="form-control form-control-sm @error('nik_konsumen') is-invalid @enderror" value="{{ $Konsumen->nik_konsumen }}">
                            @error('nik_konsumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_konsumen" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Nama</label>
                            <input type="text" id="nama_konsumen" name="nama_konsumen" class="form-control form-control-sm @error('nama_konsumen') is-invalid @enderror" value="{{ $Konsumen->nama_konsumen }}">
                            @error('nama_konsumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_hp" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Nomor HP</label>
                            <input type="text" id="no_hp" name="no_hp" class="form-control form-control-sm @error('no_hp') is-invalid @enderror" value="{{ $Konsumen->no_hp }}">
                            @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="jenis_kelamin_id" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Jenis Kelamin</label>
                            <select class="tomselect @error('jenis_kelamin_id') is-invalid @enderror" name="jenis_kelamin_id" id="jenis_kelamin_id">
                                <option selected disabled {{ old('jenis_kelamin_id', $Konsumen->jenis_kelamin_id) ? '' : 'selected' }}> --Pilih Jenis Kelamin-- </option>
                                @foreach ($data_jenis_kelamin as $items )
                                    <option value="{{ $items->id }}" {{ old('jenis_kelamin_id', $Konsumen->jenis_kelamin_id) == $items->id ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_kelamin_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi_code" class="form-label fw-bold">Provinsi KTP</label>
                            <select id="provinsi_code" name="provinsi_code" class="@error('provinsi') is-invalid @enderror">
                                <option value="" disabled {{ old('provinsi_code', $Konsumen->provinsi_code) ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                @foreach ($provinces as $p)
                                <option value="{{ $p->code }}" {{ old('provinsi_code', $Konsumen->provinsi_code) === $p->code ? 'selected' : '' }}>
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
                                @if(!empty($citySelected))
                                <option value="{{ $citySelected->code }}" selected>{{ $citySelected->name }}</option>
                                @else
                                <option value="" disabled selected> --Pilih Kota-- </option>
                                @endif                            
                            </select>
                            @error('kota_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan_code">Kecamatan</label>
                            <select id="kecamatan_code" name="kecamatan_code" class="@error('kecamatan_code') is-invalid @enderror">
                                @if(!empty($districtSelected))
                                <option value="{{ $districtSelected->code }}" selected>{{ $districtSelected->name }}</option>
                                @else
                                <option value="" disabled selected> --Pilih Kecamatan-- </option>
                                @endif
                            </select>                                     
                            @error('kecamatan_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelurahan_code">Kelurahan</label>
                            <select id="kelurahan_code" name="kelurahan_code" class="@error('kelurahan_code') is-invalid @enderror">
                                @if(!empty($villageSelected))
                                <option value="{{ $villageSelected->code }}" selected>{{ $villageSelected->name }}</option>
                                @else
                                <option value="" disabled selected> --Pilih Kelurahan-- </option>
                                @endif
                            </select>                                     
                            @error('kelurahan_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat_konsumen" class="form-label">Alamat</label>
                            <textarea id="alamat_konsumen" name="alamat_konsumen" class="form-control form-control-sm @error('alamat_konsumen') is-invalid @enderror" rows="2">{{ $Konsumen->alamat_konsumen }}</textarea>
                            @error('alamat_konsumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pekerjaan_id" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Pekerjaan</label>
                            <select class="tomselect @error('pekerjaan_id') is-invalid @enderror" name="pekerjaan_id" id="pekerjaan_id">
                                <option {{ old('pekerjaan_id', $Konsumen->pekerjaan_id) ? '' : 'selected' }} selected disabled>--Pekerjaan--</option>
                                @foreach ($data_pekerjaan as $items )
                                    <option value="{{ $items->id }}" {{ old('pekerjaan_id', $Konsumen->pekerjaan_id) == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                            @error('pekerjaan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label mb-3">Marketing</label>
                            <input type="text" class="form-control form-control-sm  @error('marketing') is-invalid @enderror" name="marketing" value="{{ $Konsumen->marketing }}" readonly>
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
                                        <input type="number" name="nik_pasangan" class="form-control form-control-sm" value="{{ $Konsumen->nik_pasangan }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Nama Pasangan</label>
                                        <input type="text" name="nama_pasangan" class="form-control form-control-sm" value="{{ $Konsumen->nama_pasangan }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Nomor HP Pasangan</label>
                                        <input type="number" name="no_hp_pasangan" class="form-control form-control-sm" value="{{ $Konsumen->no_hp_pasangan }}">
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
                                        <input type="number" id="booking_fee" name="booking_fee" class="form-control form-control-sm" value="{{ old('booking_fee', $Konsumen->booking_fee) }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label fw-bold">Tanggal Booking</label>
                                        <input type="text" class="form-control form-control-sm datetimepicker" name="tanggal_booking" value="{{ old('tanggal_booking', $Konsumen->tanggal_booking) }}">
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
                <button type="submit" class="btn btn-primary buttonedit">Update</button>
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
        document.addEventListener('DOMContentLoaded', async () => {
            const oldProv      = "{{ old('provinsi_code', $Konsumen->provinsi_code ?? '') }}";
            const oldKota      = "{{ old('kota_code', $Konsumen->kota_code ?? '') }}";
            const oldKecamatan = "{{ old('kecamatan_code', $Konsumen->kecamatan_code ?? '') }}";
            const oldKelurahan = "{{ old('kelurahan_code', $Konsumen->kelurahan_code ?? '') }}";

            const provTS = new TomSelect('#provinsi_code',{create:false,maxItems:1,sortField:{field:'text',direction:'asc'}});
            const kotaTS = new TomSelect('#kota_code',    {create:false,maxItems:1,sortField:{field:'text',direction:'asc'}});
            const kecTS  = new TomSelect('#kecamatan_code',    {create:false,maxItems:1,sortField:{field:'text',direction:'asc'}});
            const kelTS  = new TomSelect('#kelurahan_code',    {create:false,maxItems:1,sortField:{field:'text',direction:'asc'}});

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
                const list = await api("{{ route('ajax.villages.by-district') }}", {kecamatan_code: districtCode});
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
