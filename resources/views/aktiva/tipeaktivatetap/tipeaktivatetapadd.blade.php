@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Tipe Aktiva Tetap</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/penjual/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>* Tipe Aktiva Tetap</label>
                                    <input type="text"
                                        class="form-control @error('nama_depan_penjual') is-invalid @enderror"name="nama_depan_penjual"
                                        value="{{ old('nama_depan_penjual') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tipe Aktiva Tetap Pajak</label>
                                    <select class="form-control @error('tempat_lahir_pegawai') is-invalid @enderror"
                                        name="tempat_lahir_pegawai">
                                        <option selected disabled> --Pilih Kota-- </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Metode Penyusutan</label>
                                    <select class="form-control @error('tempat_lahir_pegawai') is-invalid @enderror"
                                        name="tempat_lahir_pegawai">
                                        <option selected disabled> --Pilih Kota-- </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Umur Perkiraan</label>
                                    <input type="text"
                                        class="form-control @error('nama_belakang_penjual') is-invalid @enderror"name="nama_belakang_penjual"
                                        value="{{ old('nama_belakang_penjual') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nilai Penyusutan</label>
                                    <input type="text"
                                        class="form-control @error('nama_belakang_penjual') is-invalid @enderror"name="nama_belakang_penjual"
                                        value="{{ old('nama_belakang_penjual') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit"><i
                                        class="fa fa-check mr-2"></i>Simpan</button>
                                <a href="{{ route('penjual/list/page') }}"
                                    class="btn btn-primary float-left veiwbutton ml-3"><i
                                        class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
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
@endsection
