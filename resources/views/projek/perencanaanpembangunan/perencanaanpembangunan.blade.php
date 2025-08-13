@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Data Perencanaan Pembanguan</h4>
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

                            <div class="form-group mb-1 flex-column">
                                <label>Klaster/Perumahan</label>
                                <select class="form-control form-control-sm mb-2" name="klaster_perumahan"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Klaster/Perumahan--</option>
                                </select>
                            </div>
                            <div class="form-group mb-1 flex-column">
                                <label>Blok</label>
                                <select class="form-control form-control-sm mb-2" name="blok"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Blok--</option>
                                </select>
                            </div>
                            <div class="form-group mb-1 flex-column">
                                <label>Tipe</label>
                                <select class="form-control form-control-sm mb-2" name="tipe"
                                    onchange="this.form.submit()">
                                    <option value="" selected>--Tipe--</option>
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
                                            <th>Nama</th>
                                            <th>Klaster</th>
                                            <th>Blok</th>
                                            <th>Nomor Unit</th>
                                            <th>Luas Tanah (m2)</th>
                                            <th>Luas Bangunan (m2)</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
