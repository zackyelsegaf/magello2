@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Data Booking</h4>
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
                                <label for="">Tanggal</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="filterTanggal" name="filterTanggal">
                                    <label class="form-check-label" for="filterTanggal">Filter Tanggal</label>

                                    <div class="form-group mb-1 mt-2" id="tanggalInputs" style="display: none;">
                                        <input type="date" name="tanggal_mulai">
                                        <input type="date" name="tanggal_selesai">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <label>Cluster/Perumahan</label>
                                <select class="form-control form-control-sm" name="mata_uang_pelanggan"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Cluster/Perumahan--</option>
                                </select>
                            </div>
                            <div class="form-group mb-1 flex-column ">
                                <label>Blok</label>
                                <select class="form-control form-control-sm mb-2" name="mata_uang_pelanggan"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Blok--</option>
                                </select>
                            </div>
                            <div class="form-group mb-1 flex-column ">
                                <label>Status Pengajuan</label>
                                <select class="form-control form-control-sm" name="mata_uang_pelanggan"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Status Pengajuan--</option>
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
                                            <th>Nomor Booking</th>
                                            <th>Tanggal Booking</th>
                                            <th>Nomor SPR</th>
                                            <th>Nama</th>
                                            <th>Nomor Hp</th>
                                            <th>Kluster</th>
                                            <th>Kavling</th>
                                            <th>Status Pengajuan</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            // Fungsi toggle
            document.getElementById('filterTanggal').addEventListener('change', function() {
                document.getElementById('tanggalInputs').style.display = this.checked ? 'block' : 'none';
            });
        </script>
    </div>
@endsection
