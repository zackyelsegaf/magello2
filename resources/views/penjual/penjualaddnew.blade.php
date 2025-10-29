@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Penjual</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/penjual/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Depan</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_depan_penjual') is-invalid @enderror"name="nama_depan_penjual" value="{{ old('nama_depan_penjual') }}">
                                     @error('nama_depan_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nama Belakang</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_belakang_penjual') is-invalid @enderror"name="nama_belakang_penjual" value="{{ old('nama_belakang_penjual') }}">
                                     @error('nama_belakang_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <input type="text" class="form-control form-control-sm  @error('jabatan') is-invalid @enderror"name="jabatan" value="{{ old('jabatan') }}">
                                     @error('jabatan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="dihentikan">Dihentikan</label>
                                    <label class="switch">
                                        <input type="hidden" name="dihentikan" value="0">
                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan') ? 'checked' : '' }}>
                                         @error('dihentikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#detail">Detail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#memo">Memo</a>
                            </li>
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No. Kantor 1</label>
                                                    <input type="text" class="form-control form-control-sm  @error('no_kantor_1_penjual') is-invalid @enderror"name="no_kantor_1_penjual" value="{{ old('no_kantor_1_penjual') }}">
                                                     @error('no_kantor_1_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>No. Kantor 2</label>
                                                        <input type="text" class="form-control form-control-sm  @error('no_kantor_2_penjual') is-invalid @enderror"name="no_kantor_2_penjual" value="{{ old('no_kantor_2_penjual') }}">
                                                         @error('no_kantor_2_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No. Ekstensi 1</label>
                                                    <input type="text" class="form-control form-control-sm  @error('no_ekstensi_1_penjual') is-invalid @enderror"name="no_ekstensi_1_penjual" value="{{ old('no_ekstensi_1_penjual') }}">
                                                     @error('no_ekstensi_1_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label>No. Ekstensi 2</label>
                                                        <input type="text" class="form-control form-control-sm  @error('no_ekstensi_2_penjual') is-invalid @enderror"name="no_ekstensi_2_penjual" value="{{ old('no_ekstensi_2_penjual') }}">
                                                         @error('no_ekstensi_2_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>No. HP</label>
                                            <input type="text" class="form-control form-control-sm  @error('no_hp_penjual') is-invalid @enderror"name="no_hp_penjual" value="{{ old('no_hp_penjual') }}">
                                             @error('no_hp_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label>No. Telp Rumah</label>
                                            <input type="text" class="form-control form-control-sm  @error('no_telp_penjual') is-invalid @enderror"name="no_telp_penjual" value="{{ old('no_telp_penjual') }}">
                                             @error('no_telp_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label>No. Fax</label>
                                            <input type="text" class="form-control form-control-sm  @error('no_fax_penjual') is-invalid @enderror"name="no_fax_penjual" value="{{ old('no_fax_penjual') }}">
                                             @error('no_fax_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Pager</label>
                                            <input type="text" class="form-control form-control-sm  @error('pager_penjual') is-invalid @enderror"name="pager_penjual" value="{{ old('pager_penjual') }}">
                                             @error('pager_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="text" class="form-control form-control-sm  @error('email_penjual') is-invalid @enderror"name="email_penjual" value="{{ old('email_penjual') }}">
                                             @error('email_penjual')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="card card-table">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="PenjualAddList">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Dari Penjualan</th>
                                                        <th>Sampai Penjualan</th>
                                                        <th>Persentase %</th>
                                                        <th>Nilai Tetap</th>
                                                        <th>Berdasarkan</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dokumen" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>File 1</label>
                                                    <input type="text" class="form-control form-control-sm " name="fileupload_1" placeholder="Link dokumen Anda" value="{{ old('fileupload_1') }}">
                                                     @error('fileupload_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="memo" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{-- <label>Memo</label> --}}
                                                    <textarea class="form-control form-control-sm  @error('memo') is-invalid @enderror" name="memo" value="{{ old('memo') }}">{{ old('memo') }}</textarea>
                                                     @error('memo')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
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
                                <a href="{{ route('penjual/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2">
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
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    @endsection
@endsection
