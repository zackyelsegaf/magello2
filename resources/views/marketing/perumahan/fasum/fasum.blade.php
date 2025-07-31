@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Fasum</h4>
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
                                <input type="text" name="" class="form-control form-control-sm"
                                    onchange="this.form.submit()" placeholder="" value="">
                            </div>
                            <div class="form-group mb-1">
                                <label>Cluster/Perumahan</label>
                                <select class="form-control form-control-sm" name="cluster" onchange="this.form.submit()">
                                    <option value="" selected>-- Cluster/Perumahan --</option>
                                    <!-- Tambahkan opsi -->
                                </select>
                            </div>

                            <div class="form-group mb-1">
                                <label>Blok</label>
                                <select class="form-control form-control-sm" name="blok" onchange="this.form.submit()">
                                    <option value="" selected>-- Blok --</option>
                                </select>
                            </div>

                            <div class="form-group mb-1">
                                <label>Status Pembangunan</label>
                                <select class="form-control form-control-sm" name="status_pembangunan"
                                    onchange="this.form.submit()">
                                    <option value="" selected>-- Status Pembangunan --</option>
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
                                            <th>Nama Kluster</th>
                                            <th>Blok</th>
                                            <th>Nomor Unit</th>
                                            <th>Jumlah Lantai</th>
                                            <th>Luas Tanah (m2)</th>
                                            <th>Luas Bangunan (m2)</th>
                                            <th>Status Pembangunan</th>
                                            <th>Status Penjualan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="page-header">
                        <div class="mb-15 row align-items-center">
                            <div class="col">
                                <a href="{{ Route('fasum/add/new') }}" class="btn btn-primary float-left veiwbutton"><i
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
