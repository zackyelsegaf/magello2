@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Kavling</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('kavling/update', $updateKavling->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="kluster" class="form-label fw-bold">Kluster</label>
                        <select class="tomselect @error('cluster_id') is-invalid @enderror" name="cluster_id" id="kluster" data-placeholder="Pilih cluster...">
                            <option {{ old('cluster_id') ? '' : 'selected' }} disabled></option>
                            @foreach ($cluster as $items )
                            <option value="{{ $items->id }}">{{ $items->nama_cluster }}</option>
                            @endforeach
                        </select>
                        @error('cluster_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="tipe_model" class="form-label fw-bold">Tipe Model</label>
                        <input type="text" id="tipe_model" name="tipe_model" class="form-control" value="{{ old('tipe_model', $updateKavling->tipe_model) }}" placeholder="Tipe Model" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="blok" class="form-label fw-bold">Blok</label>
                        <input type="text" id="blok" name="blok_kapling" class="form-control @error('blok_kapling') is-invalid @enderror" value="{{ old('blok_kapling', $updateKavling->blok_kapling) }}" placeholder="Blok">
                        @error('blok_kapling')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_unit" class="form-label fw-bold">Nomor Unit</label>
                        <input type="number" id="nomor_unit" name="nomor_unit_kapling" class="form-control @error('nomor_unit_kapling') is-invalid @enderror" value="{{ old('nomor_unit_kapling', $updateKavling) }}" placeholder="Nomor Unit">
                        @error('nomor_unit_kapling')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="jumlah_lantai" class="form-label fw-bold">Jumlah Lantai</label>
                        <input type="number" id="jumlah_lantai" name="jumlah_lantai" class="form-control @error('jumlah_lantai') is-invalid @enderror" value="{{ old('jumlah_lantai', $updateKavling->jumlah_lantai) }}" placeholder="Jumlah Lantai">
                        @error('jumlah_lantai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="luas_tanah" class="form-label fw-bold">Luas Tanah (m²)</label>
                        <input type="number" id="luas_tanah" name="luas_tanah" class="form-control @error('luas_tanah') is-invalid @enderror" value="{{ old('luas_tanah', $updateKavling->luas_tanah) }}" placeholder="Luas Tanah (m²)">
                        @error('luas_tanah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="luas_bangunan" class="form-label fw-bold">Luas Bangunan (m²)</label>
                        <input type="number" id="luas_bangunan" name="luas_bangunan" class="form-control @error('luas_bangunan') is-invalid @enderror" value="{{ old('luas_bangunan', $updateKavling->luas_bangunan) }}" placeholder="Luas Bangunan (m²)">
                    </div>

                    <div class="col-md-4">
                        <label for="rap_rab" class="form-label fw-bold">RAP & RAB</label>
                        <select class="tomselect @error('rap_rab_id') is-invalid @enderror" name="rap_rab_id" id="rap_rab" data-placeholder="Pilih rap & rab...">
                            <option {{ old('rap_rab_id') ? '' : 'selected' }} disabled></option>
                            @foreach ($rap_rab as $items )
                            <option value="{{ $items->id }}">{{ $items->judul_rap }}</option>
                            @endforeach
                        </select>
                        @error('rap_rab_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="harga" class="form-label fw-bold">Harga</label>
                        <input type="number" id="harga" name="harga_kapling" class="form-control @error('harga_kapling') is-invalid @enderror" value="{{ old('harga_kapling', $updateKavling->harga_kapling) }}" placeholder="Harga">
                        @error('harga_kapling')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="spesifikasi" class="form-label">Spesifikasi</label>
                        <textarea id="spesifikasi" class="form-control @error('spesifikasi') is-invalid @enderror" name="spesifikasi" rows="2"></textarea>
                        @error('spesifikasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check mr-2"></i> Simpan
                        </button>
                        <a href="{{ route('kavling/list/page') }}" class="btn btn-primary ml-3">
                            <i class="fas fa-chevron-left mr-2"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

    {{-- Cleave.js untuk masking angka/rupiah --}}
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // --- TomSelect
        document.querySelectorAll('select.tomselect').forEach(function (el) {
            new TomSelect(el, {
                create: false, // data harus dari master (FK), hindari input bebas
                sortField: { field: "text", direction: "asc" }
            });
        });
    });
    </script>
@endpush
@endsection
