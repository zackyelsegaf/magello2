@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <div class="mt-5">
                            <h4 class="card-title float-left mt-2">
                                {{-- <i class="fas fa-book mr-3"></i> --}}
                                Buku Kas</h4>
                        </div>
                        <div class="col-auto text-end float-right ms-auto">
                            <span class="d-none d-sm-inline-block">
                                <button type="button" class="btn btn-primary veiwbutton1 mr-3" data-toggle="modal" data-target="#pemasukan"><i class="fas fa-plus mr-2"></i> Catat Pemasukan</button>
                                <button type="button" class="btn btn-primary veiwbutton2 float-right" data-toggle="modal" data-target="#pengeluaran"><i class="fas fa-minus mr-2"></i> Catat Pengeluaran</button>
                            </span>
                            <span class="d-inline-block d-sm-none">
                                <button type="button" class="btn btn-primary veiwbutton1 mr-3" data-toggle="modal" data-target="#pemasukan"><i class="fas fa-plus"></i></button>
                                <button type="button" class="btn btn-primary veiwbutton2 float-right" data-toggle="modal" data-target="#pengeluaran"><i class="fas fa-minus"></i></button>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row align-items-top">
                    <div class="col px-3 py-1">
                        <h6 class="font-weight-bold">Kategori:</h6>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card card-table">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="BukuKasList">
                                <thead class="thead-dark">
                                <tr>
                                    <th>No</th>
                                    <th hidden>ID</th>
                                    <th>Buku Kas</th>
                                    <th>Kategori Kas</th>
                                    <th>Tipe Kas</th>
                                    <th>Nominal</th>
                                    <th>Tanggal Transaksi</th>
                                    <th>Referensi</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="pemasukan" tabindex="-1" role="dialog" aria-labelledby="modalPemasukan" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content my-rounded-2">
                        <div class="modal-header">
                            <h6 class="modal-title font-weight-bold">Catat Pemasukan</h6>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('devina-cashbook.buku-kas.tambah.form') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group mb-2">
                                <div class="form-group">
                                    <label for="tipe_id" class=""><strong class="text-danger align-middle">*</strong>&nbsp;Tipe Transaksi</label>
                                    @php
                                        $selected = old('tipe_id', $model->tipe_id ?? 1);
                                    @endphp
                                    <select class="tomselect @error('tipe_id') is-invalid @enderror" name="tipe_id" id="tipe_id">
                                        <option value="" disabled>--Status Pengajuan--</option>
                                        @foreach ($tipeKas as $items)
                                            <option value="{{ $items->id }}" {{ $selected == $items->id ? 'selected' : '' }}>
                                                {{ $items->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tipe_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                            <div class="form-group m-2">
                                <label class="fw-bold">Kategori</label>
                                <select class="tomselect @error('kategori_id') is-invalid @enderror" name="kategori_id" id="kategori_id">
                                    <option {{ old('kategori_id') ? '' : 'selected' }} disabled>--Kategori--</option>
                                    @foreach ($kategoriKas as $items )
                                        <option value="{{ $items->id }}" {{ old('kategori_id') == $items->id ? 'selected' : '' }}>{{ $items->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label class="fw-bold">Tanggal</label>
                                <input type="text" name="tanggal" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal') }}">
                            </div>
                            <div class="form-group mb-2">
                                <label class="fw-bold">Nominal</label>
                                <input type="text" name="nominal" class="form-control form-control-sm rupiah" placeholder="contoh: 3.750.000" value="{{ old('nominal') }}">
                            </div>
                            {{-- <div class="form-group mb-2">
                                <label class="fw-bold">Bukti Pembayaran</label>
                                <div class="custom-file">
                                    <input type="file" name="bukti_pembayaran" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="custom-file-label">Pilih File</label>
                                </div>
                            </div> --}}
                            <div class="form-group mb-2">
                                <label>Keterangan</label>
                                <textarea name="keterangan" rows="2" class="form-control" placeholder="opsional">{{ old('keterangan') }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="approved_by" value="{{ old('approved_by', Auth::user()->id) }}">
                                    <input type="checkbox" name="is_approved" id="approve_bpb" value="1" class="custom-control-input" {{ old('is_approved') ? 'checked' : '' }}>
                                    <label for="approve_bpb" class="custom-control-label">Sekaligus setujui (approve)</label>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 border-top">
                            <button id="tambahPemasukan" type="submit" class="btn btn-primary buttonedit float-right"><i class="fas fa-save mr-2"></i>Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="pengeluaran" tabindex="-1" role="dialog" aria-labelledby="modalPengeluaran" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content my-rounded-2">
                        <div class="modal-header">
                            <h6 class="modal-title font-weight-bold">Catat Pengeluaran</h6>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="jenis_id" value="4">
                            <div class="form-group mb-2">
                                <label class="fw-bold">Tanggal Pembayaran</label>
                                <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran') }}">
                            </div>
                            <div class="form-group mb-2">
                                <label class="fw-bold">Nominal</label>
                                <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" placeholder="contoh: 3.750.000" value="{{ old('nominal_pembayaran') }}">
                            </div>
                            <div class="form-group mb-2">
                                <label class="fw-bold">Bukti Pembayaran</label>
                                <div class="custom-file">
                                    <input type="file" name="bukti_pembayaran" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="custom-file-label">Pilih File</label>
                                </div>
                            </div>
                            <div class="form-group mb-2">
                                <label>Catatan</label>
                                <textarea name="catatan_pembayaran" rows="2" class="form-control" placeholder="opsional">{{ old('catatan_pembayaran') }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="hidden" name="approved_by" value="{{ old('approved_by', Auth::user()->id) }}">
                                    <input type="checkbox" name="is_approved" id="approve_bpb" value="1" class="custom-control-input" {{ old('is_approved') ? 'checked' : '' }}>
                                    <label for="approve_bpb" class="custom-control-label">Sekaligus setujui (approve)</label>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 border-top">
                            <button id="tambahPengeluaran" type="submit" class="btn btn-primary buttonedit float-right"><i class="fas fa-save mr-2"></i>Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@section('script')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('select.tomselect').forEach(function (el) {
                new TomSelect(el,{
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    },
                    maxOptions: null,
                    maxItems: 1
                });
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#BukuKasList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: true,
                ajax: {
                    url: "{{ route('devina-cashbook.get-buku-kas-data') }}",
                },
                columns: [{
                        data: 'no',
                        name: 'no',
                        orderable: true,
                        searchable: true
                    },
                    {
                        data: 'id',
                        name: 'id',
                        visible: false
                    },
                    {
                        data: 'buku_kas',
                        name: 'buku_kas'
                    },
                    {
                        data: 'kategori_kas',
                        name: 'kategori_kas'
                    },
                    {
                        data: 'tipe_kas',
                        name: 'tipe_kas'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal',
                    },
                    {
                        data: 'nominal',
                        name: 'nominal',
                    },
                    {
                        data: 'referensi',
                        name: 'referensi',
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                    },
                    {
                        data: 'modify',
                        name: 'modify',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
    <script>
        document.addEventListener("click", function(e) {
            let btn = e.target.closest(".btn-hapus");
            if (!btn) return;
            e.preventDefault();
            let id = btn.getAttribute("data-id");
            Swal.fire({
                title: 'Hapus data?',
                text: 'Tindakan ini tidak bisa dibatalkan!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "/buku-kas/hapus/" + id;
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cleaveMap = new WeakMap();
            window.__cleaveMap = cleaveMap;

            function initCleave(el) {
                if (!el || el.classList.contains('cleave-initialized')) return;
                const instance = new Cleave(el, {
                    numeral: true,
                    numeralPositiveOnly: true,
                    numeralDecimalScale: 2,
                    numeralThousandsGroupStyle: 'thousand',
                    numeralDecimalMark: '.',
                    delimiter: ',',
                    prefix: 'Rp ',
                    rawValueTrimPrefix: true
                });
                el.classList.add('cleave-initialized');
                cleaveMap.set(el, instance);
            }

            window.initCleaveIn = function(container) {
                container.querySelectorAll('input.rupiah').forEach(initCleave);
            };

            document.querySelectorAll('input.rupiah').forEach(initCleave);

            document.querySelectorAll('form').forEach(function (form) {
                form.addEventListener('submit', function () {
                    form.querySelectorAll('input.rupiah').forEach(function (el) {
                        const inst = cleaveMap.get(el);
                        if (inst) el.value = inst.getRawValue();
                    });
                });
            });
        });
    </script>
@endsection
@endsection
