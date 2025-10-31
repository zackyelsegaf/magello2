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
                            <label for="cluster_id" class=""><strong class="text-danger align-middle">*</strong>&nbsp;Nama Cluster</label>
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
                            <select class="tomselect @error('status_pengajuan_id') is-invalid @enderror" name="status_pengajuan_id" id="status_pengajuan_id">
                                <option {{ old('status_pengajuan_id') ? '' : 'selected' }} disabled>--Status Pengajuan--</option>
                                @foreach ($data_status_pengajuan as $items )
                                    <option value="{{ $items->id }}" {{ old('status_pengajuan_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                            @error('status_pengajuan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status_pernikahan_ids" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Status Pernikahan</label>
                            <select class="tomselect @error('status_pernikahan_id') is-invalid @enderror" name="status_pernikahan_id" id="status_pernikahan_ids">
                                <option {{ old('status_pernikahan_id') ? '' : 'selected' }} disabled>--Status Pernikahan--</option>
                                @foreach ($status_pernikahan as $items )
                                    <option value="{{ $items->id }}" {{ old('status_pernikahan_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                            @error('status_pernikahan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Data Diri Calon Konsumen</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nik_1" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;NIK</label>
                            <input type="text" id="nik_1" name="nik_1" class="form-control form-control-sm input-nik @error('nik_1') is-invalid @enderror" value="{{ old('nik_1') }}">
                            @error('nik_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_1" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Nama</label>
                            <input type="text" id="nama_1" name="nama_1" class="form-control form-control-sm @error('nama_1') is-invalid @enderror" value="{{ old('nama_1') }}">
                            @error('nama_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="no_hp_1" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Nomor HP</label>
                            <input type="text" id="no_hp_1" name="no_hp_1" class="form-control form-control-sm @error('no_hp_1') is-invalid @enderror" value="{{ old('no_hp_1') }}">
                            @error('no_hp_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="tempat_lahir_1" class="form-label fw-bold">Tempat Lahir</label>
                            <input type="text" id="tempat_lahir_1" name="tempat_lahir_1" class="form-control form-control-sm" value="{{ old('tempat_lahir_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-bold">Tanggal Lahir</label>
                            <input type="text" class="form-control form-control-sm datetimepicker" name="tanggal_lahir_1" value="{{ old('tanggal_lahir_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="religion_id" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Pilih Agama</label>
                            <select class="tomselect @error('religion_id') is-invalid @enderror" name="religion_id" id="religion_id">
                                <option {{ old('religion_id') ? '' : 'selected' }} disabled>--Pilih Agama--</option>
                                @foreach ($agama as $items )
                                    <option value="{{ $items->id }}" {{ old('religion_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                            @error('religion_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                            <label for="provinsi_code" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Provinsi KTP</label>
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
                            <label for="kota_code" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Kota KTP</label>
                            <select id="kota_code" name="kota_code" class="@error('kota_code') is-invalid @enderror">
                                <option value="" {{ old('kota_code') ? '' : 'selected' }}> --Pilih Kota-- </option>
                            </select>
                            @error('kota_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan_code">Kecamatan KTP</label>
                            <select id="kecamatan_code" name="kecamatan_code">
                                <option value="" {{ old('kecamatan_code') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>                                     
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelurahan_code">Kelurahan KTP</label>
                            <select id="kelurahan_code" name="kelurahan_code">
                                <option value="" {{ old('kelurahan_code') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>                                     
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat_konsumen" class="form-label"><strong class="text-danger align-middle">*</strong>&nbsp;Alamat KTP</label>
                            <textarea id="alamat_konsumen" name="alamat_konsumen" class="form-control form-control-sm @error('alamat_konsumen') is-invalid @enderror" rows="2">{{ old('alamat_konsumen') }}</textarea>
                            @error('alamat_konsumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi_code_1" class="form-label fw-bold">Provinsi Domisili</label>
                            <select id="provinsi_code_1" name="provinsi_code_1">
                                <option value="" disabled {{ old('provinsi_code_1') ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                @foreach ($provinces as $p)
                                <option value="{{ $p->code }}" {{ old('provinsi_code_1') === $p->code ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kota_code_1" class="form-label fw-bold">Kota Domisili</label>
                            <select id="kota_code_1" name="kota_code_1">
                                <option value="" {{ old('kota_code_1') ? '' : 'selected' }}> --Pilih Kota-- </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan_code_1">Kecamatan Domisili</label>
                            <select id="kecamatan_code_1" name="kecamatan_code_1">
                                <option value="" {{ old('kecamatan_code_1') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>                                     
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelurahan_code_1">Kelurahan Domisili</label>
                            <select id="kelurahan_code_1" name="kelurahan_code_1">
                                <option value="" {{ old('kelurahan_code_1') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>                                     
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat_1" class="form-label">Alamat Domisili</label>
                            <textarea id="alamat_1" name="alamat_1" class="form-control form-control-sm" rows="2">{{ old('alamat_1') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pekerjaan_1_id" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Pekerjaan
                            </label>
                            <select class="tomselect @error('pekerjaan_1_id') is-invalid @enderror" name="pekerjaan_1_id" id="pekerjaan_1_id">
                                <option {{ old('pekerjaan_1_id') ? '' : 'selected' }} disabled>--Pekerjaan--</option>
                                @foreach ($data_pekerjaan as $items )
                                    <option value="{{ $items->id }}" {{ old('pekerjaan_1_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                            @error('pekerjaan_1_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Ayah</label>
                            <input type="text" class="form-control form-control-sm mb-3" name="nama_ayah" value="{{ old('nama_ayah') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Nama Ibu</label>
                            <input type="text" class="form-control form-control-sm mb-3" name="nama_ibu" value="{{ old('nama_ibu') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>No NPWP</label>
                            <input type="text" class="form-control form-control-sm mb-3 npwp" name="npwp_1" value="{{ old('npwp_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>NPPKP</label>
                            <input type="text" class="form-control form-control-sm mb-3 npwp" name="nppkp_konsumen" value="{{ old('nppkp_konsumen') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label"><strong class="text-danger align-middle">*</strong>&nbsp;Marketing</label>
                            <input type="text" class="form-control form-control-sm  @error('marketing') is-invalid @enderror" name="marketing" value="{{ old('marketing', Auth::user()->name) }}" readonly>
                            @error('marketing')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email" class="form-label fw-bold"><strong class="text-danger align-middle">*</strong>&nbsp;Email</label>
                            <input type="text" name="email" class="form-control form-control-sm @error('email') is-invalid @enderror" value="{{ old('email') }}">
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Penjualan</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat_pajak_1" class="form-label">Alamat Pajak 1</label>
                            <textarea id="alamat_pajak_1" name="alamat_pajak_1" class="form-control form-control-sm" rows="2">{{ old('alamat_pajak_1') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat_pajak_2" class="form-label">Alamat Pajak 2</label>
                            <textarea id="alamat_pajak_2" name="alamat_pajak_2" class="form-control form-control-sm" rows="2">{{ old('alamat_pajak_2') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pajak 1</label>
                            <select class="tomselect"  name="pajak_1_id">
                                <option {{ old('pajak_1_id') ? '' : 'selected' }} disabled> --Pilih Pajak 1-- </option>
                                @foreach ($pajak as $items )
                                    <option value="{{ $items->id }}" {{ old('pajak_1_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Pajak 2</label>
                            <select class="tomselect"  name="pajak_2_id">
                                <option {{ old('pajak_2_id') ? '' : 'selected' }} disabled> --Pilih Pajak 2-- </option>
                                @foreach ($pajak as $items )
                                    <option value="{{ $items->id }}" {{ old('pajak_2_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Level Harga</label>
                            <select class="tomselect"  name="level_harga_id">
                                <option {{ old('level_harga_id') ? '' : 'selected' }} disabled> --Pilih Level Harga-- </option>
                                @foreach ($level_harga as $items )
                                    <option value="{{ $items->id }}" {{ old('level_harga_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Diskon Penjualan</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="diskon_penjualan" placeholder="Persentase Pajak" value="{{ old('diskon_penjualan') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Syarat</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Syarat</label>
                            <select class="tomselect"  name="syarat_id">
                                <option {{ old('syarat_id') ? '' : 'selected' }} disabled> --Pilih Syarat-- </option>
                                @foreach ($syarat as $items )
                                    <option value="{{ $items->id }}" {{ old('syarat_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Batas Maksimal Hutang</label>
                            <input type="text" class="form-control form-control-sm rupiah" name="batas_maks_hutang" value="{{ old('batas_maks_hutang') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Batas Umur Hutang</label>
                            <div class="input-group">
                                <input type="text" class="form-control form-control-sm" name="batas_umur_hutang" placeholder="Batas Umur Hutang" value="{{ old('batas_umur_hutang') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">Hari</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="data_pasangan_id_0">
                    <h6 class="font-weight-bold">Data Pasangan Suami/Istri</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_2" class="form-label fw-bold">Nama Lengkap</label>
                                <input type="text" id="nama_2" name="nama_2" class="form-control form-control-sm" value="{{ old('nama_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinsi_code_2" class="form-label fw-bold">Provinsi KTP</label>
                                <select id="provinsi_code_2" name="provinsi_code_2">
                                    <option value="" disabled {{ old('provinsi_code_2') ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                    @foreach ($provinces as $p)
                                    <option value="{{ $p->code }}" {{ old('provinsi_code_2') === $p->code ? 'selected' : '' }}>
                                        {{ $p->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kota_code_2" class="form-label fw-bold">Kota KTP</label>
                                <select id="kota_code_2" name="kota_code_2">
                                    <option value="" {{ old('kota_code_2') ? '' : 'selected' }}> --Pilih Kota-- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan_code_2">Kecamatan KTP</label>
                                <select id="kecamatan_code_2" name="kecamatan_code_2">
                                    <option value="" {{ old('kecamatan_code_2') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelurahan_code_2">Kelurahan KTP</label>
                                <select id="kelurahan_code_2" name="kelurahan_code_2">
                                    <option value="" {{ old('kelurahan_code_2') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat_2" class="form-label">Alamat KTP</label>
                                <textarea id="alamat_2" name="alamat_2" class="form-control form-control-sm" rows="2">{{ old('alamat_2') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinsi_code_3" class="form-label fw-bold">Provinsi Domisili</label>
                                <select id="provinsi_code_3" name="provinsi_code_3">
                                    <option value="" disabled {{ old('provinsi_code_3') ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                    @foreach ($provinces as $p)
                                    <option value="{{ $p->code }}" {{ old('provinsi_code_3') === $p->code ? 'selected' : '' }}>
                                        {{ $p->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kota_code_3" class="form-label fw-bold">Kota Domisili</label>
                                <select id="kota_code_3" name="kota_code_3">
                                    <option value="" {{ old('kota_code_3') ? '' : 'selected' }}> --Pilih Kota-- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan_code_3">Kecamatan Domisili</label>
                                <select id="kecamatan_code_3" name="kecamatan_code_3">
                                    <option value="" {{ old('kecamatan_code_3') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                                </select>                                     
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelurahan_code_3">Kelurahan Domisili</label>
                                <select id="kelurahan_code_3" name="kelurahan_code_3">
                                    <option value="" {{ old('kelurahan_code_3') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                                </select>                                     
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat_3" class="form-label">Alamat Domisili</label>
                                <textarea id="alamat_3" name="alamat_3" class="form-control form-control-sm" rows="2">{{ old('alamat_3') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nik_2" class="form-label fw-bold">NIK KTP</label>
                                <input type="text" id="nik_2" name="nik_2" class="form-control form-control-sm input-nik" value="{{ old('nik_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>No NPWP</label>
                                <input type="text" class="form-control form-control-sm  mb-3 npwp" name="npwp_2" value="{{ old('npwp_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pekerjaan_id" class="form-label fw-bold">Pekerjaan
                                </label>
                                <select class="tomselect" name="pekerjaan_id" id="pekerjaan_id">
                                    <option {{ old('pekerjaan_id') ? '' : 'selected' }} disabled>--Pekerjaan--</option>
                                    @foreach ($data_pekerjaan as $items )
                                        <option value="{{ $items->id }}" {{ old('pekerjaan_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="no_hp_2" class="form-label fw-bold">No HP</label>
                                <input type="text" id="no_hp_2" name="no_hp_2" class="form-control form-control-sm" value="{{ old('no_hp_2') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Data Pekerjaan Calon Konsumen</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_perusahaan_1" class="form-label fw-bold">Nama Perusahaan</label>
                            <input type="text" id="nama_perusahaan_1" name="nama_perusahaan_1" class="form-control form-control-sm" value="{{ old('nama_perusahaan_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi_code_4" class="form-label fw-bold">Provinsi Perusahaan</label>
                            <select id="provinsi_code_4" name="provinsi_code_4">
                                <option value="" disabled {{ old('provinsi_code_4') ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                @foreach ($provinces as $p)
                                <option value="{{ $p->code }}" {{ old('provinsi_code_4') === $p->code ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kota_code_4" class="form-label fw-bold">Kota Perusahaan</label>
                            <select id="kota_code_4" name="kota_code_4">
                                <option value="" {{ old('kota_code_4') ? '' : 'selected' }}> --Pilih Kota-- </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan_code_4">Kecamatan Perusahaan</label>
                            <select id="kecamatan_code_4" name="kecamatan_code_4">
                                <option value="" {{ old('kecamatan_code_4') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>                                     
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelurahan_code_4">Kelurahan Perusahaan</label>
                            <select id="kelurahan_code_4" name="kelurahan_code_4">
                                <option value="" {{ old('kelurahan_code_4') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>                                     
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat_4" class="form-label">Alamat Perusahaan</label>
                            <textarea id="alamat_4" name="alamat_4" class="form-control form-control-sm" rows="2">{{ old('alamat_4') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bidang_usaha_1" class="form-label fw-bold">Bidang Usaha</label>
                            <input type="number" id="bidang_usaha_1" name="bidang_usaha_1" class="form-control form-control-sm" value="{{ old('bidang_usaha_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Jabatan</label>
                            <input type="text" class="form-control form-control-sm  mb-3" name="jabatan_1" value="{{ old('jabatan_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Status Pekerjaan</label>
                            <input type="text" class="form-control form-control-sm  mb-3" name="status_pekerjaan_1" value="{{ old('status_pekerjaan_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label fw-bold">Tanggal Mulai Bekerja</label>
                            <input type="text" class="form-control form-control-sm datetimepicker" name="tanggal_mulai_kerja_1" value="{{ old('tanggal_mulai_kerja_1') }}">
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Nominal Pendapatan Calon Konsumen</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gaji_pokok_1" class="form-label fw-bold">Gaji Pokok</label>
                            <input type="text" id="gaji_pokok_1" name="gaji_pokok_1" class="form-control form-control-sm rupiah" value="{{ old('gaji_pokok_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cycle_gaji_pokok_1" class="form-label fw-bold">Cycle Gaji Pokok</label>
                            <input type="text" id="cycle_gaji_pokok_1" name="cycle_gaji_pokok_1" class="form-control form-control-sm rupiah" value="{{ old('cycle_gaji_pokok_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="gaji_tambahan_1" class="form-label fw-bold">Gaji Tambahan</label>
                            <input type="text" id="gaji_tambahan_1" name="gaji_tambahan_1" class="form-control form-control-sm rupiah" value="{{ old('gaji_tambahan_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="daftar_cicilan_1" class="form-label fw-bold">Daftar Cicilan</label>
                            <input type="text" id="daftar_cicilan_1" name="daftar_cicilan_1" class="form-control form-control-sm rupiah" value="{{ old('daftar_cicilan_1') }}">
                        </div>
                    </div>
                </div>
                <div id="data_pasangan_id_1">
                    <h6 class="font-weight-bold">Data Pekerjaan Pasangan Calon Konsumen</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_perusahaan_2" class="form-label fw-bold">Nama Perusahaan</label>
                                <input type="text" id="nama_perusahaan_2" name="nama_perusahaan_2" class="form-control form-control-sm" value="{{ old('nama_perusahaan_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinsi_code_5" class="form-label fw-bold">Provinsi Perusahaan</label>
                                <select id="provinsi_code_5" name="provinsi_code_5">
                                    <option value="" disabled {{ old('provinsi_code_5') ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                    @foreach ($provinces as $p)
                                    <option value="{{ $p->code }}" {{ old('provinsi_code_5') === $p->code ? 'selected' : '' }}>
                                        {{ $p->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kota_code_5" class="form-label fw-bold">Kota Perusahaan</label>
                                <select id="kota_code_5" name="kota_code_5">
                                    <option value="" {{ old('kota_code_5') ? '' : 'selected' }}> --Pilih Kota-- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan_code_5">Kecamatan Perusahaan</label>
                                <select id="kecamatan_code_5" name="kecamatan_code_5">
                                    <option value="" {{ old('kecamatan_code_5') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                                </select>                                     
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelurahan_code_5">Kelurahan Perusahaan</label>
                                <select id="kelurahan_code_5" name="kelurahan_code_5">
                                    <option value="" {{ old('kelurahan_code_5') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                                </select>                                     
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat_5" class="form-label">Alamat Perusahaan</label>
                                <textarea id="alamat_5" name="alamat_5" class="form-control form-control-sm" rows="2">{{ old('alamat_5') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bidang_usaha_2" class="form-label fw-bold">Bidang Usaha</label>
                                <input type="number" id="bidang_usaha_2" name="bidang_usaha_2" class="form-control form-control-sm" value="{{ old('bidang_usaha_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control form-control-sm  mb-3" name="jabatan_2" value="{{ old('jabatan_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status Pekerjaan</label>
                                <input type="text" class="form-control form-control-sm  mb-3" name="status_pekerjaan_2" value="{{ old('status_pekerjaan_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="form-label fw-bold">Tanggal Mulai Bekerja</label>
                                <input type="text" class="form-control form-control-sm datetimepicker" name="tanggal_mulai_kerja_2" value="{{ old('tanggal_mulai_kerja_2') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="data_pasangan_id_2">
                    <h6 class="font-weight-bold">Nominal Pendapatan Pasangan Calon Konsumen</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gaji_pokok_2" class="form-label fw-bold">Gaji Pokok</label>
                                <input type="text" id="gaji_pokok_2" name="gaji_pokok_2" class="form-control form-control-sm rupiah" value="{{ old('gaji_pokok_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="cycle_gaji_pokok_2" class="form-label fw-bold">Cycle Gaji Pokok</label>
                                <input type="text" id="cycle_gaji_pokok_2" name="cycle_gaji_pokok_2" class="form-control form-control-sm rupiah" value="{{ old('cycle_gaji_pokok_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="gaji_tambahan_2" class="form-label fw-bold">Gaji Tambahan</label>
                                <input type="text" id="gaji_tambahan_2" name="gaji_tambahan_2" class="form-control form-control-sm rupiah" value="{{ old('gaji_tambahan_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="daftar_cicilan_2" class="form-label fw-bold">Daftar Cicilan</label>
                                <input type="text" id="daftar_cicilan_2" name="daftar_cicilan_2" class="form-control form-control-sm rupiah" value="{{ old('daftar_cicilan_2') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Data Usaha Calon Konsumen (Wirausaha)</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nama_usaha_1" class="form-label fw-bold">Nama Usaha</label>
                            <input type="text" id="nama_usaha_1" name="nama_usaha_1" class="form-control form-control-sm" value="{{ old('nama_usaha_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="provinsi_code_6" class="form-label fw-bold">Provinsi Usaha</label>
                            <select id="provinsi_code_6" name="provinsi_code_6">
                                <option value="" disabled {{ old('provinsi_code_6') ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                @foreach ($provinces as $p)
                                <option value="{{ $p->code }}" {{ old('provinsi_code_6') === $p->code ? 'selected' : '' }}>
                                    {{ $p->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kota_code_6" class="form-label fw-bold">Kota Usaha</label>
                            <select id="kota_code_6" name="kota_code_6">
                                <option value="" {{ old('kota_code_6') ? '' : 'selected' }}> --Pilih Kota-- </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kecamatan_code_6">Kecamatan Usaha</label>
                            <select id="kecamatan_code_6" name="kecamatan_code_6">
                                <option value="" {{ old('kecamatan_code_6') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>                                     
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="kelurahan_code_6">Kelurahan Usaha</label>
                            <select id="kelurahan_code_6" name="kelurahan_code_6">
                                <option value="" {{ old('kelurahan_code_6') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                            </select>                                     
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="alamat_6" class="form-label">Alamat Usaha</label>
                            <textarea id="alamat_6" name="alamat_6" class="form-control form-control-sm" rows="2">{{ old('alamat_6') }}</textarea>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bidang_wirausaha_1" class="form-label fw-bold">Bidang Usaha</label>
                            <input type="number" id="bidang_wirausaha_1" name="bidang_wirausaha_1" class="form-control form-control-sm" value="{{ old('bidang_wirausaha_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Lama Usaha</label>
                            <input type="text" class="form-control form-control-sm  mb-3" name="lama_usaha_1" value="{{ old('lama_usaha_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Legalitas Usaha</label>
                            <input type="text" class="form-control form-control-sm  mb-3" name="legalitas_1" value="{{ old('legalitas_1') }}">
                        </div>
                    </div>
                </div>
                <h6 class="font-weight-bold">Nominal Pendapatan Calon Konsumen (Wirausaha)</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pendapatan_kotor_1" class="form-label fw-bold">Pendapatan Kotor</label>
                            <input type="text" id="pendapatan_kotor_1" name="pendapatan_kotor_1" class="form-control form-control-sm rupiah" value="{{ old('pendapatan_kotor_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pendapatan_bersih_1" class="form-label fw-bold">Pendapatan Bersih</label>
                            <input type="text" id="pendapatan_bersih_1" name="pendapatan_bersih_1" class="form-control form-control-sm rupiah" value="{{ old('pendapatan_bersih_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="pendapatan_tambahan_1" class="form-label fw-bold">Pendapatan Tambahan</label>
                            <input type="text" id="pendapatan_tambahan_1" name="pendapatan_tambahan_1" class="form-control form-control-sm rupiah" value="{{ old('pendapatan_tambahan_1') }}">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="daftar_cicilan_wirausaha_1" class="form-label fw-bold">Daftar Cicilan</label>
                            <input type="text" id="daftar_cicilan_wirausaha_1" name="daftar_cicilan_wirausaha_1" class="form-control form-control-sm rupiah" value="{{ old('daftar_cicilan_wirausaha_1') }}">
                        </div>
                    </div>
                </div>
                <div id="data_pasangan_id_3">
                    <h6 class="font-weight-bold">Data Usaha Pasangan Calon Konsumen (Wirausaha)</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nama_usaha_2" class="form-label fw-bold">Nama Usaha</label>
                                <input type="text" id="nama_usaha_2" name="nama_usaha_2" class="form-control form-control-sm" value="{{ old('nama_usaha_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="provinsi_code_7" class="form-label fw-bold">Provinsi Usaha</label>
                                <select id="provinsi_code_7" name="provinsi_code_7">
                                    <option value="" disabled {{ old('provinsi_code_7') ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                    @foreach ($provinces as $p)
                                    <option value="{{ $p->code }}" {{ old('provinsi_code_7') === $p->code ? 'selected' : '' }}>
                                        {{ $p->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kota_code_7" class="form-label fw-bold">Kota Usaha</label>
                                <select id="kota_code_7" name="kota_code_7">
                                    <option value="" {{ old('kota_code_7') ? '' : 'selected' }}> --Pilih Kota-- </option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kecamatan_code_7">Kecamatan Usaha</label>
                                <select id="kecamatan_code_7" name="kecamatan_code_7">
                                    <option value="" {{ old('kecamatan_code_7') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                                </select>                                     
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="kelurahan_code_7">Kelurahan Usaha</label>
                                <select id="kelurahan_code_7" name="kelurahan_code_7">
                                    <option value="" {{ old('kelurahan_code_7') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                                </select>                                     
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="alamat_7" class="form-label">Alamat Usaha</label>
                                <textarea id="alamat_7" name="alamat_7" class="form-control form-control-sm" rows="2">{{ old('alamat_7') }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="bidang_wirausaha_2" class="form-label fw-bold">Bidang Usaha</label>
                                <input type="number" id="bidang_wirausaha_2" name="bidang_wirausaha_2" class="form-control form-control-sm" value="{{ old('bidang_wirausaha_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Lama Usaha</label>
                                <input type="text" class="form-control form-control-sm  mb-3" name="lama_usaha_2" value="{{ old('lama_usaha_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Legalitas Usaha</label>
                                <input type="text" class="form-control form-control-sm  mb-3" name="legalitas_2" value="{{ old('legalitas_2') }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="data_pasangan_id_4">
                    <h6 class="font-weight-bold">Nominal Pendapatan Pasangan Calon Konsumen (Wirausaha)</h6>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pendapatan_kotor_2" class="form-label fw-bold">Pendapatan Kotor</label>
                                <input type="text" id="pendapatan_kotor_2" name="pendapatan_kotor_2" class="form-control form-control-sm" value="{{ old('pendapatan_kotor_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pendapatan_bersih_2" class="form-label fw-bold">Pendapatan Bersih</label>
                                <input type="text" id="pendapatan_bersih_2" name="pendapatan_bersih_2" class="form-control form-control-sm" value="{{ old('pendapatan_bersih_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="pendapatan_tambahan_2" class="form-label fw-bold">Pendapatan Tambahan</label>
                                <input type="text" id="pendapatan_tambahan_2" name="pendapatan_tambahan_2" class="form-control form-control-sm" value="{{ old('pendapatan_tambahan_2') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="daftar_cicilan_wirausaha_2" class="form-label fw-bold">Daftar Cicilan</label>
                                <input type="text" id="daftar_cicilan_wirausaha_2" name="daftar_cicilan_wirausaha_2" class="form-control form-control-sm" value="{{ old('daftar_cicilan_wirausaha_2') }}">
                            </div>
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
                        <a href="{{ route('konsumen/list/page') }}" class="btn btn-primary float-left mr-2 buttonedit">
                            <i class="fas fa-chevron-left mr-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary buttonedit">
                            <i class="fa fa-save mr-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
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
        document.addEventListener('DOMContentLoaded', function () {
            const statusPernikahanSelect = document.getElementById('status_pernikahan_ids');
            const dataPasangan0 = document.getElementById('data_pasangan_id_0');
            const dataPasangan1 = document.getElementById('data_pasangan_id_1');
            const dataPasangan2 = document.getElementById('data_pasangan_id_2');
            const dataPasangan3 = document.getElementById('data_pasangan_id_3');
            const dataPasangan4 = document.getElementById('data_pasangan_id_4');

            function toggleFields() {
                const selectedValue = statusPernikahanSelect.value;

                if (selectedValue === '1') {
                    dataPasangan0.style.display = 'none';
                    dataPasangan1.style.display = 'none';
                    dataPasangan2.style.display = 'none';
                    dataPasangan3.style.display = 'none';
                    dataPasangan4.style.display = 'none';
                } else if (selectedValue === '2') {
                    dataPasangan0.style.display = '';
                    dataPasangan1.style.display = '';
                    dataPasangan2.style.display = '';
                    dataPasangan3.style.display = '';
                    dataPasangan4.style.display = '';
                } else if (selectedValue === '3') {
                    dataPasangan0.style.display = 'none';
                    dataPasangan1.style.display = 'none';
                    dataPasangan2.style.display = 'none';
                    dataPasangan3.style.display = 'none';
                    dataPasangan4.style.display = 'none';
                } else if (selectedValue === '4') {
                    dataPasangan0.style.display = 'none';
                    dataPasangan1.style.display = 'none';
                    dataPasangan2.style.display = 'none';
                    dataPasangan3.style.display = 'none';
                    dataPasangan4.style.display = 'none';
                } else {
                    dataPasangan0.style.display = 'none';
                    dataPasangan1.style.display = 'none';
                    dataPasangan2.style.display = 'none';
                    dataPasangan3.style.display = 'none';
                    dataPasangan4.style.display = 'none';
                }
            }
            statusPernikahanSelect.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script>
    <script>
        var cleave = new Cleave('.input-nik', {
            delimiter: '-',
            blocks: [4, 4, 4, 4],
            uppercase: true
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cleaveMap = new WeakMap();
            window.__cleaveMap = cleaveMap;

            function initCleave(el) {
                if (!el || el.classList.contains('cleave-initialized-npwp')) return;
                const instance = new Cleave(el, {
                    delimiters: ['.', '.', '.','-','.'],
                    blocks: [3, 3, 3, 1, 3, 3],
                    uppercase: true
                });
                el.classList.add('cleave-initialized-npwp');
                cleaveMap.set(el, instance);
            }

            window.initCleaveIn = function(container) {
                container.querySelectorAll('input.npwp').forEach(initCleave);
            };

            document.querySelectorAll('input.npwp').forEach(initCleave);

            document.querySelectorAll('form').forEach(function (form) {
                form.addEventListener('submit', function () {
                    form.querySelectorAll('input.npwp').forEach(function (el) {
                        const inst = cleaveMap.get(el);
                        if (inst) el.value = inst.getRawValue();
                    });
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cleaveMap = new WeakMap();
            window.__cleaveMap = cleaveMap;

            function initCleave(el) {
                if (!el || el.classList.contains('cleave-initialized')) return;
                const instance = new Cleave(el, {
                    numeral: true,
                    numeralPositiveOnly: true,
                    numeralDecimalScale: 2,
                    numeralThousandsGroupStyle: 'thousand',
                    numeralDecimalMark: '.',
                    delimiter: ',',
                    prefix: 'Rp ',
                    rawValueTrimPrefix: true
                });
                el.classList.add('cleave-initialized');
                cleaveMap.set(el, instance);
            }

            window.initCleaveIn = function(container) {
                container.querySelectorAll('input.rupiah').forEach(initCleave);
            };

            document.querySelectorAll('input.rupiah').forEach(initCleave);

            document.querySelectorAll('form').forEach(function (form) {
                form.addEventListener('submit', function () {
                    form.querySelectorAll('input.rupiah').forEach(function (el) {
                        const inst = cleaveMap.get(el);
                        if (inst) el.value = inst.getRawValue();
                    });
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
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const oldProv       = "{{ old('provinsi_code_1') }}";
            const oldKota       = "{{ old('kota_code_1') }}";
            const oldKecamatan  = "{{ old('kecamatan_code_1') }}";
            const oldKelurahan  = "{{ old('kelurahan_code_1') }}";  
            const kelurahanText = document.querySelector('input[name="kelurahan"]'); 

            const provTS = new TomSelect('#provinsi_code_1', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });

            const kotaTS = new TomSelect('#kota_code_1', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kotaTS.disable();

            const kecamatanTS = new TomSelect('#kecamatan_code_1', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kecamatanTS.disable();

            const kelurahanTS = new TomSelect('#kelurahan_code_1', {  
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
                const url = "{{ route('ajax.cities.by-province-1') }}" + '?provinsi_code_1=' + encodeURIComponent(provCode);
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
                const url = "{{ route('ajax.districts.by-city-1') }}" + '?kota_code_1=' + encodeURIComponent(cityCode);
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
                    const url = "{{ route('ajax.villages.by-district-1') }}" + '?kecamatan_code_1=' + encodeURIComponent(districtCode);
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
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const oldProv       = "{{ old('provinsi_code_2') }}";
            const oldKota       = "{{ old('kota_code_2') }}";
            const oldKecamatan  = "{{ old('kecamatan_code_2') }}";
            const oldKelurahan  = "{{ old('kelurahan_code_2') }}";  
            const kelurahanText = document.querySelector('input[name="kelurahan"]'); 

            const provTS = new TomSelect('#provinsi_code_2', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });

            const kotaTS = new TomSelect('#kota_code_2', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kotaTS.disable();

            const kecamatanTS = new TomSelect('#kecamatan_code_2', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kecamatanTS.disable();

            const kelurahanTS = new TomSelect('#kelurahan_code_2', {  
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
                const url = "{{ route('ajax.cities.by-province-2') }}" + '?provinsi_code_2=' + encodeURIComponent(provCode);
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
                const url = "{{ route('ajax.districts.by-city-2') }}" + '?kota_code_2=' + encodeURIComponent(cityCode);
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
                    const url = "{{ route('ajax.villages.by-district-2') }}" + '?kecamatan_code_2=' + encodeURIComponent(districtCode);
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
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const oldProv       = "{{ old('provinsi_code_3') }}";
            const oldKota       = "{{ old('kota_code_3') }}";
            const oldKecamatan  = "{{ old('kecamatan_code_3') }}";
            const oldKelurahan  = "{{ old('kelurahan_code_3') }}";  
            const kelurahanText = document.querySelector('input[name="kelurahan"]'); 

            const provTS = new TomSelect('#provinsi_code_3', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });

            const kotaTS = new TomSelect('#kota_code_3', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kotaTS.disable();

            const kecamatanTS = new TomSelect('#kecamatan_code_3', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kecamatanTS.disable();

            const kelurahanTS = new TomSelect('#kelurahan_code_3', {  
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
                const url = "{{ route('ajax.cities.by-province-3') }}" + '?provinsi_code_3=' + encodeURIComponent(provCode);
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
                const url = "{{ route('ajax.districts.by-city-3') }}" + '?kota_code_3=' + encodeURIComponent(cityCode);
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
                    const url = "{{ route('ajax.villages.by-district-3') }}" + '?kecamatan_code_3=' + encodeURIComponent(districtCode);
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
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const oldProv       = "{{ old('provinsi_code_4') }}";
            const oldKota       = "{{ old('kota_code_4') }}";
            const oldKecamatan  = "{{ old('kecamatan_code_4') }}";
            const oldKelurahan  = "{{ old('kelurahan_code_4') }}";  
            const kelurahanText = document.querySelector('input[name="kelurahan"]'); 

            const provTS = new TomSelect('#provinsi_code_4', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });

            const kotaTS = new TomSelect('#kota_code_4', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kotaTS.disable();

            const kecamatanTS = new TomSelect('#kecamatan_code_4', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kecamatanTS.disable();

            const kelurahanTS = new TomSelect('#kelurahan_code_4', {  
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
                const url = "{{ route('ajax.cities.by-province-4') }}" + '?provinsi_code_4=' + encodeURIComponent(provCode);
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
                const url = "{{ route('ajax.districts.by-city-4') }}" + '?kota_code_4=' + encodeURIComponent(cityCode);
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
                    const url = "{{ route('ajax.villages.by-district-4') }}" + '?kecamatan_code_4=' + encodeURIComponent(districtCode);
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
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const oldProv       = "{{ old('provinsi_code_5') }}";
            const oldKota       = "{{ old('kota_code_5') }}";
            const oldKecamatan  = "{{ old('kecamatan_code_5') }}";
            const oldKelurahan  = "{{ old('kelurahan_code_5') }}";  
            const kelurahanText = document.querySelector('input[name="kelurahan"]'); 

            const provTS = new TomSelect('#provinsi_code_5', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });

            const kotaTS = new TomSelect('#kota_code_5', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kotaTS.disable();

            const kecamatanTS = new TomSelect('#kecamatan_code_5', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kecamatanTS.disable();

            const kelurahanTS = new TomSelect('#kelurahan_code_5', {  
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
                const url = "{{ route('ajax.cities.by-province-5') }}" + '?provinsi_code_5=' + encodeURIComponent(provCode);
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
                const url = "{{ route('ajax.districts.by-city-5') }}" + '?kota_code_5=' + encodeURIComponent(cityCode);
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
                    const url = "{{ route('ajax.villages.by-district-5') }}" + '?kecamatan_code_5=' + encodeURIComponent(districtCode);
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
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const oldProv       = "{{ old('provinsi_code_6') }}";
            const oldKota       = "{{ old('kota_code_6') }}";
            const oldKecamatan  = "{{ old('kecamatan_code_6') }}";
            const oldKelurahan  = "{{ old('kelurahan_code_6') }}";  
            const kelurahanText = document.querySelector('input[name="kelurahan"]'); 

            const provTS = new TomSelect('#provinsi_code_6', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });

            const kotaTS = new TomSelect('#kota_code_6', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kotaTS.disable();

            const kecamatanTS = new TomSelect('#kecamatan_code_6', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kecamatanTS.disable();

            const kelurahanTS = new TomSelect('#kelurahan_code_6', {  
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
                const url = "{{ route('ajax.cities.by-province-6') }}" + '?provinsi_code_6=' + encodeURIComponent(provCode);
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
                const url = "{{ route('ajax.districts.by-city-6') }}" + '?kota_code_6=' + encodeURIComponent(cityCode);
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
                    const url = "{{ route('ajax.villages.by-district-6') }}" + '?kecamatan_code_6=' + encodeURIComponent(districtCode);
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
    <script>
        document.addEventListener('DOMContentLoaded', async function () {
            const oldProv       = "{{ old('provinsi_code_7') }}";
            const oldKota       = "{{ old('kota_code_7') }}";
            const oldKecamatan  = "{{ old('kecamatan_code_7') }}";
            const oldKelurahan  = "{{ old('kelurahan_code_7') }}";  
            const kelurahanText = document.querySelector('input[name="kelurahan"]'); 

            const provTS = new TomSelect('#provinsi_code_7', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });

            const kotaTS = new TomSelect('#kota_code_7', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kotaTS.disable();

            const kecamatanTS = new TomSelect('#kecamatan_code_7', {
                create: false,                 
                maxItems: 1,
                sortField: { field: "text", direction: "asc" }
            });
            kecamatanTS.disable();

            const kelurahanTS = new TomSelect('#kelurahan_code_7', {  
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
                const url = "{{ route('ajax.cities.by-province-7') }}" + '?provinsi_code_7=' + encodeURIComponent(provCode);
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
                const url = "{{ route('ajax.districts.by-city-7') }}" + '?kota_code_7=' + encodeURIComponent(cityCode);
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
                    const url = "{{ route('ajax.villages.by-district-7') }}" + '?kecamatan_code_7=' + encodeURIComponent(districtCode);
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