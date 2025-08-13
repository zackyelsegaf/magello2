@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah RAB & RAP</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('rabrap/list/page') }}">
                @csrf

                <div class="row mb-3">

                    <div class="col-md-4">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul') }}"
                            placeholder="Judul">
                    </div>
                    <div class="col-md-4">
                        <label for="perumahan_cluster" class="form-label fw-bold">Perumahan Cluster</label>
                        <select class="form-control @error('perumahan_cluster') is-invalid @enderror" name="perumahan_cluster"
                            id="perumahan_cluster">
                            <option value="">-- Pilih Perumahan Cluster --</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="tipe_model" class="form-label fw-bold">Tipe Model</label>
                        <select class="form-control @error('tipe_model') is-invalid @enderror" name="tipe_model"
                            id="tipe_model">
                            <option value="">-- Pilih Tipe Model --</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="persentase_kenaikan" class="form-label fw-bold text-nowrap">Persentase Kenaikan
                            Kuantitas RAP ke RAB</label>
                        <input type="number" id="persentase_kenaikan" name="persentase_kenaikan" class="form-control"
                            value="{{ old('persentase_kenaikan') }}" placeholder="Persentase Kenaikan Kuantitas RAP ke RAB">
                    </div>
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-6">
                        <label for="total_rap" class="form-label fw-bold">Total RAP</label>
                        <input type="text" id="total_rap" name="total_rap" class="form-control"
                            value="{{ old('total_rap') }}" placeholder="Total RAP" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="total_rab" class="form-label fw-bold">Total RAB</label>
                        <input type="text" id="total_rab" name="total_rab" class="form-control"
                            value="{{ old('total_rab') }}" placeholder="Total RAB" readonly>
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

                        <!-- Modal Item RAP & RAB -->
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content my-rounded-2">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Item RAP & RAB</h5>
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
                                                        class="form-control form-control-sm">
                                                        <option value="">-- Pilih Item --</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="satuan" class="form-label fw-bold">Satuan</label>
                                                    <select name="satuan" id="satuan"
                                                        class="form-control form-control-sm">
                                                        <option value="">-- Pilih Satuan --</option>
                                                        <option value="Unit">test</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="kuantitas_rap" class="form-label fw-bold">Kuantitas
                                                        RAP</label>
                                                    <input type="text" name="kuantitas_rap" id="kuantitas_rap"
                                                        class="form-control form-control-sm" placeholder="Kuantitas RAP">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="naik" class="form-label fw-bold">Naik (%)</label>
                                                    <input type="number" name="naik" id="naik"
                                                    class="form-control form-control-sm" placeholder="Naik (%)">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="kuantitas_rab" class="form-label fw-bold">Kuantitas
                                                        RAB</label>
                                                    <input type="text" name="kuantitas_rab" id="kuantitas_rab" readonly
                                                        class="form-control form-control-sm" placeholder="Kuantitas RAB">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="harga" class="form-label fw-bold">Harga</label>
                                                    <input type="text" name="harga" id="harga"
                                                        class="form-control form-control-sm" placeholder="Harga">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="total_rap" class="form-label fw-bold">Total
                                                        RAP</label>
                                                    <input type="text" name="total_rap" id="total_rap" readonly
                                                        class="form-control form-control-sm" placeholder="Total RAP">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="total_rap" class="form-label fw-bold">Total
                                                        RAP</label>
                                                    <input type="text" name="Total_rap" id="total_rap" readonly
                                                        class="form-control form-control-sm" placeholder="Total RAP">
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

                        <div class="table-responsive">
                            {{-- Tabel  --}}
                            <table class="table table-striped table-bordered table-hover table-center mb-0">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Item</th>
                                        <th>Satuan</th>
                                        <th>Kuantitas RAP</th>
                                        <th>Naik (%)</th>
                                        <th>Kuantitas RAB</th>
                                        <th>Harga</th>
                                        <th>Total</th>
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
                        <a href="{{ route('rabrap/list/page') }}" class="btn btn-primary ml-3">
                            <i class="fas fa-chevron-left mr-2"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tambahBtn = document.getElementById('tambahTerpilih');
            const tableBody = document.getElementById('TableBody');

            tambahBtn.addEventListener('click', function() {
                const item = document.getElementById('item').value;
                const satuan = document.getElementById('satuan').value;
                const kuantitasRap = document.getElementById('kuantitas_rap').value;
                const naik = document.getElementById('naik').value;
                const harga = document.getElementById('harga').value;

                // Bikin baris baru
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="text" name="satuan[]" value="${satuan}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="kuantitas_rap[]" value="${kuantitasRap}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="naik[]" value="${naik}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="kuantitas_rab[]" value="" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="harga[]" value="${harga}" class="form-control form-control-sm" readonly></td>
                    <td>
                        <label>RAP</label>
                        <input type="text" name="total_rap[]" readonly class="form-control form-control-sm">
                        <label>RAB</label>
                        <input type="text" name="total_rab[]" readonly class="form-control form-control-sm">
                    </td>
                        <td><button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                    </td>
                `;

                tableBody.appendChild(row);

                // Reset input modal
                ['item', 'satuan', 'kuantitas_rap', 'naik', 'harga'].forEach(id => {
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
@endsection
@endsection
