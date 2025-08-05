@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Pembiayaan Pesanan</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="card rounded-default p-3 filterBox text-white">
                        <form method="GET" action="">
                            <div class="form-group mb-1">
                                <label>Pencarian</label>
                                <input type="text" name="kode_aktiva" class="form-control form-control-sm"
                                    onchange="this.form.submit()" placeholder="No Penyesuaian" value="">
                            </div>
                            <div class="form-group mb-1">
                                <input type="text" name="nama_aktiva_tetap" class="form-control form-control-sm"
                                    onchange="this.form.submit()" placeholder="Deskripsi" value="">
                            </div>

                            <div class="form-group mb-1">
                                <label for="">Tanggal</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="filterTanggal" name="filterTanggal">
                                    <label class="form-check-label" for="filterTanggal">Filter Tanggal</label>

                                    <div class="form-group mb-1 mt-2" id="tanggalInputs" style="display: none;">
                                        <input type="date" name="tanggal_mulai">
                                        <input type="date" name="tanggal_selesai">
                                    </div>
                                </div>

                                <div class="form-group mb-1">
                                    <label>Status</label>
                                    <select class="form-control form-control-sm" name="mata_uang_pelanggan"
                                        onchange="this.form.submit()">
                                        <option value="" selected>--Status--</option>
                                    </select>
                                </div>

                                <label class="mt-3" for="">Catatan Audit</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="filterTanggalEfektif"
                                        name="filterTanggalEfektif">
                                    <label class="form-check-label" for="filterTanggalEfektif">Catatan
                                        Pemeriksaan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="filterTanggalEfektif"
                                        name="filterTanggalEfektif">
                                    <label class="form-check-label" for="filterTanggalEfektif">Belum Catatan
                                        Pemeriksaan</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="filterTanggalEfektif"
                                        name="filterTanggalEfektif">
                                    <label class="form-check-label" for="filterTanggalEfektif">Disetujui</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="filterTanggalEfektif"
                                        name="filterTanggalEfektif">
                                    <label class="form-check-label" for="filterTanggalEfektif">Belum Disetujui</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="filterTanggalEfektif"
                                        name="filterTanggalEfektif">
                                    <label class="form-check-label" for="filterTanggalEfektif">Tindak Lanjut</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="filterTanggalEfektif"
                                        name="filterTanggalEfektif">
                                    <label class="form-check-label" for="filterTanggalEfektif">Belum Tindak
                                        Lanjut/label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="filterTanggalEfektif"
                                        name="filterTanggalEfektif">
                                    <label class="form-check-label" for="filterTanggalEfektif">Urgent</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="filterTanggalEfektif"
                                        name="filterTanggalEfektif">
                                    <label class="form-check-label" for="filterTanggalEfektif">Tidak Urgent</label>
                                </div>
                            </div>

                            <script>
                                // Fungsi toggle
                                document.getElementById('filterTanggal').addEventListener('change', function() {
                                    document.getElementById('tanggalInputs').style.display = this.checked ? 'block' : 'none';
                                });

                                document.getElementById('filterTanggalEfektif').addEventListener('change', function() {
                                    document.getElementById('tanggalEfektifInputs').style.display = this.checked ? 'block' : 'none';
                                });
                            </script>

                            <div class="form-group mb-1 flex-column  ">
                                <label>Easy Branch</label>
                                <select class="form-control form-control-sm mb-2" name="mata_uang_pelanggan"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Semua Pengguna--</option>
                                </select>
                                <select class="form-control form-control-sm" name="mata_uang_pelanggan"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Semua Cabang--</option>
                                </select>
                            </div>

                        </form>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-center mb-0"
                                    id="DepartemenList">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th width="20"><input type="checkbox" id="select_all"></th>
                                            <th>No</th>
                                            <th hidden>ID</th>
                                            <th>No Pembayaran</th>
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                            <th>Nilai Barang</th>
                                            <th>Nilai Biaya</th>
                                            <th>Total Pembiayaan</th>
                                            <th>Status</th>
                                            <th>Pengguna</th>
                                            <th>Cabang</th>
                                            <th>No Persetujuan</th>
                                            <th>Catatan Pemeriksaan</th>
                                            <th>Disetujui</th>
                                            <th>Urgensi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="page-header">
                        <div class="mb-15 row align-items-center">
                            <div class="col">
                                <a href="{{ Route('pembiayaanpesanan/add/new') }}"
                                    class="btn btn-primary float-left veiwbutton"><i
                                        class="fas fa-plus mr-2"></i>Tambah</a>
                                <button id="deleteSelected" class="btn btn-primary float-left veiwbutton ml-3"><i
                                        class="fas fa-trash mr-2"></i>Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
