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
                <div class="col-md-6 px-3">
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
                
                <div class="col-md-6 px-3">
                    <div class="my-rounded-2">
                        <div class="col-md-12 p-2 bg-danger-card my-rounded-2">
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
                                            <h3 class="font-weight-bold text-danger">{{ 'Rp ' . number_format($grandTotal, 0, '.', ',') ?? 'Rp 0' }}</h3>
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
                                    <select class="tomselect @error('biaya_pembayaran_id') is-invalid @enderror" name="biaya_pembayaran_id" id="biaya_pembayaran_ids">
                                        <option {{ old('biaya_pembayaran_id') ? '' : 'selected' }} disabled>--Status Pengajuan--</option>
                                        @foreach ($biaya_pembayaran as $items )
                                            <option value="{{ $items->id }}" {{ old('biaya_pembayaran_id') == $items->id ? 'selected' : '' }} 
                                                {{-- @if($items->nama == 'Booking Fee') selected @endif --}}
                                                >{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="float-right mr-0 p-0" id="bk_0">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_0_0_0">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Booking Fee</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_1">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_1_1_1">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Uang Muka</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_2">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_2_2_2">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Kelebihan Tanah</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_3">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_3_3_3">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Penambahan Bangunan</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_4">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_4_4_4">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Lainnya</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_5">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_5_5_5">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Akad Kredit</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_6">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_6_6_6">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Biaya Penambahan Fasilitas</strong>
                                </button>
                            </div>
                            <div class="float-right mr-0 p-0" id="bk_7">
                                <button type="button" class="btn btn-primary buttonedit mt-3" data-toggle="modal" data-target="#bk_7_7_7">
                                    <strong><i class="fas fa-wallet mr-2 ml-1"></i>Penerimaan KPR dari Bank</strong>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="my-rounded-2">
                        <div class="col-md-12 p-3 bg-white border my-rounded-2">
                            <div id="bk_0_0">
                                <div class="modal fade" id="bk_0_0_0" tabindex="-1" role="dialog" aria-labelledby="modalLabelPekerja" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Booking Fee</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group mb-1">
                                                        <label for="tanggal_pembayaran_0" class="form-label fw-bold">Tanggal</label>
                                                        <input type="date" name="tanggal_pembayaran_0" id="tanggal_pembayaran_0" class="form-control form-control-sm" value="{{ old('tanggal_0') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="nominal_0" class="form-label fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_0" id="nominal_0" class="form-control form-control-sm" value="{{ old('nominal_0') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="tipe_pembayaran_0" class="form-label fw-bold">Tipe Pembayaran</label>
                                                        <input type="text" name="tipe_pembayaran_0" id="tipe_pembayaran_0" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="fileupload_0">Bukti Pembayaran</label>
                                                        <div class="custom-file">
                                                            <input type="file" id="fileupload_0" name="fileupload_0" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="catatan_0" class="form-label">Catatan</label>
                                                        <textarea id="catatan_0" name="catatan_0" class="form-control" col="6">{{ old('catatan_0') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBookingFee" type="button" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="row pt-5">
                                    <div class="col-md-5">
                                        <div class="p-3 bg-success-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-success"><i class="fas fa-handshake mr-3 my-0 text-success h6"></i> Nilai Kontrak {{ 'Rp ' . number_format($costs->booking_fee ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="p-3 bg-danger-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-danger"><i class="fas fa-hand-holding-usd mr-3 my-0 text-danger h6"></i>Sisa Piutang Booking Fee : {{ 'Rp ' . number_format($costs->booking_fee ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bk_1_1">
                                <div class="modal fade" id="bk_1_1_1" tabindex="-1" role="dialog" aria-labelledby="modalUangMuka" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Uang Muka</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group mb-1">
                                                        <label for="tanggal_pembayaran_1" class="form-label fw-bold">Tanggal</label>
                                                        <input type="date" name="tanggal_pembayaran_1" id="tanggal_pembayaran_1" class="form-control form-control-sm" value="{{ old('tanggal_1') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="nominal_1" class="form-label fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_1" id="nominal_1" class="form-control form-control-sm" value="{{ old('nominal_1') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="tipe_pembayaran_1" class="form-label fw-bold">Tipe Pembayaran</label>
                                                        <input type="text" name="tipe_pembayaran_1" id="tipe_pembayaran_1" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="fileupload_1">Bukti Pembayaran</label>
                                                        <div class="custom-file">
                                                            <input type="file" id="fileupload_1" name="fileupload_1" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="catatan_1" class="form-label">Catatan</label>
                                                        <textarea id="catatan_1" name="catatan_1" class="form-control" col="6">{{ old('catatan_1') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahUangMuka" type="button" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="row pt-5">
                                    <div class="col-md-5">
                                        <div class="p-3 bg-success-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-success"><i class="fas fa-handshake mr-3 my-0 text-success h6"></i> Nilai Kontrak {{ 'Rp ' . number_format($costs->uang_muka ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="p-3 bg-danger-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-danger"><i class="fas fa-hand-holding-usd mr-3 my-0 text-danger h6"></i>Sisa Piutang Uang Muka : {{ 'Rp ' . number_format($costs->uang_muka ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bk_2_2">
                                <div class="modal fade" id="bk_2_2_2" tabindex="-1" role="dialog" aria-labelledby="modalBiayaKelebihanTanah" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Tambah Biaya kelebihan Tanah</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group mb-1">
                                                        <label for="tanggal_pembayaran_2" class="form-label fw-bold">Tanggal</label>
                                                        <input type="date" name="tanggal_pembayaran_2" id="tanggal_pembayaran_2" class="form-control form-control-sm" value="{{ old('tanggal_2') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="nominal_2" class="form-label fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_2" id="nominal_2" class="form-control form-control-sm" value="{{ old('nominal_2') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="tipe_pembayaran_2" class="form-label fw-bold">Tipe Pembayaran</label>
                                                        <input type="text" name="tipe_pembayaran_2" id="tipe_pembayaran_2" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="fileupload_2">Bukti Pembayaran</label>
                                                        <div class="custom-file">
                                                            <input type="file" id="fileupload_2" name="fileupload_2" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="catatan_2" class="form-label">Catatan</label>
                                                        <textarea id="catatan_2" name="catatan_2" class="form-control" col="6">{{ old('catatan_2') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaKelebihanTanah" type="button" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="row pt-5">
                                    <div class="col-md-5">
                                        <div class="p-3 bg-success-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-success"><i class="fas fa-handshake mr-3 my-0 text-success h6"></i> Nilai Kontrak {{ 'Rp ' . number_format($costs->biaya_kelebihan_tanah ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="p-3 bg-danger-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-danger"><i class="fas fa-hand-holding-usd mr-3 my-0 text-danger h6"></i>Sisa Piutang Biaya Kelebihan Tanah : {{ 'Rp ' . number_format($costs->biaya_kelebihan_tanah ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bk_3_3">
                                <div class="modal fade" id="bk_3_3_3" tabindex="-1" role="dialog" aria-labelledby="modalBiayaPenambahanBangunan" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Biaya Penambahan Bangunan</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group mb-1">
                                                        <label for="tanggal_pembayaran_3" class="form-label fw-bold">Tanggal</label>
                                                        <input type="date" name="tanggal_pembayaran_3" id="tanggal_pembayaran_3" class="form-control form-control-sm" value="{{ old('tanggal_3') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="nominal_3" class="form-label fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_3" id="nominal_3" class="form-control form-control-sm" value="{{ old('nominal_3') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="tipe_pembayaran_3" class="form-label fw-bold">Tipe Pembayaran</label>
                                                        <input type="text" name="tipe_pembayaran_3" id="tipe_pembayaran_3" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="fileupload_3">Bukti Pembayaran</label>
                                                        <div class="custom-file">
                                                            <input type="file" id="fileupload_3" name="fileupload_3" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="catatan_3" class="form-label">Catatan</label>
                                                        <textarea id="catatan_3" name="catatan_3" class="form-control" col="6">{{ old('catatan_3') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaPenambahanBangunan" type="button" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="row pt-5">
                                    <div class="col-md-5">
                                        <div class="p-3 bg-success-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-success"><i class="fas fa-handshake mr-3 my-0 text-success h6"></i> Nilai Kontrak {{ 'Rp ' . number_format($costs->biaya_penambahan_bangunan ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="p-3 bg-danger-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-danger"><i class="fas fa-hand-holding-usd mr-3 my-0 text-danger h6"></i>Sisa Piutang Biaya Penambahan Bangunan : {{ 'Rp ' . number_format($costs->biaya_penambahan_bangunan ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bk_4_4">
                                <div class="modal fade" id="bk_4_4_4" tabindex="-1" role="dialog" aria-labelledby="modalBiayaLainnya" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Biaya Lainnya</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group mb-1">
                                                        <label for="tanggal_pembayaran_4" class="form-label fw-bold">Tanggal</label>
                                                        <input type="date" name="tanggal_pembayaran_4" id="tanggal_pembayaran_4" class="form-control form-control-sm" value="{{ old('tanggal_4') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="nominal_4" class="form-label fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_4" id="nominal_4" class="form-control form-control-sm" value="{{ old('nominal_4') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="tipe_pembayaran_4" class="form-label fw-bold">Tipe Pembayaran</label>
                                                        <input type="text" name="tipe_pembayaran_4" id="tipe_pembayaran_4" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="fileupload_4">Bukti Pembayaran</label>
                                                        <div class="custom-file">
                                                            <input type="file" id="fileupload_4" name="fileupload_4" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="catatan_4" class="form-label">Catatan</label>
                                                        <textarea id="catatan_4" name="catatan_4" class="form-control" col="6">{{ old('catatan_4') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaLainnya" type="button" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="row pt-5">
                                    <div class="col-md-5">
                                        <div class="p-3 bg-success-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-success"><i class="fas fa-handshake mr-3 my-0 text-success h6"></i> Nilai Kontrak {{ 'Rp ' . number_format($costs->biaya_lainnya ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="p-3 bg-danger-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-danger"><i class="fas fa-hand-holding-usd mr-3 my-0 text-danger h6"></i>Sisa Piutang Biaya Lainnya : {{ 'Rp ' . number_format($costs->biaya_lainnya ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bk_5_5">
                                <div class="modal fade" id="bk_5_5_5" tabindex="-1" role="dialog" aria-labelledby="modalBiayaAkadKredit" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Biaya Akad Kredit</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group mb-1">
                                                        <label for="tanggal_pembayaran_5" class="form-label fw-bold">Tanggal</label>
                                                        <input type="date" name="tanggal_pembayaran_5" id="tanggal_pembayaran_5" class="form-control form-control-sm" value="{{ old('tanggal_5') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="nominal_5" class="form-label fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_5" id="nominal_5" class="form-control form-control-sm" value="{{ old('nominal_5') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="tipe_pembayaran_5" class="form-label fw-bold">Tipe Pembayaran</label>
                                                        <input type="text" name="tipe_pembayaran_5" id="tipe_pembayaran_5" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="fileupload_5">Bukti Pembayaran</label>
                                                        <div class="custom-file">
                                                            <input type="file" id="fileupload_5" name="fileupload_5" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="catatan_5" class="form-label">Catatan</label>
                                                        <textarea id="catatan_5" name="catatan_5" class="form-control" col="6">{{ old('catatan_5') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaAkadKredit" type="button" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="row pt-5">
                                    <div class="col-md-5">
                                        <div class="p-3 bg-success-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-success"><i class="fas fa-handshake mr-3 my-0 text-success h6"></i> Nilai Kontrak {{ 'Rp ' . number_format($costs->biaya_akad_kredit ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="p-3 bg-danger-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-danger"><i class="fas fa-hand-holding-usd mr-3 my-0 text-danger h6"></i>Sisa Piutang Biaya Akad Kredit : {{ 'Rp ' . number_format($costs->biaya_akad_kredit ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bk_6_6">
                                <div class="modal fade" id="bk_6_6_6" tabindex="-1" role="dialog" aria-labelledby="modalBiayaPenambahanFasilitas" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Biaya Penambahan Fasilitas</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group mb-1">
                                                        <label for="tanggal_pembayaran_6" class="form-label fw-bold">Tanggal</label>
                                                        <input type="date" name="tanggal_pembayaran_6" id="tanggal_pembayaran_6" class="form-control form-control-sm" value="{{ old('tanggal_6') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="nominal_6" class="form-label fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_6" id="nominal_6" class="form-control form-control-sm" value="{{ old('nominal_6') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="tipe_pembayaran_6" class="form-label fw-bold">Tipe Pembayaran</label>
                                                        <input type="text" name="tipe_pembayaran_6" id="tipe_pembayaran_6" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="fileupload_6">Bukti Pembayaran</label>
                                                        <div class="custom-file">
                                                            <input type="file" id="fileupload_6" name="fileupload_6" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="catatan_6" class="form-label">Catatan</label>
                                                        <textarea id="catatan_6" name="catatan_6" class="form-control" col="6">{{ old('catatan_6') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahBiayaPenambahanFasilitas" type="button" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="row pt-5">
                                    <div class="col-md-5">
                                        <div class="p-3 bg-success-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-success"><i class="fas fa-handshake mr-3 my-0 text-success h6"></i> Nilai Kontrak {{ 'Rp ' . number_format($costs->biaya_penambahan_fasilitas ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="p-3 bg-danger-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-danger"><i class="fas fa-hand-holding-usd mr-3 my-0 text-danger h6"></i>Sisa Piutang Biaya Penambahan Fasilitas : {{ 'Rp ' . number_format($costs->biaya_penambahan_fasilitas ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="bk_7_7">
                                <div class="modal fade" id="bk_7_7_7" tabindex="-1" role="dialog" aria-labelledby="modalLabelPenerimaanKpr" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h6 class="modal-title font-weight-bold">Tambah Pembayaran Penerimaan KPR dari Bank</h6>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <form method="POST" action="" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group mb-1">
                                                        <label for="tanggal_pembayaran_7" class="form-label fw-bold">Tanggal</label>
                                                        <input type="date" name="tanggal_pembayaran_7" id="tanggal_pembayaran_7" class="form-control form-control-sm" value="{{ old('tanggal_7') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="nominal_7" class="form-label fw-bold">Nominal</label>
                                                        <input type="text" name="nominal_7" id="nominal_7" class="form-control form-control-sm" value="{{ old('nominal_7') }}">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="tipe_pembayaran_7" class="form-label fw-bold">Tipe Pembayaran</label>
                                                        <input type="text" name="tipe_pembayaran_7" id="tipe_pembayaran_7" class="form-control form-control-sm">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="fileupload_7">Bukti Pembayaran</label>
                                                        <div class="custom-file">
                                                            <input type="file" id="fileupload_7" name="fileupload_7" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <label for="catatan_7" class="form-label">Catatan</label>
                                                        <textarea id="catatan_7" name="catatan_7" class="form-control" col="6">{{ old('catatan_7') }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button id="tambahPenerimaanKpr" type="button" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
                                <div class="row pt-5">
                                    <div class="col-md-5">
                                        <div class="p-3 bg-success-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-success"><i class="fas fa-handshake mr-3 my-0 text-success h6"></i> Nilai Kontrak {{ 'Rp ' . number_format($costs->penerimaan_kpr ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="p-3 bg-danger-card my-rounded-2 m-2">
                                            <h8 class="font-weight-bold m-0 text-danger"><i class="fas fa-hand-holding-usd mr-3 my-0 text-danger h6"></i>Sisa Piutang Penerimaan KPR dari Bank : {{ 'Rp ' . number_format($costs->penerimaan_kpr ?? 0, 0, '.', ',') ?? 'Rp 0' }}</h8>
                                        </div>
                                    </div>
                                </div>
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
            const bK_0_0 = document.getElementById('bk_0_0');
            const bK_1_1 = document.getElementById('bk_1_1');
            const bK_2_2 = document.getElementById('bk_2_2');
            const bK_3_3 = document.getElementById('bk_3_3');
            const bK_4_4 = document.getElementById('bk_4_4');
            const bK_5_5 = document.getElementById('bk_5_5');
            const bK_6_6 = document.getElementById('bk_6_6');
            const bK_7_7 = document.getElementById('bk_7_7');

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
@endpush
@endsection
