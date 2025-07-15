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
                                    <select class="form-select select2-tag" id="gudang" name="gudang[]" multiple>
                                        <option></option>
                                        @foreach ($gudang as $items )
                                            <option value="{{ $items->nama_gudang }}" 
                                                {{ in_array($items->nama_gudang, old('gudang', $cabang->gudang ?? [])) ? 'selected' : '' }}>
                                                {{ $items->nama_gudang }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="Pengguna" class="form-label fw-bold">Pengguna</label>
                                    <select class="form-select select2-tag" id="pengguna" name="pengguna[]" multiple>
                                        <option></option>
                                        @foreach ($users as $items )
                                            <option value="{{ $items->name }}" 
                                                {{ in_array($items->name, old('pengguna', $cabang->pengguna ?? [])) ? 'selected' : '' }}>
                                                {{ $items->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit">Update</button>
            </form>
        </div>
    </div>
    @section('script')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-tag').select2({
            tags: true,
            placeholder: 'Pilih atau ketik Gudang',
            allowClear: true,
            width: '100%'
            });
        });
    </script>
    @endsection
@endsection