@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Kluster/ Perumahan</h3>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('prospek/list/page') }}">
                @csrf
                <!-- Section 1: Form Header -->
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nama_kluster" class="form-label fw-bold">Nama Kluster</label>
                        <input type="text" id="nama_kluster" name="nama_kluster" class="form-control"
                            value="{{ old('nama_kluster') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_hp" class="form-label fw-bold">Nomor Hp</label>
                        <input type="number" id="nomor_hp" name="nomor_hp" class="form-control"
                            value="{{ old('nomor_hp') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="email" class="form-label fw-bold">Luas Tanah Total (m2)</label>
                        <input type="luas_tanah_total" id="luas_tanah_total" name="luas_tanah_total" class="form-control"
                            value="{{ old('luas_tanah_total') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="ditugaskan_ke" class="form-label fw-bold">Provinsi</label>
                        <select class="form-control @error('ditugaskan_ke') is-invalid @enderror" name="ditugaskan_ke"
                            id="ditugaskan_ke">
                            <option value="">--Provinsi--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="sumber_prospek" class="form-label fw-bold">Kota</label>
                        <select class="form-control @error('sumber_prospek') is-invalid @enderror" name="sumber_prospek"
                            id="sumber_prospek">
                            <option value="">--Kota--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="kecamatan" class="form-label fw-bold">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                            value="{{ old('kecamatan') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="kelurahan" class="form-label fw-bold">Kelurahan</label>
                        <input type="text" id="kelurahan" name="kelurahan" class="form-control"
                            value="{{ old('kelurahan') }}">
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea id="alamat" class="form-control" rows="2"></textarea>
                    </div>
                </div>

                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit">
                                <i class="fa fa-check mr-2"></i>Simpan
                            </button>
                            <a href="{{ route('klusterperumahan/list/page') }}"
                                class="btn btn-primary float-left veiwbutton ml-3">
                                <i class="fas fa-chevron-left mr-2"></i>Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
