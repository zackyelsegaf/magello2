@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-4">
                        <h3 class="page-title mt-5">Tambah Data Faktur</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pembelian/faktur/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12">
                                <div class="row checkbox-row-mobile-horizontal">
                                    <div class="col-md-2 p-2">
                                        <div class="form-group">
                                            <div class="dd"></div>
                                            <div class="checkbox-wrapper-4">
                                                <input type="hidden" name="pajak_check" value="0">
                                                <input class="inp-cbx" name="pajak_check" id="pajak_check" type="checkbox" value="1" {{ old('pajak_check') ? 'checked' : '' }}>
                                                <label class="cbx" for="pajak_check">
                                                    <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                    <span><strong>Pajak</strong></span>
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
                                                <input type="hidden" name="termasuk_pajak_check" value="0">
                                                <input class="inp-cbx" name="termasuk_pajak_check" id="termasuk_pajak_check" type="checkbox" value="1" {{ old('termasuk_pajak_check') ? 'checked' : '' }} disabled>
                                                <label class="cbx" for="termasuk_pajak_check">
                                                    <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                    <span><strong>Termasuk Pajak</strong></span>
                                                </label>
                                                <svg class="inline-svg">
                                                    <symbol id="check-4" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </symbol>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-2 p-2">
                                        <div class="form-group">
                                            <div class="dd"></div>
                                            <div class="checkbox-wrapper-4">
                                                <input type="hidden" name="tutup_check" value="0">
                                                <input class="inp-cbx" name="tutup_check" id="tutup_check" type="checkbox" value="1" {{ old('tutup_check') ? 'checked' : '' }}>
                                                <label class="cbx" for="tutup_check">
                                                    <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                    <span><strong>Tutup</strong></span>
                                                </label>
                                                <svg class="inline-svg">
                                                    <symbol id="check-4" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </symbol>
                                                </svg>
                                            </div>
                                        </div>
                                    </div> --}}
                                    <div class="col-md-2 p-2">
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
                                    {{-- <div class="col-md-3 p-2">
                                        <div class="form-group">
                                            <div class="dd"></div>
                                            <div class="checkbox-wrapper-4">
                                                <input type="hidden" name="uang_muka_check" value="0">
                                                <input class="inp-cbx" name="uang_muka_check" id="uang_muka_check" type="checkbox" value="1" {{ old('uang_muka_check') ? 'checked' : '' }}>
                                                <label class="cbx" for="uang_muka_check">
                                                    <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                    <span><strong>Uang Muka</strong></span>
                                                </label>
                                                <svg class="inline-svg">
                                                    <symbol id="check-4" viewbox="0 0 12 10">
                                                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                    </symbol>
                                                </svg>
                                            </div>
                                        </div>
                                    </div> --}}
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
                                                <label>No. Faktur</label>
                                                <input type="text" class="form-control" name="no_faktur" value="{{ $kodeBaru }}">
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
                                                <input type="text" class="form-control" name="no_formulir" value="{{ $kodeBaru }}" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Pengguna</label>
                                            <input type="text" class="form-control" name="pengguna_faktur" value="{{ Auth::user()->name }}">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Status</label>
                                            <input type="text" class="form-control" name="status_faktur" value="Menunggu">
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tanggal Faktur</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker @error('tgl_faktur') is-invalid @enderror" name="tgl_faktur" value="{{ old('tgl_faktur') }}"> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Pemasok</label>
                                                <select id="namaBarangSelect" class="form-control @error('pemasok_faktur') is-invalid @enderror" name="pemasok_faktur">
                                                    <option {{ old('pemasok_faktur') ? '' : 'selected' }} disabled> -- Pilih Pemasok</option>
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
                                                <select id="noPemasokSelect" class="form-control"  name="no_pemasok" style="display: none">
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
                                                <select class="form-control @error('proyek') is-invalid @enderror"  name="proyek">
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
                                                <select class="form-control @error('gudang') is-invalid @enderror" id="default_gudang" name="gudang">
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
                                                <select class="form-control @error('departemen') is-invalid @enderror"  name="departemen">
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
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#rincian">Rincian Barang</a> 
                            </li>
                            {{-- <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#rincianbiaya">Rincian Biaya</a> 
                            </li> --}}
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#informasi">Informasi</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#ricape">Rincian Catatan Pemeriksaan</a> 
                            </li>
                        </ul>
                    </div>
                    <div style="padding-bottom: 15px;" id="rincian" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="row float-right mr-0">
                                    {{-- <button type="button" class="btn btn-primary buttonedit mb-3" id="tambahBarangBtn">
                                        <strong><i class="fas fa-cube mr-3 ml-1"></i>Tambah</strong>
                                    </button> --}}
                                    <button type="button" class="btn btn-primary buttonedit mb-3 mr-3" data-toggle="modal" data-target="#modalPesanan">
                                        <strong><i class="fas fa-paper-plane mr-2 ml-1"></i>Pesanan Pembelian</strong>
                                    </button>
                                    <button type="button" class="btn btn-primary buttonedit mb-3 mr-3" data-toggle="modal" data-target="#modalPenerimaan">
                                        <strong><i class="fas fa-paper-plane mr-2 ml-1"></i>Penerimaan Pembelian</strong>
                                    </button>
                                    <button type="button" class="btn btn-primary buttonedit mb-3" data-toggle="modal" data-target="#modalBarang">
                                        <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                                    </button>
                                </div>
                                <!-- Modal -->
                                <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Pilih Barang</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div id="filterBox" class="mb-3">
                                                <div class="card m-3 text-white">
                                                    <div class="form-group mb-1">
                                                        <input type="text" name="no_barang" id="no_barang" class="form-control form-control-sm" placeholder="No Barang">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <input type="text" name="nama_barang" id="nama_barang" class="form-control form-control-sm" placeholder="Deskripsi">
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <select name="kategori_barang" id="kategori_barang" class="form-control form-control-sm">
                                                            <option value="">-- Pilih Kategori --</option>
                                                            @foreach($kategori_barang as $items)
                                                                <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-1">
                                                        <select name="tipe_persediaan" id="tipe_persediaan" class="form-control form-control-sm">
                                                            <option value="">-- Pilih Tipe Persediaan --</option>
                                                            @foreach($tipe_persediaan as $items)
                                                                <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    {{-- <div class="form-group mb-1">
                                                        <select name="nama_gudang" id="nama_gudang" class="form-control form-control-sm">
                                                            <option value="">-- Pilih Gudang --</option>
                                                            @foreach($gudang as $items)
                                                                <option value="{{ $items->nama_gudang }}">{{ $items->nama_gudang }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div> --}}
                                                </div>
                                            </div>                                            
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="tabelPilihBarang" style="margin: 0; border-collapse: collapse; width: 100%;">
                                                        <thead class="thead-dark">
                                                            <tr style="padding: 0; margin: 0;">
                                                                <th style="padding: 7px; text-align: center;"><input type="checkbox" id="checkAll"></th>
                                                                <th style="padding: 4px;">No. Barang</th>
                                                                <th style="padding: 4px;">Nama Barang</th>
                                                                <th style="padding: 4px;">Satuan</th>
                                                                <th style="padding: 4px;">Kuantitas</th>
                                                                <th style="padding: 4px;">Harga Satuan</th>
                                                                <th style="padding: 4px;">Kode Pajak</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($barang as $item)
                                                                <tr style="padding: 0; margin: 0;">
                                                                    <td style="padding: 4px; text-align: center;">
                                                                        <input type="checkbox" class="check-barang"
                                                                               data-id="{{ $item->no_barang }}"
                                                                               data-nama="{{ $item->nama_barang }}"
                                                                               data-satuan="{{ $item->satuan }}"
                                                                               data-biaya_satuan_saldo_awal="{{ $item->biaya_satuan_saldo_awal }}"
                                                                               data-kuantitas="{{ $item->kuantitas_saldo_awal }}"
                                                                               data-kode_pajak="{{ $item->kode_pajak || '' }}">
                                                                    </td>
                                                                    <td style="padding: 4px;">{{ $item->no_barang }}</td>
                                                                    <td style="padding: 4px;">{{ $item->nama_barang }}</td>
                                                                    <td style="padding: 4px;">{{ $item->satuan }}</td>
                                                                    <td style="padding: 4px;">{{ $item->kuantitas_saldo_awal }}</td>
                                                                    <td style="padding: 4px;">{{ $item->biaya_satuan_saldo_awal }}</td>
                                                                    <td style="padding: 4px;">{{ $item->kode_pajak || '' }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary buttonedit" id="tambahBarangTerpilih"><i class="fas fa-paper-plane mr-2"></i> Tambah ke Form</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal Pesanan --}}
                                <div class="modal fade" id="modalPesanan" tabindex="-1" role="dialog" aria-labelledby="modalPesananLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Pilih Pesanan</h5>
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
                                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="tabelPilihPesananBarang" style="margin: 0; border-collapse: collapse; width: 100%;">
                                                        <thead class="thead-dark">
                                                            <tr style="padding: 0; margin: 0;">
                                                                <th style="padding: 7px; text-align: center;"><input type="checkbox" id="checkAllPesanan"></th>
                                                                <th style="padding: 4px;">No. Pesanan</th>
                                                                <th style="padding: 4px;">Tanggal Pesanan</th>
                                                                <th style="padding: 4px;">Deskripsi</th>
                                                                <th style="padding: 4px;">No. Permintaan</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($pesanan_pembelian as $item)
                                                                <tr style="padding: 0; margin: 0;">
                                                                    <td style="padding: 4px; text-align: center;">
                                                                        <input type="checkbox" class="check-pesanan"
                                                                               data-id="{{ $item->no_pesanan }}"
                                                                               data-no_barang="{{ $item->no_barang }}"
                                                                               data-deskripsi_barang="{{ $item->deskripsi_barang }}"
                                                                               data-kts_pesanan="{{ $item->kts_pesanan }}"
                                                                               data-satuan="{{ $item->satuan }}"
                                                                               data-tgl="{{ $item->tgl_pesanan }}"
                                                                               data-deskripsi="{{ $item->deskripsi_pesanan }}"
                                                                               data-diskon="{{ $item->diskon_barang }}"
                                                                               data-no_permintaan="{{ $item->no_permintaan }}">
                                                                    </td>
                                                                    <td style="padding: 4px;">{{ $item->no_pesanan }}</td>
                                                                    <td style="padding: 4px;">{{ $item->tgl_pesanan }}</td>
                                                                    <td style="padding: 4px;">{{ $item->deskripsi_pesanan }}</td>
                                                                    <td style="padding: 4px;">{{ $item->no_permintaan }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary buttonedit" id="tambahPesananTerpilih"><i class="fas fa-paper-plane mr-2"></i> Tambah ke Form</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Modal Penerimaan --}}
                                <div class="modal fade" id="modalPenerimaan" tabindex="-1" role="dialog" aria-labelledby="modalPenerimaanLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content my-rounded-2">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Pilih Penerimaan</h5>
                                                <button type="button" class="close" data-dismiss="modal">
                                                    <span>&times;</span>
                                                </button>
                                            </div>
                                            <div id="filterBox" class="mb-3" style="display: none;">
                                                <div class="card m-3 text-white">
                                                    <div class="form-group mb-1">
                                                        <input type="text" name="no_penerimaan" id="no_penerimaan" class="form-control form-control-sm" placeholder="No Penerimaan">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="tabelPilihPenerimaanBarang" style="margin: 0; border-collapse: collapse; width: 100%;">
                                                        <thead class="thead-dark">
                                                            <tr style="padding: 0; margin: 0;">
                                                                <th style="padding: 7px; text-align: center;"><input type="checkbox" id="checkAllPenerimaan"></th>
                                                                <th style="padding: 4px;">No. Penerimaan</th>
                                                                <th style="padding: 4px;">Tanggal Penerimaan</th>
                                                                <th style="padding: 4px;">Deskripsi</th>
                                                                <th style="padding: 4px;">No. Formulir</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($penerimaan_pembelian as $item)
                                                                <tr style="padding: 0; margin: 0;">
                                                                    <td style="padding: 4px; text-align: center;">
                                                                        <input type="checkbox" class="check-penerimaan"
                                                                               data-id="{{ $item->no_penerimaan }}"
                                                                               data-no_barang="{{ $item->no_barang }}"
                                                                               data-deskripsi_barang="{{ $item->deskripsi_barang }}"
                                                                               data-kts_pesanan="{{ $item->kts_penerimaan }}"
                                                                               data-satuan="{{ $item->satuan }}"
                                                                               data-tgl="{{ $item->tgl_penerimaan }}"
                                                                               data-deskripsi="{{ $item->deskripsi_penerimaan }}"
                                                                               data-formulir="{{ $item->no_formulir }}">
                                                                    </td>
                                                                    <td style="padding: 4px;">{{ $item->no_penerimaan }}</td>
                                                                    <td style="padding: 4px;">{{ $item->tgl_penerimaan }}</td>
                                                                    <td style="padding: 4px;">{{ $item->deskripsi_penerimaan }}</td>
                                                                    <td style="padding: 4px;">{{ $item->no_formulir }}</td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>                                                    
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-primary buttonedit" id="tambahPenerimaanTerpilih"><i class="fas fa-paper-plane mr-2"></i> Tambah ke Form</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <i class="fa fa-exclamation-triangle mr-2"></i><strong>Halo {{ Auth::user()->name }}, </strong> Setelah pilih barang, jangan lupa isi kuantitas pesanannya!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Dari</th>
                                                <th>No. Barang</th>
                                                <th>Deskripsi Barang</th>
                                                <th>Kts</th>
                                                <th>Satuan</th>
                                                <th>Harga Satuan</th>
                                                <th>Diskon %</th>
                                                <th>Pajak</th>
                                                <th>Jumlah</th>
                                                <th>Reserve 1</th>
                                                <th>Reserve 2</th>
                                                <th>Reserve 3</th>
                                                <th>No. Penerimaan</th>
                                                <th>No. Pesanan</th>
                                                <th>No. Permintaan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="barangTableBody">
                                            @if(old('no_barang'))
                                                @foreach(old('no_barang') as $index => $no_barang)
                                                    <tr>
                                                        {{-- <td style="background-color: {{ $isPesanan ? '#27548A' : '#333' }};">
                                                            <h7 class="font-weight-bold text-white">{{ $isPesanan ? 'Pesanan' : 'Barang' }}</h7>
                                                        </td> --}}
                                                        <td><input style="width: 150px;" type="text" name="no_barang[]" value="{{ $no_barang }}" class="form-control form-control-sm" readonly></td>
                                                        <td><input style="width: 150px;" type="text" name="deskripsi_barang[]" value="{{ old('deskripsi_barang')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="kts_faktur[]" value="{{ old('kts_faktur')[$index] ?? '' }}" class="form-control form-control-sm @error("kts_faktur.$index") is-invalid @enderror">
                                                            @error("kts_faktur.$index")
                                                                <p class="Invalid-feedback">{{ $message }}</p>
                                                            @enderror
                                                        </td>
                                                        <td><input style="width: 150px;" type="text" name="satuan[]" value="{{ old('satuan')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="harga_satuan[]" value="{{ old('harga_satuan')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="diskon_barang[]" value="{{ old('diskon_barang')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="kode_pajak[]" value="{{ old('kode_pajak')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="jumlah_total_harga[]" value="{{ old('jumlah_total_harga')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="reserve_1[]" value="{{ old('reserve_1')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="reserve_2[]" value="{{ old('reserve_2')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="reserve_3[]" value="{{ old('reserve_3')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="no_penerimaan[]" value="{{ old('no_penerimaan')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="no_pesanan[]" value="{{ old('no_pesanan')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="no_permintaan[]" value="{{ old('no_permintaan')[$index] ?? '' }}" class="form-control form-control-sm"></td>
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
                    <div style="padding-bottom: 15px;" id="rincianbiaya" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Akun</th>
                                                <th>Nama Akun</th>
                                                <th>Jumlah</th>
                                                <th>Catatan</th>
                                                <th>Alokasi ke Barang</th>
                                                <th>Alokasi ke Pemasok</th>
                                                <th>Beban ke Tagihan</th>
                                                <th>Nama Pemasok</th>
                                                <th>No. Faktur</th>
                                                <th>Nama Akun</th>
                                                <th>Tanggal</th>
                                            </tr>
                                        </thead>
                                        <tbody id="barangTableBody">
                                            <tr>
                                                {{-- <td style="background-color: {{ $isPesanan ? '#27548A' : '#333' }};">
                                                    <h7 class="font-weight-bold text-white">{{ $isPesanan ? 'Pesanan' : 'Barang' }}</h7>
                                                </td> --}}
                                                <td><input style="width: 150px;" type="text" name="no_akun" value="{{ old('no_akun') }}" class="form-control form-control-sm" readonly></td>
                                                <td><input style="width: 150px;" type="text" name="nama_akun" value="{{ old('nama_akun') }}" class="form-control form-control-sm"></td>
                                                <td><input style="width: 150px;" type="text" name="jumlah" value="{{ old('jumlah') }}" class="form-control form-control-sm"></td>
                                                <td><input style="width: 150px;" type="text" name="catatan" value="{{ old('catatan') }}" class="form-control form-control-sm"></td>
                                                <td>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="alokasi_barang_check" value="0">
                                                        <input class="inp-cbx" name="alokasi_barang_check" id="alokasi_barang_check" type="checkbox" value="1"
                                                            {{ old("alokasi_barang_check") ? 'checked' : '' }}>
                                                        <label class="cbx" for="alokasi_barang_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="alokasi_pemasok_check" value="0">
                                                        <input class="inp-cbx" name="alokasi_pemasok_check" id="alokasi_pemasok_check" type="checkbox" value="1"
                                                            {{ old("alokasi_pemasok_check") ? 'checked' : '' }}>
                                                        <label class="cbx" for="alokasi_pemasok_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="checkbox-wrapper-4">
                                                        <input type="hidden" name="beban_tagihan_check" value="0">
                                                        <input class="inp-cbx" name="beban_tagihan_check" id="beban_tagihan_check" type="checkbox" value="1"
                                                            {{ old("beban_tagihan_check") ? 'checked' : '' }}>
                                                        <label class="cbx" for="beban_tagihan_check">
                                                            <span><svg width="12px" height="10px"><use xlink:href="#check-4"></use></svg></span>
                                                        </label>
                                                        <svg class="inline-svg">
                                                            <symbol id="check-4" viewbox="0 0 12 10">
                                                                <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                                                            </symbol>
                                                        </svg>
                                                    </div>
                                                </td>
                                                <td><input style="width: 150px;" type="text" name="nama_pemasok_detail" value="{{ old('nama_pemasok_detail') }}" class="form-control form-control-sm"></td>
                                                <td><input style="width: 150px;" type="text" name="no_faktur_detail" value="{{ old('no_faktur_detail') }}" class="form-control form-control-sm"></td>
                                                <td><input style="width: 150px;" type="text" name="nama_akun" value="{{ old('nama_akun') }}" class="form-control form-control-sm"></td>
                                                <td><input style="width: 150px;" type="date" name="tanggal_detail" value="{{ old('tanggal_detail') }}" class="form-control form-control-sm"></td>
                                            </tr>
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
                                                <textarea id="alamatPemasokInput" class="form-control @error('alamat_pemasok') is-invalid @enderror" name="alamat_pemasok" placeholder="Alamat Pemasok">{{ old('alamat_pemasok') }}</textarea>
                                            </div>                                       
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Tgl. Kirim</strong></label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker" name="tgl_kirim" value="{{ old('tgl_kirim') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <label><strong>Nilai Tukar</strong></label>
                                                <input id="nilaiTukarInput" type="text" class="form-control" name="nilai_tukar" value="{{ old('nilai_tukar') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <label><strong>Nilai Tukar Pajak</strong></label>
                                                <input id="nilaiTukarPajak" type="text" class="form-control" name="nilai_tukar_pajak" value="{{ old('nilai_tukar_pajak') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Kirim Melalui</strong></label>
                                                <select name="kirim_melalui" id="kirim_melalui" class="form-control">
                                                    <option value="0">0</option>
                                                    <option value="Tidak ada data" disabled>Tidak ada data</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>Tgl. Pajak</strong></label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker" name="tgl_pajak" value="{{ old('tgl_pajak') }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-1">
                                                <label><strong>FOB</strong></label>
                                                <select name="fob" class="form-control">
                                                    <option value="">-- Pilih FOB --</option>
                                                    <option value="Shipping Point">Shipping Point</option>
                                                    <option value="Destination">Destination</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label><strong>No. Faktur Pajak</strong></label>
                                                <input type="text" class="form-control" name="no_faktur_pajak" value="{{ old('no_faktur_pajak') }}">
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
                                                    <input type="text" class="form-control" name="fileupload_1" placeholder="Link dokumen Anda" value="{{ old('fileupload_1') }}">
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
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_1" placeholder="Deskripsi">{{ old('deskripsi_1') }}</textarea>
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
                                                    <textarea style="width: 300px; height:100px;" class="form-control" name="deskripsi_2" value="{{ old('deskripsi_2') }}" placeholder="Deskripsi">{{ old('deskripsi_2') }}</textarea>
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
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="deskripsi" class="tab-pane fade show active">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control" name="deskripsi_faktur" value="{{ old('deskripsi_faktur') }}" placeholder="Deskripsi">{{ old('deskripsi_faktur') }}</textarea> 
                                                </div>
                                            </div>
                                        </div>
                                        <div id="uang_muka_form" style="display: none;">
                                            <div class="form-group">
                                                <label>Akun Piutang</label>
                                                <select class="form-control form-control-sm" name="akun_uang_muka">
                                                    <option selected disabled> --Pilih Sub-- </option>
                                                    @foreach ($nama_akun as $items )
                                                        <option value="{{ $items->no_akun }}"
                                                            @if($items->nama_akun_indonesia == 'Hutang Dagang - IDR') selected @endif>
                                                            {{ $items->no_akun .' '. $items->nama_akun_indonesia }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Uang Muka</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm" name="uang_muka" value="{{ old('uang_muka') }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label>Uang Muka Terpakai</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-sm" name="uang_muka_terpakai" value="{{ old('uang_muka_terpakai') }}">
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
                        <div class="col-md-6">
                            <div style="padding-bottom: 400px;" id="deskripsi" class="tab-pane fade show active">
                                <div class="card float-right">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label><strong>Sub Total</strong></label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="sub_total" value="{{ old('sub_total') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label>Diskon</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="input-group input-group-sm mb-4" style="width: 120px;">
                                                    <input type="number" class="form-control" name="diskon_left" value="{{ old('diskon_left') }}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">%</span>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="total_diskon_right" value="{{ old('total_diskon_right') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="ppnRow" style="display: none;">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label>PPN 11%</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" id="ppn_11_persen" name="ppn_11_persen" value="{{ old('ppn_11_persen') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row" id="pajak2Row" style="display: none;">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label>Pajak 2</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" name="pajak_2" value="{{ old('pajak_2') }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label>Jumlah Biaya</label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" id="jumlah_biaya" name="jumlah_biaya" value="{{ old('jumlah_biaya') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4 p-0">
                                                <div class="form-group">
                                                    <label><strong>Jumlah</strong></label>
                                                </div>
                                            </div>
                                            <div class="col-md-8 p-0">
                                                <div class="form-group">
                                                    <input type="text" class="form-control form-control-sm" id="jumlah" name="jumlah" value="{{ old('jumlah') }}" readonly>
                                                </div>
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
                            <a href="{{ route('pembelian/faktur/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
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
                url: "{{ route('get-faktur2-data') }}",
                method: 'GET',
                data: {
                    no_barang: $('#no_barang').val(),
                    nama_barang: $('#nama_barang').val(),
                    kategori_barang: $('#kategori_barang').val(),
                    tipe_persediaan: $('#tipe_persediaan').val(),
                    default_gudang: $('#default_gudang').val()
                },
                success: function(response) {
                    let tbody = '';
                    response.forEach(item => {
                        tbody += `
                            <tr>
                                <td style="text-align: center;">
                                    <input type="checkbox" class="check-barang"
                                        data-id="${item.no_barang}"
                                        data-nama="${item.nama_barang}"
                                        data-satuan="${item.satuan}"
                                        data-kuantitas="${item.kuantitas_saldo_awal}"
                                        data-biaya_satuan_saldo_awal="${item.biaya_satuan_saldo_awal}"
                                        data-kode_pajak="${item.kode_pajak || ''}">

                                </td>
                                <td>${item.no_barang}</td>
                                <td>${item.nama_barang}</td>
                                <td>${item.satuan}</td>
                                <td>${item.kuantitas_saldo_awal}</td>
                                <td>${item.biaya_satuan_saldo_awal}</td>
                                <td>${item.kode_pajak || ''}</td>
                            </tr>
                        `;
                    });
                    $('#tabelPilihBarang tbody').html(tbody);
                }
            });
        }

        $('#no_barang, #nama_barang, #kategori_barang, #tipe_persediaan, #default_gudang').on('keyup change', function() {
            fetchFilteredData();
        });
    });
    </script>
    <script>
        $(document).ready(function() {
        function fetchFilteredData() {
            $.ajax({
                url: "{{ route('get-faktur23-data') }}",
                method: 'GET',
                data: {
                    no_pesanan: $('#no_pesanan').val(),
                    pemasok_pesanan: $('#namaBarangSelect').val()
                },
                success: function(response) {
                    let tbody = '';
                    response.forEach(item => {
                        tbody += `
                            <tr>
                                <td style="text-align: center;">
                                    <input type="checkbox" class="check-pesanan"
                                        data-id="${item.no_pesanan}"
                                        data-no_barang="${item.no_barang}"
                                        data-deskripsi_barang="${item.deskripsi_barang}"
                                        data-kts_pesanan="${item.kts_pesanan}"
                                        data-tgl="${item.tgl_pesanan}"
                                        data-deskripsi="${item.deskripsi_pesanan}"
                                        data-diskon="${item.diskon_barang}"
                                        data-no_permintaan="${item.no_permintaan}">
                                </td>
                                <td style="padding: 4px;">${item.no_pesanan}</td>
                                <td style="padding: 4px;">${item.tgl_pesanan}</td>
                                <td style="padding: 4px;">${item.deskripsi_pesanan || ''}</td>
                                <td style="padding: 4px;">${item.no_permintaan || ''}</td>
                            </tr>
                        `;
                    });
                    $('#tabelPilihPesananBarang tbody').html(tbody);
                }
            });
        }

        $('#no_pesanan, #namaBarangSelect').on('keyup change', function() {
            fetchFilteredData();
        });
    });
    </script>
    <script>
        $(document).ready(function() {
        function fetchFilteredData() {
            $.ajax({
                url: "{{ route('get-faktur23-data') }}",
                method: 'GET',
                data: {
                    no_penerimaan: $('#no_penerimaan').val(),
                    pemasok_penerimaan: $('#namaBarangSelect').val()
                },
                success: function(response) {
                    let tbody = '';
                    response.forEach(item => {
                        tbody += `
                            <tr>
                                <td style="text-align: center;">
                                    <input type="checkbox" class="check-penerimaan"
                                        data-id="${item.no_penerimaan}"
                                        data-no_barang="${item.no_barang}"
                                        data-deskripsi_barang="${item.deskripsi_barang}"
                                        data-kts_penerimaan="${item.kts_penerimaan}"
                                        data-harga_satuan="${item.harga_satuan}"
                                        data-tgl="${item.tgl_penerimaan}"
                                        data-deskripsi="${item.deskripsi_penerimaan}">
                                </td>
                                <td style="padding: 4px;">${item.no_penerimaan}</td>
                                <td style="padding: 4px;">${item.tgl_penerimaan}</td>
                                <td style="padding: 4px;">${item.deskripsi_penerimaan || ''}</td>
                                <td style="padding: 4px;">${item.no_permintaan || ''}</td>
                            </tr>
                        `;
                    });
                    $('#tabelPilihPenerimaanBarang tbody').html(tbody);
                }
            });
        }

        $('#no_penerimaan, #namaBarangSelect').on('keyup change', function() {
            fetchFilteredData();
        });
    });
    </script>             
    <script>
        $(document).ready(function () {
        $('#checkAll').click(function () {
            $('.check-barang').prop('checked', this.checked);
        });
    
        $('#tambahBarangTerpilih').click(function () {
            $('.check-barang:checked').each(function () {
                let id = $(this).data('id');
                let nama = $(this).data('nama');
                let satuan = $(this).data('satuan');
                let kuantitas = $(this).data('kuantitas');
                let biaya_satuan_saldo_awal = $(this).data('biaya_satuan_saldo_awal');
                let kode_pajak = $(this).data('kode_pajak') || '';
    
                let newRow = `
                <tr class="barang-row">
                    <td style="background-color: #333; width: 150px;"><h7 class="font-weight-bold text-white" >Barang</h7></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_barang[]" value="${id}" readonly></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm  deskripsi-barang-input" name="deskripsi_barang[]" value="${nama}"></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kts_faktur[]" value=""></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="satuan[]" value="${satuan}"></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="harga_satuan[]" value="${biaya_satuan_saldo_awal  || ''}"></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="diskon_barang[]" value=""></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kode_pajak[]" value="${kode_pajak || ''}"></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="jumlah_total_harga[]" value=""></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_1[]" value=""></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_2[]" value=""></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_3[]" value=""></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_penerimaan[]" value=""></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_pesanan[]" value=""></td>
                    <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_permintaan[]" value=""></td>
                    <td><button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                </tr>`;
                
                $('#barangTableBody').append(newRow);
            });
    
            $('#modalBarang').modal('hide');
        });

        $(document).on('click', '.remove-row', function () {
            $(this).closest('tr').remove();
        });

        $('#modalBarang').on('show.bs.modal', function () {
            $('#checkAll').prop('checked', false);
            $('.check-barang').prop('checked', false);
        });
    });
    </script>
    <script>
        $(document).ready(function () {
            $('#checkAllPesanan').click(function () {
                $('.check-pesanan').prop('checked', this.checked);
            });

            $('#tambahPesananTerpilih').click(function () {
                let selectedPesanan = $('.check-pesanan:checked').first();
                if (selectedPesanan.length === 0) {
                    alert("Pilih minimal satu pesanan terlebih dahulu.");
                    return;
                }

                let no_pesanan = selectedPesanan.data('id');

                $.ajax({
                    url: '/get-detail-faktur',
                    method: 'GET',
                    data: { no_pesanan: no_pesanan },
                    success: function (data) {
                        data.forEach(item => {
                            let newRow = `
                            <tr class="pesanan-row">
                                <td style="background-color: #27548A;"><h7 class="font-weight-bold text-white">Pesanan</h7></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_barang[]" value="${item.no_barang}" readonly></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="deskripsi_barang[]" value="${item.deskripsi_barang}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kts_faktur[]" value="${item.kts_pesanan || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="satuan[]" value="${item.satuan}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="harga_satuan[]" value="${item.harga_satuan || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="diskon_barang[]" value="${item.diskon_barang || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kode_pajak[]" value="${item.pajak || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="jumlah_total_harga[]" value="${item.jumlah_total_harga || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_1[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_2[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_3[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_penerimaan[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_pesanan[]" value="${item.no_pesanan || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_permintaan[]" value="${item.no_permintaan || ''}"></td>
                                <td><button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                            </tr>`;
                            $('#barangTableBody').append(newRow);
                        });

                        $('#modalPesanan').modal('hide');
                        hitungSemuaJumlahDanSubTotal();
                    },
                    error: function () {
                        alert("Gagal mengambil data detail pesanan.");
                    }
                });
            });

            $('#modalPesanan').on('show.bs.modal', function () {
                $('#checkAllPesanan').prop('checked', false);
                $('.check-pesanan').prop('checked', false);
            });

            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
                hitungSemuaJumlahDanSubTotal();
            });

            $(document).on('input', 'input[name="kts_pesanan[]"], input[name="kts_faktur[]"], input[name="harga_satuan[]"], input[name="diskon_barang[]"], input[name="diskon_left"], #estimasi_biaya, #aktif_ppn', function () {
                hitungSemuaJumlahDanSubTotal();
            });

            function hitungSemuaJumlahDanSubTotal() {
                let subTotal = 0;

                $('#barangTableBody tr').each(function () {
                    let kts = parseFloat($(this).find('input[name="kts_pesanan[]"], input[name="kts_faktur[]"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    let harga = parseFloat($(this).find('input[name="harga_satuan[]"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    let diskon = parseFloat($(this).find('input[name="diskon_barang[]"]').val()?.replace('%', '').replace(',', '.')) || 0;

                    let jumlah = kts * harga * (1 - (diskon / 100));
                    jumlah = parseFloat(jumlah);

                    $(this).find('input[name="jumlah_total_harga[]"]').val(jumlah);
                    subTotal += jumlah;
                });

                $('input[name="sub_total"]').val(subTotal);

                let diskonPersen = parseFloat($('input[name="diskon_left"]').val()?.replace(',', '.')) || 0;
                let totalDiskon = subTotal * (diskonPersen / 100);
                $('input[name="total_diskon_right"]').val(totalDiskon);

                let pajakCheckbox = document.getElementById('pajak_check');
                let ppn = (pajakCheckbox && pajakCheckbox.checked) ? (subTotal - totalDiskon) * 0.11 : 0;
                $('input[name="ppn_11_persen"]').val(ppn);

                let estimasiBiaya = parseFloat($('input[name="estimasi_biaya"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                let jumlahTotal = subTotal - totalDiskon + ppn + estimasiBiaya;
                $('input[name="jumlah"]').val(jumlahTotal);
            }
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#checkAllPenerimaan').click(function () {
                $('.check-penerimaan').prop('checked', this.checked);
            });

            $('#tambahPenerimaanTerpilih').click(function () {
                let selectedPenerimaan = $('.check-penerimaan:checked').first();
                if (selectedPenerimaan.length === 0) {
                    alert("Pilih minimal satu penerimaan terlebih dahulu.");
                    return;
                }

                let no_penerimaan = selectedPenerimaan.data('id');

                $.ajax({
                    url: '/get-detail2-faktur',
                    method: 'GET',
                    data: { no_penerimaan: no_penerimaan },
                    success: function (data) {
                        data.forEach(item => {
                            let newRow = `
                            <tr class="penerimaan-row">
                                <td style="background-color: #3A83DDFF;"><h7 class="font-weight-bold text-white">Penerimaan</h7></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_barang[]" value="${item.no_barang}" readonly></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="deskripsi_barang[]" value="${item.deskripsi_barang}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kts_faktur[]" value="${item.kts_penerimaan || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="satuan[]" value="${item.satuan}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="harga_satuan[]" value="${item.harga_satuan || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="diskon_barang[]" value="${item.diskon_barang || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kode_pajak[]" value="${item.kode_pajak || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="jumlah_total_harga[]" value="${item.jumlah_total_harga || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_1[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_2[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="reserve_3[]" value=""></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_penerimaan[]" value="${item.no_penerimaan || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_pesanan[]" value="${item.no_pesanan || ''}"></td>
                                <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_permintaan[]" value="${item.no_permintaan || ''}"></td>
                                <td><button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                            </tr>`;

                            $('#barangTableBody').append(newRow);
                        });

                        $('#modalPenerimaan').modal('hide');
                        hitungSemuaJumlahDanSubTotal();
                    },
                    error: function () {
                        alert("Gagal mengambil data detail penerimaan.");
                    }
                });
            });

            $(document).on('click', '.remove-row', function () {
                $(this).closest('tr').remove();
                hitungSemuaJumlahDanSubTotal();
            });

            $('#modalPenerimaan').on('show.bs.modal', function () {
                $('#checkAllPenerimaan').prop('checked', false);
                $('.check-penerimaan').prop('checked', false);
            });

            $(document).on('input', 'input[name="kts_faktur[]"], input[name="harga_satuan[]"], input[name="diskon_barang[]"], input[name="diskon_left"], #estimasi_biaya, #aktif_ppn', function () {
                hitungSemuaJumlahDanSubTotal();
            });

            function hitungSemuaJumlahDanSubTotal() {
                let subTotal = 0;

                $('#barangTableBody tr').each(function () {
                    let kts = parseFloat($(this).find('input[name="kts_faktur[]"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    let harga = parseFloat($(this).find('input[name="harga_satuan[]"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                    let diskon = parseFloat($(this).find('input[name="diskon_barang[]"]').val()?.replace('%', '').replace(',', '.')) || 0;

                    let jumlah = kts * harga * (1 - (diskon / 100));
                    jumlah = parseFloat(jumlah);

                    $(this).find('input[name="jumlah_total_harga[]"]').val(jumlah);
                    subTotal += jumlah;
                });

                $('input[name="sub_total"]').val(subTotal);

                let diskonPersen = parseFloat($('input[name="diskon_left"]').val()?.replace(',', '.')) || 0;
                let totalDiskon = subTotal * (diskonPersen / 100);
                $('input[name="total_diskon_right"]').val(totalDiskon);

                let pajakCheckbox = document.getElementById('pajak_check');
                let ppn = (pajakCheckbox && pajakCheckbox.checked) ? (subTotal - totalDiskon) * 0.11 : 0;
                $('input[name="ppn_11_persen"]').val(ppn);

                let estimasiBiaya = parseFloat($('input[name="estimasi_biaya"]').val()?.replace(/\./g, '').replace(/,/g, '.')) || 0;
                let jumlahTotal = subTotal - totalDiskon + ppn + estimasiBiaya;
                $('input[name="jumlah"]').val(jumlahTotal);
            }
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
            const pajakCheckbox = document.getElementById('pajak_check');
            const termasukPajakCheckbox = document.getElementById('termasuk_pajak_check');
            const satuanSelect = document.getElementById('satuanSelect');
            const ppnRow = document.getElementById('ppnRow');
            const pajak2Row = document.getElementById('pajak2Row');


            // Tak set gini pas awal mau isi form
            termasukPajakCheckbox.disabled = true;
            pajakCheckbox.disabled = false;

            function togglePPNDisplay() {
                if (pajakCheckbox.checked) {
                    ppnRow.style.display = 'flex';
                } else {
                    ppnRow.style.display = 'none';
                }
            }

            function togglePajak2Display() {
                if (pajakCheckbox.checked) {
                    pajak2Row.style.display = 'flex';
                } else {
                    pajak2Row.style.display = 'none';
                }
            }

            togglePPNDisplay();
            togglePajak2Display();

            pajakCheckbox.addEventListener('change', togglePPNDisplay);
            pajakCheckbox.addEventListener('change', togglePajak2Display);

            namaBarangSelect.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];
                const pajakValue = selectedOption.getAttribute('data-pajak');

                // Ini buat nek pas kosong nilainya
                if (selectedOption.value === "") {
                    termasukPajakCheckbox.disabled = true;
                    termasukPajakCheckbox.checked = false;

                    pajakCheckbox.disabled = true;
                    pajakCheckbox.checked = false;
                } else {
                    // pajak_1_check = 1
                    if (pajakValue === "1") {
                        pajakCheckbox.disabled = false;
                        pajakCheckbox.checked = true;

                        termasukPajakCheckbox.disabled = false;
                    } else {
                    // pajak_1_check = 0
                        pajakCheckbox.checked = false;
                        pajakCheckbox.disabled = true;

                        termasukPajakCheckbox.checked = false;
                        termasukPajakCheckbox.disabled = true;
                    }
                }

                togglePPNDisplay();
                togglePajak2Display();

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