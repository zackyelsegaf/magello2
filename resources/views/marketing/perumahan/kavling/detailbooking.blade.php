@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Detail Booking a/n {{ $konsumen->nama_konsumen }}</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('booking/detail', $detailBooking->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 d-none">
                    <label for="metode_pembayaran" class="form-label fw-bold">Metode Pembayaran</label>
                    <select class="tomselect @error('metode_pembayaran') is-invalid @enderror" name="metode_pembayaran" id="metode_pembayaran_id" data-placeholder="Pilih Metode Pembayaran...">
                        <option selected disabled>-- Siklus Pembayaran --</option>
                        <option value="Cash Keras" {{ old('metode_pembayaran', $detailBooking->metode_pembayaran) == 'Cash Keras' ? 'selected' : '' }}>Cash Keras</option>
                        <option value="Cash Bertahap" {{ old('metode_pembayaran', $detailBooking->metode_pembayaran) == 'Cash Bertahap' ? 'selected' : '' }}>Cash Bertahap</option>
                        <option value="KPR" {{ old('metode_pembayaran', $detailBooking->metode_pembayaran) == 'KPR' ? 'selected' : '' }}>KPR</option>
                    </select>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#biayakonsumen">Biaya</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Persyaratan Dokumen</a>
                            </li>
                        </ul>
                    </div>
                    <div id="biayakonsumen" class="tab-pane fade show active mt-3">
                        <div id="biaya_konsumen_1" class="row mb-5">
                            <div id="bk_0" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Booking Fee</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->booking_fee ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                            <div id="bk_1" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Uang Muka</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->uang_muka ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                            <div id="bk_2" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Biaya Administrasi</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->biaya_administrasi ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                            <div id="bk_3" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Biaya Akad Kredit</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->biaya_akad_kredit ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                            <div id="bk_4" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Biaya Kelebihan Tanah</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->biaya_kelebihan_tanah ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                            <div id="bk_5" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Biaya Penambahan Bangunan</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->biaya_penambahan_bangunan ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                            <div id="bk_6" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Biaya Lainnya</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->biaya_lainnya ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                            <div id="bk_7" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Biaya Penambahan Fasilitas</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->biaya_penambahan_fasilitas ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                            <div id="bk_8" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Penerimaan KPR dari Bank</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->penerimaan_kpr ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                            <div id="bk_9" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Total Penjualan Cash</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->total_penjualan_cash ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                            <div id="bk_10" class="col-md-6 mt-2 py-2">
                                <label for="blok" class="form-label fw-bold"><strong>Cicilan Cash (Bertahap)</strong></label>
                                <h4 class="text-secondary">{{ 'Rp ' . number_format($costs->cicilan_cash ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h4>
                            </div>
                        </div>
                    </div>
                    <div id="dokumen" class="tab-pane fade mt-3">
                        <div class="card">
                            <div class="card-header bg-transparent">
                                <h5 class="font-weight-bold"><i class="fas fa-money-bill-wave mr-3"></i>Metode Pembayaran: {{ $detailBooking->metode_pembayaran ?? '-' }}</h5>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-borderless mb-0 align-middle" id="dokumenTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th style="width:10%;">Nama Dokumen</th>
                                                <th style="width:10%;">Status</th>
                                                <th style="width:15%;">File Terbaru</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($jenisDokumen as $jenis)
                                                @php
                                                    $dok = $dokumenByJenis->get($jenis->id);
                                                    $hasFiles = $dok && $dok->files && $dok->files->count() > 0;
                                                    $latest = $hasFiles ? $dok->files->first() : null;
                                                @endphp
                                                <tr>
                                                    <td class="py-2"><strong>{{ $jenis->nama }}</strong></td>
                                                    <td class="py-2">
                                                        @if ($dok && $dok->is_submitted)
                                                            <span class="badge badge-success mb-2"><i class="fas fa-check mr-2"></i>Diupload</span>
                                                            @if ($dok->submitted_at)
                                                                <div class="font-weight-bold">
                                                                    {{ \Illuminate\Support\Carbon::parse($dok->submitted_at)->locale('id')->isoFormat('dddd, D MMMM Y') }}
                                                                </div>
                                                            @endif
                                                        @else
                                                            <span class="badge badge-secondary">Belum Upload Persyaratan</span>
                                                        @endif
                                                    </td>
                                                    <td class="py-2">
                                                        @if ($latest)
                                                            @php
                                                                $url = $latest->url ?? ($latest->file_arsip ? asset('storage/'.$latest->file_arsip) : null);
                                                            @endphp
                                                            <a href="{{ $url }}" class="btn btn-primary buttonedit-sm" target="_blank">
                                                                <i class="fas fa-file-pdf mr-2"></i>Download File
                                                                {{-- {{ $latest->original_name ?? 'Lihat File' }} --}}
                                                            </a>
                                                            {{-- <div class="text-muted small">
                                                                {{ $latest->mime_type ?? '-' }} •
                                                                {{ number_format(($latest->file_size ?? 0)/1024, 0) }} KB
                                                                @if($latest->tanggal_arsip)
                                                                    • {{ \Illuminate\Support\Carbon::parse($latest->tanggal_arsip)->isoFormat('D MMM Y') }}
                                                                @endif
                                                            </div> --}}
                                                        @else
                                                            <span class="font-weight-bold">Tidak ada file</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @if ($jenisDokumen->isEmpty())
                                                <tr><td colspan="4" class="text-center text-muted py-4">Tidak ada jenis dokumen untuk metode ini.</td></tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <a href="{{ route('booking/list/page') }}" class="btn btn-primary buttonedit">
                            <i class="fas fa-chevron-left mr-2"></i> Kembali
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')
    <script>    
        $(document).ready(function () {
            $('#tambahBarangBtn').click(function () {
                let row = $('.barang-row:first').clone();
    
                row.find('select').val('');
                row.find('input').val('');
                $('#barangTableBody').append(row);
            });
    
            $(document).on('change', '.no-barang-select', function () {
                let selected = $(this).find(':selected');
                let row = $(this).closest('tr');
    
                row.find('.deskripsi-barang-input').val(selected.data('nama'));
                row.find('.kts-barang-input').val(selected.data('kts'));
                row.find('select[name="satuan[]"]').val(selected.data('satuan'));
            });
    
            $(document).on('click', '.remove-row', function () {
                if ($('#barangTableBody .barang-row').length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert("Minimal satu barang harus ada.");
                }
            });
        });
    </script>
    <script>
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
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fee = document.getElementById('booking_fee');
            const ids = ['diskon_cb_0', 'jadwal_cb_0'];
            const tabDataLink = document.getElementById('diskon_0');
            const tabBookingLink = document.getElementById('jadwal_tabel_0');

            function guard(e){
                if (!(fee.value || '').trim() || fee.value === '0') {
                e.preventDefault();
                e.currentTarget.checked = false;
                Swal.fire({
                    icon: 'error',
                    text: 'Silakan isi Booking Fee terlebih dahulu!',
                    confirmButtonColor: '#8c54ff',
                    timer: 2500,
                    showConfirmButton: true
                });
                if (tabDataLink) new bootstrap.Tab(tabDataLink).show?.();
                fee.focus();
                } else if (tabBookingLink) {
                new bootstrap.Tab(tabBookingLink).show?.();
                }
            }

            ids.forEach(id => document.getElementById(id)?.addEventListener('click', guard));
        });
    </script> --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Uncheck semua checkbox di blok yg field nominal-nya kosong/0 saat load
            document.querySelectorAll('[id^="bk_"]').forEach(wrap => {
                const field = wrap.querySelector('input[type="text"]');
                if (!field || !(field.value || '').trim() || field.value === '0') {
                wrap.querySelectorAll('.custom-control-input').forEach(cb => cb.checked = false);
                }
            });

            // Cekal centang jika nominal belum diisi (berlaku untuk semua checkbox di setiap bk_*)
            document.querySelectorAll('[id^="bk_"] .custom-control-input').forEach(cb => {
                cb.addEventListener('click', function (e) {
                const wrap  = e.currentTarget.closest('[id^="bk_"]');
                const field = wrap.querySelector('input[type="text"]'); // ambil input nominal di blok tsb
                const val   = (field && field.value || '').trim();

                if (!val || val === '0') {
                    e.preventDefault();
                    e.currentTarget.checked = false;
                    Swal.fire({
                    icon: 'error',
                    text: 'Silakan isi nominal terlebih dahulu!',
                    confirmButtonColor: '#8c54ff',
                    timer: 2500,
                    showConfirmButton: true
                    });
                    field && field.focus();
                }
                });
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[id^="bk_"]').forEach(w => {
                const f = w.querySelector('input[type="text"]');
                if (!f || !f.value.trim() || f.value.trim() === '0') {
                w.querySelectorAll('.custom-control-input').forEach(cb => cb.checked = false);
                }
            });

            document.addEventListener('click', e => {
                if (!e.target.classList.contains('custom-control-input')) return;

                const w = e.target.closest('[id^="bk_"]');
                const f = w && w.querySelector('input[type="text"]');

                if (!f || !f.value.trim() || f.value.trim() === '0') {
                e.preventDefault();
                e.target.checked = false;
                Swal.fire({
                    icon: 'error',
                    text: 'Silakan isi nominal terlebih dahulu!',
                    confirmButtonColor: '#8c54ff',
                    timer: 2500,
                    showConfirmButton: true
                });
                f && f.focus();
                }
            });
        });
    </script>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox_diskon = document.getElementById("diskon_cb_0");
            const diskonInput = document.getElementById("diskon_0");
            const checkbox_jadwal = document.getElementById("jadwal_cb_0");
            const jadwalTabel = document.getElementById("jadwal_tabel_0");

            function toggleDiskonInput() {
                if (checkbox_diskon.checked) {
                    diskonInput.style.display = "block";
                } else {
                    diskonInput.style.display = "none";
                }
            }

            function toggleJadwalTabel() {
                if (checkbox_jadwal.checked) {
                    jadwalTabel.style.display = "block";
                } else {
                    jadwalTabel.style.display = "none";
                }
            }

            toggleDiskonInput();
            toggleJadwalTabel();

            checkbox_diskon.addEventListener("change", toggleDiskonInput);
            checkbox_jadwal.addEventListener("change", toggleJadwalTabel);
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const show = (el, on) => { if (el) el.style.display = on ? 'block' : 'none'; };
            document.querySelectorAll('[id^="diskon_cb_"]').forEach(cb => {
                const i = cb.id.replace('diskon_cb_', '');
                const target = document.getElementById('diskon_' + i);
                const sync = () => show(target, cb.checked);
                sync();
                cb.addEventListener('change', sync);
            });

            document.querySelectorAll('[id^="jadwal_cb_"]').forEach(cb => {
                const i = cb.id.replace('jadwal_cb_', '');
                const target = document.getElementById('jadwal_tabel_' + i);
                const sync = () => show(target, cb.checked);
                sync();
                cb.addEventListener('change', sync);
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
