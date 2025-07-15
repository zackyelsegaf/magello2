@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Aktiva Tetap</h3>
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
                                    <label>Nama Aktiva</label>
                                    <input type="text"
                                        class="form-control @error('nama_depan_penjual') is-invalid @enderror"name="nama_depan_penjual"
                                        value="{{ old('nama_depan_penjual') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Departemen</label>
                                    <select class="form-control @error('tempat_lahir_pegawai') is-invalid @enderror"
                                        name="tempat_lahir_pegawai">
                                        <option selected disabled> --Pilih Kota-- </option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Akun Aktiva</label>
                                    <input type="text"
                                        class="form-control @error('nama_belakang_penjual') is-invalid @enderror"name="nama_belakang_penjual"
                                        value="{{ old('nama_belakang_penjual') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nilai Aktiva</label>
                                    <input type="text"
                                        class="form-control @error('nama_belakang_penjual') is-invalid @enderror"name="nama_belakang_penjual"
                                        value="{{ old('nama_belakang_penjual') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Penggunaan</label>
                                    <input type="date"
                                        class="form-control @error('nama_belakang_penjual') is-invalid @enderror"name="nama_belakang_penjual"
                                        value="{{ old('nama_belakang_penjual') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Tanggal Akuisisi</label>
                                    <input type="date"
                                        class="form-control @error('nama_belakang_penjual') is-invalid @enderror"name="nama_belakang_penjual"
                                        value="{{ old('nama_belakang_penjual') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Umur Perkiraan</label>
                                    <input type="text"
                                        class="form-control @error('nama_belakang_penjual') is-invalid @enderror"name="nama_belakang_penjual"
                                        value="{{ old('nama_belakang_penjual') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Metode Depresi</label>
                                    <input type="text"
                                        class="form-control @error('nama_belakang_penjual') is-invalid @enderror"name="nama_belakang_penjual"
                                        value="{{ old('nama_belakang_penjual') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Departemen</label>
                                    <select class="form-control @error('tempat_lahir_pegawai') is-invalid @enderror"
                                        name="tempat_lahir_pegawai">
                                        <option selected disabled> --Pilih Kota-- </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#detail">Aktiva Tetap</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Pengeluaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#memo">Memo</a>
                            </li>
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">
                        <div class="container mt-4">
                            <form>
                                <!-- Umur Perkiraan -->
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Umur Perkiraan</label>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" placeholder="0">
                                        <div class="form-text">Th</div>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" placeholder="0">
                                        <div class="form-text">Bulan</div>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control" placeholder="0">
                                        <div class="form-text">%</div>
                                    </div>
                                </div>

                                <!-- Metode Penyusutan -->
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label text-danger">* Metode Penyusutan</label>
                                    <div class="col-sm-9">
                                        <select class="form-select">
                                            <option selected>Tidak Menyusut</option>
                                            <option>Garis Lurus</option>
                                            <option>Saldo Menurun</option>
                                            <option>Metode Khusus</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Akun Aktiva -->
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label text-danger">* Akun Aktiva</label>
                                    <div class="col-sm-9">
                                        <select class="form-select">
                                            <option selected disabled>Pilih akun aktiva</option>
                                            <option>Aset Tetap - Kendaraan</option>
                                            <option>Aset Tetap - Bangunan</option>
                                            <option>Aset Tetap - Peralatan</option>
                                        </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="dokumen" class="tab-pane fade">
                        <div class="container mt-4 mb-4">    
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>No. Akun</th>
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                            <th>Nilai</th>
                                            <th>Rekonsiliasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control" /></td>
                                            <td><input type="date" class="form-control" /></td>
                                            <td><input type="text" class="form-control" /></td>
                                            <td><input type="number" class="form-control text-end" value="0" />
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input mt-2" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Footer Summary -->
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <label>Biaya Aktiva</label>
                                    <input type="number" class="form-control text-end" value="0" />
                                </div>
                                <div class="col-md-3">
                                    <label>Nilai Penyusutan</label>
                                    <input type="number" class="form-control text-end" value="0" />
                                </div>
                                <div class="col-md-3">
                                    <label>Nilai Buku</label>
                                    <input type="number" class="form-control text-end" value="0" />
                                </div>
                                <div class="col-md-3">
                                    <label>Nilai Sisa</label>
                                    <input type="number" class="form-control text-end" value="0" />
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
                                                    <textarea class="form-control @error('memo') is-invalid @enderror" name="memo" value="{{ old('memo') }}">{{ old('memo') }}</textarea>
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
                                <button type="submit" class="btn btn-primary buttonedit"><i
                                        class="fa fa-check mr-2"></i>Simpan</button>
                                <a href="{{ route('penjual/list/page') }}"
                                    class="btn btn-primary float-left veiwbutton ml-3"><i
                                        class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
@endsection
@endsection
