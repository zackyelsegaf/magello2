@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Master Biaya Lahan</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('masterbiayalahan/list/page') }}">
                @csrf

                <div class="row mb-3">

                    <div class="col-md-4">
                        <label for="nama_biaya" class="form-label fw-bold">Nama Biaya</label>
                        <input type="text" id="nama_biaya" name="nama_biaya" class="form-control form-control-sm"
                            value="{{ old('nama_biaya') }}" placeholder="Nama Biaya">
                    </div>

                    <div class="col-md-4">
                        <label for="akun_perolehan" class="form-label fw-bold">Akun Perolehan</label>
                        <select class="tomselect @error('akun_perolehan') is-invalid @enderror" name="akun_perolehan" id="akun_perolehan" data-placeholder="Pilih akun...">
                            <option {{ old('akun_perolehan') ? '' : 'selected' }} disabled></option>
                            @foreach ($akun as $items )
                            <option value="{{ $items->nama_akun_indonesia }}">{{ $items->nama_akun_indonesia }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="akun_closing" class="form-label fw-bold">Akun Closing</label>
                        <select class="tomselect @error('akun_closing') is-invalid @enderror" name="akun_closing" id="akun_closing" data-placeholder="Pilih akun...">
                            <option {{ old('akun_closing') ? '' : 'selected' }} disabled></option>
                            @foreach ($akun as $items )
                            <option value="{{ $items->nama_akun_indonesia }}">{{ $items->nama_akun_indonesia }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check mr-2"></i> Simpan
                        </button>
                        <a href="{{ route('masterbiayalahan/list/page') }}" class="btn btn-primary ml-3">
                            <i class="fas fa-chevron-left mr-2"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
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
