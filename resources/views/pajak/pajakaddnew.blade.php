@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Pajak</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pajak/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kode</label>
                                    <input type="text" class="form-control form-control-sm  @error('kode') is-invalid @enderror" name="kode" placeholder="Kode pajak pelanggan" value="{{ old('kode') }}">
                                      @error('kode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama') is-invalid @enderror" name="nama" placeholder="Nama pajak" value="{{ old('nama') }}">
                                      @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nilai</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-sm  @error('nilai_persentase') is-invalid @enderror" name="nilai_persentase" placeholder="Persentase Pajak" value="{{ old('nilai_persentase', 1) }}">
                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>
                                @error('nilai_persentase')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div class="form-group">
                                    <label>Akun Pajak Penjualan</label>
                                    <input type="text" class="form-control form-control-sm @error('akun_pajak_penjualan') is-invalid @enderror" name="akun_pajak_penjualan" placeholder="Akun pajak penjualan" value="{{ old('akun_pajak_penjualan') }}">
                                </div>
                                <div class="form-group">
                                    <label>Akun Pajak Pembelian</label>
                                    <input type="text" class="form-control form-control-sm @error('akun_pajak_pembelian') is-invalid @enderror" name="akun_pajak_pembelian" placeholder="Akun pajak pembelian" value="{{ old('akun_pajak_pembelian') }}">
                                      @error('akun_pajak_pembelian')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control form-control-sm  @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <a href="{{ route('pajak/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2">
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
