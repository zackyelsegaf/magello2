@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Barang per Gudang</h4>
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
                                <input type="text" name="no_barang" class="form-control form-control-sm"
                                    onchange="this.form.submit()" placeholder="No Barang" value="">
                            </div>
                            <div class="form-group mb-1">
                                <input type="text" name="deskripsi" class="form-control form-control-sm"
                                    onchange="this.form.submit()" placeholder="Deskripsi" value="">
                            </div>
                            <div class="form-group mb-3">
                                <label for="kategori">Kategori</label>
                                <select name="kategori" id="kategori" class="form-control form-control-sm"
                                    onchange="this.form.submit()">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                </select>
                            </div>

                            <div class="form-group mb-1">
                                <button type="button" class="btn bg-white text-dark w-100">Pilih Barang</button>
                            </div>
                            <div class="form-group mb-3">
                                <button type="button" class="btn bg-white text-dark w-100">Pilih Gudang</button>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="tampilkanSatuan" checked>
                                <label class="form-check-label" for="tampilkanSatuan">
                                    Tampilkan Satuan
                                </label>
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
                                            <th>Deskripsi Barang</th>
                                            <th>GMP0001</th>
                                            <th>GMP0002</th>
                                            <th>GMP0003</th>
                                            <th>GMP0004</th>
                                            <th>GMP0005</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="page-header">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
