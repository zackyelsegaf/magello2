@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Pengajuan Bahan Bangunan</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('pengajuanbahanbangunan/list/page') }}">
                @csrf

                <div class="row mb-3">

                    <div class="col-md-4">
                        <label for="nomor_pengajuan" class="form-label fw-bold">Nomor Pengajuan</label>
                        <input type="text" id="nomor_pengajuan" name="nomor_pengajuan" class="form-control" value="{{ old('nomor_pengajuan') }}"
                            placeholder="Nomor Pengajuan">
                    </div>
                    <div class="col-md-4">
                        <label for="spk" class="form-label fw-bold">SPK</label>
                        <select class="tomselect @error('spk') is-invalid @enderror" name="spk" id="spk">
                            <option value="">-- Pilih SPK --</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="perumahan_cluster" class="form-label fw-bold">Perumahan/Cluster</label>
                        <select class="tomselect @error('perumahan_cluster') is-invalid @enderror"
                            name="perumahan_cluster" id="perumahan_cluster">
                            <option value="">-- Pilih Perumahan/Cluster --</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="kavling" class="form-label fw-bold">Kavling</label>
                        <select class="tomselect @error('kavling') is-invalid @enderror" name="kavling" id="kavling">
                            <option value="">-- Pilih Kavling --</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="perumahan_cluster" class="form-label fw-bold">Tanggal</label>
                        <input type="text" id="perumahan_cluster" name="perumahan_cluster" class="form-control datetimepicker"
                            value="{{ old('perumahan_cluster') }}" placeholder="Perumahan Cluster">
                    </div>
                    <div class="col-12">
                        <label for="catatan" class="form-label">Catatan</label>
                        <textarea id="catatan" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        {{-- Tombol Tambah  --}}
                        <div class="row float-right mr-0">
                            <button type="button" class="btn btn-primary buttonedit mb-3" data-toggle="modal"
                                data-target="#modal">
                                <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                            </button>
                        </div>

                        <!-- Modal Item Pengajuan Bahan Bangunan -->
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
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
                                                <div class="form-group mb-1">
                                                    <label for="item" class="form-label fw-bold">Item</label>
                                                    <select name="item" id="item"
                                                        class="tomselect">
                                                        <option value="">-- Pilih Item --</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="stok" class="form-label fw-bold">Stok</label>
                                                    <input type="number" name="stok" id="stok"
                                                        class="form-control form-control-sm" placeholder="Stok">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <label for="kuota" class="form-label fw-bold">Kuota</label>
                                                    <input type="number" name="kuota" id="kuota"
                                                        class="form-control form-control-sm" placeholder="Kuota">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <label for="kuantitas" class="form-label fw-bold">Kuantitas</label>
                                                    <input type="number" name="kuantitas" id="kuantitas"
                                                        class="form-control form-control-sm" placeholder="Kuantitas">
                                                </div>

                                                <div class="form-group mb-1">
                                                    <label for="satuan" class="form-label fw-bold">Satuan</label>
                                                    <select name="satuan" id="satuan"
                                                        class="tomselect">
                                                        <option value="">-- Pilih Satuan --</option>
                                                        <option value="Unit">test</option>
                                                    </select>

                                                    <div class="form-group mb-1">
                                                        <label for="merk" class="form-label fw-bold">Merk</label>
                                                        <input type="number" name="merk" id="merk"
                                                            class="form-control form-control-sm" placeholder="Merk">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary buttonedit" id="tambahTerpilih"><i
                                                class="fas fa-paper-plane mr-2"></i> Tambah ke Form</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <p class="font-weight-bold mb-0 h6">Item Pengajuan Bahan Bangunan</p>
                                </div>
                            </div>
                            <div class="col-md-12 mr-3">
                                <div class="text-center">
                                    <p class="font-weight-light">Silahkan masukkan poin - poin Pengajuan Bahan Bangunan</p>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive">
                            {{-- Tabel  --}}
                            <table class="table table-striped table-bordered table-hover table-center mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Item</th>
                                        <th>Stok</th>
                                        <th>Kuota</th>
                                        <th>Kuantitas</th>
                                        <th>Satuan</th>
                                        <th>Merk</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="TableBody">
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check mr-2"></i> Simpan
                        </button>
                        <a href="{{ route('pengajuanbahanbangunan/list/page') }}" class="btn btn-primary ml-3">
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
        document.addEventListener('DOMContentLoaded', function() {
            const tambahBtn = document.getElementById('tambahTerpilih');
            const tableBody = document.getElementById('TableBody');

            tambahBtn.addEventListener('click', function() {
                const item = document.getElementById('item').value;
                const stok = document.getElementById('stok').value;
                const kuota = document.getElementById('kuota').value;
                const kuantitas = document.getElementById('kuantitas').value;
                const satuan = document.getElementById('satuan').value;
                const merk = document.getElementById('merk').value;

                // Bikin baris baru
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="text" name="item[]" value="${item}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="stok[]" value="${stok}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="kuota[]" value="${kuota}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="kuantitas[]" value="${kuantitas}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="satuan[]" value="${satuan}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="merk[]" value="${merk}" class="form-control form-control-sm" readonly></td>
                    <td>
                        <button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row">
                            <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                        </button>
                    </td>
                `;

                tableBody.appendChild(row);

                // Reset input modal
                ['item', 'stok', 'kuota', 'kuantitas', 'satuan', 'merk'].forEach(id => {
                    document.getElementById(id).value = '';
                });

                // Tutup modal
                $('#modal').modal('hide');
            });

            // Event hapus baris
            tableBody.addEventListener('click', function(e) {
                if (e.target.closest('.remove-row')) {
                    e.target.closest('tr').remove();
                }
            });
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
