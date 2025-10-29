@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Pegawai</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('pegawai/update', $Pegawai->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h6 class="font-weight-bold">Data Pribadi</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NIK</label>
                            <input type="text" class="form-control form-control-sm  @error('nik_pegawai') is-invalid @enderror" name="nik_pegawai" value="{{ $Pegawai->nik_pegawai }}">
                            @error('nik_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input type="text" class="form-control form-control-sm  @error('nama_pegawai') is-invalid @enderror" name="nama_pegawai" value="{{ $Pegawai->nama_pegawai }}">
                            @error('nama_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tanggal Lahir</label>
                            <div class="cal-icon">
                            <input type="text" class="form-control form-control-sm  datetimepicker @error('tanggal_lahir_pegawai') is-invalid @enderror" name="tanggal_lahir_pegawai" value="{{ $Pegawai->tanggal_lahir_pegawai }}">
                                @error('tanggal_lahir_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Kota Kelahiran</label>
                            <select class="tomselect @error('tempat_lahir_pegawai') is-invalid @enderror"  name="tempat_lahir_pegawai" placeholder="Ketik untuk cari!">
                                <option selected disabled {{ old('tempat_lahir_pegawai', $Pegawai->tempat_lahir_pegawai) ? '' : 'selected' }}> --Pilih Kota Lahir-- </option>
                                @foreach ($kota as $k )
                                    <option value="{{ $k->id }}" {{ old('tempat_lahir_pegawai', $Pegawai->tempat_lahir_pegawai) == $k->id ? 'selected' : '' }}>
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
                            <select class="tomselect @error('jenis_kelamin_pegawai_id') is-invalid @enderror" name="jenis_kelamin_pegawai_id">
                                <option selected disabled {{ old('jenis_kelamin_pegawai_id', $Pegawai->jenis_kelamin_pegawai_id) ? '' : 'selected' }}> --Pilih Jenis Kelamin-- </option>
                                @foreach ($gender as $items)
                                    <option value="{{ $items->id }}" {{ old('jenis_kelamin_pegawai_id', $Pegawai->jenis_kelamin_pegawai_id) == $items->id ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                                @error('jenis_kelamin_pegawai_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Agama</label>
                            <select class="tomselect @error('agama_pegawai_id') is-invalid @enderror" name="agama_pegawai_id">
                                <option selected disabled {{ old('agama_pegawai_id', $Pegawai->agama_pegawai_id) ? '' : 'selected' }}> --Pilih Agama-- </option>
                                @foreach ($agama as $items)
                                    <option value="{{ $items->id }}" {{ old('agama_pegawai_id', $Pegawai->agama_pegawai_id) == $items->id ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                                @error('agama_pegawai_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status Pernikahan</label>
                            <select class="tomselect @error('status_pernikahan_pegawai_id') is-invalid @enderror" name="status_pernikahan_pegawai_id">
                                <option selected disabled {{ old('status_pernikahan_pegawai_id', $Pegawai->status_pernikahan_pegawai_id) ? '' : 'selected' }}> --Pilih Status Pernikahan-- </option>
                                @foreach ($data as $items)
                                    <option value="{{ $items->id }}" {{ old('status_pernikahan_pegawai_id', $Pegawai->status_pernikahan_pegawai_id) == $items->id ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                                @error('status_pernikahan_pegawai_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Golongan Darah</label>
                            <select class="tomselect" name="golongan_darah_pegawai_id">
                                <option selected disabled {{ old('golongan_darah_pegawai_id', $Pegawai->golongan_darah_pegawai_id) ? '' : 'selected' }}> --Pilih Golongan Darah-- </option>
                                @foreach ($golongan_darah as $items)
                                    <option value="{{ $items->id }}" {{ old('golongan_darah_pegawai_id', $Pegawai->golongan_darah_pegawai_id) == $items->id ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
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
                            <input type="text" class="form-control form-control-sm" name="nama_bank_pegawai" value="{{ $Pegawai->nama_bank_pegawai }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nomor Rekening</label>
                            <input type="text" class="form-control form-control-sm" name="nomor_rekening_pegawai" value="{{ $Pegawai->nomor_rekening_pegawai }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Atas Nama No. Rekening</label>
                            <input type="text" class="form-control form-control-sm" name="atas_nama_pegawai" value="{{ $Pegawai->atas_nama_pegawai }}">
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Data Orang Tua</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" class="form-control form-control-sm  @error('nama_ayah_pegawai') is-invalid @enderror" name="nama_ayah_pegawai" value="{{ $Pegawai->nama_ayah_pegawai }}">
                            @error('nama_ayah_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" class="form-control form-control-sm  @error('nama_ibu_pegawai') is-invalid @enderror" name="nama_ibu_pegawai" value="{{ $Pegawai->nama_ibu_pegawai }}">
                            @error('nama_ibu_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Data Pekerjaan</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status</label>
                            <select class="tomselect @error('status_pekerjaan_pegawai_id') is-invalid @enderror" name="status_pekerjaan_pegawai_id">
                                <option selected disabled {{ old('status_pekerjaan_pegawai_id', $Pegawai->status_pekerjaan_pegawai_id) ? '' : 'selected' }}> --Pilih Status Pekerjaan-- </option>
                                @foreach ($status_pekerjaan as $items)
                                    <option value="{{ $items->id }}" {{ old('status_pekerjaan_pegawai_id', $Pegawai->status_pekerjaan_pegawai_id) == $items->id ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status_pekerjaan_pegawai_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Foto</label>
                            <div class="custom-file mb-3">
                                <input type="file" class="custom-file-input" id="customFile" name="foto_pegawai" value="{{ old('foto_pegawai') }}">
                                    @error('foto_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <label class="custom-file-label" for="customFile">Pilih Foto</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-group">
                            <label>Tanggal Terima</label>
                            <div class="cal-icon">
                                <input type="text" class="form-control form-control-sm  datetimepicker" name="tanggal_masuk_pegawai" value="{{ $Pegawai->tanggal_masuk_pegawai }}">
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
                            <input type="text" class="form-control form-control-sm  @error('email_pegawai') is-invalid @enderror" name="email_pegawai" value="{{ $Pegawai->email_pegawai }}">
                                @error('email_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" class="form-control form-control-sm  @error('no_telp_pegawai') is-invalid @enderror" name="no_telp_pegawai" value="{{ $Pegawai->no_telp_pegawai }}">
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
                                <option value="" disabled {{ old('provinsi_code', $Pegawai->provinsi_code) ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                @foreach ($provinces as $p)
                                <option value="{{ $p->code }}" {{ old('provinsi_code', $Pegawai->provinsi_code) === $p->code ? 'selected' : '' }}>
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
                            <label>Kecamatan</label>
                            <select id="kecamatan" name="kecamatan_code" class="@error('kecamatan_code') is-invalid @enderror">
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
                            <label>Kelurahan</label>
                            <select id="kelurahan" name="kelurahan_code" class="@error('kelurahan_code') is-invalid @enderror">
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
                            <label>RT</label>
                            <input type="text" class="form-control form-control-sm @error('rt_pegawai') is-invalid @enderror" name="rt_pegawai" value="{{ $Pegawai->rt_pegawai }}">
                                @error('rt_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>RW</label>
                                <input type="text" class="form-control form-control-sm  @error('rw_pegawai') is-invalid @enderror" name="rw_pegawai" value="{{ $Pegawai->rw_pegawai }}">
                                @error('rw_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jalan</label>
                            <textarea class="form-control form-control-sm  @error('alamat_pegawai') is-invalid @enderror" name="alamat_pegawai">{{ old('memo', $Pegawai->alamat_pegawai) }}</textarea>
                                @error('alamat_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Nomor Identitas</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jenis Identitas</label>
                            <select class="tomselect" name="jenis_identitas_pegawai_id">
                                <option selected disabled {{ old('jenis_identitas_pegawai_id', $Pegawai->jenis_identitas_pegawai_id) ? '' : 'selected' }}> --Pilih Jenis Identitas-- </option>
                                @foreach ($kartu_identitas as $items)
                                    <option value="{{ $items->id }}" {{ old('jenis_identitas_pegawai_id', $Pegawai->jenis_identitas_pegawai_id) == $items->id ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nomor Identitas</label>
                            <input type="text" class="form-control form-control-sm" name="nomor_identitas_pegawai" value="{{ $Pegawai->nomor_identitas_pegawai }}">
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Kontak Darurat</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" class="form-control form-control-sm  @error('nama_kontak_darurat_pegawai') is-invalid @enderror" name="nama_kontak_darurat_pegawai" value="{{ $Pegawai->nama_kontak_darurat_pegawai }}">
                                @error('nama_kontak_darurat_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nomor Telepon</label>
                            <input type="text" class="form-control form-control-sm  @error('no_telp_darurat_pegawai') is-invalid @enderror" name="no_telp_darurat_pegawai" value="{{ $Pegawai->no_telp_darurat_pegawai }}">
                                @error('no_telp_darurat_pegawai')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Hubungan</label>
                            <select class="tomselect @error('hubungan_pegawai') is-invalid @enderror" name="hubungan_pegawai">
                                <option selected disabled {{ old('hubungan_pegawai', $Pegawai->hubungan_pegawai) ? '' : 'selected' }}> --Pilih Jenis Identitas-- </option>
                                @foreach ($hubungan_pegawai as $items)
                                    <option value="{{ $items->id }}" {{ old('hubungan_pegawai', $Pegawai->hubungan_pegawai) == $items->id ? 'selected' : '' }}>
                                        {{ $items->nama }}
                                    </option>
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
                            <input type="text" class="form-control form-control-sm" name="twitter" value="{{ $Pegawai->twitter }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Instagram</label>
                            <input type="text" class="form-control form-control-sm" name="instagram" value="{{ $Pegawai->instagram }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Youtube</label>
                            <input type="text" class="form-control form-control-sm" name="youtube" value="{{ $Pegawai->youtube }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Facebook</label>
                            <input type="text" class="form-control form-control-sm" name="facebook" value="{{ $Pegawai->facebook }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Linkedin</label>
                            <input type="text" class="form-control form-control-sm" name="linkedin" value="{{ $Pegawai->linkedin }}">
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
                                    <i class="fas fa-save mr-2"></i>Update
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
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', async () => {
            const oldProv      = "{{ old('provinsi_code', $Pegawai->provinsi_code ?? '') }}";
            const oldKota      = "{{ old('kota_code', $Pegawai->kota_code ?? '') }}";
            const oldKecamatan = "{{ old('kecamatan_code', $Pegawai->kecamatan_code ?? '') }}";
            const oldKelurahan = "{{ old('kelurahan_code', $Pegawai->kelurahan_code ?? '') }}";

            const provTS = new TomSelect('#provinsi',{create:false,maxItems:1,sortField:{field:'text',direction:'asc'}});
            const kotaTS = new TomSelect('#kota',    {create:false,maxItems:1,sortField:{field:'text',direction:'asc'}});
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
