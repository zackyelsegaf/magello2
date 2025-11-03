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
                        <h5 class="m-0 text-info"><i class="fas fa-user mr-2 my-0 text-info h4"></i> Detail Pembayaran a/n {{  $detailBooking->konsumen->nama_1 }}</h5>
                    </div>
                </div>
                <div class="col-md-6 px-3">
                    <div class="p-3 mb-3 bg-info-card my-rounded-2">
                        <h5 class="m-0 text-info"><i class="fas fa-money-bill-wave mr-2 my-0 text-info h4"></i> Metode Pembayaran: {{ $detailBooking->metode_pembayaran }}</h5>
                    </div>
                </div>
                <div class="col-md-4 px-3">
                    <div class="my-rounded-2 mb-lg-3">
                        <div class="col-md-12 p-2 bg-info-card my-rounded-2">
                            <div class="d-flex align-items-center flex-nowrap my-rounded-2 p-3">
                                <div class="w-100">
                                    <div class="dash-widget-header">
                                        <div>
                                            @php
                                                $sumFields = [
                                                    'booking_fee',
                                                    'biaya_lainnya',
                                                    'total_penjualan_cash',
                                                    'uang_muka',
                                                    'biaya_administrasi',
                                                    'biaya_akad_kredit',
                                                    'biaya_kelebihan_tanah',
                                                    'biaya_penambahan_bangunan',
                                                    'biaya_penambahan_fasilitas',
                                                    'cicilan_cash',
                                                    'penerimaan_kpr'
                                                ];
                                                $grandTotal = 0;
                                                foreach ($sumFields as $f) {
                                                    $grandTotal += (int)($costs->{$f} ?? 0);
                                                }
                                            @endphp
                                            <h3 class="font-weight-bold text-info">{{ 'Rp ' . number_format($grandTotal, 0, '.', ',') ?? 'Rp 0' }}</h3>
                                            <h5 class="text-info">Total Piutang</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-inline-flex align-items-center justify-content-center rounded pt-3 px-4 text-white">
                                    <div class="timeline-icons">
                                        <h2><i class="fas fa-calculator text-info"></i></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 px-3">
                    <div class="my-rounded-2 mb-lg-3">
                        <div class="col-md-12 p-2 bg-success-card my-rounded-2">
                            <div class="d-flex align-items-center flex-nowrap my-rounded-2 p-3">
                                <div class="w-100">
                                    <div class="dash-widget-header">
                                        <div>
                                            {{-- @php
                                                $sumFields = [
                                                    'booking_fee',
                                                    'biaya_lainnya',
                                                    'total_penjualan_cash',
                                                    'uang_muka',
                                                    'biaya_administrasi',
                                                    'biaya_akad_kredit',
                                                    'biaya_kelebihan_tanah',
                                                    'biaya_penambahan_bangunan',
                                                    'biaya_penambahan_fasilitas',
                                                    'cicilan_cash',
                                                    'penerimaan_kpr'
                                                ];
                                                $grandTotal = 0;
                                                foreach ($sumFields as $f) {
                                                    $grandTotal += (int)($costs->{$f} ?? 0);
                                                }
                                            @endphp --}}
                                            <h3 class="font-weight-bold text-success">{{ 'Rp ' . number_format($totalPembayaran, 0, '.', ',') ?? 'Rp 0' }}</h3>
                                            <h5 class="text-success">Pembayaran</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-inline-flex align-items-center justify-content-center rounded pt-3 px-4 text-white">
                                    <div class="timeline-icons">
                                        <h2><i class="fas fa-clipboard-check text-success"></i></h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 px-3">
                    <div class="my-rounded-2">
                        <div class="col-md-12 p-2 bg-danger-card my-rounded-2">
                            <div class="d-flex align-items-center flex-nowrap my-rounded-2 p-3">
                                <div class="w-100">
                                    <div class="dash-widget-header">
                                        <div>
                                            {{-- @php
                                                $sumFields = [
                                                    'booking_fee',
                                                    'biaya_lainnya',
                                                    'total_penjualan_cash',
                                                    'uang_muka',
                                                    'biaya_administrasi',
                                                    'biaya_akad_kredit',
                                                    'biaya_kelebihan_tanah',
                                                    'biaya_penambahan_bangunan',
                                                    'biaya_penambahan_fasilitas',
                                                    'cicilan_cash',
                                                    'penerimaan_kpr'
                                                ];
                                                $grandTotal = 0;
                                                foreach ($sumFields as $f) {
                                                    $grandTotal += (int)($costs->{$f} ?? 0);
                                                }
                                            @endphp --}}
                                            <h3 class="font-weight-bold text-danger">{{ 'Rp ' . number_format($sisaHutang, 0, '.', ',') ?? 'Rp 0' }}</h3>
                                            <h5 class="text-danger">Sisa Hutang</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-inline-flex align-items-center justify-content-center rounded pt-3 px-4 text-white">
                                    <div class="timeline-icons">
                                        <h2><i class="fas fa-coins text-danger"></i></h2>
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
                                    <label for="biaya_pembayaran_ids" class=""><h5>Pilih Pembayaran :</h5></label>
                                    <select class="tomselect @error('jenis_biaya_konsumen_id') is-invalid @enderror" name="jenis_biaya_konsumen_id" id="biaya_pembayaran_ids">
                                        <option {{ old('jenis_biaya_konsumen_id') ? '' : 'selected' }} disabled>--Status Pengajuan--</option>
                                        @foreach ($biaya_pembayaran as $items )
                                            <option value="{{ $items->id }}" {{ old('jenis_biaya_konsumen_id') == $items->id ? 'selected' : '' }} 
                                                {{-- @if($items->id == 1) selected @endif --}}
                                                >{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            {{-- @php
                                $noJenis = (int)($tagihan0 ?? 0) === 0;
                            @endphp
                            @if($noJenis)
                                <div class="float-right mr-0 p-0" id="bk_0">
                                    <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_0_0_0">
                                        <strong><i class="fas fa-wallet mr-2 ml-1"></i>Booking Fee</strong>
                                    </button>
                                </div>
                            @else
                                <div class="col-md-6 float-right mr-0 p-0" id="bk_0">
                                    <div class="px-0">
                                        <div class="p-3 bg-secondary-card my-rounded-2">
                                            <h8 class="font-weight-bold m-0 text-secondary">
                                                <i class="fas mr-3 my-0 text-secondary fa-check-circle h6"></i>
                                                Lunas
                                            </h8>
                                        </div>
                                    </div>
                                </div>
                            @endif --}}
                            <div class="float-right mr-0 p-0" id="bk_0">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_0_0_0">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Booking Fee</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_1">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_1_1_1">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Administrasi</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_2">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_2_2_2">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Uang Muka</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_3">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_3_3_3">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Kelebihan Tanah</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_4">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_4_4_4">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Penambahan Bangunan</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_5">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_5_5_5">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Lainnya</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_6">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_6_6_6">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Total Penjualan Cash</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_7">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_7_7_7">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Cicilan Cash (Bertahap)</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_8">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_8_8_8">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Akad Kredit</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_9">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_9_9_9">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Penambahan Fasilitas</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_10">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_10_10_10">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Penerimaan KPR dari Bank</strong>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="my-rounded-2">
                        <div class="col-md-12 p-3 bg-white border my-rounded-2">
                            <div id="bk_0_0">
                                @foreach ($dataku1 as $detailBookingFee)
                                <div class="modal fade" id="modal-edit-bf-{{ $detailBookingFee->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditBF{{ $detailBookingFee->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold" id="modalEditBF{{ $detailBookingFee->id }}">
                                                    Edit Pembayaran — {{ $detailBookingFee->nomor_referensi }}
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran0.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pembayaran_id" value="{{ $detailBookingFee->id }}">
                                                <input type="hidden" name="jenis_id" value="0">
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Tanggal Pembayaran</label>
                                                        <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran', \Carbon\Carbon::parse($detailBookingFee->tanggal_pembayaran)->format('d/m/Y')) }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" value="{{ old('nominal_pembayaran', number_format((int)$detailBookingFee->nominal_pembayaran, 0, '.', '.')) }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ (old('akun_id', $detailBookingFee->akun_id)==$a->id) ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        @if(!empty($detailBookingFee->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($detailBookingFee->bukti_pembayaran);
                                                        @endphp
                                                            <div class="form-group mb-2">
                                                                <label class="fw-bold">Bukti Pembayaran</label>
                                                                <small class="d-block">
                                                                    <a class="btn btn-primary buttonedit-sm" href="{{ $url }}" target="_blank">
                                                                        <strong><i class="fas fa-eye mr-2"></i></strong>Lihat
                                                                    </a>
                                                                </small>
                                                            </div><br>
                                                        @endif
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label>Catatan</label>
                                                        <textarea name="catatan_pembayaran" rows="2" class="form-control" placeholder="opsional">{{ old('catatan_pembayaran', $detailBookingFee->catatan_pembayaran) }}</textarea>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="approve" id="approve_edit_{{ $detailBookingFee->id }}" value="1" class="custom-control-input" {{ old('approve', $detailBookingFee->is_approved) ? 'checked' : '' }}>
                                                            <label for="approve_edit_{{ $detailBookingFee->id }}" class="custom-control-label">
                                                                Sekaligus setujui (approve)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary buttonedit">
                                                        <i class="fas fa-save mr-2"></i>Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover m-0 p-0 separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku1 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        {{-- <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a> --}}
                                                        <a href="#modal-edit-bf-{{ $record->id }}" class="btn btn-primary buttonedit-sm" data-toggle="modal">
                                                            <i class="fas fa-edit mr-2 h7"></i>Edit
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h6 class="text-truncate text-center"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $noJenis = (int)($tagihan0 ?? 0) === 0;
                                @endphp
                                @if($noJenis)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-md-12 px-0">
                                            <div class="p-3 bg-secondary-card my-rounded-2 m-2">
                                                <div class="row pt-0 pl-2 pr-2 justify-content-between">
                                                    <div class="col">
                                                        <h8 class="font-weight-bold m-0 text-secondary">
                                                            <i class="fas fa-info-circle mr-3 h7"></i> Nilai kontrak belum diisi!
                                                        </h8>
                                                    </div>
                                                    <div class="col">
                                                        <a class="font-weight-bold text-secondary float-right" href="{{ route('booking/edit', $detailBooking->id) }}">
                                                            Detail Booking<i class="fas fa-chevron-circle-right ml-2 h7"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis0 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan0 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis0 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis0 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis0 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis0 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis0 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Booking Fee : ' . 'Rp ' . number_format($sisaPerJenis0 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="bk_1_1">
                                @foreach ($dataku2 as $detailBiayaAdministrasi)
                                <div class="modal fade" id="modal-edit-ba-{{ $detailBiayaAdministrasi->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEditBA{{ $detailBiayaAdministrasi->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold" id="modalEditBA{{ $detailBiayaAdministrasi->id }}">
                                                    Edit Pembayaran — {{ $detailBiayaAdministrasi->nomor_referensi }}
                                                </h6>
                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran0.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <input type="hidden" name="pembayaran_id" value="{{ $detailBiayaAdministrasi->id }}">
                                                <input type="hidden" name="jenis_id" value="0">
                                                <div class="modal-body">
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Tanggal Pembayaran</label>
                                                        <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran', \Carbon\Carbon::parse($detailBiayaAdministrasi->tanggal_pembayaran)->format('d/m/Y')) }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" value="{{ old('nominal_pembayaran', number_format((int)$detailBiayaAdministrasi->nominal_pembayaran, 0, '.', '.')) }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ (old('akun_id', $detailBiayaAdministrasi->akun_id)==$a->id) ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        @if(!empty($detailBiayaAdministrasi->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($detailBiayaAdministrasi->bukti_pembayaran);
                                                        @endphp
                                                            <div class="form-group mb-2">
                                                                <label class="fw-bold">Bukti Pembayaran</label>
                                                                <small class="d-block">
                                                                    <a class="btn btn-primary buttonedit-sm" href="{{ $url }}" target="_blank">
                                                                        <strong><i class="fas fa-eye mr-2"></i></strong>Lihat
                                                                    </a>
                                                                </small>
                                                            </div><br>
                                                        @endif
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label>Catatan</label>
                                                        <textarea name="catatan_pembayaran" rows="2" class="form-control" placeholder="opsional">{{ old('catatan_pembayaran', $detailBiayaAdministrasi->catatan_pembayaran) }}</textarea>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="approve" id="approve_edit_{{ $detailBiayaAdministrasi->id }}" value="1" class="custom-control-input" {{ old('approve', $detailBiayaAdministrasi->is_approved) ? 'checked' : '' }}>
                                                            <label for="approve_edit_{{ $detailBiayaAdministrasi->id }}" class="custom-control-label">
                                                                Sekaligus setujui (approve)
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary buttonedit">
                                                        <i class="fas fa-save mr-2"></i>Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku2 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        {{-- <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a>
                                                        @if(!empty($record->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($record->bukti_pembayaran);
                                                        @endphp
                                                            <a class="btn btn-primary buttonedit-sm ml-2" href="{{ $url }}" target="_blank">
                                                                <strong><i class="fas fa-receipt mr-2"></i></strong>Bukti
                                                            </a>
                                                            <a class="btn btn-primary buttonedit2-sm" href="{{ route('pembayaran/arsip/delete', $record->id) }}">
                                                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                            </a>
                                                        @endif --}}
                                                        <a href="#modal-edit-ba-{{ $record->id }}" class="btn btn-primary buttonedit-sm" data-toggle="modal">
                                                            <i class="fas fa-edit mr-2 h7"></i>Edit
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h6 class="text-truncate text-center"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $noJenis = (int)($tagihan1 ?? 0) === 0;
                                @endphp
                                @if($noJenis)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-md-12 px-0">
                                            <div class="p-3 bg-secondary-card my-rounded-2 m-2">
                                                <div class="row pt-0 pl-2 pr-2 justify-content-between">
                                                    <div class="col">
                                                        <h8 class="font-weight-bold m-0 text-secondary">
                                                            <i class="fas fa-info-circle mr-3 h7"></i> Nilai kontrak belum diisi!
                                                        </h8>
                                                    </div>
                                                    <div class="col">
                                                        <a class="font-weight-bold text-secondary float-right" href="{{ route('booking/edit', $detailBooking->id) }}">
                                                            Detail Booking<i class="fas fa-chevron-circle-right ml-2 h7"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis1 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan1 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis1 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis1 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis1 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis1 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis1 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Biaya Administrasi : ' . 'Rp ' . number_format($sisaPerJenis1 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="bk_2_2">
                                <div class="modal fade" id="bk_2_2_2" tabindex="-1" role="dialog" aria-labelledby="modalBiayaUangMuka" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Biaya Uang Muka</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran2.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="jenis_id" value="2">
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Tanggal Pembayaran</label>
                                                        <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" placeholder="contoh: 3.750.000" value="{{ old('nominal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ old('akun_id')==$a->id ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
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
                                                            <input type="checkbox" name="approve" id="approve_bum" value="1" class="custom-control-input" {{ old('approve') ? 'checked' : '' }}>
                                                            <label for="approve_bum" class="custom-control-label">Sekaligus setujui (approve)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaUangMuka" type="submit" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover m-0 p-0 separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku3 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a>
                                                        @if(!empty($record->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($record->bukti_pembayaran);
                                                        @endphp
                                                            <a class="btn btn-primary buttonedit-sm ml-2" href="{{ $url }}" target="_blank">
                                                                <strong><i class="fas fa-receipt mr-2"></i></strong>Bukti
                                                            </a>
                                                            {{-- <a class="btn btn-primary buttonedit2-sm" href="{{ route('pembayaran/arsip/delete', $record->id) }}">
                                                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                            </a> --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h6 class="text-truncate text-center"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $noJenis = (int)($tagihan2 ?? 0) === 0;
                                @endphp
                                @if($noJenis)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-md-12 px-0">
                                            <div class="p-3 bg-secondary-card my-rounded-2 m-2">
                                                <div class="row pt-0 pl-2 pr-2 justify-content-between">
                                                    <div class="col">
                                                        <h8 class="font-weight-bold m-0 text-secondary">
                                                            <i class="fas fa-info-circle mr-3 h7"></i> Nilai kontrak belum diisi!
                                                        </h8>
                                                    </div>
                                                    <div class="col">
                                                        <a class="font-weight-bold text-secondary float-right" href="{{ route('booking/edit', $detailBooking->id) }}">
                                                            Detail Booking<i class="fas fa-chevron-circle-right ml-2 h7"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis2 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan2 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis2 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis2 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis2 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis2 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis2 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Uang Muka : ' . 'Rp ' . number_format($sisaPerJenis2 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="bk_3_3">
                                <div class="modal fade" id="bk_3_3_3" tabindex="-1" role="dialog" aria-labelledby="modalBiayaKelebihanTanah" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Biaya Kelebihan Tanah</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran3.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="jenis_id" value="3">
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Tanggal Pembayaran</label>
                                                        <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" placeholder="contoh: 3.750.000" value="{{ old('nominal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ old('akun_id')==$a->id ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
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
                                                            <input type="checkbox" name="approve" id="approve_bkt" value="1" class="custom-control-input" {{ old('approve') ? 'checked' : '' }}>
                                                            <label for="approve_bkt" class="custom-control-label">Sekaligus setujui (approve)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaKelebihanTanah" type="submit" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover m-0 p-0 separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku4 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a>
                                                        @if(!empty($record->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($record->bukti_pembayaran);
                                                        @endphp
                                                            <a class="btn btn-primary buttonedit-sm ml-2" href="{{ $url }}" target="_blank">
                                                                <strong><i class="fas fa-receipt mr-2"></i></strong>Bukti
                                                            </a>
                                                            {{-- <a class="btn btn-primary buttonedit2-sm" href="{{ route('pembayaran/arsip/delete', $record->id) }}">
                                                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                            </a> --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h6 class="text-truncate text-center"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $noJenis = (int)($tagihan3 ?? 0) === 0;
                                @endphp
                                @if($noJenis)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-md-12 px-0">
                                            <div class="p-3 bg-secondary-card my-rounded-2 m-2">
                                                <div class="row pt-0 pl-2 pr-2 justify-content-between">
                                                    <div class="col">
                                                        <h8 class="font-weight-bold m-0 text-secondary">
                                                            <i class="fas fa-info-circle mr-3 h7"></i> Nilai kontrak belum diisi!
                                                        </h8>
                                                    </div>
                                                    <div class="col">
                                                        <a class="font-weight-bold text-secondary float-right" href="{{ route('booking/edit', $detailBooking->id) }}">
                                                            Detail Booking<i class="fas fa-chevron-circle-right ml-2 h7"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis3 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan3 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis3 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis3 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis3 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis3 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis3 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Biaya Kelebihan Tanah : ' . 'Rp ' . number_format($sisaPerJenis3 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="bk_4_4">
                                <div class="modal fade" id="bk_4_4_4" tabindex="-1" role="dialog" aria-labelledby="modalBiayaPenambahanBangunan" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Biaya Penambahan Bangunan</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran4.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
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
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ old('akun_id')==$a->id ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
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
                                                            <input type="checkbox" name="approve" id="approve_bpb" value="1" class="custom-control-input" {{ old('approve') ? 'checked' : '' }}>
                                                            <label for="approve_bpb" class="custom-control-label">Sekaligus setujui (approve)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaPenambahanBangunan" type="submit" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover m-0 p-0 separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku5 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a>
                                                        @if(!empty($record->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($record->bukti_pembayaran);
                                                        @endphp
                                                            <a class="btn btn-primary buttonedit-sm ml-2" href="{{ $url }}" target="_blank">
                                                                <strong><i class="fas fa-receipt mr-2"></i></strong>Bukti
                                                            </a>
                                                            {{-- <a class="btn btn-primary buttonedit2-sm" href="{{ route('pembayaran/arsip/delete', $record->id) }}">
                                                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                            </a> --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h6 class="text-truncate text-center"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $noJenis = (int)($tagihan4 ?? 0) === 0;
                                @endphp
                                @if($noJenis)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-md-12 px-0">
                                            <div class="p-3 bg-secondary-card my-rounded-2 m-2">
                                                <div class="row pt-0 pl-2 pr-2 justify-content-between">
                                                    <div class="col">
                                                        <h8 class="font-weight-bold m-0 text-secondary">
                                                            <i class="fas fa-info-circle mr-3 h7"></i> Nilai kontrak belum diisi!
                                                        </h8>
                                                    </div>
                                                    <div class="col">
                                                        <a class="font-weight-bold text-secondary float-right" href="{{ route('booking/edit', $detailBooking->id) }}">
                                                            Detail Booking<i class="fas fa-chevron-circle-right ml-2 h7"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis4 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan4 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis4 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis4 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis4 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis4 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis4 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Biaya Penambahan Bangunan : ' . 'Rp ' . number_format($sisaPerJenis4 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="bk_5_5">
                                <div class="modal fade" id="bk_5_5_5" tabindex="-1" role="dialog" aria-labelledby="modalBiayaLainnya" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Biaya Lainnya</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran5.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="jenis_id" value="5">
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Tanggal Pembayaran</label>
                                                        <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" placeholder="contoh: 3.750.000" value="{{ old('nominal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ old('akun_id')==$a->id ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
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
                                                            <input type="checkbox" name="approve" id="approve_bl" value="1" class="custom-control-input" {{ old('approve') ? 'checked' : '' }}>
                                                            <label for="approve_bl" class="custom-control-label">Sekaligus setujui (approve)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaLainnya" type="submit" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover m-0 p-0 separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku6 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a>
                                                        @if(!empty($record->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($record->bukti_pembayaran);
                                                        @endphp
                                                            <a class="btn btn-primary buttonedit-sm ml-2" href="{{ $url }}" target="_blank">
                                                                <strong><i class="fas fa-receipt mr-2"></i></strong>Bukti
                                                            </a>
                                                            {{-- <a class="btn btn-primary buttonedit2-sm" href="{{ route('pembayaran/arsip/delete', $record->id) }}">
                                                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                            </a> --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h6 class="text-truncate text-center"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $noJenis = (int)($tagihan5 ?? 0) === 0;
                                @endphp
                                @if($noJenis)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-md-12 px-0">
                                            <div class="p-3 bg-secondary-card my-rounded-2 m-2">
                                                <div class="row pt-0 pl-2 pr-2 justify-content-between">
                                                    <div class="col">
                                                        <h8 class="font-weight-bold m-0 text-secondary">
                                                            <i class="fas fa-info-circle mr-3 h7"></i> Nilai kontrak belum diisi!
                                                        </h8>
                                                    </div>
                                                    <div class="col">
                                                        <a class="font-weight-bold text-secondary float-right" href="{{ route('booking/edit', $detailBooking->id) }}">
                                                            Detail Booking<i class="fas fa-chevron-circle-right ml-2 h7"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis5 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan4 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis5 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis5 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis5 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis5 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis5 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Biaya Lainnya : ' . 'Rp ' . number_format($sisaPerJenis5 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="bk_6_6">
                                <div class="modal fade" id="bk_6_6_6" tabindex="-1" role="dialog" aria-labelledby="modalTotalPenjualanCash" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Total Penjualan Cash</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran6.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="jenis_id" value="6">
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Tanggal Pembayaran</label>
                                                        <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" placeholder="contoh: 3.750.000" value="{{ old('nominal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ old('akun_id')==$a->id ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
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
                                                            <input type="checkbox" name="approve" id="approve_tpc" value="1" class="custom-control-input" {{ old('approve') ? 'checked' : '' }}>
                                                            <label for="approve_tpc" class="custom-control-label">Sekaligus setujui (approve)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahTotalPenjualanCash" type="submit" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover m-0 p-0 separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku7 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a>
                                                        @if(!empty($record->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($record->bukti_pembayaran);
                                                        @endphp
                                                            <a class="btn btn-primary buttonedit-sm ml-2" href="{{ $url }}" target="_blank">
                                                                <strong><i class="fas fa-receipt mr-2"></i></strong>Bukti
                                                            </a>
                                                            {{-- <a class="btn btn-primary buttonedit2-sm" href="{{ route('pembayaran/arsip/delete', $record->id) }}">
                                                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                            </a> --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h6 class="text-truncate text-center"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $noJenis = (int)($tagihan6 ?? 0) === 0;
                                @endphp
                                @if($noJenis)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-md-12 px-0">
                                            <div class="p-3 bg-secondary-card my-rounded-2 m-2">
                                                <div class="row pt-0 pl-2 pr-2 justify-content-between">
                                                    <div class="col">
                                                        <h8 class="font-weight-bold m-0 text-secondary">
                                                            <i class="fas fa-info-circle mr-3 h7"></i> Nilai kontrak belum diisi!
                                                        </h8>
                                                    </div>
                                                    <div class="col">
                                                        <a class="font-weight-bold text-secondary float-right" href="{{ route('booking/edit', $detailBooking->id) }}">
                                                            Detail Booking<i class="fas fa-chevron-circle-right ml-2 h7"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis6 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan6 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis6 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis6 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis6 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis6 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis6 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Total Penjualan Cash : ' . 'Rp ' . number_format($sisaPerJenis6 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="bk_7_7">
                                <div class="modal fade" id="bk_7_7_7" tabindex="-1" role="dialog" aria-labelledby="modalLabelCicilanCash" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Cicilan Cash (Bertahap)</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran7.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="jenis_id" value="7">
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Tanggal Pembayaran</label>
                                                        <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" placeholder="contoh: 3.750.000" value="{{ old('nominal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ old('akun_id')==$a->id ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
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
                                                            <input type="checkbox" name="approve" id="approve_cc" value="1" class="custom-control-input" {{ old('approve') ? 'checked' : '' }}>
                                                            <label for="approve_cc" class="custom-control-label">Sekaligus setujui (approve)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahCicilanCash" type="submit" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover m-0 p-0 separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku8 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a>
                                                        @if(!empty($record->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($record->bukti_pembayaran);
                                                        @endphp
                                                            <a class="btn btn-primary buttonedit-sm ml-2" href="{{ $url }}" target="_blank">
                                                                <strong><i class="fas fa-receipt mr-2"></i></strong>Bukti
                                                            </a>
                                                            {{-- <a class="btn btn-primary buttonedit2-sm" href="{{ route('pembayaran/arsip/delete', $record->id) }}">
                                                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                            </a> --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h6 class="text-truncate text-center"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $noJenis = (int)($tagihan7 ?? 0) === 0;
                                @endphp
                                @if($noJenis)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-md-12 px-0">
                                            <div class="p-3 bg-secondary-card my-rounded-2 m-2">
                                                <div class="row pt-0 pl-2 pr-2 justify-content-between">
                                                    <div class="col">
                                                        <h8 class="font-weight-bold m-0 text-secondary">
                                                            <i class="fas fa-info-circle mr-3 h7"></i> Nilai kontrak belum diisi!
                                                        </h8>
                                                    </div>
                                                    <div class="col">
                                                        <a class="font-weight-bold text-secondary float-right" href="{{ route('booking/edit', $detailBooking->id) }}">
                                                            Detail Booking<i class="fas fa-chevron-circle-right ml-2 h7"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis7 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan7 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis7 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis7 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis7 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis7 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis7 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Cicilan Cash (Bertahap) : ' . 'Rp ' . number_format($sisaPerJenis7 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="bk_8_8">
                                <div class="modal fade" id="bk_8_8_8" tabindex="-1" role="dialog" aria-labelledby="modalLabelBiayaAkadKredit" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Biaya Akad Kredit</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran8.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="jenis_id" value="8">
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Tanggal Pembayaran</label>
                                                        <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" placeholder="contoh: 3.750.000" value="{{ old('nominal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ old('akun_id')==$a->id ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
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
                                                            <input type="checkbox" name="approve" id="approve_bak" value="1" class="custom-control-input" {{ old('approve') ? 'checked' : '' }}>
                                                            <label for="approve_bak" class="custom-control-label">Sekaligus setujui (approve)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaAkadKredit" type="submit" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover m-0 p-0 separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku9 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a>
                                                        @if(!empty($record->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($record->bukti_pembayaran);
                                                        @endphp
                                                            <a class="btn btn-primary buttonedit-sm ml-2" href="{{ $url }}" target="_blank">
                                                                <strong><i class="fas fa-receipt mr-2"></i></strong>Bukti
                                                            </a>
                                                            {{-- <a class="btn btn-primary buttonedit2-sm" href="{{ route('pembayaran/arsip/delete', $record->id) }}">
                                                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                            </a> --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h6 class="text-truncate text-center"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $isEmpty = blank($tagihan8) && blank($sisaPerJenis8);
                                @endphp

                                @if($isEmpty)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-12 px-0">
                                            <div class="p-3 bg-warning-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-warning">
                                                    <i class="fas fa-info-circle mr-3 h6"></i> Jenis tidak dipilih
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis8 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan8 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis8 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis8 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis8 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis8 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis8 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Biaya Akad Kredit : ' . 'Rp ' . number_format($sisaPerJenis8 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="bk_9_9">
                                <div class="modal fade" id="bk_9_9_9" tabindex="-1" role="dialog" aria-labelledby="modalLabelBiayaPenambahanFasilitas" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Biaya Penambahan Fasilitas</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran9.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="jenis_id" value="9">
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Tanggal Pembayaran</label>
                                                        <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" placeholder="contoh: 3.750.000" value="{{ old('nominal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ old('akun_id')==$a->id ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
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
                                                            <input type="checkbox" name="approve" id="approve_bpf" value="1" class="custom-control-input" {{ old('approve') ? 'checked' : '' }}>
                                                            <label for="approve_bpf" class="custom-control-label">Sekaligus setujui (approve)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaPenambahanFasilitas" type="submit" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover m-0 p-0 separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku10 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a>
                                                        @if(!empty($record->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($record->bukti_pembayaran);
                                                        @endphp
                                                            <a class="btn btn-primary buttonedit-sm ml-2" href="{{ $url }}" target="_blank">
                                                                <strong><i class="fas fa-receipt mr-2"></i></strong>Bukti
                                                            </a>
                                                            {{-- <a class="btn btn-primary buttonedit2-sm" href="{{ route('pembayaran/arsip/delete', $record->id) }}">
                                                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                            </a> --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="8"><h6 class="text-truncate text-center"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $noJenis = (int)($tagihan9 ?? 0) === 0;
                                @endphp
                                @if($noJenis)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-md-12 px-0">
                                            <div class="p-3 bg-secondary-card my-rounded-2 m-2">
                                                <div class="row pt-0 pl-2 pr-2 justify-content-between">
                                                    <div class="col">
                                                        <h8 class="font-weight-bold m-0 text-secondary">
                                                            <i class="fas fa-info-circle mr-3 h7"></i> Nilai kontrak belum diisi!
                                                        </h8>
                                                    </div>
                                                    <div class="col">
                                                        <a class="font-weight-bold text-secondary float-right" href="{{ route('booking/edit', $detailBooking->id) }}">
                                                            Detail Booking<i class="fas fa-chevron-circle-right ml-2 h7"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis9 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan9 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis9 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis9 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis9 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis9 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis9 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Biaya Penambahan Fasilitas : ' . 'Rp ' . number_format($sisaPerJenis9 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div id="bk_10_10">
                                <div class="modal fade" id="bk_10_10_10" tabindex="-1" role="dialog" aria-labelledby="modalLabelPenerimaanKpr" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Penerimaan KPR dari Bank</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="{{ route('booking.pembayaran-booking/payment.pembayaran10.store', ['id' => $detailBooking->id]) }}" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <input type="hidden" name="jenis_id" value="10">
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Tanggal Pembayaran</label>
                                                        <input type="text" name="tanggal_pembayaran" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_pembayaran" class="form-control form-control-sm rupiah" placeholder="contoh: 3.750.000" value="{{ old('nominal_pembayaran') }}">
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="fw-bold">Masuk ke Akun</label>
                                                        <select name="akun_id" class="tomselect">
                                                            @foreach($akun as $a)
                                                            <option value="{{ $a->id }}"
                                                                {{ old('akun_id')==$a->id ? 'selected' : '' }}>
                                                                {{ $a->no_akun }} — {{ $a->nama_akun_indonesia }}
                                                            </option>
                                                            @endforeach
                                                        </select>
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
                                                            <input type="checkbox" name="approve" id="approve_kpr" value="1" class="custom-control-input" {{ old('approve') ? 'checked' : '' }}>
                                                            <label for="approve_kpr" class="custom-control-label">Sekaligus setujui (approve)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahPenerimaanKpr" type="submit" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive pt-2 table-wrap">
                                    <table class="table table-borderless table-striped table-hover m-0 p-0 separates">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th id="th-1">No</th>
                                                <th>Nomor Referensi</th>
                                                <th>Tanggal Pembayaran</th>
                                                <th>Nominal Pembayaran</th>
                                                <th>Nama Akun</th>
                                                <th>Status</th>
                                                <th>Catatan</th>
                                                <th id="th-2">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody class="my-tbody-spacing">
                                            @forelse ($dataku11 as $key => $record)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $record->nomor_referensi }}</td>
                                                    <td>{{ $record->tanggal_pembayaran }}</td>
                                                    <td>
                                                        Rp {{ number_format($record->nominal_pembayaran ?? 0, 0, '.', ',') }}
                                                    </td>
                                                    <td>{{ $record->akun?->nama_akun_indonesia }}</td>
                                                    <td>
                                                        @if($record->is_approved)
                                                            <span class="badge badge-success">Disetujui oleh {{ $record->approvedByUser->name ?? '' }}</span>
                                                        @else
                                                            <span class="badge badge-secondary">Menunggu</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $record->catatan_pembayaran }}</td>
                                                    <td>
                                                        <a href="{{ route('booking/pembayaran-booking/payment/kwitansipdf', $record->id) }}" class="btn btn-primary ml-2 buttonedit-sm" target="_blank">
                                                            <i class="fas fa-receipt mr-2"></i> Invoice
                                                        </a>
                                                        @if(!empty($record->bukti_pembayaran))
                                                        @php
                                                            $url = Storage::url($record->bukti_pembayaran);
                                                        @endphp
                                                            <a class="btn btn-primary buttonedit-sm ml-2" href="{{ $url }}" target="_blank">
                                                                <strong><i class="fas fa-receipt mr-2"></i></strong>Bukti
                                                            </a>
                                                            {{-- <a class="btn btn-primary buttonedit2-sm" href="{{ route('pembayaran/arsip/delete', $record->id) }}">
                                                                <i class="fas fa-trash-alt mr-2"></i>Hapus
                                                            </a> --}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr><td><h6 class="text-truncate"><i class="fas fa-seedling mr-2"></i>Tidak ada data pembayaran.</h6></td></tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                @php
                                    $noJenis = (int)($tagihan10 ?? 0) === 0;
                                @endphp
                                @if($noJenis)
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="col-md-12 px-0">
                                            <div class="p-3 bg-secondary-card my-rounded-2 m-2">
                                                <div class="row pt-0 pl-2 pr-2 justify-content-between">
                                                    <div class="col">
                                                        <h8 class="font-weight-bold m-0 text-secondary">
                                                            <i class="fas fa-info-circle mr-3 h7"></i> Nilai kontrak belum diisi!
                                                        </h8>
                                                    </div>
                                                    <div class="col">
                                                        <a class="font-weight-bold text-secondary float-right" href="{{ route('booking/edit', $detailBooking->id) }}">
                                                            Detail Booking<i class="fas fa-chevron-circle-right ml-2 h7"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="row pt-2 pl-2 pr-2">
                                        <div class="{{ ($sisaPerJenis10 ?? 0) == 0 ? 'col-md-8 px-0' : 'col-md-5 px-0' }}">
                                            <div class="p-3 bg-success-card my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 text-success">
                                                    <i class="fas fa-handshake mr-3 my-0 text-success h6"></i>
                                                    Nilai Kontrak {{ 'Rp ' . number_format($tagihan10 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                        <div class="{{ ($sisaPerJenis10 ?? 0) == 0 ? 'col-md-4 px-0' : 'col-md-7 px-0' }}">
                                            <div class="p-3 {{ ($sisaPerJenis10 ?? 0) == 0 ? 'bg-success-card' : 'bg-danger-card' }} my-rounded-2 m-2">
                                                <h8 class="font-weight-bold m-0 {{ ($sisaPerJenis10 ?? 0) == 0 ? 'text-success' : 'text-danger' }}">
                                                    <i class="fas mr-3 my-0 {{ ($sisaPerJenis10 ?? 0) == 0 ? 'text-success fa-check-circle' : 'text-danger fa-hand-holding-usd' }} h6"></i>
                                                    {{ ($sisaPerJenis10 ?? 0) == 0 ? 'Lunas' : 'Sisa Piutang Penerimaan KPR dari Bank : ' . 'Rp ' . number_format($sisaPerJenis10 ?? 0, 0, '.', ',') }}
                                                </h8>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-header">
                <div class="mt-3 row align-items-center">
                    <div class="col">
                        <div class="">
                            <a href="{{ route('booking/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2">
                                <i class="fas fa-chevron-left mr-2"></i>Batal
                            </a>
                            {{-- <button type="submit" class="btn btn-primary buttonedit">
                                <i class="fas fa-save mr-2"></i>Update
                            </button> --}}
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
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#PembayaranBooking').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-booking-fee-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.bookingfee_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.bookingfee_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script> --}}
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#BiayaAdministrasiList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-biaya-administrasi-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.biayaAdministrasi_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.biayaAdministrasi_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script> --}}
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#UangMukaList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-uang-muka-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.bookingfee_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.bookingfee_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#BiayaKelebihanTanahList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-biaya-kelebihan-tanah-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.bookingfee_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.bookingfee_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#BiayaPenambahanBangunanList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-biaya-penambahan-bangunan-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.bookingfee_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.bookingfee_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#BiayaLainnyaList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-biaya-lainnya-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.bookingfee_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.bookingfee_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('select.tomselect').forEach(function (el) {
                new TomSelect(el,{
                    create: false
                });
            });
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const biayaPembayaranSelect = document.getElementById('biaya_pembayaran_ids');
            const bK_0 = document.getElementById('bk_0');
            const bK_1 = document.getElementById('bk_1');
            const bK_2 = document.getElementById('bk_2');
            const bK_3 = document.getElementById('bk_3');
            const bK_4 = document.getElementById('bk_4');
            const bK_5 = document.getElementById('bk_5');
            const bK_6 = document.getElementById('bk_6');
            const bK_7 = document.getElementById('bk_7');
            const bK_8 = document.getElementById('bk_8');
            const bK_9 = document.getElementById('bk_9');
            const bK_10 = document.getElementById('bk_10');
            const bK_0_0 = document.getElementById('bk_0_0');
            const bK_1_1 = document.getElementById('bk_1_1');
            const bK_2_2 = document.getElementById('bk_2_2');
            const bK_3_3 = document.getElementById('bk_3_3');
            const bK_4_4 = document.getElementById('bk_4_4');
            const bK_5_5 = document.getElementById('bk_5_5');
            const bK_6_6 = document.getElementById('bk_6_6');
            const bK_7_7 = document.getElementById('bk_7_7');
            const bK_8_8 = document.getElementById('bk_8_8');
            const bK_9_9 = document.getElementById('bk_9_9');
            const bK_10_10 = document.getElementById('bk_10_10');

            function toggleFields() {
                const selectedValue = biayaPembayaranSelect.value;

                if (selectedValue === '1') {
                    bK_0.style.display = '';
                    bK_0_0.style.display = '';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                } else if (selectedValue === '2') {
                    bK_0.style.display = 'none';
                    bK_0_0.style.display = 'none';
                    bK_1.style.display = '';
                    bK_1_1.style.display = '';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                } else if (selectedValue === '3') {
                    bK_0.style.display = 'none';
                    bK_0_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = '';
                    bK_2_2.style.display = '';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                } else if (selectedValue === '4') {
                    bK_0.style.display = 'none';
                    bK_0_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = '';
                    bK_3_3.style.display = '';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                } else if (selectedValue === '5') {
                    bK_0.style.display = 'none';
                    bK_0_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = '';
                    bK_4_4.style.display = '';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                } else if (selectedValue === '6') {
                    bK_0.style.display = 'none';
                    bK_0_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = '';
                    bK_5_5.style.display = '';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                } else if (selectedValue === '7') {
                    bK_0.style.display = 'none';
                    bK_0_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = '';
                    bK_6_6.style.display = '';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                } else if (selectedValue === '8') {
                    bK_0.style.display = 'none';
                    bK_0_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = '';
                    bK_7_7.style.display = '';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                } else if (selectedValue === '9') {
                    bK_0.style.display = 'none';
                    bK_0_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = '';
                    bK_8_8.style.display = '';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                } else if (selectedValue === '10') {
                    bK_0.style.display = 'none';
                    bK_0_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = '';
                    bK_9_9.style.display = '';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                } else if (selectedValue === '11') {
                    bK_0.style.display = 'none';
                    bK_0_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = '';
                    bK_10_10.style.display = '';
                } else {
                    bK_0.style.display = '';
                    bK_0_0.style.display = '';
                    bK_1.style.display = 'none';
                    bK_1_1.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_2_2.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_3_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_4_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_5_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_6_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_7_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_8_8.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_9_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    bK_10_10.style.display = 'none';
                }
            }
            biayaPembayaranSelect.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script>
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
@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    {{-- <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#TotalPenjualanCashList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-total-penjualan-cash-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.bookingfee_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.bookingfee_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#CicilanCashList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-cicilan-cash-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.bookingfee_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.bookingfee_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#BiayaAkadKreditList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-biaya-akad-kredit-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.bookingfee_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.bookingfee_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#BiayaPenambahanFasilitasList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-biaya-penambahan-fasilitas-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.bookingfee_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.bookingfee_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#PenerimaanKprList').DataTable({
                processing: true,
                serverSide: true,
                ordering: true,
                searching: false,
                ajax: {
                    url: "{{ route('get-penerimaan-kpr-data', ['id' => $detailBooking->id]) }}",
                    // data: function(d) {
                    //     d.nama = $('input[name=nama]').val(),
                    //     d.pemasok_id = $('input[name=pemasok_id]').val(),
                    //     d.mata_uang_id = $('select[name=mata_uang_id]').val(),
                    //     d.dihentikan = $('input[name=dihentikan]:checked').val();
                    // }
                },
                columns: [
                    {
                        data: 'nomor_referensi',
                        name: 'nomor_referensi',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'tanggal_pembayaran',
                        name: 'tanggal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nominal_pembayaran',
                        name: 'nominal_pembayaran',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_akun',
                        name: 'nama_akun',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'is_approved',
                        name: 'is_approved',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'catatan_pembayaran',
                        name: 'catatan_pembayaran',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            // $('#select_all').on('click', function() {
            //     $('.bookingfee_checkbox').prop('checked', this.checked);
            // });

            // $('#PembayaranBooking tbody').on('mouseenter', 'tr', function() {
            //     $(this).css('cursor', 'pointer');
            // });

            // $('#deleteSelected').on('click', function() {
            //     var selectedIds = $('.bookingfee_checkbox:checked').map(function() {
            //         return $(this).val();
            //     }).get();

            //     if (selectedIds.length > 0) {
            //         if (confirm('Apakah yakin ingin menghapus data yang dipilih?')) {
            //             $.ajax({
            //                 url: "{{ route('pemasok/delete') }}",
            //                 type: "POST",
            //                 data: {
            //                     ids: selectedIds,
            //                     _token: "{{ csrf_token() }}"
            //                 },
            //                 success: function(response) {
            //                     location.reload();
            //                 },
            //             });
            //         }
            //     } else {
            //         alert('Pilih setidaknya satu data untuk dihapus!');
            //     }
            // });

            // $('#PembayaranBooking tbody').on('click', 'tr', function(e) {
            //     // Cek apakah yang diklik adalah checkbox atau elemen dalam checkbox
            //     if ($(e.target).is('input[type="checkbox"], label')) {
            //         return; // Jika iya, hentikan eksekusi supaya tidak redirect
            //     }

            //     var data = table.row(this).data();
            //         if (data) {
            //             window.location.href = "/pemasok/edit/" + data.id + "/" + data.pemasok_id;
            //         }
            // });
        });
    </script> --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- TomSelect
            document.querySelectorAll('select.tomselect').forEach(function (el) {
                new TomSelect(el, {
                    create: false
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
    </script> --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            // DataTables client-side: sorting, search, paging semua di sisi browser
            $('#PembayaranBooking').DataTable({
                paging: true,
                searching: true,
                info: false
                // tidak perlu ajax, tidak perlu columns/order, dll.
            });
        });
    </script> --}}
@endpush
@endsection
