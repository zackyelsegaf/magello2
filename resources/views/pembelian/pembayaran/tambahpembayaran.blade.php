@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h3 class="page-title mt-5">Tambah Data Pembayaran - <span id="statusBadge"></span></h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pembelian/pembayaran/save') }}" id="formPembayaran" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row checkbox-row-mobile-horizontal">
                                    <div class="col-md-3 p-2">
                                        <div class="form-group">
                                            <div class="dd"></div>
                                            <div class="checkbox-wrapper-4">
                                                <input type="hidden" name="cek_kosong_check" value="0">
                                                <input class="inp-cbx" name="cek_kosong_check" id="cek_kosong_check" type="checkbox" value="1" {{ old('cek_kosong_check') ? 'checked' : '' }}>
                                                <label class="cbx" for="cek_kosong_check">
                                                    <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                    <span><strong>Cek Kosong</strong></span>
                                                </label>
                                                <svg class="inline-svg">
                                                    <symbol id="check-4" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </symbol>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 p-2">
                                        <div class="form-group">
                                            <div class="dd"></div>
                                            <div class="checkbox-wrapper-4">
                                                <input type="hidden" name="pajak_check" value="0">
                                                <input class="inp-cbx" name="pajak_check" id="pajak_check" type="checkbox" value="1" {{ old('pajak_check') ? 'checked' : '' }} disabled>
                                                <label class="cbx" for="pajak_check">
                                                    <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                    <span><strong>Pembayaran Pajak</strong></span>
                                                </label>
                                                <svg class="inline-svg">
                                                    <symbol id="check-4" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </symbol>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 p-2">
                                        <div class="form-group">
                                            <div class="dd"></div>
                                            <div class="checkbox-wrapper-4">
                                                <input type="hidden" name="disetujui_check" value="0">
                                                <input class="inp-cbx" name="disetujui_check" id="disetujui_check" type="checkbox" value="1" {{ old('disetujui_check') ? 'checked' : '' }}>
                                                <label class="cbx" for="disetujui_check">
                                                    <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                    <span><strong>Disetujui</strong></span>
                                                </label>
                                                <svg class="inline-svg">
                                                    <symbol id="check-4" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </symbol>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="alert alert-primary align-middle" role="alert">
                                <i class="fa fa-exclamation-triangle mr-2 align-middle"></i>Inputan dengan label <strong class="text-danger h3 align-middle">*</strong> wajib diisi!
                                {{-- <button type="button" class="close align-middle" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> --}}
                            </div>
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Pembayaran</label>
                                                <input type="text" class="form-control form-control-sm" name="no_pembayaran" value="{{ $kodeBaru }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="persetujuan-field" style="display: none;">
                                            <div class="form-group">
                                                <label>No. Persetujuan</label>
                                                <input type="text" class="form-control" name="no_persetujuan" value="{{ old('no_persetujuan') }}" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Formulir</label>
                                                <input type="text" class="form-control form-control-sm" name="no_formulir" value="{{ $kodeBaru }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Pengguna</label>
                                            <input type="text" class="form-control form-control-sm" name="pengguna_pembayaran" value="{{ Auth::user()->name }}">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Status</label>
                                            <input type="text" class="form-control form-control-sm" id="status_pembayaran" name="status_pembayaran" value="Menunggu">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tanggal Pembayaran</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control form-control-sm datetimepicker @error('tgl_pembayaran') is-invalid @enderror" name="tgl_pembayaran" value="{{ old('tgl_pembayaran') }}"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Pemasok</label>
                                                <select id="namaBarangSelect" class="form-control form-control-sm @error('pemasok_pembayaran') is-invalid @enderror" name="pemasok_pembayaran">
                                                    <option {{ old('pemasok_pembayaran') ? '' : 'selected' }} disabled> -- Pilih Pemasok</option>
                                                    @foreach ($pemasok as $items )
                                                        <option value="{{ $items->nama }}"
                                                            data-no-pemasok="{{ $items->pemasok_id }}"
                                                            data-syarat="{{ $items->syarat }}"
                                                            data-alamat-1="{{ $items->alamat_1 }}"
                                                            data-nilai-tukar="{{ $items->nilai_tukar }}"
                                                            data-pajak="{{ $items->pajak_1_check }}">
                                                            {{ $items->pemasok_id . " - " . $items->nama . " - " . $items->mata_uang }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <select id="noPemasokSelect" class="form-control form-control-sm"  name="no_pemasok" style="display: none">
                                                    <option {{ old('no_pemasok') ? '' : 'selected' }} disabled></option>
                                                    @foreach ($pemasok as $items )
                                                    <option value="{{ $items->pemasok_id }}">{{ $items->pemasok_id }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Proyek</label>
                                                <select class="form-control form-control-sm @error('proyek') is-invalid @enderror"  name="proyek">
                                                    <option {{ old('proyek') ? '' : 'selected' }} disabled></option>
                                                    @foreach ($proyek as $items )
                                                    <option value="{{ $items->nama_proyek }}">{{ $items->proyek_id . " - " . $items->nama_proyek }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Gudang</label>
                                                <select class="form-control form-control-sm @error('gudang') is-invalid @enderror" id="default_gudang" name="gudang">
                                                    <option {{ old('gudang') ? '' : 'selected' }} disabled></option>
                                                    @foreach ($gudang as $items )
                                                    <option value="{{ $items->nama_gudang }}">{{ $items->nama_gudang }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Departemen</label>
                                                <select class="form-control form-control-sm @error('departemen') is-invalid @enderror"  name="departemen">
                                                    <option {{ old('departemen') ? '' : 'selected' }} disabled></option>
                                                    @foreach ($departemen as $items )
                                                    <option value="{{ $items->nama_departemen }}">{{ $items->nama_departemen }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#rincian">Rincian Data</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Attachment Document</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#ricape">Rincian Catatan Pemeriksaan</a> 
                            </li>
                        </ul>
                    </div>
                    <div style="padding-bottom: 15px;" id="rincian" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Bank</strong></label>
                                                <select id="bankSelect" class="form-control form-control-sm" name="akun_bank">
                                                    <option selected disabled> --Pilih Sub-- </option>
                                                    @foreach ($nama_akun as $items )
                                                        <option value="{{ $items->no_akun }}"
                                                            data-saldo_akun="{{ $items->saldo_akun }}"
                                                            @if($items->nama_akun_indonesia == 'Kas - Kotamobagu - IDR') selected @endif>
                                                            {{ $items->nama_akun_indonesia ." ( ". $items->saldo_akun ." ) " }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Tgl. Cek</strong></label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control form-control-sm datetimepicker" name="tgl_cek" value="{{ old('tgl_cek') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <label><strong>Nilai Tukar</strong></label>
                                                <input id="nilaiTukarInput" type="text" class="form-control form-control-sm" name="nilai_tukar" value="{{ old('nilai_tukar') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>No. Cek</strong></label>
                                                <input type="text" class="form-control form-control-sm" name="no_cek" value="{{ old('no_cek') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-1" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Jumlah Cek</strong></label>
                                                <input type="text" class="form-control form-control-sm" name="jumlah_check" value="{{ old('jumlah_check') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-1" style="display: none;">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Saldo</strong></label>
                                                <input type="text" id="saldoAkunInput" class="form-control form-control-sm" name="saldo_bank" value="{{ old('saldo_bank') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 15px;" id="dokumen" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="page-header">
                                    <div class="row float-right">
                                        <button type="button" id="fileuploads_btn_add" class="btn btn-primary buttonedit float-right">
                                            <i class="fa fa-plus mr-2"></i>Tambah Field
                                        </button>
                                    </div>
                                </div>
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12" id="fileuploads_loop_add">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="fileupload_1">File 1</label>
                                                    <input type="text" class="form-control form-control-sm" name="fileupload_1" placeholder="Link dokumen Anda" value="{{ old('fileupload_1') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 15px;" id="ricape" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-10">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="tindak_lanjut_check" value="0">
                                                        <input class="inp-cbx" name="tindak_lanjut_check" id="tindak_lanjut_check" type="checkbox" value="1" {{ old('tindak_lanjut_check') ? 'checked' : '' }}>
                                                        <label class="cbx" for="tindak_lanjut_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                            <span><strong>Tindak Lanjut</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="urgent_check" value="0">
                                                        <input class="inp-cbx" name="urgent_check" id="urgent_check" type="checkbox" value="1" {{ old('urgent_check') ? 'checked' : '' }}>
                                                        <label class="cbx" for="urgent_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                            <span><strong>Urgent</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <textarea style="width: 300px; height:100px;" class="form-control form-control-sm" name="deskripsi_1" placeholder="Deskripsi" value="{{ old('deskripsi_1') }}">{{ old('deskripsi_1') }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <div class="dd"></div>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="catatan_pemeriksaan_check" value="0">
                                                        <input class="inp-cbx" name="catatan_pemeriksaan_check" id="catatan_pemeriksaan_check" type="checkbox" value="1" {{ old('catatan_pemeriksaan_check') ? 'checked' : '' }}>
                                                        <label class="cbx" for="catatan_pemeriksaan_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                            <span><strong>Catatan Pemeriksaan</strong></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <textarea style="width: 300px; height:100px;" class="form-control form-control-sm" name="deskripsi_2" value="{{ old('deskripsi_2') }}" placeholder="Deskripsi">{{ old('deskripsi_2') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#deskripsi">Deskripsi</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#informasi">Informasi Lainnya</a> 
                            </li>
                        </ul>
                    </div>
                    <div style="padding-bottom: 15px;" id="deskripsi" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="row float-right mr-0">
                                    {{-- <button type="button" class="btn btn-primary buttonedit mb-3" id="tambahBarangBtn">
                                        <strong><i class="fas fa-cube mr-3 ml-1"></i>Tambah</strong>
                                    </button> --}}
                                    <button type="button" class="btn btn-primary buttonedit mb-3 mr-3" data-toggle="modal" data-target="#modalFaktur">
                                        <strong><i class="fas fa-paper-plane mr-2 ml-1"></i>Faktur Pembelian</strong>
                                    </button>
                                    {{-- <button type="button" class="btn btn-primary buttonedit mb-3 mr-3" data-toggle="modal" data-target="#modalPenerimaan">
                                        <strong><i class="fas fa-paper-plane mr-2 ml-1"></i>Penerimaan Pembelian</strong>
                                    </button> --}}
                                    {{-- <button type="button" class="btn btn-primary buttonedit mb-3" data-toggle="modal" data-target="#modalBarang">
                                        <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                                    </button> --}}
                                </div>
                                {{-- Modal Faktur --}}
                                <div class="modal fade" id="modalFaktur" tabindex="-1" role="dialog" aria-labelledby="modalFakturLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Pilih Faktur</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div id="filterBox" class="mb-3" style="display: none;">
                                                <div class="card m-3 text-white">
                                                    <div class="form-group mb-1">
                                                        <input type="text" name="no_faktur" id="no_faktur" class="form-control form-control-sm" placeholder="No Pesanan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="tabelPilihFakturBarang" style="margin: 0; border-collapse: collapse; width: 100%;">
                                                        <thead class="thead-dark">
                                                            <tr style="padding: 0; margin: 0;">
                                                                <th style="padding: 7px; text-align: center;"><input type="checkbox" id="checkAllFaktur"></th>
                                                                <th style="padding: 4px;">No. Faktur</th>
                                                                <th style="padding: 4px;">Tanggal Faktur</th>
                                                                <th style="padding: 4px;">Deskripsi</th>
                                                                <th style="padding: 4px;">No. Permintaan</th>
                                                                <th style="padding: 4px;">No. Pesanan</th>
                                                                <th style="padding: 4px;">No. Penerimaan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($faktur_pembelian as $item)
                                                                <tr style="padding: 0; margin: 0;">
                                                                    <td style="padding: 4px; text-align: center;">
                                                                        <input type="checkbox" class="check-faktur"
                                                                               data-id="{{ $item->no_faktur }}"
                                                                               data-no_barang="{{ $item->no_barang }}"
                                                                               data-deskripsi_barang="{{ $item->deskripsi_barang }}"
                                                                               data-kts_faktur="{{ $item->kts_faktur }}"
                                                                               data-satuan="{{ $item->satuan }}"
                                                                               data-tgl="{{ $item->tgl_faktur }}"
                                                                               data-deskripsi="{{ $item->deskripsi_faktur }}"
                                                                               data-diskon="{{ $item->diskon_barang }}"
                                                                               data-no_permintaan="{{ $item->no_permintaan }}"
                                                                               data-no_pesanan="{{ $item->no_pesanan }}"
                                                                               data-no_penerimaan="{{ $item->no_penerimaan }}">
                                                                    </td>
                                                                    <td style="padding: 4px;">{{ $item->no_faktur }}</td>
                                                                    <td style="padding: 4px;">{{ $item->tgl_faktur }}</td>
                                                                    <td style="padding: 4px;">{{ $item->deskripsi_faktur }}</td>
                                                                    <td style="padding: 4px;">{{ $item->no_permintaan }}</td>
                                                                    <td style="padding: 4px;">{{ $item->no_pesanan }}</td>
                                                                    <td style="padding: 4px;">{{ $item->no_penerimaan }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary buttonedit" id="tambahFakturTerpilih"><i class="fas fa-paper-plane mr-2"></i> Tambah ke Form</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Faktur</th>
                                                <th>Tgl. Faktur</th>
                                                <th>Jatuh Tempo</th>
                                                <th>PPh Ps. 23</th>
                                                <th>Diskon</th>
                                                <th>Jumlah</th>
                                                <th>Terhutang</th>
                                                <th>Jumlah Pembayaran</th>
                                                <th>Deskripsi</th>
                                                <th>Bayar</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="barangTableBody">
                                            @if(old('no_faktur'))
                                                @foreach(old('no_faktur') as $index => $no_faktur)
                                                    <tr>
                                                        <td><input style="width: 150px;" type="text" name="no_faktur[]" value="{{ $no_faktur }}" class="form-control form-control-sm" readonly></td>
                                                        <td><input style="width: 150px;" type="text" name="tgl_faktur[]" value="{{ old('tgl_faktur')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="jatuh_tempo[]" value="{{ old('jatuh_tempo')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="pph_23[]" value="{{ old('pph_23')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="diskon[]" value="{{ old('diskon')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="jumlah[]" value="{{ old('jumlah')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="terhutang[]" value="{{ old('terhutang')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="jumlah_pembayaran[]" value="{{ old('jumlah_pembayaran')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="deskripsi_rincian[]" value="{{ old('deskripsi_rincian')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td>
                                                            <div class="checkbox-wrapper-4">
                                                                <input type="hidden" name="bayar_check[{{ $index }}]" value="0">
                                                                <input class="inp-cbx" name="bayar_check[{{ $index }}]" id="bayar_check_{{ $index }}" type="checkbox" value="1"
                                                                    {{ old('bayar_check')[$index] ?? false ? 'checked' : '' }}>
                                                                <label class="cbx" for="bayar_check_{{ $index }}">
                                                                    <span>
                                                                        <svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg>
                                                                    </span>
                                                                </label>
                                                                <svg class="inline-svg" style="display: none;">
                                                                    <symbol id="check-4" viewbox="0 0 12 10">
                                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                                    </symbol>
                                                                </svg>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row">
                                                                <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 15px;" id="informasi" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-6"> 
                                            <div class="form-group">
                                                <label><strong>Alamat Pemasok</strong></label>
                                                <textarea id="alamatPemasokInput" class="form-control form-control-sm" name="alamat_pemasok" placeholder="Alamat Pemasok">{{ old('alamat_pemasok') }}</textarea>
                                            </div> 
                                            <div class="form-group">
                                                <textarea class="form-control form-control-sm" name="deskripsi" placeholder="Deskripsi">{{ old('deskripsi') }}</textarea>
                                            </div>                                      
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-check mr-2"></i>Simpan</button>
                            <a href="{{ route('pembelian/pembayaran/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.querySelector('input[name="disetujui_check"]');
            const persetujuanField = document.getElementById('persetujuan-field');

            function toggleField() {
                if (checkbox.checked) {
                    persetujuanField.style.display = 'block';
                } else {
                    persetujuanField.style.display = 'none';
                }
            }

            checkbox.addEventListener('change', toggleField);
            toggleField();
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("uang_muka_check");
            const tipeAkunForm = document.getElementById("uang_muka_form");
    
            function toggleTipeAkunForm() {
                if (checkbox.checked) {
                    tipeAkunForm.style.display = "block";
                } else {
                    tipeAkunForm.style.display = "none";
                }
            }
    
            toggleTipeAkunForm();
    
            checkbox.addEventListener("change", toggleTipeAkunForm);
        });
    </script>
    <script>
        $(document).ready(function() {
            function fetchFilteredData() {
                $.ajax({
                    url: "{{ route('get-pembayaran23-data') }}",
                    method: 'GET',
                    data: {
                        no_faktur: $('#no_faktur').val(),
                        pemasok_faktur: $('#namaBarangSelect').val()
                    },
                    success: function(response) {
                        let tbody = '';
                        response.forEach(item => {
                            tbody += `
                                <tr>
                                    <td style="text-align: center;">
                                        <input type="checkbox" class="check-faktur"
                                            data-id="${item.no_faktur}"
                                            data-no_barang="${item.no_barang}"
                                            data-deskripsi_barang="${item.deskripsi_barang}"
                                            data-kts_faktur="${item.kts_faktur}"
                                            data-satuan="${item.satuan}"
                                            data-tgl="${item.tgl_faktur}"
                                            data-deskripsi="${item.deskripsi_faktur}"
                                            data-diskon="${item.diskon_barang}"
                                            data-no_permintaan="${item.no_permintaan}"
                                            data-no_pesanan="${item.no_pesanan}"
                                            data-no_penerimaan="${item.no_penerimaan}">
                                    </td>
                                    <td style="padding: 4px;">${item.no_faktur}</td>
                                    <td style="padding: 4px;">${item.tgl_faktur}</td>
                                    <td style="padding: 4px;">${item.deskripsi_faktur || ''}</td>
                                    <td style="padding: 4px;">${item.no_permintaan || ''}</td>
                                    <td style="padding: 4px;">${item.no_pesanan || ''}</td>
                                    <td style="padding: 4px;">${item.no_penerimaan || ''}</td>
                                </tr>
                            `;
                        });
                        $('#tabelPilihFakturBarang tbody').html(tbody);
                    }
                });
            }

            $('#no_faktur, #namaBarangSelect').on('keyup change', function() {
                fetchFilteredData();
            });
        });
    </script>         
    <script>
        $(document).ready(function () {
            $('#checkAllFaktur').click(function () {
                $('.check-faktur').prop('checked', this.checked);
            });

            $('#tambahFakturTerpilih').click(function () {
                let selectedFaktur = $('.check-faktur:checked');
                if (selectedFaktur.length === 0) {
                    alert("Pilih minimal satu pesanan terlebih dahulu.");
                    return;
                }

                selectedFaktur.each(function () {
                    let no_faktur = $(this).data('id');

                    $.ajax({
                        url: '/get-detail-pembayaran',
                        method: 'GET',
                        data: { no_faktur: no_faktur },
                        success: function (data) {
                            data.forEach(item => {
                                let newRow = `
                                <tr class="faktur-row">
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_faktur[]" value="${item.no_faktur}" readonly></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="tgl_faktur[]" value="${item.tgl_faktur || ''}"></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="jatuh_tempo[]" value="${item.tgl_faktur || ''}"></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="pph_23[]" value=""></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="diskon[]" value="${item.diskon_barang || ''}"></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm jumlah-field" name="jumlah[]" value="${item.jumlah || ''}"></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="terhutang[]" value=""></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="jumlah_pembayaran[]" value=""></td>
                                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="deskripsi_rincian[]" value=""></td>
                                    <td>
                                        <div class="checkbox-wrapper-4">
                                            <input type="checkbox" class="inp-cbx bayar-check" name="bayar_check[]" value="0" id="bayar_check_${item.no_faktur}">
                                            <label class="cbx" for="bayar_check_${item.no_faktur}">
                                                <span>
                                                    <svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg>
                                                </span>
                                            </label>
                                            <svg class="inline-svg">
                                                <symbol id="check-4" viewBox="0 0 12 10">
                                                    <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                </symbol>
                                            </svg>
                                        </div>
                                    </td>
                                    <td><button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                                </tr>`;
                                $('#barangTableBody').append(newRow);
                            });

                            hitungJumlahCheck();
                        },
                        error: function () {
                            alert("Gagal mengambil data detail pesanan.");
                        }
                    });
                });

                $('#modalFaktur').modal('hide');
            });

            $('#modalFaktur').on('show.bs.modal', function () {
                $('#checkAllFaktur').prop('checked', false);
                $('.check-faktur').prop('checked', false);
            });

            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
                hitungJumlahCheck();
            });

            $(document).on('input', 'input[name="jumlah[]"], .bayar-check', function () {
                hitungJumlahCheck();
            });

            $(document).on('change', '.bayar-check', function () {
                hitungJumlahCheck();
            });

            function hitungJumlahCheck() {
                let total = 0;

                $('#barangTableBody tr').each(function () {
                    let checkbox = $(this).find('.bayar-check');
                    if (checkbox.prop('checked')) {
                        let jumlah = parseFloat($(this).find('input[name="jumlah_pembayaran[]"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                        total += jumlah;
                    }
                });

                $('input[name="jumlah_check"]').val(total);
                kurangiSaldoBank(total);
            }

            let saldoAwal = 0;

            $(document).ready(function () {
                $('#bankSelect').on('change', function () {
                    saldoAwal = parseFloat($(this).find(':selected').data('saldo_akun')) || 0;
                    $('#saldoAkunInput').val(formatRupiah(saldoAwal));
                    hitungJumlahPembayaran();
                    hitungJumlahCheck();
                });

                $(document).on('input', 'input[name="jumlah_pembayaran[]"], input[name="jumlah[]"]', function () {
                    hitungJumlahPembayaran();
                    hitungJumlahCheck();
                });

                $(document).on('change', '.bayar-check', function () {
                    hitungJumlahCheck();
                });
            });

            function hitungJumlahPembayaran() {
                $('#barangTableBody tr').each(function () {
                    let jumlah = parseFloat(toAngka($(this).find('input[name="jumlah[]"]').val())) || 0;
                    let bayar = parseFloat(toAngka($(this).find('input[name="jumlah_pembayaran[]"]').val())) || 0;

                    if (bayar > jumlah) {
                        bayar = jumlah;
                        $(this).find('input[name="jumlah_pembayaran[]"]').val(formatRupiah(bayar));
                    }

                    let hutang = jumlah - bayar;
                    $(this).find('input[name="terhutang[]"]').val(formatRupiah(hutang));
                });
            }

            function hitungJumlahCheck() {
                let totalCheck = 0;

                $('#barangTableBody tr').each(function () {
                    let checkbox = $(this).find('.bayar-check');
                    if (checkbox.prop('checked')) {
                        let bayar = parseFloat(toAngka($(this).find('input[name="jumlah_pembayaran[]"]').val())) || 0;
                        totalCheck += bayar;
                    }
                });

                $('input[name="jumlah_check"]').val(formatRupiah(totalCheck));

                let sisa = saldoAwal - totalCheck;
                $('#saldoAkunInput').val(formatRupiah(sisa));
            }

            function toAngka(rp) {
                if (!rp) return "0";
                return rp.replace(/\./g, '').replace(',', '.');
            }

            function formatRupiah(angka) {
                angka = parseFloat(angka).toFixed(2);
                let parts = angka.split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return parts.join(',');
            }

            $('#formPembayaran').on('submit', function () {
                $('input.bayar-check').each(function () {
                    $(this).val($(this).prop('checked') ? '1' : '0');
                });

                // Format nilai angka
                $('input[name="jumlah[]"], input[name="jumlah_pembayaran[]"], input[name="terhutang[]"], input[name="jumlah_check"], input[name="saldo_bank"]').each(function () {
                    let val = $(this).val();
                    val = val.replace(/\./g, '').split(',')[0].replace(/[^0-9\-]/g, '');
                    $(this).val(val);
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('bayar_check');
            const kolomNilai = document.querySelectorAll('.kolom-nilai');
    
            function toggleKolomNilai() {
                const show = checkbox.checked;
                kolomNilai.forEach(kolom => {
                    kolom.style.display = show ? '' : 'none';
                });
            }
    
            toggleKolomNilai();
            checkbox.addEventListener('change', toggleKolomNilai);
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const disetujuiCheck = document.getElementById("disetujui_check");
            const statusInput = document.getElementById("status_pembayaran");
            const statusBadge = document.getElementById("statusBadge");
            const checkboxTutup = document.querySelectorAll('input[id^="bayar_check_"]');

            function updateStatus() {
                let jumlahCheckbox = checkboxTutup.length;
                let checkedCount = 0;
                let statusText = '';
                let badgeHTML = '';

                checkboxTutup.forEach(cb => {
                    if (cb.checked && cb.value === "1") {
                        checkedCount++;
                    }
                });

                if (disetujuiCheck.checked && disetujuiCheck.value === "1") {
                    statusText = 'Diterima';
                    badgeHTML = '<span class="badge bg-success"><i class="fas fa-check"> </i> Diterima</span>';
                } else if (checkedCount === jumlahCheckbox && jumlahCheckbox > 0) {
                    statusText = 'Diproses';
                    badgeHTML = '<span class="badge bg-info"><i class="fas fa-tasks"> </i> Diproses</span>';
                } else if (checkedCount > 0) {
                    statusText = 'Diproses';
                    badgeHTML = '<span class="badge bg-info"><i class="fas fa-tasks"> </i> Diproses</span>';
                } else {
                    statusText = 'Menunggu';
                    badgeHTML = '<span class="badge bg-warning"><i class="fas fa-spinner"> </i> Menunggu</span>';
                }

                statusInput.value = statusText;

                statusBadge.innerHTML = badgeHTML;
            }

            updateStatus();

            disetujuiCheck.addEventListener('change', updateStatus);
            checkboxTutup.forEach(cb => {
                cb.addEventListener('change', updateStatus);
            });
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
        const tableBody = document.getElementById('permintaanBody');
        const tambahBtn = document.getElementById('tambahBaris');
    
        // Tambah Baris
        tambahBtn.addEventListener('click', function () {
            const row = tableBody.querySelector('tr');
            const clone = row.cloneNode(true);
    
            // Bersihkan input value
            clone.querySelectorAll('input, select').forEach(function (el) {
                if (el.tagName === 'SELECT') {
                    el.selectedIndex = 0;
                } else {
                    el.value = '';
                }
            });
    
            tableBody.appendChild(clone);
        });
    
        // Hapus Baris
        tableBody.addEventListener('click', function (e) {
            if (e.target.classList.contains('removeRow')) {
                const rows = tableBody.querySelectorAll('tr');
                if (rows.length > 1) {
                    e.target.closest('tr').remove();
                } else {
                    alert("Minimal satu baris harus ada!");
                }
            }
        });
    
        // Auto set deskripsi dan kuantitas saat pilih barang
        tableBody.addEventListener('change', function (e) {
            if (e.target.classList.contains('nama-barang')) {
                const selected = e.target.selectedOptions[0];
                const tr = e.target.closest('tr');
                const deskripsi = selected.getAttribute('data-nama');
                const satuan = selected.getAttribute('data-satuan');
    
                tr.querySelector('.deskripsi-barang').value = deskripsi;
                tr.querySelector('.satuan-permintaan').value = satuan;
            }
        });
    });
    </script>                  --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('tindak_lanjut_check');
            const kolomNilai = document.querySelectorAll('.kolom-nilai');
    
            function toggleKolomNilai() {
                const show = checkbox.checked;
                kolomNilai.forEach(kolom => {
                    kolom.style.display = show ? '' : 'none';
                });
            }
    
            toggleKolomNilai();
            checkbox.addEventListener('change', toggleKolomNilai);
        });
    </script>    
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('urgent_check');
            const kolomNilai = document.querySelectorAll('.kolom-nilai');
    
            function toggleKolomNilai() {
                const show = checkbox.checked;
                kolomNilai.forEach(kolom => {
                    kolom.style.display = show ? '' : 'none';
                });
            }
    
            toggleKolomNilai();
            checkbox.addEventListener('change', toggleKolomNilai);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('catatan_pemeriksaan_check');
            const kolomNilai = document.querySelectorAll('.kolom-nilai');
    
            function toggleKolomNilai() {
                const show = checkbox.checked;
                kolomNilai.forEach(kolom => {
                    kolom.style.display = show ? '' : 'none';
                });
            }
    
            toggleKolomNilai();
            checkbox.addEventListener('change', toggleKolomNilai);
        });
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const namaBarangSelect = document.getElementById('namaBarangSelect');
            const noPemasokSelect = document.getElementById('noPemasokSelect');
            const syaratSelect = document.getElementById('syaratSelect');
            const alamatPemasokInput = document.getElementById('alamatPemasokInput');
            const nilaiTukarInput = document.getElementById('nilaiTukarInput');
            const pajakCheckbox = document.getElementById('pajak_check');
            const satuanSelect = document.getElementById('satuanSelect');

            namaBarangSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const pajakValue = selectedOption.getAttribute('data-pajak');

                if (pajakValue === "1") {
                    pajakCheckbox.checked = true;
                } else {
                    pajakCheckbox.checked = false;
                }

                noPemasokSelect.value = selectedOption.getAttribute('data-no-pemasok') || '';
                syaratSelect.value = selectedOption.getAttribute('data-syarat') || '';
                alamatPemasokInput.value = selectedOption.getAttribute('data-alamat-1') || '';
                nilaiTukarInput.value = selectedOption.getAttribute('data-nilai-tukar') || '';
                satuanSelect.value = selectedOption.getAttribute('data-satuan') || '';
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const namaBarangSelect = document.getElementById('namaBarangSelect');
            const noPemasokSelect = document.getElementById('noPemasokSelect');
            const alamatPemasokInput = document.getElementById('alamatPemasokInput');
            const nilaiTukarInput = document.getElementById('nilaiTukarInput');
            const nilaiTukarPajak = document.getElementById('nilaiTukarPajak');
            const satuanSelect = document.getElementById('satuanSelect');

            namaBarangSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];

                noPemasokSelect.value = selectedOption.getAttribute('data-no-pemasok') || '';
                alamatPemasokInput.value = selectedOption.getAttribute('data-alamat-1') || '';
                nilaiTukarInput.value = selectedOption.getAttribute('data-nilai-tukar') || '';
                nilaiTukarPajak.value = selectedOption.getAttribute('data-nilai-tukar') || '';
                satuanSelect.value = selectedOption.getAttribute('data-satuan') || '';
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const bankSelect = document.getElementById('bankSelect');
            const saldoInput = document.getElementById('saldoAkunInput');

            function formatRupiah(angka) {
                angka = parseFloat(angka).toFixed(2);
                let parts = angka.split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return parts.join(',');
            }

            function updateSaldo() {
                const selectedOption = bankSelect.options[bankSelect.selectedIndex];
                const saldo = selectedOption.getAttribute('data-saldo_akun') || '0';
                saldoInput.value = formatRupiah(saldo);
            }

            updateSaldo();

            bankSelect.addEventListener('change', updateSaldo);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const noAkunSelect = document.getElementById('noAkunSelect');
            const namaAkunSelect = document.getElementById('namaAkunSelect');
        
        noAkunSelect.addEventListener('change', function () {
            const selectedNo = this.value;
            const nama = this.options[this.selectedIndex].getAttribute('data-nama');
    
            for (let i = 0; i < namaAkunSelect.options.length; i++) {
                if (namaAkunSelect.options[i].value === nama) {
                    namaAkunSelect.selectedIndex = i;
                    break;
                }
            }
        });
    
        namaAkunSelect.addEventListener('change', function () {
            const selectedNama = this.value;
            const no = this.options[this.selectedIndex].getAttribute('data-no');
    
            for (let i = 0; i < noAkunSelect.options.length; i++) {
                if (noAkunSelect.options[i].value === no) {
                    noAkunSelect.selectedIndex = i;
                    break;
                }
            }
        });
    });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("sub_barang_check");
            const tipeAkunForm = document.getElementById("tipe_barang_form");
    
            function toggleTipeAkunForm() {
                if (checkbox.checked) {
                    tipeAkunForm.style.display = "block";
                } else {
                    tipeAkunForm.style.display = "none";
                }
            }
    
            toggleTipeAkunForm();
    
            checkbox.addEventListener("change", toggleTipeAkunForm);
        });
    </script>
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('nilaiSaatIniInput');
    
            input.addEventListener('input', () => {
                let angka = input.value.replace(/\D/g, '');
                input.value = formatRupiah(angka);
            });
    
            input.closest('form').addEventListener('submit', () => {
                input.value = input.value.replace(/\D/g, '');
            });
    
            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('biaya_satuan_saldo_awal');
    
            input.addEventListener('input', () => {
                let angka = input.value.replace(/\D/g, '');
                input.value = formatRupiah(angka);
            });
    
            input.closest('form').addEventListener('submit', () => {
                input.value = input.value.replace(/\D/g, '');
            });
    
            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script>
    {{-- <script>
        document.getElementById('namaBarangSelect').addEventListener('change', function () {
            let selectedOption = this.options[this.selectedIndex];
            document.getElementById('ktsSaatIniInput').value = selectedOption.getAttribute('data-ktssaatini');
            document.getElementById('nilaiSaatIniInput').value = selectedOption.getAttribute('data-nilaisaatini');
            document.getElementById('deskripsiBarangInput').value = selectedOption.getAttribute('data-nama');
            document.getElementById('departemenSelect').value = selectedOption.getAttribute('data-departemen');
            document.getElementById('proyekSelect').value = selectedOption.getAttribute('data-proyek');
            document.getElementById('gudangSelect').value = selectedOption.getAttribute('data-gudang');
            });
    </script>     --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const biaya_satuan_saldo_awal = document.getElementById('biaya_satuan_saldo_awal');
            const kuantitas_saldo_awal = document.getElementById('kuantitas_saldo_awal');
            const total_saldo = document.getElementById('total_saldo');

            function handleInputFormat(input) {
                input.addEventListener('input', () => {
                    let angka = input.value.replace(/\D/g, '');
                    input.value = formatRupiah(angka);
                    hitungTotal();
                });
            }
    
            handleInputFormat(biaya_satuan_saldo_awal);
            handleInputFormat(kuantitas_saldo_awal);
    
            function hitungTotal() {
                let saldo = parseInt(biaya_satuan_saldo_awal.value.replace(/\D/g, '')) || 0;
                let tambahan = parseInt(kuantitas_saldo_awal.value.replace(/\D/g, '')) || 0;
                let total = saldo * tambahan;
                total_saldo.value = formatRupiah(String(total));
                document.getElementById('total_saldo_awal').value = total;
            }
    
            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
    
            const form = biaya_satuan_saldo_awal.closest('form');
            if (form) {
                form.addEventListener('submit', () => {
                    biaya_satuan_saldo_awal.value = biaya_satuan_saldo_awal.value.replace(/\D/g, '');
                    kuantitas_saldo_awal.value = kuantitas_saldo_awal.value.replace(/\D/g, '');
                });
            }
        });
    </script>
    <script>
        let fieldIndex = 1;
        const maxFields = 7;

        document.getElementById('fileuploads_btn_add').addEventListener('click', function () {
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
                            <input type="text" name="fileupload_${fieldIndex}" class="form-control" />
                        </div>
                    </div>
                </div>
            
            `;

            fieldContainer.appendChild(newField);
        });
    </script>
    @endsection
@endsection