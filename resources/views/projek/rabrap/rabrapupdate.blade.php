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
            <form method="POST" action="{{ route('rabrap/update', $updateRabRap->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="judul_rap" class="form-label fw-bold">Judul</label>
                        <input type="text" id="judul_rap" name="judul_rap" class="form-control form-control-sm @error('judul_rap') is-invalid @enderror" value="{{ old('judul_rap', $updateRabRap->judul_rap) }}">
                        @error('judul_rap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal_pencatatan" class="form-label fw-bold">Tanggal</label>
                        <input type="text" id="tanggal_pencatatan" name="tanggal_pencatatan" class="form-control form-control-sm datetimepicker @error('tanggal_pencatatan') is-invalid @enderror" value="{{ old('tanggal_pencatatan') }}">
                        @error('tanggal_pencatatan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="cluster" class="form-label fw-bold">Perumahan Cluster</label>
                        <select class="tomselect @error('cluster') is-invalid @enderror" name="cluster" id="cluster" data-placeholder="Pilih cluster...">
                            <option selected disabled></option>
                            @foreach ($cluster as $items )
                            <option value="{{ $items->nama_cluster }}" {{ old('cluster', $updateRabRap->cluster) == $items->nama_cluster ? 'selected' : '' }}>{{ $items->nama_cluster }}</option>
                            @endforeach
                        </select>
                        @error('cluster')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tipe_model" class="form-label fw-bold">Tipe Model</label>
                        <select class="tomselect @error('tipe_model') is-invalid @enderror" name="tipe_model" id="tipe_model" data-placeholder="Pilih Tipe Model...">
                            <option {{ old('tipe_model', $updateRabRap->tipe_model) ? '' : 'selected' }} disabled>-- Pilih Tipe Model --</option>
                            <option value="Kapling" {{ old('tipe_model', $updateRabRap->tipe_model) == 'Kapling' ? 'selected' : '' }}>Kapling</option>
                            <option value="Fasos" {{ old('tipe_model', $updateRabRap->tipe_model) == 'Fasos' ? 'selected' : '' }}>Fasilitas Sosial</option>
                            <option value="Fasum" {{ old('tipe_model', $updateRabRap->tipe_model) == 'Fasum' ? 'selected' : '' }}>Fasilitas Umum</option>
                        </select>
                        @error('tipe_model')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="persen_kenaikan_qty" class="form-label fw-bold text-nowrap">Persentase Kenaikan Kuantitas RAP ke RAB</label>
                        <input type="number" id="persen_kenaikan_qty" name="persen_kenaikan_qty" class="form-control form-control-sm" value="{{ old('persen_kenaikan_qty', $updateRabRap->persen_kenaikan_qty) }}" placeholder="Persentase Kenaikan Kuantitas RAP ke RAB">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="total_rap" class="form-label fw-bold">Total RAP</label>
                        <input type="text" id="total_rap" name="total_rap" class="form-control form-control-sm rupiah" value="{{ old('total_rap', $updateRabRap->total_rap) }}" placeholder="Total RAP" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="total_rab" class="form-label fw-bold">Total RAB</label>
                        <input type="text" id="total_rab" name="total_rab" class="form-control form-control-sm rupiah" value="{{ old('total_rab', $updateRabRap->total_rab) }}" placeholder="Total RAB" readonly>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">

                        {{-- Tombol Tambah  --}}
                        <div class="row float-right mr-0">
                            {{-- <button type="button" class="btn btn-primary buttonedit mb-3" data-toggle="modal"
                                data-target="#modal">
                                <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                            </button> --}}
                            <button type="button" class="btn btn-primary buttonedit mb-3" data-toggle="modal" data-target="#modalBarang">
                                <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                            </button>
                        </div>

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
                                        </div>
                                    </div>
                                    <div class="modal-body">
                                        <div class="table-responsive">
                                            <table class="datatable table table-striped table-bordered table-hover table-center mb-0" id="tabelPilihBarang" style="margin: 0; border-collapse: collapse; width: 100%;">
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
                                                                        data-kode_pajak="{{ $item->kode_pajak }}">
                                                            </td>
                                                            <td style="padding: 4px;">{{ $item->no_barang }}</td>
                                                            <td style="padding: 4px;">{{ $item->nama_barang }}</td>
                                                            <td style="padding: 4px;">{{ $item->satuan }}</td>
                                                            <td style="padding: 4px;">{{ $item->kuantitas_saldo_awal }}</td>
                                                            <td style="padding: 4px;">{{ $item->biaya_satuan_saldo_awal }}</td>
                                                            <td style="padding: 4px;">{{ $item->kode_pajak }}</td>
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

                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    <p class="font-weight-bold mb-0 h6">RAP & RAB Items</p>
                                </div>
                            </div>
                            <div class="col-md-12 mr-1">
                                <div class="text-center">
                                    <p class="font-weight-light">Silahkan masukkan poin - poin RAP & RAB</p>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Item RAP & RAB -->
                        <div class="table-responsive">
                            {{-- Tabel  --}}
                            <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
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
                                <tbody id="barangTableBody">
                                    @foreach ($updateRabRap->detail as $index => $detail)
                                        <tr class="barang-row">
                                            <td style="display: none;"><input style="width: 150px;" type="text" name="no_item[]" value="{{ $detail->no_item }}" class="form-control form-control-sm" readonly></td>
                                            <td><input style="width: 150px;" type="text" name="nama_item[]" value="{{ $detail->nama_item }}" class="form-control form-control-sm"></td>
                                            <td><input style="width: 150px;" type="text" name="satuan[]" value="{{ $detail->satuan }}" class="form-control form-control-sm"></td>
                                            <td><input style="width: 150px;" type="text" name="rap_qty[]" value="{{ $detail->rap_qty }}" class="form-control form-control-sm @error("rap_qty.$index") is-invalid @enderror">
                                                @error("rap_qty.$index")
                                                    <p class="Invalid-feedback ">{{ $message }}</p>
                                                @enderror
                                            </td>
                                            <td><input style="width: 150px;" type="text" name="persen_naik[]" value="{{ $detail->persen_naik }}" class="form-control form-control-sm"></td>
                                            <td><input style="width: 150px;" type="text" name="rab_qty[]" value="{{ $detail->rab_qty }}" class="form-control form-control-sm"></td>
                                            <td><input style="width: 150px;" type="text" name="harga_item[]" value="{{ $detail->harga_item }}" class="form-control form-control-sm rupiah"></td>
                                            <td>
                                                <small><strong>Total RAP</strong></small>
                                                <input style="width: 150px;" type="text" name="total_rap_item[]" value="{{ $detail->total_rap_item }}" readonly class="form-control form-control-sm rupiah">
                                                <small><strong>Total RAB</strong></small>
                                                <input style="width: 150px;" type="text" name="total_rab_item[]" value="{{ $detail->total_rab_item }}" readonly class="form-control form-control-sm rupiah">
                                            </td>
                                            <td>
                                                <button style="width: 150px;" type="button" class="btn btn-primary buttonedit2 mr-2 remove-row">
                                                    <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <a href="{{ route('rabrap/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2">
                                    <i class="fas fa-chevron-left mr-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary buttonedit">
                                    <i class="fas fa-save mr-2"></i>Update
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchFilteredData() {
                $.ajax({
                    url: "{{ route('get-raprab2-data') }}",
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
                                            data-kode_pajak="${item.kode_pajak}">

                                    </td>
                                    <td>${item.no_barang}</td>
                                    <td>${item.nama_barang}</td>
                                    <td>${item.satuan}</td>
                                    <td>${item.kuantitas_saldo_awal || ''}</td>
                                    <td>${item.biaya_satuan_saldo_awal || ''}</td>
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
                        <td style="display: none;"><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_item[]" value="${id}" readonly></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm  deskripsi-barang-input" name="nama_item[]" value="${nama}"></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="satuan[]" value="${satuan}"></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="rap_qty[]" value=""></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="persen_naik[]" value=""></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="rab_qty[]" value="" readonly></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm rupiah" name="harga_item[]" value="${biaya_satuan_saldo_awal || ''}"></td>
                        <td>
                            <small><strong>Total RAP</strong></small>
                            <input style="width: 150px;" type="text" name="total_rap_item[]" readonly class="form-control form-control-sm rupiah">
                            <small><strong>Total RAB</strong></small>
                            <input style="width: 150px;" type="text" name="total_rab_item[]" readonly class="form-control form-control-sm rupiah">
                        </td>
                        <td><button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                    </tr>`;

                    $('#barangTableBody').append(newRow);

                    if (window.initCleaveIn) {
                        const lastRow = $('#barangTableBody tr.barang-row').last().get(0);
                        window.initCleaveIn(lastRow);
                    }
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

            $(document).ready(function () {
                function readNumber($input) {
                    const el = $input.get(0);
                    if (el && el.classList.contains('rupiah') && window.__cleaveMap) {
                        const inst = window.__cleaveMap.get(el);
                        if (inst) {
                            const raw = inst.getRawValue();
                            const n = parseFloat(raw);
                            return isNaN(n) ? 0 : n;
                        }
                    }
                    const v = ($input.val() ?? '').toString().replace(/\s+/g,'').replace(',', '.');
                    const n = parseFloat(v);
                    return isNaN(n) ? 0 : n;
                }

                function writeCurrency($input, number) {
                    const el = $input.get(0);
                    if (el && el.classList.contains('rupiah') && window.__cleaveMap) {
                        const inst = window.__cleaveMap.get(el);
                        if (inst) {
                            inst.setRawValue((+number || 0).toFixed(0));
                            return;
                        }
                    }
                    $input.val(number);
                }

                function recalcRow($row) {
                    const rapQty = readNumber($row.find('input[name="rap_qty[]"]'));
                    let persen   = $row.find('input[name="persen_naik[]"]').val();
                    if (persen === '' || persen === null) persen = $('#persen_kenaikan_qty').val();
                    const p = parseFloat(persen) || 0;

                    const harga  = readNumber($row.find('input[name="harga_item[]"]'));

                    const qtyRAB   = rapQty * (1 + (p/100));
                    const totalRAP = rapQty * harga;
                    const totalRAB = qtyRAB * harga;

                    $row.find('input[name="rab_qty[]"]').val(Number.isInteger(qtyRAB) ? qtyRAB : qtyRAB.toFixed(2));
                    writeCurrency($row.find('input[name="total_rap_item[]"]'), totalRAP);
                    writeCurrency($row.find('input[name="total_rab_item[]"]'), totalRAB);
                }

                function recalcHeaderTotals() {
                    let sumRAP = 0, sumRAB = 0;
                    $('#barangTableBody tr.barang-row').each(function(){
                        sumRAP += readNumber($(this).find('input[name="total_rap_item[]"]'));
                        sumRAB += readNumber($(this).find('input[name="total_rab_item[]"]'));
                    });
                    writeCurrency($('#total_rap'), sumRAP);
                    writeCurrency($('#total_rab'), sumRAB);
                }

                $(document).on('input', 'input[name="rap_qty[]"], input[name="persen_naik[]"], input[name="harga_item[]"]', function(){
                    const $row = $(this).closest('tr.barang-row');
                    recalcRow($row);
                    recalcHeaderTotals();
                });

                $('#persen_kenaikan_qty').on('input', function(){
                    $('#barangTableBody tr.barang-row').each(function(){
                        recalcRow($(this));
                    });
                    recalcHeaderTotals();
                });

                $('#tambahBarangTerpilih').off('click.calc').on('click.calc', function(){
                    setTimeout(function(){
                        const $row = $('#barangTableBody tr.barang-row').last();
                        $(document).trigger('input');
                        $row.each(function(){

                        });
                    }, 0);
                });

                $(document).on('click', '.remove-row', function () {
                    const $tr = $(this).closest('tr.barang-row');
                    $tr.remove();
                    recalcHeaderTotals();
                });

                $('#barangTableBody tr.barang-row').each(function(){
                    recalcRow($(this));
                });
                recalcHeaderTotals();
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
