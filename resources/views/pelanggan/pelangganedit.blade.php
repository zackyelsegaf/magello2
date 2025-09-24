@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Mata Uang</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('pelanggan/update', $Pelanggan->id) }}" method="POST" enctype="multipart/form-data">
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
                                                    <input type="text" class="form-control form-control-sm " id="pelanggan_id" name="pelanggan_id" value="{{ $Pelanggan->pelanggan_id }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Pelanggan</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama') is-invalid @enderror" name="nama" value="{{ $Pelanggan->nama }}">
                                                     @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="tomselect @error('status_id') is-invalid @enderror" name="status_id">
                                                        <option selected disabled {{ old('status_id', $Pelanggan->status_id) ? '' : 'selected' }}> --Pilih Status-- </option>
                                                        @foreach ($data as $items)
                                                            <option value="{{ $items->id }}" {{ old('status_id', $Pelanggan->status_id) == $items->id ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                     @error('status_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>NIK</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nik') is-invalid @enderror" name="nik" value="{{ $Pelanggan->nik }}">
                                                     @error('nik')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <h7 class="font-weight-bold">Tempat dan Tanggal Lahir</h7>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Kota</label>
                                                            <select class="tomselect @error('tempat_lahir') is-invalid @enderror"  name="tempat_lahir">
                                                                <option selected disabled {{ old('tempat_lahir', $Pelanggan->tempat_lahir) ? '' : 'selected' }}> --Pilih Kota-- </option>
                                                                @foreach ($kota as $items )
                                                                    <option value="{{ $items->id }}" {{ old('tempat_lahir', $Pelanggan->tempat_lahir) == $items->id ? 'selected' : '' }}>
                                                                        {{ $items->nama }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                             @error('tempat_lahir')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal Lahir</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control form-control-sm  datetimepicker @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir" value="{{ $Pelanggan->tanggal_lahir }}">
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
                                                    <select class="tomselect @error('religion_id') is-invalid @enderror" name="religion_id">
                                                        <option selected disabled {{ old('religion_id', $Pelanggan->religion_id) ? '' : 'selected' }}> --Pilih Agama-- </option>
                                                        @foreach ($agama as $items )
                                                            <option value="{{ $items->id }}" {{ old('religion_id', $Pelanggan->religion_id) == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                     @error('religion_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Jenis Kelamin</label>
                                                    <select class="tomselect @error('gender_id') is-invalid @enderror"  name="gender_id">
                                                        <option selected disabled {{ old('gender_id', $Pelanggan->gender_id) ? '' : 'selected' }}> --Pilih Gender-- </option>
                                                        @foreach ($gender as $items )
                                                            <option value="{{ $items->id }}" {{ old('gender_id', $Pelanggan->gender_id) == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                     @error('gender_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Ayah</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama_ayah') is-invalid @enderror" name="nama_ayah" value="{{ $Pelanggan->nama_ayah }}">
                                                     @error('nama_ayah')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Ibu</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama_ibu') is-invalid @enderror" name="nama_ibu" value="{{ $Pelanggan->nama_ibu }}">
                                                     @error('nama_ibu')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="dihentikan">Dihentikan</label>
                                                    <label class="switch">
                                                        <input type="hidden" name="dihentikan" value="0">
                                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan', $Pelanggan->dihentikan) ? 'checked' : '' }}>
                                                         @error('dihentikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <span class="ml-2" id="dihentikan-status">{{ old('dihentikan', $Pelanggan->dihentikan) ? 'Aktif' : 'Tidak Aktif' }}</span>
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
                                        <button type="button" id="fileuploads_btn_update" class="btn btn-primary buttonedit1 float-right"><i class="fa fa-plus mr-2"></i>Tambah Field</button>
                                    </div>
                                </div>
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12" id="fileuploads_loop">
                                        @php
                                            $i = 1;
                                        @endphp
                                        @while (!empty($Pelanggan["fileupload_$i"]))
                                            <div class="row formtype mb-2" id="fieldRow_{{ $i }}">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="fileupload_{{ $i }}">File {{ $i }}</label>
                                                        <input type="text" class="form-control form-control-sm " name="fileupload_{{ $i }}" value="{{ $Pelanggan["fileupload_$i"] }}" placeholder="Link dokumen Anda">
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
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#info">Info</a>
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
                                                    <label>Alamat 1</label>
                                                    <textarea class="form-control form-control-sm  @error('alamat_1') is-invalid @enderror" name="alamat_1">{{ old('alamat_1', $Pelanggan->alamat_1) }}</textarea>
                                                     @error('alamat_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat 2</label>
                                                    <textarea class="form-control form-control-sm" name="alamat_2">{{ old('alamat_2', $Pelanggan->alamat_2) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak 1</label>
                                                    <textarea class="form-control form-control-sm" name="alamatpajak_1">{{ old('alamatpajak_1', $Pelanggan->alamatpajak_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak 2</label>
                                                    <textarea class="form-control form-control-sm" name="alamatpajak_2">{{ old('alamatpajak_2', $Pelanggan->alamatpajak_2) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <select id="provinsi_code" class="@error('provinsi_code') is-invalid @enderror" name="provinsi_code">
                                                        <option selected disabled {{ old('provinsi_code', $Pelanggan->provinsi_code) ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                                        @foreach ($provinsi as $p)
                                                        <option value="{{ $p->code }}" {{ old('provinsi_code', $Pelanggan->provinsi_code) === $p->code ? 'selected' : '' }}>
                                                            {{ $p->name }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                     {{-- @error('provinsi_code')<div class="invalid-feedback">{{ $message }}</div>@enderror --}}
                                                </div>
                                                <div class="form-group">
                                                    <label>Kota</label>
                                                    <select id="kota_code" class="@error('kota_code') is-invalid @enderror"  name="kota_code">
                                                        <option selected disabled {{ old('kota_code', $Pelanggan->kota_code) ? '' : 'selected' }}> --Pilih Kota-- </option>
                                                        @foreach ($kota as $items )
                                                            <option value="{{ $items->nama }}" {{ old('kota_code', $Pelanggan->kota_code) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                     {{-- @error('kota_code')<div class="invalid-feedback">{{ $message }}</div>@enderror --}}
                                                </div>
                                                <div class="form-group">
                                                    <label for="kecamatan_code">Kecamatan</label>
                                                    <select id="kecamatan_code" name="kecamatan_code" class="@error('kecamatan_code') is-invalid @enderror">
                                                        @if(!empty($districtSelected))
                                                        <option value="{{ $districtSelected->code }}" selected>{{ $districtSelected->name }}</option>
                                                        @else
                                                        <option value="" disabled selected> --Pilih Kecamatan-- </option>
                                                        @endif
                                                    </select>                                     
                                                    {{-- @error('kecamatan_code')<div class="invalid-feedback">{{ $message }}</div>@enderror --}}
                                                </div>
                                                <div class="form-group">
                                                    <label for="kelurahan_code">Kelurahan</label>
                                                    <select id="kelurahan_code" name="kelurahan_code" class="@error('kelurahan_code') is-invalid @enderror">
                                                        @if(!empty($villageSelected))
                                                        <option value="{{ $villageSelected->code }}" selected>{{ $villageSelected->name }}</option>
                                                        @else
                                                        <option value="" disabled selected> --Pilih Kelurahan-- </option>
                                                        @endif
                                                    </select>                                     
                                                    {{-- @error('kelurahan_code')<div class="invalid-feedback">{{ $message }}</div>@enderror --}}
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Pos</label>
                                                    <input type="text" class="form-control form-control-sm" name="kode_pos" value="{{ $Pelanggan->kode_pos }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kontak</label>
                                                    <input type="text" class="form-control form-control-sm" name="kontak" value="{{ $Pelanggan->kontak }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>No. Telp</label>
                                                    <input type="text" class="form-control form-control-sm" name="no_telp" value="{{ $Pelanggan->no_telp }}">
                                                </div><div class="form-group">
                                                    <label>No. FAX</label>
                                                    <input type="text" class="form-control form-control-sm"  name="no_fax" value="{{ $Pelanggan->no_fax }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control form-control-sm" name="email" value="{{ $Pelanggan->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control form-control-sm" name="website" value="{{ $Pelanggan->website }}">
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
                                                    <input type="text" class="form-control form-control-sm  mb-3 @error('npwp') is-invalid @enderror" name="npwp" value="{{ $Pelanggan->npwp }}">
                                                     @error('npwp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>NPPKP</label>
                                                    <input type="text" class="form-control form-control-sm  mb-3 @error('nppkp') is-invalid @enderror" name="nppkp" value="{{ $Pelanggan->nppkp }}">
                                                     @error('nppkp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 1</label>
                                                    <select class="tomselect @error('pajak_1_id') is-invalid @enderror" name="pajak_1_id">
                                                        <option selected disabled {{ old('pajak_1_id', $Pelanggan->pajak_1_id) ? '' : 'selected' }}> --Pilih Pajak 1-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->id }}" {{ old('pajak_1_id', $Pelanggan->pajak_1_id) == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                     @error('pajak_1_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 2</label>
                                                    <select class="tomselect @error('pajak_2_id') is-invalid @enderror"  name="pajak_2_id">
                                                        <option selected disabled {{ old('pajak_2_id', $Pelanggan->pajak_2_id) ? '' : 'selected' }}> --Pilih Pajak 2-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->id }}" {{ old('pajak_2_id', $Pelanggan->pajak_2_id) == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
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
                                                    <select class="tomselect @error('tipe_pelanggan_id') is-invalid @enderror"  name="tipe_pelanggan_id">
                                                        <option selected disabled {{ old('tipe_pelanggan_id', $Pelanggan->tipe_pelanggan_id) ? '' : 'selected' }}> --Pilih Tipe Pelanggan-- </option>
                                                        @foreach ($tipe_pelanggan as $items )
                                                            <option value="{{ $items->id }}" {{ old('tipe_pelanggan_id', $Pelanggan->tipe_pelanggan_id) == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                     @error('tipe_pelanggan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Level Harga</label>
                                                    <select class="tomselect"  name="level_harga">
                                                        <option selected disabled {{ old('level_harga', $Pelanggan->level_harga) ? '' : 'selected' }}> --Pilih Level Harga-- </option>
                                                        <option value="Shipping Point" {{ old('level_harga', $Pelanggan->level_harga  ?? null) == 'Shipping Point' ? 'selected' : '' }}>Shipping Point</option>
                                                    <option value="Destination" {{ old('level_harga', $Pelanggan->level_harga  ?? null) == 'Destination' ? 'selected' : '' }}>Destination</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Diskon Penjualan</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm" name="diskon_penjualan_pelanggan" placeholder="Persentase Pajak" value="{{ $Pelanggan->diskon_penjualan_pelanggan }}">
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
                                                        <option selected disabled  {{ old('syarat_id', $Pelanggan->syarat_id) ? '' : 'selected' }}> --Pilih Syarat-- </option>
                                                        @foreach ($syarat as $items )
                                                            <option value="{{ $items->id }}" {{ old('syarat_id', $Pelanggan->syarat_id) == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Batas Maksimal Hutang</label>
                                                    <input type="text" class="form-control form-control-sm rupiah" name="batas_maks_hutang" value="{{ $Pelanggan->batas_maks_hutang }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Batas Umur Hutang</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control form-control-sm" name="batas_umur_hutang" placeholder="Batas Umur Hutang" value="{{ $Pelanggan->batas_umur_hutang }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">Hari</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Mata Uang</label>
                                                    <select class="tomselect @error('mata_uang_id') is-invalid @enderror"  name="mata_uang_id">
                                                        <option selected disabled  {{ old('mata_uang_id', $Pelanggan->mata_uang_id) ? '' : 'selected' }}> --Pilih Mata Uang-- </option>
                                                        @foreach ($mata_uang as $items )
                                                            <option value="{{ $items->id }}" {{ old('mata_uang_id', $Pelanggan->mata_uang_id) == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                     @error('mata_uang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Saldo Awal</label>
                                                            <input type="text" class="form-control form-control-sm rupiah" name="saldo_awal" value="{{ $Pelanggan->saldo_awal }}">
                                                             @error('saldo_awal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control form-control-sm  datetimepicker @error('tanggal_pelanggan') is-invalid @enderror" name="tanggal_pelanggan" value="{{ $Pelanggan->tanggal_pelanggan }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control form-control-sm" name="deskripsi">{{ old('deskripsi', $Pelanggan->deskripsi) }}</textarea>
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{-- <label>Memo</label> --}}
                                                    <textarea class="form-control form-control-sm" name="memo">{{ old('memo', $Pelanggan->memo) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
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
            const checkbox = document.getElementById('dihentikan');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }

            updateStatusText();

            checkbox.addEventListener('change', updateStatusText);
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
                            <input type="text" class="form-control form-control-sm " name="fileupload_${fieldCount}" placeholder="Link dokumen Anda">
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
        document.addEventListener('DOMContentLoaded', async () => {
            const oldProv      = "{{ old('provinsi_code', $Pelanggan->provinsi_code ?? '') }}";
            const oldKota      = "{{ old('kota_code', $Pelanggan->kota_code ?? '') }}";
            const oldKecamatan = "{{ old('kecamatan_code', $Pelanggan->kecamatan_code ?? '') }}";
            const oldKelurahan = "{{ old('kelurahan_code', $Pelanggan->kelurahan_code ?? '') }}";

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
