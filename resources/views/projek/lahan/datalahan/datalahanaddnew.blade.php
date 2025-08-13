@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Lahan</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('datalahan/list/page') }}">
                @csrf

                <div class="row mb-3">

                    <div class="col-md-4">
                        <label for="nama_tanah" class="form-label fw-bold">Nama Tanah</label>
                        <input type="text" id="nama_tanah" name="nama_tanah" class="form-control"
                        value="{{ old('nama_tanah') }}" placeholder="Nama Tanah">
                    </div>

                    <div class="col-md-4">
                        <label for="klaster_proyek" class="form-label fw-bold">Untuk Klaster Proyek</label>
                        <select class="form-control @error('klaster_proyek') is-invalid @enderror" name="klaster_proyek" id="klaster_proyek">
                            <option value="">-- Pilih Klaster Proyek --</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="tanggal_perolehan" class="form-label fw-bold">Tanggal Perolehan</label>
                        <input type="date" id="tanggal_perolehan" name="tanggal_perolehan" class="form-control" value="{{ old('tanggal_perolehan') }}"
                            placeholder="Tanggal Perolehan">
                    </div>

                    <div class="col-md-4">
                        <label for="tuan_tanah" class="form-label fw-bold">Tuan Tanah</label>
                        <select class="form-control @error('tuan_tanah') is-invalid @enderror" name="tuan_tanah" id="klaster_proyek">
                            <option value="">-- Pilih Tuan Tanah --</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_hp_tuan_tanah" class="form-label fw-bold">Nomor Hp Tuan Tanah</label>
                        <input type="number" id="nomor_hp_tuan_tanah" name="nomor_hp_tuan_tanah" class="form-control"
                            value="{{ old('nomor_hp_tuan_tanah') }}" placeholder="Nomor Hp Tuan Tanah">
                    </div>

                    <div class="col-md-4">
                        <label for="luas_area" class="form-label fw-bold">Luas Area (m²)</label>
                        <input type="text" id="luas_area" name="luas_area" class="form-control"
                            value="{{ old('luas_area') }}" placeholder="Luas Area (m²)">
                    </div>

                    <div class="col-md-4">
                        <label for="harga" class="form-label fw-bold">Harga per (m²)</label>
                        <input type="text" id="harga" name="harga" class="form-control" value="{{ old('harga') }}"
                            placeholder="Harga per (m²)">
                    </div>

                    <div class="col-md-4">
                        <label for="dicatat_sebagai" class="form-label fw-bold">Dicatat Sebagai</label>
                        <select class="form-control @error('dicatat_sebagai') is-invalid @enderror" name="dicatat_sebagai" id="klaster_proyek">
                            <option value="">-- Pilih Dicatat Sebagai --</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea id="catatan" class="form-control" rows="2"></textarea>
                    </div>
                </div>

                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check mr-2"></i> Simpan
                        </button>
                        <a href="{{ route('datalahan/list/page') }}" class="btn btn-primary ml-3">
                            <i class="fas fa-chevron-left mr-2"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
