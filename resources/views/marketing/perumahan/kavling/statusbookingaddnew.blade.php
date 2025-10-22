@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Kavling</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('form/booking/update/save', $kavling->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="konsumen" class="form-label fw-bold">Konsumen</label>
                    <select class="tomselect @error('konsumen_id') is-invalid @enderror" name="konsumen_id" id="konsumen" data-placeholder="Pilih konsumen...">
                        <option {{ old('konsumen_id') ? '' : 'selected' }} disabled></option>
                        @foreach ($konsumen as $items )
                        <option value="{{ $items->id }}" {{ old('konsumen_id') == $items->id ? 'selected' : '' }}>{{ $items->nama_1 }}</option>
                        @endforeach
                    </select>
                    @error('konsumen_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="kapling" class="form-label fw-bold">Kapling</label>
                    <select class="tomselect @error('kapling_id') is-invalid @enderror" name="kapling_id" data-placeholder="Pilih Kapling">
                        @foreach($cluster as $clusterId => $items)
                            <optgroup class="font-weight-bold" label="{{ $items->first()->nama_cluster }}">
                                @foreach($items as $k)
                                    @if($k->kapling_id)
                                        <option value="{{ $k->kapling_id }}" {{ old('kapling_id', $kavling->id) == $k->kapling_id ? 'selected' : '' }}>
                                            {{ $k->nama_cluster }} - {{ $k->blok_kapling }} / {{ $k->nomor_unit_kapling }}
                                        </option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('kapling_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="nomor_booking" class="form-label fw-bold">Nomor Booking</label>
                    <input type="text" id="nomor_booking" class="form-control form-control-sm font-weight-bold" value="{{ $nomorPreview }}" readonly>
                </div>
                <div class="mb-3" style="display: none;">
                    <label for="status_pengajuan" class="form-label fw-bold">Status Pengajuan</label>
                    <input type="text" id="status_pengajuan" name="status_pengajuan" class="form-control form-control-sm font-weight-bold" value="Booking" readonly>
                </div>
                <div class="mb-3">
                    <label for="tanggal_booking" class="form-label fw-bold">Tanggal Booking</label>
                    <input type="text" id="tanggal_booking" name="tanggal_booking" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_booking') }}">
                    {{-- @error('tanggal_booking')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror --}}
                </div>
                <div class="mb-3">
                    <label for="metode_pembayaran" class="form-label fw-bold">Metode Pembayaran</label>
                    <select class="tomselect @error('metode_pembayaran') is-invalid @enderror" name="metode_pembayaran" id="metode_pembayaran_id" data-placeholder="Pilih Metode Pembayaran...">
                        <option value="">-- Siklus Pembayaran --</option>
                        <option value="Cash Keras" {{ old('metode_pembayaran') == 'Cash Keras' ? 'selected' : '' }}>Cash Keras</option>
                        <option value="Cash Bertahap" {{ old('metode_pembayaran') == 'Cash Bertahap' ? 'selected' : '' }}>Cash Bertahap</option>
                        <option value="KPR" {{ old('metode_pembayaran') == 'KPR' ? 'selected' : '' }}>KPR</option>
                    </select>
                    @error('metode_pembayaran')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#biayakonsumen">Biaya Konsumen</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen Persyaratan</a>
                            </li>
                        </ul>
                    </div>
                    <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert">
                        <i class="fa fa-exclamation-triangle mr-2"></i><strong>Halo {{ Auth::user()->name }}, </strong> Silahkan pilih metode pembayaran terlebih dahulu!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div id="biayakonsumen" class="tab-pane fade show active mt-3">
                        @foreach(collect($jenisBiaya)->chunk(2) as $pair)
                            <div class="row">
                                @foreach($pair as $jb)
                                    @php
                                        $prefix = "costs.{$jb->id}";
                                        $existing = isset($booking)
                                        ? optional($booking->costs->firstWhere('jenis_biaya_id', $jb->id))
                                        : null;
                                        $rows = old("costs.{$jb->id}.schedules", $existing?->schedules?->map(fn($s)=>[
                                            'due_date'=>$s->tanggal_bayar, 'amount'=>$s->nominal_pembayaran
                                        ])->toArray() ?? []);
                                    @endphp

                                    <div class="col-md-6 mt-2 py-2" data-biaya-id="{{ $jb->id }}">
                                        <label class="form-label fw-bold"><strong>{{ $jb->nama }}</strong></label>
                                        <input type="text" class="form-control form-control-sm mb-1 rupiah" name="costs[{{ $jb->id }}][amount]" value="{{ old("$prefix.amount", $existing->nominal_biaya ?? 0) }}" placeholder="0">
                                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="diskon_cb_{{ $jb->id }}" name="costs[{{ $jb->id }}][use_discount]" value="1" {{ old("$prefix.use_discount", $existing->use_diskon ?? false) ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="diskon_cb_{{ $jb->id }}">Buat Diskon {{ $jb->nama }}</label>
                                        </div>
                                        <input type="text" class="form-control form-control-sm mb-2" name="costs[{{ $jb->id }}][discount]" value="{{ old("$prefix.discount", $existing->nominal_diskon ?? '') }}" placeholder="Nominal diskon">
                                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="jadwal_cb_{{ $jb->id }}" name="costs[{{ $jb->id }}][use_schedule]" value="1" {{ old("$prefix.use_schedule", $existing->use_jadwal ?? false) ? 'checked' : '' }} data-target="#jadwal_tabel_{{ $jb->id }}">
                                            <label class="custom-control-label" for="jadwal_cb_{{ $jb->id }}">
                                                Buat Jadwal Pembayaran {{ $jb->nama }}
                                            </label>
                                        </div>
                                        <div id="jadwal_tabel_{{ $jb->id }}" style="{{ count($rows)?'':'display:none' }}">
                                            <div class="row float-right mr-0">
                                                <button type="button" class="btn btn-primary buttonedit-sm mb-2 add-row" data-ct="{{ $jb->id }}"><strong><i class="fas fa-plus mr-2 ml-1"></i></strong>Tambah</button>
                                            </div>
                                            <div class="table-responsive mt-2">
                                                <table class="table table-striped table-bordered table-hover table-center mb-0">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Tanggal</th>
                                                            <th>Nominal</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="apalah" class="schedule-body" data-ct="{{ $jb->id }}">
                                                        @foreach($rows as $i => $r)
                                                        <tr class="barang-row">
                                                            <td><input type="date" class="form-control form-control-sm" name="costs[{{ $jb->id }}][schedules][{{ $i }}][due_date]" value="{{ $r['due_date'] ?? '' }}"></td>
                                                            <td><input type="text" class="form-control form-control-sm rupiah" name="costs[{{ $jb->id }}][schedules][{{ $i }}][amount]" value="{{ $r['amount'] ?? '' }}"></td>
                                                            <td style="width: 80px;"><button style="width: 100px;" type="button" class="btn btn-primary buttonedit2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                @if($pair->count() === 1)
                                    <div class="col"></div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <div id="dokumen" class="tab-pane fade mt-3">
                        @php $i = 1; @endphp
                            @foreach(collect($jenisDokumen)->chunk(2) as $pair)
                                <div class="row mb-2">
                                    @foreach($pair as $jenis)
                                        <div class="col" data-jenis-id="{{ $jenis->id }}">
                                            <label class="mb-1"><strong>{{ $jenis->nama }}</strong></label>
                                            <div class="custom-file mb-3">
                                            <input type="hidden" name="jenis_dokumen_persyaratan_id_{{ $i }}" value="{{ $jenis->id }}">
                                            <input type="file" class="custom-file-input" id="file_arsip_{{ $i }}" name="file_arsip_{{ $i }}">
                                            <label class="custom-file-label" for="file_arsip_{{ $i }}">Pilih File</label>
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                    @endforeach
                                </div>
                            @endforeach
                        <input type="hidden" name="arsip_counter" value="{{ $i - 1 }}">
                    </div>
                </div>
                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check mr-2"></i> Simpan
                        </button>
                        <a href="{{ route('kavling/list/page') }}" class="btn btn-primary ml-3">
                            <i class="fas fa-chevron-left mr-2"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    {{-- <script>    
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
    </script> --}}
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
        window.DOKUMEN_SHOW_IDS = @json($showIdsByMetode ?? []);
    </script>
    <script>
        window.BIAYA_SHOW_IDS = @json($showIdsByBiaya ?? []);
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const select  = document.getElementById('metode_pembayaran_id');
            const items   = document.querySelectorAll('[data-jenis-id]');
            const items1   = document.querySelectorAll('[data-biaya-id]');
            const show    = el => { if (el && el.style) el.style.display = ''; };
            const hide    = el => { if (el && el.style) el.style.display = 'none'; };

            function applyByMetode(val) {
                const allowed = (window.DOKUMEN_SHOW_IDS && window.DOKUMEN_SHOW_IDS[val]) || [];
                items.forEach(el => {
                const id = parseInt(el.getAttribute('data-jenis-id'), 10);
                if (!val || !allowed.length) return hide(el);
                allowed.includes(id) ? show(el) : hide(el);
                });
            }

            function applyByBiaya(val) {
                const allowed = (window.BIAYA_SHOW_IDS && window.BIAYA_SHOW_IDS[val]) || [];
                items1.forEach(el => {
                const id = parseInt(el.getAttribute('data-biaya-id'), 10);
                if (!val || !allowed.length) return hide(el);
                allowed.includes(id) ? show(el) : hide(el);
                });
            }

            function apply() {
                let val = '';
                if (!select) return;
                if (select.tomselect && typeof select.tomselect.getValue === 'function') {
                val = select.tomselect.getValue(); // TomSelect
                } else {
                val = select.value; // native
                }
                applyByMetode((val || '').trim());
                applyByBiaya((val || '').trim());
            }

            if (select) {
                const ts = select.tomselect || null;
                if (ts && typeof ts.on === 'function') {
                ts.on('change', apply);
                setTimeout(apply, 0); // initial setelah TomSelect set value
                } else {
                select.addEventListener('change', apply);
                apply(); // initial
                }
            }
        });
    </script>

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
    {{-- <script>
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
    </script> --}}
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
    {{-- <script>
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
    <script>
        document.addEventListener('click', function(e){
            if (e.target.matches('.add-row')) {
                const ct = e.target.getAttribute('data-ct');
                const tbody = document.querySelector(`.schedule-body[data-ct="${ct}"]`);
                const idx = tbody.querySelectorAll('tr').length;
                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td><input type="text" class="form-control form-control-sm datetimepicker"
                    name="costs[${ct}][schedules][${idx}][due_date]"></td>
                <td><input type="text" class="form-control form-control-sm"
                    name="costs[${ct}][schedules][${idx}][amount]"></td>
                <td style="width: 80px;"><button style="width: 100px;" type="button" class="btn btn-sm btn-danger buttonedit2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i></strong>Hapus</button></td>`;
                tbody.appendChild(tr);
            }
            if (e.target.matches('.remove-row')) {
                e.target.closest('tr').remove();
            }
            if (e.target.matches('input[id^="jadwal_cb_"]')) {
                const target = document.querySelector(e.target.dataset.target);
                if (target) target.style.display = e.target.checked ? '' : 'none';
            }
        }, false);
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            function getDiscountInput(cb) {
                const group = cb.closest('.custom-control');
                let el = group ? group.nextElementSibling : null;
                while (el && !(el.tagName === 'INPUT' && el.type === 'text')) {
                el = el.nextElementSibling;
                }
                return el;
            }

            function toggleDiscount(cb) {
                const input = getDiscountInput(cb);
                if (!input) return;
                input.style.display = cb.checked ? 'block' : 'none';
            }

            function getTargetEl(cb) {
                const sel = cb.getAttribute('data-target');
                return sel ? document.querySelector(sel) : null;
            }

            function toggleSchedule(cb) {
                const box = getTargetEl(cb);
                if (!box) return;
                const tbody = box.querySelector('tbody.schedule-body');
                const hasRows = tbody && tbody.querySelectorAll('tr').length > 0;
                box.style.display = (cb.checked || hasRows) ? 'block' : 'none';
            }

            function nextScheduleIndex(tbody) {
                return tbody.querySelectorAll('tr').length;
            }

            function initDateTimePicker(scope) {
                if (window.$ && typeof $.fn.datetimepicker === 'function') {
                const $scope = scope ? $(scope) : $(document);
                $scope.find('.datetimepicker').each(function(){ 
                    try { $(this).datetimepicker(); } catch(e) {}
                });
                }
            }

            document.querySelectorAll('input[id^="diskon_cb_"]').forEach(function (cb) {
                toggleDiscount(cb);
                cb.addEventListener('change', function () { toggleDiscount(cb); });
            });

            document.querySelectorAll('input[id^="jadwal_cb_"]').forEach(function (cb) {
                toggleSchedule(cb);
                cb.addEventListener('change', function () { toggleSchedule(cb); });
            });

            document.addEventListener('click', function (e) {
                const addBtn = e.target.closest('.add-row');
                if (!addBtn) return;

                const ct = addBtn.getAttribute('data-ct'); 
                const box = document.querySelector('#jadwal_tabel_' + ct);
                if (!box) return;

                const tbody = box.querySelector('tbody.schedule-body[data-ct="' + ct + '"]');
                if (!tbody) return;

                const idx = nextScheduleIndex(tbody);

                const tr = document.createElement('tr');
                tr.innerHTML = `
                <td>
                    <input type="date" class="form-control form-control-sm"
                        name="costs[${ct}][schedules][${idx}][due_date]" value="">
                </td>
                <td>
                    <input type="text" class="form-control form-control-sm rupiah"
                        name="costs[${ct}][schedules][${idx}][amount]" value="">
                </td>
                <td style="width: 80px;">
                    <button type="button" class="btn btn-primary buttonedit2 remove-row" style="width: 100px;">
                    <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                    </button>
                </td>
                `;

                tbody.appendChild(tr);

                box.style.display = 'block';

                initDateTimePicker(tr);

                initCleaveIn(tr);
            });

            document.addEventListener('click', function (e) {
                const rmBtn = e.target.closest('.remove-row');
                if (!rmBtn) return;

                const tr = rmBtn.closest('tr');
                const tbody = tr && tr.parentElement;
                const box = tr && tr.closest('[id^="jadwal_tabel_"]');

                if (tr) tr.remove();

                if (box) {
                const cbId = box.id.replace('jadwal_tabel_', 'jadwal_cb_');
                const cb = document.getElementById(cbId);
                const hasRows = tbody && tbody.querySelectorAll('tr').length > 0;
                if (cb && !cb.checked && !hasRows) {
                    box.style.display = 'none';
                }
                }
            });

            initDateTimePicker();
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
