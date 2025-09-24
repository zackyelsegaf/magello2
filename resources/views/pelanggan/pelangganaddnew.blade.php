@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Pelanggan</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pelanggan/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#detail">Detail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a>
                            </li>
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No</label>
                                                    <input type="text" class="form-control form-control-sm " name="pelanggan_id" value="{{ $kodeBaru }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Pelanggan</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}">
                                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="tomselect @error('status_id') is-invalid @enderror" name="status_id">
                                                        <option {{ old('status_id') ? '' : 'selected' }} disabled> --Pilih Status-- </option>
                                                        @foreach ($data as $items )
                                                        <option value="{{ $items->id }}" {{ old('status_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('status_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>NIK</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nik') is-invalid @enderror" name="nik" value="{{ old('nik') }}">
                                                    @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <h7 class="font-weight-bold">Tempat dan Tanggal Lahir</h7>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Kota Kelahiran</label>
                                                            <select class="tomselect @error('tempat_lahir') is-invalid @enderror"  name="tempat_lahir">
                                                                <option {{ old('tempat_lahir') ? '' : 'selected' }} disabled> --Pilih Kota-- </option>
                                                                @foreach ($kota as $items )
                                                                    <option value="{{ $items->id }}" {{ old('tempat_lahir') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Lahir</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control form-control-sm  datetimepicker @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                                                                @error('tanggal_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- <div class="form-group">
                                                            <label>Negara</label>
                                                            <select class="form-control form-control-sm  @error('negara') is-invalid @enderror"  name="negara">
                                                                <option selected disabled> --Pilih Negara-- </option>
                                                                @foreach ($negara as $items )
                                                                    <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                            @error('negara')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        </div> --}}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Agama</label>
                                                    <select class="tomselect @error('religion_id') is-invalid @enderror"  name="religion_id">
                                                        <option {{ old('religion_id') ? '' : 'selected' }} disabled> --Pilih Agama-- </option>
                                                        @foreach ($agama as $items )
                                                            <option value="{{ $items->id }}" {{ old('religion_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('religion_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="tomselect @error('gender_id') is-invalid @enderror"  name="gender_id">
                                                        <option {{ old('gender_id') ? '' : 'selected' }} disabled> --Pilih Gender-- </option>
                                                        @foreach ($gender as $items )
                                                            <option value="{{ $items->id }}" {{ old('gender_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('gender_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Ayah</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama_ayah') is-invalid @enderror" name="nama_ayah" value="{{ old('nama_ayah') }}">
                                                    @error('nama_ayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Ibu</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama_ibu') is-invalid @enderror" name="nama_ibu" value="{{ old('nama_ibu') }}">
                                                    @error('nama_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="dihentikan">Dihentikan</label>
                                                    <label class="switch">
                                                        <input type="hidden" name="dihentikan" value="0">
                                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan') ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dokumen" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="page-header">
                                    <div class="row float-right">
                                        <button type="button" id="fileuploads_btn_add" class="btn btn-primary buttonedit1 float-right">
                                            <i class="fa fa-plus mr-2"></i>Tambah Field
                                        </button>
                                    </div>
                                </div>
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12" id="fileuploads_loop_add">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fileupload_1">File 1</label>
                                                    <input type="text" class="form-control form-control-sm " name="fileupload_1" placeholder="Link dokumen Anda" value="{{ old('fileupload_1') }}">
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
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#info">Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#penjualan">Penjualan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#syarat">Syarat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#memo">Memo</a>
                            </li>
                        </ul>
                    </div>
                    <div id="info" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat</label>
                                                    <input type="text" class="form-control form-control-sm mb-3 @error('alamat_1') is-invalid @enderror" name="alamat_1" value="{{ old('alamat_1') }}">
                                                    @error('alamat_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    {{-- <label>Alamat 2</label> --}}
                                                    <input type="text" class="form-control form-control-sm" name="alamat_2" value="{{ old('alamat_2') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak</label>
                                                    <input type="text" class="form-control form-control-sm  mb-3" name="alamatpajak_1" value="{{ old('alamatpajak_1') }}">
                                                    {{-- <label>Alamat Pajak 2</label> --}}
                                                    <input type="text" class="form-control form-control-sm " name="alamatpajak_2" value="{{ old('alamatpajak_2') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <select id="provinsi_code" name="provinsi_code" class="@error('provinsi_code') is-invalid @enderror">
                                                        <option value="" disabled {{ old('provinsi_code') ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                                        @foreach ($provinsi as $p)
                                                        <option value="{{ $p->code }}" {{ old('provinsi_code') === $p->code ? 'selected' : '' }}>
                                                            {{ $p->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                    @error('provinsi_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kota</label>
                                                    <select id="kota_code" name="kota_code" class="@error('kota_code') is-invalid @enderror">
                                                        <option value="" {{ old('kota_code') ? '' : 'selected' }}> --Pilih Kota-- </option>
                                                    </select>
                                                    @error('kota_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kecamatan</label>
                                                    <select id="kecamatan_code" name="kecamatan_code" class="@error('kecamatan_code') is-invalid @enderror">
                                                        <option value="" {{ old('kecamatan_code') ? '' : 'selected' }}> --Pilih Kecamatan-- </option>
                                                    </select>
                                                    @error('kecamatan_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kelurahan</label>
                                                    <select id="kelurahan_code" name="kelurahan_code" class="@error('kelurahan_code') is-invalid @enderror">
                                                        <option value="" {{ old('kelurahan_code') ? '' : 'selected' }}> --Pilih Kelurahan-- </option>
                                                    </select>
                                                    @error('kelurahan_code')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Pos</label>
                                                    <input type="text" class="form-control form-control-sm" name="kode_pos" value="{{ old('kode_pos') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kontak</label>
                                                    <input type="text" class="form-control form-control-sm " name="kontak" value="{{ old('kontak') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>No. Telp</label>
                                                    <input type="text" class="form-control form-control-sm" name="no_telp" value="{{ old('no_telp') }}">
                                                </div><div class="form-group">
                                                    <label>No. FAX</label>
                                                    <input type="text" class="form-control form-control-sm "  name="no_fax" value="{{ old('no_fax') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control form-control-sm " name="email" value="{{ old('email') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control form-control-sm " name="website" value="{{ old('website') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="penjualan" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>NPWP</label>
                                                    <input type="text" class="form-control form-control-sm  mb-3 @error('npwp') is-invalid @enderror" name="npwp" value="{{ old('npwp') }}">
                                                    @error('npwp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>NPPKP</label>
                                                    <input type="text" class="form-control form-control-sm  mb-3 @error('nppkp') is-invalid @enderror" name="nppkp" value="{{ old('nppkp') }}">
                                                    @error('nppkp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 1</label>
                                                    <select class="tomselect @error('pajak_1_id') is-invalid @enderror"  name="pajak_1_id">
                                                        <option {{ old('pajak_1_id') ? '' : 'selected' }} disabled> --Pilih Pajak 1-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->id }}" {{ old('pajak_1_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pajak_1_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 2</label>
                                                    <select class="tomselect @error('pajak_2_id') is-invalid @enderror"  name="pajak_2_id">
                                                        <option {{ old('pajak_2_id') ? '' : 'selected' }} disabled> --Pilih Pajak 2-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->id }}" {{ old('pajak_2_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pajak_2_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label>Penjual</label>
                                                    <select class="form-control form-control-sm  @error('penjual') is-invalid @enderror"  name="penjual">
                                                        <option selected disabled> --Pilih Penjual-- </option>
                                                        @foreach ($penjual as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div> --}}
                                                <div class="form-group">
                                                    <label>Tipe Pelanggan</label>
                                                    <select class="tomselect  @error('tipe_pelanggan_id') is-invalid @enderror"  name="tipe_pelanggan_id">
                                                        <option {{ old('tipe_pelanggan_id') ? '' : 'selected' }} disabled> --Pilih Tipe Pelanggan-- </option>
                                                        @foreach ($tipe_pelanggan as $items )
                                                            <option value="{{ $items->id }}" {{ old('tipe_pelanggan_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tipe_pelanggan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Level Harga</label>
                                                    <select class="tomselect"  name="level_harga">
                                                        <option {{ old('level_harga') ? '' : 'selected' }} disabled> --Pilih Level Harga-- </option>
                                                        <option value="Shipping Point">Shipping Point</option>
                                                        <option value="Destination">Destination</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Diskon Penjualan</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm" name="diskon_penjualan_pelanggan" placeholder="Persentase Pajak" value="{{ old('diskon_penjualan_pelanggan') }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">%</span>
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
                    <div id="syarat" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row formtype">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>Syarat</label>
                                                    <select class="tomselect"  name="syarat_id">
                                                        <option {{ old('syarat_id') ? '' : 'selected' }} disabled> --Pilih Syarat-- </option>
                                                        @foreach ($syarat as $items )
                                                            <option value="{{ $items->id }}" {{ old('syarat_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Batas Maksimal Hutang</label>
                                                    <input type="text" class="form-control form-control-sm rupiah" name="batas_maks_hutang" value="{{ old('batas_maks_hutang') }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Batas Umur Hutang</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm" name="batas_umur_hutang" placeholder="Batas Umur Hutang" value="{{ old('batas_umur_hutang') }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Hari</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mata Uang</label>
                                                    <select class="tomselect  @error('mata_uang_id') is-invalid @enderror" name="mata_uang_id">
                                                        <option {{ old('mata_uang_id') ? '' : 'selected' }} disabled> --Pilih Mata Uang-- </option>
                                                        @foreach ($mata_uang as $items )
                                                            <option value="{{ $items->id }}" {{ old('mata_uang_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('mata_uang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Saldo Awal</label>
                                                            <input type="text" class="form-control form-control-sm rupiah @error('saldo_awal') is-invalid @enderror" name="saldo_awal" value="{{ old('saldo_awal') }}">
                                                            @error('saldo_awal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control form-control-sm  datetimepicker" name="tanggal_pelanggan" value="{{ old('tanggal_pelanggan') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control form-control-sm" name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="memo" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{-- <label>Memo</label> --}}
                                                    <textarea class="form-control form-control-sm" name="memo" value="{{ old('memo') }}">{{ old('memo') }}</textarea>
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
                                <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-check mr-2"></i>Simpan</button>
                                <a href="{{ route('pelanggan/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
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
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('saldo_awal');

            input.addEventListener('input', () => {
                let angka = input.value.replace(/\D/g, '');
                input.value = formatRupiah(angka, 'Rp ');
            });

            input.closest('form').addEventListener('submit', () => {
                input.value = input.value.replace(/\D/g, '');
            });

            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script> --}}
    <script>
        let fieldIndex = 1;
        const maxFields = 7;

        document.getElementById('fileuploads_btn_add').addEventListener('click', function () {
            if (fieldIndex >= maxFields) {
                alert('Maksimal hanya boleh 7 file.');
                return;
            }

            fieldIndex++;

            const fieldContainer = document.getElementById('fileuploads_loop_add');

            const newField = document.createElement('div');
            newField.className = 'form-group';
            newField.innerHTML = `
                <div class="row formtype mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fileupload_${fieldIndex}">File ${fieldIndex}</label>
                            <input type="text" name="fileupload_${fieldIndex}" class="form-control form-control-sm " />
                            @error('fileupload_${fieldIndex}')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

            `;

            fieldContainer.appendChild(newField);
        });
    </script>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cleaveMap = new WeakMap();

            document.querySelectorAll('input.rupiah').forEach(function (el) {
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
                cleaveMap.set(el, instance);
            });

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
    <script>        
        document.addEventListener('DOMContentLoaded', async function () {
            const oldProv       = "{{ old('provinsi_code') }}";
            const oldKota       = "{{ old('kota_code') }}";
            const oldKecamatan  = "{{ old('kecamatan_code') }}";
            const oldKelurahan  = "{{ old('kelurahan_code') }}";  
            const kelurahanText = document.querySelector('input[name="kelurahan_code"]'); 

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
