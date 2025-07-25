@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">Aktiva Tetap</h4>
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
                                    onchange="this.form.submit()" placeholder="Kode Aktiva" value="">
                            </div>
                            <div class="form-group mb-1">
                                <input type="text" name="nama_aktiva_tetap" class="form-control form-control-sm"
                                    onchange="this.form.submit()" placeholder="Nama Aktiva Tetap" value="">
                            </div>

                            <div class="form-group mb-1">
                                <label class="" for="">Filter Tanggal</label>
                                <div class="form-check">
                                    <div class="form-group mb-1">
                                        <input class="form-check-input" type="checkbox" onchange="this.form.submit()"
                                            name="dihentikan" value=""
                                            {{ request('dihentikan') === null ? 'checked' : '' }}>
                                        <label class="form-check-label">Filter Tanggal</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Tanggal</label><br>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" onchange="this.form.submit()"
                                            name="dihentikan" value=""
                                            {{ request('dihentikan') === null ? 'checked' : '' }}>
                                        <label class="form-check-label">Tanggal Penggunaan</label>
                                    </div>
                                    <div class="form-check mb-1">
                                        <input class="form-check-input" type="radio" onchange="this.form.submit()"
                                            name="dihentikan" value="1"
                                            {{ request('dihentikan') === '1' ? 'checked' : '' }}>
                                        <label class="form-check-label">Tanggal Akuisisi</label>
                                    </div>

                                </div>
                                <div class="form-group mb-1">
                                    <input type="date">
                                    <input type="date">
                                </div>
                            </div>
                            <div class="form-group mb-1">
                                <label>Dihentikan</label><br>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="radio" onchange="this.form.submit()"
                                        name="dihentikan" value=""
                                        {{ request('dihentikan') === null ? 'checked' : '' }}>
                                    <label class="form-check-label">Semua</label>
                                </div>
                                <div class="form-check mb-1">
                                    <input class="form-check-input" type="radio" onchange="this.form.submit()"
                                        name="dihentikan" value="1"
                                        {{ request('dihentikan') === '1' ? 'checked' : '' }}>
                                    <label class="form-check-label">Ya</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" onchange="this.form.submit()"
                                        name="dihentikan" value="0"
                                        {{ request('dihentikan') === '0' ? 'checked' : '' }}>
                                    <label class="form-check-label">Tidak</label>
                                </div>
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
                                            <th>Kode Aktiva</th>
                                            <th>Nama Aktiva</th>
                                            <th>Nama Tipe</th>
                                            <th>Akun Aktiva</th>
                                            <th>Nilai Aktiva</th>
                                            <th>Tgl Penggunaan</th>
                                            <th>Tgl Akuisisi</th>
                                            <th>Umur Perkiraan</th>
                                            <th>Metode Depresi</th>
                                            <th>Departemen</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="page-header">
                        <div class="mb-15 row align-items-center">
                            <div class="col">
                                <a href="{{ route('aktivatetap/add/new')  }}" class="btn btn-primary float-left veiwbutton"><i
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
