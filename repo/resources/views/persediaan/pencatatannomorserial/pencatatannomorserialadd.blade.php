@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Pencatatan Nomor Serial</h3>
                    </div>
                </div>
            </div>

            <form>
                <!-- Section 1: Form -->
                <div class=" mt-3">
                    <div class="row mb-3">
                        <!-- No dan Tanggal -->
                        <div class="col-md-3">
                            <label for="tipe_transaksi" class="form-label fw-bold">Tipe Transaksi</label>
                            <select class="form-control form-control-sm mb-2" name="akun_pembiayaan">
                                <option value="" selected></option>
                            </select>
                            <label for="" class="form-label fw-bold">Transaksi No.</label>
                            <select class="form-control form-control-sm mb-2" name="akun_pembiayaan">
                                <option value="text" selected></option>
                            </select>
                        </div>

                        <!-- Akun Pembiayaan dan Tanggal -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">No. Pengisisan</label>
                            <select class="form-control form-control-sm mb-2" name="akun_pembiayaan">
                                <option value="" selected></option>
                            </select>
                            <label class="form-label fw-bold">Tanggal Pengisisan</label>
                            <input type="date" class="form-control" value="2025-07-22">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Diarsipkan Oleh</label>
                            <input type="" class="form-control" value="">
                        </div>

                    </div>
                    <div class="col-12">
                        <div class="table-responsive mb-4">
                            <table class="table table-striped table-bordered table-hover mb-0" style="min-width: 1200px;">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>No Akun</th>
                                        <th>Tanggal</th>
                                        <th>Nama Akun</th>
                                        <th>Catatan</th>
                                        <th>NIlai</th>
                                        <th>Proyek</th>
                                        <th>Departemen</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea id="deskripsi" class="form-control mt " rows="2"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
