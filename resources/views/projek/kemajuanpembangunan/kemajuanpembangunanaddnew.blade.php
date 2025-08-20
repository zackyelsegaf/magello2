@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Kemajuan Pembangunan</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('kemajuanpembangunan/list/page') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                        <input type="text" id="tanggal" name="tanggal" class="form-control datetimepicker"
                            value="{{ old('tanggal') }}" placeholder="Tanggal">
                    </div>

                    <div class="col-md-4">
                        <label for="kavling" class="form-label fw-bold">Kavling</label>
                        <select class="tomselect @error('kavling') is-invalid @enderror" name="kavling" id="kavling">
                            <option value="">-- Pilih Kavling --</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="kemajuan" class="form-label fw-bold">Kemajuan (%)</label>
                        <input type="number" id="kemajuan" name="kemajuan" class="form-control"
                            value="{{ old('kemajuan') }}" placeholder="Kemajuan">
                    </div>
                </div>

                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#dokumen">Dokumentasi</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#daftarPekerjaan">Daftar Pekerjaan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#bahan">Bahan Material</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#alat">Alat Material</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tenaga">Tenaga Kerja</a>
                            </li>
                        </ul>
                    </div>

                    <!-- Tab Dokumentasi -->
                    <div id="dokumen" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="page-header">
                                    <div class="row float-right">
                                        <button type="button" id="fileuploads_btn_add"
                                            class="btn btn-primary buttonedit1 float-right">
                                            <i class="fa fa-plus mr-2"></i>Tambah Field
                                        </button>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12" id="fileuploads_loop_add">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fileupload_1">File 1</label>
                                                    <input type="text" class="form-control form-control-sm"
                                                        name="fileupload_1" placeholder="Link dokumen Anda"
                                                        value="{{ old('fileupload_1') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Pekerjaan -->
                    <div id="daftarPekerjaan" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="row float-right mr-0">
                                    <button type="button" class="btn btn-primary buttonedit mb-3" data-toggle="modal"
                                        data-target="#modalPekerjaan">
                                        <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                                    </button>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <p class="font-weight-bold mb-0 h6">Daftar Pekerjaan</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mr-1">
                                        <div class="text-center">
                                            <p class="font-weight-light">Pekerjaan yang dilakukan di lapangan</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Pekerjaan Yang Dilaksanakan</th>
                                                <th>Lokasi</th>
                                                <th>Volume</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="TableBodyPekerjaan"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal daftar pekerjaan --}}
                    <div class="modal fade" id="modalPekerjaan" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content my-rounded-2">
                                <div class="modal-header">
                                    <h5 class="modal-title">Item Pengajuan Bahan Bangunan</h5>
                                    <button type="button" class="close" data-dismiss="modal">
                                        <span>&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div id="filterBox" class="mb-3">
                                        <div class="card m-3">

                                            <!-- Pekerjaan -->
                                            <div class="form-group mb-1">
                                                <label for="pekerjaan" class="form-label fw-bold">Pekerjaan Yang
                                                    Dilaksanakan</label>
                                                <select name="pekerjaan" id="pekerjaan"
                                                    class="tomselect">
                                                    <option value="">-- Pilih Pekerjaan Yang Dilaksanakan --</option>
                                                </select>
                                            </div>

                                            <!-- Lokasi -->
                                            <div class="form-group mb-1">
                                                <label for="lokasi" class="form-label fw-bold">Lokasi</label>
                                                <input type="text" name="lokasi" id="lokasi"
                                                    class="form-control form-control-sm" placeholder="Lokasi">
                                            </div>

                                            <!-- Volume -->
                                            <div class="form-group mb-1">
                                                <label for="volume" class="form-label fw-bold">Volume</label>
                                                <input type="number" name="volume" id="volume"
                                                    class="form-control form-control-sm" placeholder="Volume">
                                            </div>

                                            <!-- Keterangan -->
                                            <div class="form-group mb-1">
                                                <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                                                <input type="number" name="keterangan" id="keterangan"
                                                    class="form-control form-control-sm" placeholder="Keterangan">
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary buttonedit" id="tambahPekerjaan">
                                        <i class="fas fa-paper-plane mr-2"></i> Tambah ke Form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- BAHAN MATERIAL -->
                    <div id="bahan" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <p class="font-weight-bold mb-0 h6">Bahan Material</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mr-1">
                                        <div class="text-center">
                                            <p class="font-weight-light">Bahan yang digunakan dalam mengerjakan pekerjaan</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Nomor Pengajuan</th>
                                                <th>Tanggal Pengajuan</th>
                                                <th>Item</th>
                                                <th>Kuantitas</th>
                                                <th>Satuan</th>
                                            </tr>
                                        </thead>
                                        <tbody id="TableBodyBahan"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ALAT MATERIAL -->
                    <div id="alat" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="row float-right mr-0">
                                    <button type="button" class="btn btn-primary buttonedit mb-3" data-toggle="modal"
                                        data-target="#modalAlat">
                                        <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                                    </button>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <p class="font-weight-bold mb-0 h6">Alat Material</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mr-1">
                                        <div class="text-center">
                                            <p class="font-weight-light">Alat yang digunakan dalam mengerjakan pekerjaan</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Item</th>
                                                <th>Kuantitas</th>
                                                <th>Satuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="TableBodyAlat"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Alat Material -->
                    <div class="modal fade" id="modalAlat" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content my-rounded-2">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Alat Material</h5>
                                    <button type="button" class="close"
                                        data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-2">
                                        <label for="itemAlat" class="fw-bold">Item</label>
                                        <select id="itemAlat" class="tomselect">
                                            <option value="">Pilih</option>
                                            <option value="Bor">Bor</option>
                                            <option value="Gerinda">Gerinda</option>
                                            <option value="Palu">Palu</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="kuantitasAlat" class="fw-bold">Kuantitas</label>
                                        <input type="number" id="kuantitasAlat" class="form-control form-control-sm"
                                            placeholder="Jumlah">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="satuanAlat" class="fw-bold">Satuan</label>
                                        <input type="text" id="satuanAlat" class="form-control form-control-sm"
                                            placeholder="Satuan">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="tambahAlat" class="btn btn-primary buttonedit">
                                        <i class="fas fa-paper-plane mr-2"></i> Tambah ke Form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- TENAGA KERJA -->
                    <div id="tenaga" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="row float-right mr-0">
                                    <button type="button" class="btn btn-primary buttonedit mb-3" data-toggle="modal"
                                        data-target="#modalTenaga">
                                        <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                                    </button>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <p class="font-weight-bold mb-0 h6">Tenaga Kerja</p>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mr-1">
                                        <div class="text-center">
                                            <p class="font-weight-light">Tenaga Kerja yang digunakan dalam mengerjakan pekerjaan</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Item</th>
                                                <th>kuantitas</th>
                                                <th>Satuan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="TableBodyTenaga"></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Tenaga Kerja -->
                    <div class="modal fade" id="modalTenaga" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content my-rounded-2">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Tenaga Kerja</h5>
                                    <button type="button" class="close"
                                        data-dismiss="modal"><span>&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group mb-2">
                                        <label for="itemTenaga" class="fw-bold">Item</label>
                                        <select id="itemTenaga" class="tomselect">
                                            <option value="">Pilih</option>
                                            <option value="Tukang Batu">Tukang Batu</option>
                                            <option value="Tukang Kayu">Tukang Kayu</option>
                                            <option value="Tukang Las">Tukang Las</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="kuantitasTenaga" class="fw-bold">kuantitas</label>
                                        <input type="number" id="kuantitasTenaga" class="form-control form-control-sm"
                                            placeholder="Jumlah">
                                    </div>
                                    <div class="form-group mb-2">
                                        <label for="satuanTenaga" class="fw-bold">Satuan</label>
                                        <input type="text" id="satuanTenaga" class="form-control form-control-sm"
                                            placeholder="Satuan">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" id="tambahTenaga" class="btn btn-primary buttonedit">
                                        <i class="fas fa-paper-plane mr-2"></i> Tambah ke Form
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check mr-2"></i> Simpan
                        </button>
                        <a href="{{ route('kemajuanpembangunan/list/page') }}" class="btn btn-primary ml-3">
                            <i class="fas fa-chevron-left mr-2"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        // Daftar Pekerjaan
        let pekerjaanIndex = 1;
        document.getElementById('tambahPekerjaan').addEventListener('click', function() {
            let pekerjaan = document.getElementById('pekerjaan').value;
            let lokasi = document.getElementById('lokasi').value;
            let volume = document.getElementById('volume').value;
            let keterangan = document.getElementById('keterangan').value;

            let row = `<tr>
            <td>${pekerjaanIndex++}</td>
            <td><input type="text" name="pekerjaan[]" value="${pekerjaan}" class="form-control form-control-sm" readonly></td>
            <td><input type="text" name="lokasi[]" value="${lokasi}" class="form-control form-control-sm" readonly></td>
            <td><input type="text" name="volume[]" value="${volume}" class="form-control form-control-sm" readonly></td>
            <td><input type="text" name="keterangan[]" value="${keterangan}" class="form-control form-control-sm" readonly></td>
            <td><button type="button" class="btn btn-primary buttonedit2 remove-row"><i class="fas fa-trash-alt"></i> Hapus</button></td>
        </tr>`;
            document.getElementById('TableBodyPekerjaan').insertAdjacentHTML('beforeend', row);
            $('#modalPekerjaan').modal('hide');
            document.getElementById('pekerjaan').value = '';
            document.getElementById('lokasi').value = '';
            document.getElementById('volume').value = '';
            document.getElementById('keterangan').value = '';
        });
        // ALAT MATERIAL
        let alatIndex = 1;
        document.getElementById('tambahAlat').addEventListener('click', function() {
            let item = document.getElementById('itemAlat').value;
            let kuantitas = document.getElementById('kuantitasAlat').value;
            let satuan = document.getElementById('satuanAlat').value;

            let row = `<tr>
            <td>${alatIndex++}</td>
            <td><input type="text" name="alat_item[]" value="${item}" class="form-control form-control-sm" readonly></td>
            <td><input type="text" name="alat_kuantitas[]" value="${kuantitas}" class="form-control form-control-sm" readonly></td>
            <td><input type="text" name="alat_satuan[]" value="${satuan}" class="form-control form-control-sm" readonly></td>
            <td><button type="button" class="btn btn-primary buttonedit2 remove-row"><i class="fas fa-trash-alt"></i> Hapus</button></td>
        </tr>`;
            document.getElementById('TableBodyAlat').insertAdjacentHTML('beforeend', row);
            $('#modalAlat').modal('hide');
            document.getElementById('itemAlat').value = '';
            document.getElementById('kuantitasAlat').value = '';
            document.getElementById('satuanAlat').value = '';
        });

        // TENAGA KERJA
        let tenagaIndex = 1;
        document.getElementById('tambahTenaga').addEventListener('click', function() {
            let item = document.getElementById('itemTenaga').value;
            let kuantitas = document.getElementById('kuantitasTenaga').value;
            let satuan = document.getElementById('satuanTenaga').value;

            let row = `<tr>
            <td>${tenagaIndex++}</td>
            <td><input type="text" name="tenaga_item[]" value="${item}" class="form-control form-control-sm" readonly></td>
            <td><input type="text" name="tenaga_kuantitas[]" value="${kuantitas}" class="form-control form-control-sm" readonly></td>
            <td><input type="text" name="tenaga_satuan[]" value="${satuan}" class="form-control form-control-sm" readonly></td>
            <td><button type="button" class="btn btn-primary buttonedit2 remove-row"><i class="fas fa-trash-alt"></i> Hapus</button></td>
        </tr>`;
            document.getElementById('TableBodyTenaga').insertAdjacentHTML('beforeend', row);
            $('#modalTenaga').modal('hide');
            document.getElementById('itemTenaga').value = '';
            document.getElementById('kuantitasTenaga').value = '';
            document.getElementById('satuanTenaga').value = '';
        });

        // HAPUS ROW
        document.addEventListener('click', function(e) {
            if (e.target.closest('.remove-row')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
    <script>
        let fieldIndex = 1;
        const maxFields = 7;

        document.getElementById('fileuploads_btn_add').addEventListener('click', function() {
            if (fieldIndex >= maxFields) {
                alert('Maksimal hanya boleh 7 file.');
                return;
            }

            fieldIndex++;

            const fieldContainer = document.getElementById('fileuploads_loop_add');

            const newField = document.createElement('div');
            newField.className = 'form-group';
            newField.innerHTML = `
                <div class="row formtype mb-2">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fileupload_${fieldIndex}">File ${fieldIndex}</label>
                            <input type="text" name="fileupload_${fieldIndex}" class="form-control form-control-sm " />
                        </div>
                    </div>
                </div>

            `;

            fieldContainer.appendChild(newField);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('select.tomselect').forEach(function (el) {
                new TomSelect(el,{
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            });
        });
    </script>
@endsection
@endsection
