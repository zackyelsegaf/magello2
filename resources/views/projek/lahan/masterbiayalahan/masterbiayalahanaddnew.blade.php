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
                        <input type="text" id="nama_biaya" name="nama_biaya" class="form-control"
                            value="{{ old('nama_biaya') }}" placeholder="Nama Biaya">
                    </div>

                    <div class="col-md-4">
                        <label for="akun_perolehan" class="form-label fw-bold">Akun Perolehan</label>
                        <select class="form-control @error('akun_perolehan') is-invalid @enderror" name="akun_perolehan" id="akun_perolehan">
                            <option value="">-- Pilih Akun Perolehan --</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="akun_closing" class="form-label fw-bold">Akun Closing</label>
                        <select class="form-control @error('akun_closing') is-invalid @enderror" name="akun_closing" id="akun_closing">
                            <option value="">-- Pilih Akun Closing --</option>
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
@endsection
