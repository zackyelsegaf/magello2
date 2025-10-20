@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Konsumen</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/konsumen/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Pribadi</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>NIK</label>
                                    <input type="text" class="form-control form-control-sm  @error('nik_konsumen') is-invalid @enderror" name="nik_konsumen" value="{{ old('nik_konsumen') }}">
                                     @error('nik_konsumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_konsumen') is-invalid @enderror" name="nama_konsumen" value="{{ old('nama_konsumen') }}">
                                     @error('nama_konsumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>No. HP</label>
                                    <input type="text" class="form-control form-control-sm  @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ old('no_hp') }}">
                                     @error('no_hp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select class="form-control form-control-sm  @error('jenis_kelamin') is-invalid @enderror"  name="jenis_kelamin">
                                        <option selected disabled> --Pilih Jenis Kelamin-- </option>
                                        @foreach ($jenis_kelamin as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                     @error('jenis_kelamin')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <h5>Pekerjaan</h5>
                                <div class="form-group">
                                    {{-- <label>Pekerjaan</label> --}}
                                    <select class="form-control form-control-sm  @error('pekerjaan') is-invalid @enderror"  name="pekerjaan">
                                        <option selected disabled> --Pilih Pekerjaan-- </option>
                                        @foreach ($pekerjaan as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                     @error('pekerjaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Marketing</label>
                                    <input type="text" class="form-control form-control-sm  @error('marketing') is-invalid @enderror" name="marketing" value="{{ old('marketing', Auth::user()->name) }}" readonly>
                                     @error('marketing')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Lain-lain</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Cluster</label>
                                    <select class="form-control form-control-sm  @error('cluster') is-invalid @enderror"  name="cluster">
                                        <option selected disabled> --Pilih Perumahan-- </option>
                                        @foreach ($cluster as $items )
                                            <option value="{{ $items->nama_cluster }}">{{ $items->nama_cluster }}</option>
                                        @endforeach
                                    </select>
                                     @error('cluster')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Status Pengajuan</label>
                                    <select class="form-control form-control-sm  @error('status_pengajuan') is-invalid @enderror"  name="status_pengajuan">
                                        <option selected disabled> --Pilih Status-- </option>
                                        @foreach ($status_pengajuan as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                     @error('status_pengajuan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card shadow-sm my-rounded-2">
                            <div class="custom-header my-rounded">
                                <h6 class="my-padding font-weight-bold">Data Alamat</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Provinsi KTP</label>
                                    <select class="form-control form-control-sm  @error('provinsi') is-invalid @enderror"  name="provinsi">
                                        <option selected disabled> --Pilih Provinsi-- </option>
                                        @foreach ($provinsi as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                     @error('provinsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Kota KTP</label>
                                    <select class="form-control form-control-sm  @error('kota') is-invalid @enderror"  name="kota">
                                        <option selected disabled> --Pilih Kota-- </option>
                                        @foreach ($kota as $items )
                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                     @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input type="text" class="form-control form-control-sm @error('kecamatan') is-invalid @enderror " name="kecamatan" value="{{ old('kecamatan') }}">
                                     @error('kecamatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Kelurahan</label>
                                    <input type="text" class="form-control form-control-sm @error('kelurahan') is-invalid @enderror " name="kelurahan" value="{{ old('kelurahan') }}">
                                     @error('kelurahan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <textarea class="form-control form-control-sm @error('alamat_konsumen') is-invalid @enderror " name="alamat_konsumen" value="{{ old('alamat_konsumen') }}">{{ old('alamat_konsumen') }}</textarea>
                                     @error('alamat_konsumen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                                <a href="{{ route('konsumen/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
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
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endsection
@endsection
