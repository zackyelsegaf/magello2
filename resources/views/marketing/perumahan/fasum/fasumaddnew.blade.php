@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Fasum</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('fasum/list/page') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="kluster" class="form-label fw-bold">Kluster</label>
                        <select class="tomselect @error('kluster') is-invalid @enderror" name="kluster" id="kluster" data-placeholder="Pilih cluster...">
                            <option {{ old('kluster') ? '' : 'selected' }} disabled></option>
                            @foreach ($cluster as $items )
                            <option value="{{ $items->nama_cluster }}">{{ $items->nama_cluster }}</option>
                            @endforeach
                        </select>
                        @error('kluster')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="tipe_model" class="form-label fw-bold">Tipe Model</label>
                        <input type="text" id="tipe_model" name="tipe_model" class="form-control"
                            value="{{ old('tipe_model') }}" placeholder="Tipe Model">
                    </div>

                    <div class="col-md-4">
                        <label for="blok" class="form-label fw-bold">Blok</label>
                        <input type="text" id="blok" name="blok" class="form-control" value="{{ old('blok') }}"
                            placeholder="Blok">
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_unit" class="form-label fw-bold">Nomor Unit</label>
                        <input type="number" id="nomor_unit" name="nomor_unit" class="form-control"
                            value="{{ old('nomor_unit') }}" placeholder="Nomor Unit">
                    </div>

                    <div class="col-md-4">
                        <label for="jumlah_lantai" class="form-label fw-bold">Jumlah Lantai</label>
                        <input type="number" id="jumlah_lantai" name="jumlah_lantai" class="form-control"
                            value="{{ old('jumlah_lantai') }}" placeholder="Jumlah Lantai">
                    </div>

                    <div class="col-md-4">
                        <label for="luas_tanah" class="form-label fw-bold">Luas Tanah (m²)</label>
                        <input type="number" id="luas_tanah" name="luas_tanah" class="form-control"
                            value="{{ old('luas_tanah') }}" placeholder="Luas Tanah (m²)">
                    </div>

                    <div class="col-md-4">
                        <label for="luas_bangunan" class="form-label fw-bold">Luas Bangunan (m²)</label>
                        <input type="number" id="luas_bangunan" name="luas_bangunan" class="form-control"
                            value="{{ old('luas_bangunan') }}" placeholder="Luas Bangunan (m²)">
                    </div>

                    <div class="col-md-4">
                        <label for="rap_rab" class="form-label fw-bold">RAP & RAB</label>
                        <select class="tomselect @error('rap_rab') is-invalid @enderror" name="rap_rab" id="rap_rab" data-placeholder="Pilih rap & rab...">
                            <option {{ old('rap_rab') ? '' : 'selected' }} disabled></option>
                            @foreach ($rap_rab as $items )
                            <option value="{{ $items->judul_rap }}">{{ $items->judul_rap }}</option>
                            @endforeach
                        </select>
                        @error('rap_rab')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="harga" class="form-label fw-bold">Harga</label>
                        <input type="number" id="harga" name="harga" class="form-control" value="{{ old('harga') }}"
                            placeholder="Harga">
                    </div>
                    <div class="col-12">
                        <label for="spesifikasi" class="form-label">Spesifikasi</label>
                        <textarea id="spesifikasi" class="form-control" rows="2"></textarea>
                    </div>
                </div>

                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check mr-2"></i> Simpan
                        </button>
                        <a href="{{ route('fasum/list/page') }}" class="btn btn-primary ml-3">
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('select.tomselect').forEach(function (el) {
                new TomSelect(el,{
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            });
        });
    </script>
@endpush
@endsection
