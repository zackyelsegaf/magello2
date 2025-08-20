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
                        <input type="text" id="nama_tanah" name="nama_tanah" class="form-control form-control-sm"
                        value="{{ old('nama_tanah') }}" placeholder="Nama Tanah">
                    </div>

                    <div class="col-md-4">
                        <label for="klaster_proyek" class="form-label fw-bold">Untuk Klaster Proyek</label>
                        <select class="tomselect @error('klaster_proyek') is-invalid @enderror" name="klaster_proyek" id="klaster_proyek" data-placeholder="Pilih klaster...">
                            <option {{ old('klaster_proyek') ? '' : 'selected' }} disabled></option>
                            @foreach ($cluster as $items )
                            <option value="{{ $items->nama_cluster }}">{{ $items->nama_cluster }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="tanggal_perolehan" class="form-label fw-bold">Tanggal Perolehan</label>
                        <input type="text" id="tanggal_perolehan" name="tanggal_perolehan" class="form-control datetimepicker" value="{{ old('tanggal_perolehan') }}"
                            placeholder="Tanggal Perolehan">
                    </div>

                    <div class="col-md-4">
                        <label for="tuan_tanah" class="form-label fw-bold">Tuan Tanah</label>
                        <select class="tomselect @error('tuan_tanah') is-invalid @enderror" name="tuan_tanah" id="tuan_tanah" data-placeholder="Pilih supplier...">
                            <option {{ old('tuan_tanah') ? '' : 'selected' }} disabled></option>
                            @foreach ($pemasok as $items )
                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_hp_tuan_tanah" class="form-label fw-bold">Nomor Hp Tuan Tanah</label>
                        <input type="number" id="nomor_hp_tuan_tanah" name="nomor_hp_tuan_tanah" class="form-control form-control-sm"
                            value="{{ old('nomor_hp_tuan_tanah') }}" placeholder="Nomor Hp Tuan Tanah">
                    </div>

                    <div class="col-md-4">
                        <label for="luas_area" class="form-label fw-bold">Luas Area (m²)</label>
                        <input type="text" id="luas_area" name="luas_area" class="form-control form-control-sm"
                            value="{{ old('luas_area') }}" placeholder="Luas Area (m²)">
                    </div>

                    <div class="col-md-4">
                        <label for="harga" class="form-label fw-bold">Harga per (m²)</label>
                        <input type="text" id="harga" name="harga" class="form-control form-control-sm" value="{{ old('harga') }}"
                            placeholder="Harga per (m²)">
                    </div>

                    <div class="col-md-4">
                        <label for="dicatat_sebagai" class="form-label fw-bold">Dicatat Sebagai</label>
                        <select class="tomselect @error('dicatat_sebagai') is-invalid @enderror" name="dicatat_sebagai" id="dicatat_sebagai" data-placeholder="Pilih...">
                            <option value="">-- Pilih Dicatat Sebagai --</option>
                            <option value="Sebelumnya Sudah Dibeli (Sudah dicatat Persediaan Tanah)" {{ old('dicatat_sebagai') == 'Sebelumnya Sudah Dibeli (Sudah dicatat Persediaan Tanah)' ? 'selected' : '' }}>Sebelumnya Sudah Dibeli (Sudah dicatat Persediaan Tanah)</option>
                            <option value="Pembelian Lahan Baru (Belum dicatat pada Persediaan Tanah)" {{ old('dicatat_sebagai') == 'Pembelian Lahan Baru (Belum dicatat pada Persediaan Tanah)' ? 'selected' : '' }}>Pembelian Lahan Baru (Belum dicatat pada Persediaan Tanah)</option>
                        </select>
                    </div>

                    <div class="col-12">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea id="catatan" class="form-control form-control-sm" rows="2"></textarea>
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
@section('script')
    {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
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
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endsection
@endsection
