@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Pembiayaan Pesanan</h3>
                    </div>
                </div>
            </div>

            <form>
                <!-- Section 1: Form -->
                <div class="mt-3">
                    <div class="row mb-3">
                        <!-- No dan Tanggal -->
                        <div class="col-md-3">
                            <label for="no_penyesuaian" class="form-label fw-bold">No</label>
                            <input type="number" id="no_penyesuaian" class="form-control mb-2" value="1000">
                            <input type="date" id="tgl_efektif" class="form-control" value="2025-07-22">
                        </div>

                        <!-- Akun Pembiayaan dan Tanggal -->
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Akun Pembiayaan</label>
                            <select class="form-control form-control-sm mb-2" name="akun_pembiayaan">
                                <option value="" selected></option>
                            </select>
                            <input type="date" class="form-control" value="2025-07-22">
                        </div>

                        <!-- Checkbox Disetujui -->
                        <div class="col-md-2 d-flex align-items-center">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="disetujui" name="disetujui">
                                <label class="form-check-label" for="disetujui">Disetujui</label>
                            </div>
                        </div>

                        <!-- Opsi -->
                        <div class="col-md-2">
                            <label class="form-label">Opsi</label>
                            <select class="form-control" name="opsi">
                                <option>Simpan Transaksi</option>
                                <option>Salin Transaksi</option>
                            </select>
                        </div>

                        <!-- Rancangan -->
                        <div class="col-md-2">
                            <label class="form-label">Rancangan</label>
                            <select class="form-control" name="rancangan">
                                <option>----</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Section 2: Form -->
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
                                <textarea id="deskripsi" class="form-control mt " rows="2"></textarea>
                            </div>
                        </div>
                        <div class="tab-content profile-tab-cont">
                            <div class="profile-menu">
                                <ul class="nav nav-tabs nav-tabs-solid">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#biaya">Rincian Biaya</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#barang">Rincian Barang</a>
                                    </li>
                                </ul>
                            </div>
                            <div id="biaya" class="tab-pane fade show active">
                                <div class="mt-4">
                                    <form>
                                        <div class="table-responsive mb-4">
                                            <table class="table table-striped table-bordered table-hover mb-0"
                                                style="min-width: 1200px;">
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
                                            <div class="col-md-3">
                                                <label for="total_biaya" class="form-label fw-bold">Total Biaya</label>
                                                <input type="number" id="total_biaya" class="form-control mb-2"
                                                    value="1000">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div id="barang" class="tab-pane fade">
                                <div class=" mt-4">
                                    <form>
                                        <div class="table-responsive mb-4">
                                            <table class="table table-striped table-bordered table-hover mb-0"
                                                style="min-width: 1200px;">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>No Barang</th>
                                                        <th>Tanggal</th>
                                                        <th>Deskripsi</th>
                                                        <th>Kts</th>
                                                        <th>Satuan</th>
                                                        <th>Biaya</th>
                                                        <th>Proyek</th>
                                                        <th>Gudang</th>
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
                                            <div class="col-md-3">
                                                <label for="total_biaya" class="form-label fw-bold">Total Biaya</label>
                                                <input type="number" id="total_biaya" class="form-control mb-2"
                                                    value="1000">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dokumen" class="tab-pane fade">
                        <div class="container mt-5">
                            <div class="row">
                                <div id="fieldContainer" class="col-lg-6">
                                    <!-- Default 5 fields -->
                                    <div class="mb-2">
                                        <label class="form-label">File 1</label>
                                        <input type="text" class="form-control" placeholder="your document link">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">File 2</label>
                                        <input type="text" class="form-control" placeholder="your document link">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">File 3</label>
                                        <input type="text" class="form-control" placeholder="your document link">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">File 4</label>
                                        <input type="text" class="form-control" placeholder="your document link">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">File 5</label>
                                        <input type="text" class="form-control" placeholder="your document link">
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
                                input.placeholder = 'your document link';

                                wrapper.appendChild(label);
                                wrapper.appendChild(input);
                                fieldContainer.appendChild(wrapper);
                            });
                        </script>
                    </div>
            </form>
        </div>
    </div>
@endsection
