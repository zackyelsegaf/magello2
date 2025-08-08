@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Harga Jual</h3>
                    </div>
                </div>
            </div>

            <form>
                <!-- Section 1: Form Header -->
                <div class="d-flex">

                    <div class="col mb-3">
                        <div class="col-md-4">
                            <label for="no_penyesuaian" class="form-label fw-bold">No</label>
                            <input type="number" id="no_penyesuaian" class="form-control" value="1000">
                        </div>
                        <div class="col-md-4">
                            <input type="date" id="tgl_efektif" class="form-control" value="2025-07-22">
                        </div>
                    </div>
                    <div class="col mb-3">
                        <div class="col-md-4">
                            <label for="no_penyesuaian" class="form-label fw-bold">Akun Pembiayaan</label>
                            <select class="form-control form-control-sm" name="mata_uang_pelanggan"
                                onchange="this.form.submit()">
                                <option value="" selected></option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <input type="date" id="tgl_efektif" class="form-control" value="2025-07-22">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="disetujui" name="disetujui">
                            <label class="form-check-label" for="disetujui">Disetujui</label>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Opsi</label>
                            <select class="form-control @error('mata_uang_pelanggan') is-invalid @enderror"
                                name="mata_uang_pelanggan">
                                <option>Simpan Transaksi</option>
                                <option>Salin Transaksi</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Rancangan</label>
                            <select class="form-control @error('mata_uang_pelanggan') is-invalid @enderror"
                                name="mata_uang_pelanggan">
                                <option>----</option>
                            </select>
                        </div>
                    </div>
                </div>




                <!-- Section 2: Penyesuaian Harga Controls -->
                <h5 class="mb-3">Penyesuaian Harga</h5>

                <!-- Row 1: Main Controls -->
                <div class="row mb-3 align-items-end">
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-2">
                        <button type="button" class="btn btn-primary w-100">Pilih Barang</button>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-2">
                        <label class="form-label">Semua Harga Jual</label>
                        <select class="form-control @error('mata_uang_pelanggan') is-invalid @enderror"
                            name="mata_uang_pelanggan">
                            <option selected disabled>--Pilih Semua Harga Jual--</option>
                        </select>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-2">
                        <label class="form-label">Penjumlahan Nilai</label>
                        <select class="form-control @error('mata_uang_pelanggan') is-invalid @enderror"
                            name="mata_uang_pelanggan">
                            <option>--Pilih Semua Penjumlahan Nilai--</option>
                        </select>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-2">
                        <label class="form-label">Nilai Sekarang</label>
                        <select class="form-control @error('mata_uang_pelanggan') is-invalid @enderror"
                            name="mata_uang_pelanggan">
                            <option>--Pilih Semua Nilai Sekarang--</option>
                        </select>
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-2">
                        <label class="form-label">Nilai Masukan</label>
                        <input type="number" class="form-control" value="0">
                    </div>

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 mb-2">
                        <button type="button" class="btn btn-primary text-white w-100">Proses Penyesuaian</button>
                    </div>
                </div>

                <!-- Row 2: Additional Controls -->
                <div class="row mb-3 justify-start align-items-center">
                    <div class="col-lg-2 col-md-8 mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="show_last">
                            <label class="form-check-label" for="show_last">Show Last Cost & Price</label>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                        <label class="form-label">Unit</label>
                        <select class="btn btn-warning text-start w-100">
                            <option>Unit 5</option>
                        </select>
                    </div>
                </div>

                <!-- Section 3: Table -->
                <div class="table-responsive mb-4">
                    <table class="table table-striped table-bordered table-hover mb-0" style="min-width: 1200px;">
                        <thead class="thead-dark">
                            <tr>
                                <th>No Barang</th>
                                <th>Deskripsi Barang</th>
                                <th>Satuan</th>
                                <th>Biaya Aktual</th>
                                <th>Harga 1</th>
                                <th>Harga 2</th>
                                <th>Harga 3</th>
                                <th>Harga 4</th>
                                <th>Harga 5</th>
                                <th>Minimal Harga Jual</th>
                                <th>Maksimal Harga Jual</th>
                                <th>Minimal Harga Pembelian</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Section 4: Filter Controls -->
                <div class="row align-items-end mb-3">
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                        <label class="form-label">No Barang</label>
                        <input type="text" class="form-control" placeholder="No Barang">
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                        <label class="form-label">Deskripsi Barang</label>
                        <input type="text" class="form-control" placeholder="Deskripsi Barang">
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                        <label class="form-label">Mata Uang</label>
                        <select class="form-control @error('mata_uang_pelanggan') is-invalid @enderror"
                            name="mata_uang_pelanggan">
                            <option selected disabled>--Pilih Mata Uang--</option>
                        </select>
                    </div>

                    <div class="col-lg-3 col-md-4 col-sm-6 mb-2">
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary flex-fill">Filter</button>
                            <button type="button" class="btn btn-secondary flex-fill">Reset</button>
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
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">

                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea id="deskripsi" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                    </div>
                    <div id="dokumen" class="tab-pane fade">
                        <div class="mt-5">
                            <div class="row">
                                <div id="fieldContainer" class="col-lg-6">
                                    <!-- Default 5 fields -->
                                    <div class="mb-2">
                                        <label class="form-label">File 1</label>
                                        <input type="text" class="form-control" placeholder="link dokumen anda">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">File 2</label>
                                        <input type="text" class="form-control" placeholder="link dokumen anda">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">File 3</label>
                                        <input type="text" class="form-control" placeholder="link dokumen anda">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">File 4</label>
                                        <input type="text" class="form-control" placeholder="link dokumen anda">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">File 5</label>
                                        <input type="text" class="form-control" placeholder="link dokumen anda">
                                    </div>
                                </div>

                                <!-- Button -->
                                <div class="col-lg-6 d-flex justify-content-end align-items-start">
                                    <button id="addFieldBtn" class="btn btn-outline-primary btn-sm mt-2">+ Add
                                        field</button>
                                </div>
                            </div>
                        </div>

                        <script>
                            let fieldCount = 5;
                            const fieldContainer = document.getElementById('fieldContainer');
                            const addFieldBtn = document.getElementById('addFieldBtn');

                            addFieldBtn.addEventListener('click', () => {
                                fieldCount++;
                                const wrapper = document.createElement('div');
                                wrapper.className = 'mb-2';

                                const label = document.createElement('label');
                                label.className = 'form-label';
                                label.textContent = `File ${fieldCount}`;

                                const input = document.createElement('input');
                                input.type = 'text';
                                input.className = 'form-control';
                                input.placeholder = 'link dokumen anda';

                                wrapper.appendChild(label);
                                wrapper.appendChild(input);
                                fieldContainer.appendChild(wrapper);
                            });
                        </script>

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
            </form>
        </div>
    </div>
@endsection
