@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Syarat Pembayaran</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/syarat/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Syarat</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama') is-invalid @enderror"name="nama" value="{{ old('nama') }}">
                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Batas Hutang</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-sm  @error('batas_hutang') is-invalid @enderror" name="batas_hutang" value="{{ old('batas_hutang', 0)}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Hari</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cash_on_delivery">Cash on Delivery</label>
                                    <label class="switch">
                                        <input type="hidden" name="cash_on_delivery" value="0">
                                        <input type="checkbox" name="cash_on_delivery" id="cash_on_delivery" value="1" {{ old('cash_on_delivery') ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="form-group">
                                    <h7 class="font-weight-bold">Jika dibayar pada batas periode diskon</h7>
                                    <label>Persentase</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-sm  @error('persentase_diskon') is-invalid @enderror" name="persentase_diskon" value="{{ old('persentase_diskon', 0) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Periode Diskon</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-sm  @error('periode_diskon') is-invalid @enderror" name="periode_diskon" value="{{ old('periode_diskon', 0) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">Hari</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <a href="{{ route('syarat/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2">
                                    <i class="fas fa-chevron-left mr-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary buttonedit">
                                    <i class="fas fa-save mr-2"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')
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
