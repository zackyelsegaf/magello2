@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Cabang</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/cabang/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kode Cabang</label>
                                    <input type="text" class="form-control form-control-sm  @error('cabang_id') is-invalid @enderror" name="cabang_id" placeholder="Kode pajak pelanggan" value="{{ old('cabang_id') }}">
                                    @error('cabang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Cabang</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_cabang') is-invalid @enderror" name="nama_cabang" placeholder="Nama Cabang" value="{{ old('nama_cabang') }}">
                                    @error('nama_cabang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Kode Transaksi Cabang</label>
                                    <input type="text" class="form-control form-control-sm  @error('kode_transaksi') is-invalid @enderror" name="kode_transaksi" placeholder="Kode Transaksi" value="{{ old('kode_transaksi') }}">
                                    @error('kode_transaksi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="gudang" class="form-label fw-bold">Gudang</label>
                                    <select class="form-select tomselect @error('gudang') is-invalid @enderror" name="gudang[]" multiple>
                                        <option></option>
                                        @foreach ($gudang as $items )
                                        <option value="{{ $items->nama_gudang }}">{{ $items->nama_gudang }}</option>
                                        @endforeach
                                    </select>
                                    @error('gudang')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="Pengguna" class="form-label fw-bold">Pengguna</label>
                                    <select class="form-select tomselect @error('pengguna') is-invalid @enderror" name="pengguna[]" multiple>
                                        <option></option>
                                        @foreach ($users as $items )
                                        <option value="{{ $items->name }}">{{ $items->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('pengguna')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <a href="{{ route('cabang/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                                <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('select.tomselect').forEach(function (el) {
                new TomSelect(el, {
                plugins: ['remove_button'],
                create: false,
                searchField: ['text']
            });
            });
        });
    </script>
    @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Silakan periksa kembali form yang Anda isi.',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @endsection
@endsection
