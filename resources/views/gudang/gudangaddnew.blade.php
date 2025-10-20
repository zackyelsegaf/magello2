@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Gudang</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/gudang/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-6">                                              
                                <div class="form-group">
                                    <label>Nama Gudang</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_gudang') is-invalid @enderror" name="nama_gudang" value="{{ old('nama_gudang') }}">
                                    @error('nama_gudang')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control form-control-sm" name="alamat_gudang_1" value="{{ old('alamat_gudang_1') }}">{{ old('alamat_gudang_1') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Alamat 2</label>
                                    <textarea class="form-control form-control-sm " name="alamat_gudang_2" value="{{ old('alamat_gudang_2') }}">{{ old('alamat_gudang_2') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Alamat 3</label>
                                    <textarea class="form-control form-control-sm " name="alamat_gudang_3" value="{{ old('alamat_gudang_3') }}">{{ old('alamat_gudang_3') }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Penanggung Jawab</label>
                                    <input type="text" class="form-control form-control-sm " name="penanggung_jawab" value="{{ old('penanggung_jawab') }}">
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control form-control-sm " name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi') }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                                <a href="{{ route('gudang/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')     
    @endsection
@endsection