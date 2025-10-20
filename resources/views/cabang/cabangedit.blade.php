@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Cabang</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('cabang/update', $cabang->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kode Cabang</label>
                                    <input type="text" class="form-control form-control-sm  @error('cabang_id') is-invalid @enderror" name="cabang_id" placeholder="Kode pajak pelanggan" value="{{ $cabang->cabang_id }}">
                                </div>
                                <div class="form-group">
                                    <label>Nama Cabang</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_cabang') is-invalid @enderror" name="nama_cabang" placeholder="Nama Cabang" value="{{ $cabang->nama_cabang }}">
                                </div>
                                <div class="form-group">
                                    <label>Kode Transaksi Cabang</label>
                                    <input type="text" class="form-control form-control-sm  @error('kode_transaksi') is-invalid @enderror" name="kode_transaksi" placeholder="Kode Transaksi" value="{{ $cabang->kode_transaksi }}">
                                </div>
                                <div class="form-group">
                                    <label for="gudang" class="form-label fw-bold">Gudang</label>
                                    <select class="form-select tomselect @error('gudang') is-invalid @enderror" id="gudang" name="gudang[]" multiple>
                                        <option></option>
                                        @foreach ($gudang as $items )
                                            <option value="{{ $items->nama_gudang }}"
                                                {{ in_array($items->nama_gudang, old('gudang', $cabang->gudang ?? [])) ? 'selected' : '' }}>
                                                {{ $items->nama_gudang }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('gudang')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="pengguna" class="form-label fw-bold">Pengguna</label>
                                    <select class="form-select tomselect @error('pengguna') is-invalid @enderror" id="pengguna" name="pengguna[]" multiple>
                                        <option></option>
                                        @foreach ($users as $items )
                                            <option value="{{ $items->name }}"
                                                {{ in_array($items->name, old('pengguna', $cabang->pengguna ?? [])) ? 'selected' : '' }}>
                                                {{ $items->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('pengguna')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit">Update</button>
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
                title: 'Form Tidak Lengkap',
                text: 'Mohon lengkapi semua field yang diperlukan.',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @endsection
@endsection

