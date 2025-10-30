@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Pembayaran Booking</h3>
                    </div>
                </div>
            </div>
            <div class="row py-3 ml-0 mr-0 mb-3 border bg-white my-rounded-2">
                    <div class="col-md-6 px-3">
                        <div class="p-3 mb-3 bg-info-card my-rounded-2">
                            <h5 class="m-0 font-weight-bold text-info"><i class="fas fa-user mr-2 my-0 text-info h4"></i> Detail Pembayaran a/n Sriyono</h5>
                        </div>
                    </div>
                    <div class="col-md-6 px-3">
                        <div class="p-3 mb-3 bg-info-card my-rounded-2">
                            <h5 class="m-0 font-weight-bold text-info"><i class="fas fa-money-bill-wave mr-2 my-0 text-info h4"></i> Metode Pembayaran: </h5>
                        </div>
                    </div>
                <div class="col-md-6 px-3">
                    <div class="my-rounded-2">
                        <div class="col-md-12 p-2 bg-info-card my-rounded-2">
                            <div class="d-flex align-items-center flex-nowrap my-rounded-2 p-3">
                                <div class="w-100">
                                    <div class="dash-widget-header">
                                        <div>
                                            <h1 class="font-weight-bold text-info">Rp. 180,000,000</h1>
                                            <h5 class="text-info">Total Piutang</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-inline-flex align-items-center justify-content-center rounded pt-3 px-5 text-white">
                                    <div class="timeline-icons">
                                        <h1><i class="fas fa-calculator text-info"></i></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6 px-3">
                    <div class="my-rounded-2">
                        <div class="col-md-12 p-2 bg-danger-card my-rounded-2">
                            <div class="d-flex align-items-center flex-nowrap my-rounded-2 p-3">
                                <div class="w-100">
                                    <div class="dash-widget-header">
                                        <div>
                                            <h1 class="font-weight-bold text-danger">Rp. 18,000,000</h1>
                                            <h5 class="text-danger">Sisa Hutang</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-inline-flex align-items-center justify-content-center rounded pt-3 px-5 text-white">
                                    <div class="timeline-icons">
                                        <h1><i class="fas fa-coins text-danger"></i></h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 px-3">
                    <div class="row">
                        <div class="col">
                            <div class="float-left col-md-6 mr-0 p-0">
                                <div class="form-group mb-3">
                                    <label for="status_pengajuan_id" class=""><h5>Pilih Pembayaran :</h5></label>
                                    <select class="tomselect @error('status_pengajuan_id') is-invalid @enderror" name="status_pengajuan_id" id="status_pengajuan_id">
                                        <option {{ old('status_pengajuan_id') ? '' : 'selected' }} disabled>--Status Pengajuan--</option>
                                        @foreach ($data_status_pengajuan as $items )
                                            <option value="{{ $items->id }}" {{ old('status_pengajuan_id') == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('status_pengajuan_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="float-right mr-0 p-0">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#modalBarang">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Booking Fee</strong>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="my-rounded-2">
                        <div class="col-md-12 p-3 bg-white border my-rounded-2">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover table-center mb-0" id="PembayaranBooking">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>Ref.</th>
                                            <th>Tanggal</th>
                                            <th>Total</th>
                                            <th>Masuk Ke</th>
                                            <th>Status</th>
                                            <th>Keterangan</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    {{-- <tbody id="barangTableBody">
                                        @if(old('no_item'))
                                            @foreach(old('no_item') as $index => $no_item)
                                                <tr class="barang-row">
                                                    <td style="display: none;"><input style="width: 150px;" type="text" name="no_item[]" value="{{ $no_item }}" class="form-control form-control-sm" readonly></td>
                                                    <td><input style="width: 150px;" type="text" name="nama_item[]" value="{{ old('nama_item')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="satuan[]" value="{{ old('satuan')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="rap_qty[]" value="{{ old('rap_qty')[$index] ?? '' }}" class="form-control form-control-sm @error("rap_qty.$index") is-invalid @enderror">
                                                        @error("rap_qty.$index")
                                                            <p class="Invalid-feedback ">{{ $message }}</p>
                                                        @enderror
                                                    </td>
                                                    <td><input style="width: 150px;" type="text" name="persen_naik[]" value="{{ old('persen_naik')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="rab_qty[]" value="{{ old('rab_qty')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                    <td><input style="width: 150px;" type="text" name="harga_item[]" value="{{ old('harga_item')[$index] ?? '' }}" class="form-control form-control-sm rupiah"></td>
                                                    <td>
                                                        <small><strong>Total RAP</strong></small>
                                                        <input style="width: 150px;" type="text" name="total_rap_item[]" value="{{ old('total_rap_item')[$index] ?? '' }}" readonly class="form-control form-control-sm rupiah">
                                                        <small><strong>Total RAB</strong></small>
                                                        <input style="width: 150px;" type="text" name="total_rab_item[]" value="{{ old('total_rab_item')[$index] ?? '' }}" readonly class="form-control form-control-sm rupiah">
                                                    </td>
                                                    <td>
                                                        <button style="width: 150px;" type="button" class="btn btn-primary buttonedit2 mr-2 remove-row">
                                                            <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody> --}}
                                </table>
                            </div>
                            <div class="float-right pt-5">
                                <h4 class="font-weight-bold text-danger">Sisa Piutang Penerimaan KPR dari Bank : Rp 20,000,000</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.custom-file-input').forEach(function (inp) {
                inp.addEventListener('change', function (e) {
                const f = e.target.files && e.target.files[0];
                const label = inp.nextElementSibling;
                if (f && label && label.classList.contains('custom-file-label')) {
                    label.textContent = f.name;
                }
                });
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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const metodePembayaranSelect = document.getElementById('metode_pembayaran_id');
            const biayaKonsumen_1 = document.getElementById('biaya_konsumen_1');
            const bK_0 = document.getElementById('bk_0');
            const bK_1 = document.getElementById('bk_1');
            const bK_3 = document.getElementById('bk_3');
            const bK_4 = document.getElementById('bk_4');
            const bK_5 = document.getElementById('bk_5');
            const bK_6 = document.getElementById('bk_6');
            const bK_7 = document.getElementById('bk_7');
            const bK_8 = document.getElementById('bk_8');
            const bK_2 = document.getElementById('bk_2');
            const bK_9 = document.getElementById('bk_9');
            const bK_10 = document.getElementById('bk_10');
            const dokumen_1 = document.getElementById('dokumen_1');
            const dK_0 = document.getElementById('dk_0');
            const dK_1 = document.getElementById('dk_1');
            const dK_2 = document.getElementById('dk_2');
            const dokumen_2 = document.getElementById('dokumen_2');
            const dK_3 = document.getElementById('dk_3');
            const dK_4 = document.getElementById('dk_4');
            const dokumen_3 = document.getElementById('dokumen_3');
            const dK_5 = document.getElementById('dk_5');
            const dK_6 = document.getElementById('dk_6');
            const dokumen_4 = document.getElementById('dokumen_4');
            const dK_7 = document.getElementById('dk_7');
            const dK_8 = document.getElementById('dk_8');
            const dokumen_5 = document.getElementById('dokumen_5');
            const dK_9 = document.getElementById('dk_9');
            const dK_10 = document.getElementById('dk_10');
            const dokumen_6 = document.getElementById('dokumen_6');
            const dK_11 = document.getElementById('dk_11');
            const dK_12 = document.getElementById('dk_12');

            function toggleFields() {
                const selectedValue = metodePembayaranSelect.value;

                if (selectedValue === 'Cash Keras') {
                    biayaKonsumen_1.style.display = '';
                    bK_0.style.display = '';
                    bK_1.style.display = '';
                    bK_3.style.display = 'none';
                    bK_4.style.display = '';
                    bK_5.style.display = '';
                    bK_6.style.display = '';
                    bK_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_2.style.display = '';
                    bK_9.style.display = '';
                    bK_10.style.display = 'none';
                    dokumen_1.style.display = '';
                        dK_0.style.display = 'none';
                        dK_1.style.display = '';
                        dK_2.style.display = '';
                    dokumen_2.style.display = '';
                        dK_3.style.display = '';
                        dK_4.style.display = '';
                    dokumen_3.style.display = 'none';
                        dK_5.style.display = 'none';
                        dK_6.style.display = 'none';
                    dokumen_4.style.display = 'none';
                        dK_7.style.display = 'none';
                        dK_8.style.display = 'none';
                    dokumen_5.style.display = 'none';
                        dK_9.style.display = 'none';
                        dK_10.style.display = 'none';
                    dokumen_6.style.display = 'none';
                        dK_11.style.display = 'none';
                        dK_12.style.display = 'none';
                } else if (selectedValue === 'Cash Bertahap') {
                    biayaKonsumen_1.style.display = '';
                    bK_0.style.display = '';
                    bK_1.style.display = '';
                    bK_3.style.display = 'none';
                    bK_4.style.display = '';
                    bK_5.style.display = '';
                    bK_6.style.display = '';
                    bK_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_2.style.display = '';
                    bK_9.style.display = 'none';
                    bK_10.style.display = '';
                    dokumen_1.style.display = '';
                        dK_0.style.display = 'none';
                        dK_1.style.display = '';
                        dK_2.style.display = '';
                    dokumen_2.style.display = '';
                        dK_3.style.display = '';
                        dK_4.style.display = '';
                    dokumen_3.style.display = 'none';
                        dK_5.style.display = 'none';
                        dK_6.style.display = 'none';
                    dokumen_4.style.display = 'none';
                        dK_7.style.display = 'none';
                        dK_8.style.display = 'none';
                    dokumen_5.style.display = 'none';
                        dK_9.style.display = 'none';
                        dK_10.style.display = 'none';
                    dokumen_6.style.display = 'none';
                        dK_11.style.display = 'none';
                        dK_12.style.display = 'none';
                } else if (selectedValue === 'KPR') {
                    biayaKonsumen_1.style.display = '';
                    bK_0.style.display = '';
                    bK_1.style.display = '';
                    bK_2.style.display = 'none';
                    bK_3.style.display = '';
                    bK_4.style.display = '';
                    bK_5.style.display = '';
                    bK_6.style.display = '';
                    bK_7.style.display = '';
                    bK_8.style.display = '';
                    bK_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    dokumen_1.style.display = '';
                        dK_0.style.display = '';
                        dK_1.style.display = 'none';
                        dK_2.style.display = '';
                    dokumen_2.style.display = '';
                        dK_3.style.display = '';
                        dK_4.style.display = '';
                    dokumen_3.style.display = '';
                        dK_5.style.display = '';
                        dK_6.style.display = '';
                    dokumen_4.style.display = '';
                        dK_7.style.display = '';
                        dK_8.style.display = '';
                    dokumen_5.style.display = '';
                        dK_9.style.display = '';
                        dK_10.style.display = '';
                    dokumen_6.style.display = '';
                        dK_11.style.display = '';
                        dK_12.style.display = '';
                } else {
                    biayaKonsumen_1.style.display = 'none';
                    bK_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    dokumen_1.style.display = 'none';
                        dK_0.style.display = 'none';
                        dK_1.style.display = 'none';
                        dK_2.style.display = 'none';
                    dokumen_2.style.display = 'none';
                        dK_3.style.display = 'none';
                        dK_4.style.display = 'none';
                    dokumen_3.style.display = 'none';
                        dK_5.style.display = 'none';
                        dK_6.style.display = 'none';
                    dokumen_4.style.display = 'none';
                        dK_7.style.display = 'none';
                        dK_8.style.display = 'none';
                    dokumen_5.style.display = 'none';
                        dK_9.style.display = 'none';
                        dK_10.style.display = 'none';
                    dokumen_6.style.display = 'none';
                        dK_11.style.display = 'none';
                        dK_12.style.display = 'none';
                }
            }
            metodePembayaranSelect.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tlLinks = document.querySelectorAll('.tl-link');
            var panels  = document.querySelectorAll('.timeline-panel');

            function showPanel(panelId, clickedLink) {

                panels.forEach(function (p) { p.classList.add('d-none'); });

                var target = document.getElementById(panelId);
                if (target) target.classList.remove('d-none');

                document.querySelectorAll('.timeline .card').forEach(function(card){
                card.classList.remove('border', 'border-primary');
                });
                var card = clickedLink.closest('.card');
                if (card) card.classList.add('border', 'border-primary');
            }

            // Set default aktif = Pemberkasan saat load
            showPanel('panel-pemberkasan', document.querySelector('.tl-link[data-target="panel-pemberkasan"]') || document.body);

            tlLinks.forEach(function (a) {
                a.addEventListener('click', function (e) {
                e.preventDefault();
                var targetId = a.getAttribute('data-target');
                if (targetId) showPanel(targetId, a);
                });
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
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- TomSelect
            document.querySelectorAll('select.tomselect').forEach(function (el) {
                new TomSelect(el, {
                    create: false,
                    sortField: { field: "text", direction: "asc" }
                });
            });

            const cleaveMap = new WeakMap();

            document.querySelectorAll('input.rupiah').forEach(function (el) {
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
                cleaveMap.set(el, instance);
            });

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
@endpush
@endsection
