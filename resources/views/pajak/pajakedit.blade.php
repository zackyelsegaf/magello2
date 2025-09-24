@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Mata Uang</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('pajak/update', $pajak->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Kode</label>
                                    <input type="text" class="form-control form-control-sm  @error('kode') is-invalid @enderror" name="kode" placeholder="Kode pajak pelanggan" value="{{ $pajak->kode }}">
                                    @error('kode')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama') is-invalid @enderror" name="nama" placeholder="Nama pajak" value="{{ $pajak->nama }}">
                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nilai</label>
                                    <div class="input-group">
                                        <input type="number" class="form-control form-control-sm  @error('nilai_persentase') is-invalid @enderror" name="nilai_persentase" placeholder="Persentase Pajak" value="{{ $pajak->nilai_persentase }}">

                                        <div class="input-group-append">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <label>Akun Pajak Penjualan</label>
                                    <input type="text" class="form-control form-control-sm  @error('akun_pajak_penjualan') is-invalid @enderror" name="akun_pajak_penjualan" placeholder="Akun pajak penjualan" value="{{ $pajak->akun_pajak_penjualan }}">
                                    @error('akun_pajak_penjualan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Akun Pajak Pembelian</label>
                                    <input type="text" class="form-control form-control-sm  @error('akun_pajak_pembelian') is-invalid @enderror" name="akun_pajak_pembelian" placeholder="Akun pajak pembelian" value="{{ $pajak->akun_pajak_pembelian }}">
                                    @error('akun_pajak_pembelian')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control form-control-sm  @error('deskripsi') is-invalid @enderror" name="deskripsi">{{ old('deskripsi', $pajak->deskripsi) }}</textarea>
                                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
