@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Barang</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pembelian/permintaan/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="row checkbox-row-mobile-horizontal">
                                <div class="col-md-4 p-2">
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
                            {{-- <h5 class="card-title">Change Password</h5> --}}
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
                                                <label>No. Permintaan</label>
                                                <input type="text" class="form-control" name="no_permintaan" value="{{ $kodeBaru }}">
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
                                                <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tanggal Permintaan</label>
                                                <div class="cal-icon">
                                                    <input type="text" class="form-control datetimepicker @error('tgl_permintaan') is-invalid @enderror" name="tgl_permintaan" value="{{ old('tgl_permintaan') }}"> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Pengguna</label>
                                            <input type="text" class="form-control" name="pengguna_permintaan" value="{{ Auth::user()->name }}">
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" style="display: none">
                                            <label>Status</label>
                                            <input type="text" class="form-control" name="status_permintaan" value="{{ 'Menunggu' }}">
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
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#rincian">Rincian</a> 
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link" data-toggle="tab" href="#ricape">Rincian Catatan Pemeriksaan</a> 
                            </li>
                        </ul>
                    </div>
                    <div id="rincian" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="row float-right mr-0">
                                    {{-- <button type="button" class="btn btn-primary buttonedit mb-3" id="tambahBarangBtn">
                                        <strong><i class="fas fa-cube mr-3 ml-1"></i>Tambah</strong>
                                    </button> --}}
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
                                                        <select name="gudang" id="gudang" class="form-control form-control-sm">
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
                                                                               data-biaya_satuan_saldo_awal="{{ $item->biaya_satuan_saldo_awal || ''}}" 
                                                                               data-kuantitas="{{ $item->kuantitas_saldo_awal || '' }}">
                                                                    </td>
                                                                    <td style="padding: 4px;">{{ $item->no_barang }}</td>
                                                                    <td style="padding: 4px;">{{ $item->nama_barang }}</td>
                                                                    <td style="padding: 4px;">{{ $item->satuan }}</td>
                                                                    <td style="padding: 4px;">{{ $item->kuantitas_saldo_awal || '' }}</td>
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
  
                                <div class="table-responsive">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <i class="fa fa-exclamation-triangle mr-2"></i><strong>Halo {{ Auth::user()->name }}, </strong> setelah pilih barang, jangan lupa isi kuantitas permintaannya!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>No. Barang</th>
                                                <th>Deskripsi Barang</th>
                                                <th>Kts Permintaan</th>
                                                <th>Satuan</th>
                                                <th>Harga Satuan</th>
                                                <th>Jumlah</th>
                                                <th>Catatan</th>
                                                <th>Tgl. Diminta</th>
                                                <th>Kts Dipesan</th>
                                                <th>Kts Diterima</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="barangTableBody">
                                            @if(old('no_barang'))
                                                @foreach(old('no_barang') as $index => $no_barang)
                                                    <tr class="barang-row">
                                                        <td><input style="width: 150px;" type="text" name="no_barang[]" value="{{ $no_barang }}" class="form-control form-control-sm" readonly></td>
                                                        <td><input style="width: 150px;" type="text" name="deskripsi_barang[]" value="{{ old('deskripsi_barang')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="kts_permintaan[]" value="{{ old('kts_permintaan')[$index] ?? '' }}" class="form-control form-control-sm @error("kts_permintaan.$index") is-invalid @enderror">
                                                            @error("kts_permintaan.$index")
                                                                <p class="Invalid-feedback ">{{ $message }}</p>
                                                            @enderror
                                                        </td>
                                                        <td><input style="width: 150px;" type="text" name="satuan[]" value="{{ old('satuan')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="harga_satuan[]" value="{{ old('harga_satuan')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="jumlah_total_harga[]" value="{{ old('jumlah_total_harga')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="catatan[]" value="{{ old('catatan')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="date" name="tgl_diminta[]" value="{{ old('tgl_diminta')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="kts_dipesan[]" value="{{ old('kts_dipesan')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td><input style="width: 150px;" type="text" name="kts_diterima[]" value="{{ old('kts_diterima')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                        <td>
                                                            <button style="width: 150px;" type="button" class="btn btn-primary buttonedit2 mr-2 remove-row">
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
                    <div id="ricape" class="tab-pane fade">
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
                <div class="col-md-4">
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi_permintaan" value="{{ old('deskripsi_permintaan') }}" placeholder="Deskripsi">{{ old('deskripsi_permintaan') }}</textarea> 
                    </div>
                </div>
                <div class="page-header"></div>
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                                <a href="{{ route('pembelian/permintaan/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
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
        $(document).ready(function() {
        function fetchFilteredData() {
            $.ajax({
                url: "{{ route('get-permintaan2-data') }}",
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
                                        data-biaya_satuan_saldo_awal="${item.biaya_satuan_saldo_awal || ''}"
                                        data-kuantitas="${item.kuantitas_saldo_awal || ''}">
                                </td>
                                <td>${item.no_barang}</td>
                                <td>${item.nama_barang}</td>
                                <td>${item.satuan}</td>
                                <td>${item.kuantitas_saldo_awal || ''}</td>
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
        $(document).ready(function () {
            $('#checkAll').click(function () {
                $('.check-barang').prop('checked', this.checked);
            });

            $('#tambahBarangTerpilih').click(function () {
                $('.check-barang:checked').each(function () {
                    let id = $(this).data('id');
                    let nama = $(this).data('nama');
                    let satuan = $(this).data('satuan');
                    let biaya_satuan_saldo_awal = parseFloat($(this).data('biaya_satuan_saldo_awal')) || 0;

                    let newRow = `
                    <tr class="barang-row">
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="no_barang[]" value="${id}" readonly></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm deskripsi-barang-input" name="deskripsi_barang[]" value="${nama}"></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm kts-permintaan-input" name="kts_permintaan[]" data-biaya="${biaya_satuan_saldo_awal || ''}" value=""></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="satuan[]" value="${satuan}"></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="harga_satuan[]" value="${biaya_satuan_saldo_awal || ''}" readonly></td>
                        <td><input style="width: 200px;" type="text" class="form-control form-control-sm jumlah-total-harga" name="jumlah_total_harga[]" value="" readonly></td>
                        <td><input style="width: 200px;" type="text" class="form-control form-control-sm" name="catatan[]" value=""></td>
                        <td><input style="width: 150px;" type="date" class="form-control form-control-sm" name="tgl_diminta[]" value=""></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kts_dipesan[]" value=""></td>
                        <td><input style="width: 150px;" type="text" class="form-control form-control-sm" name="kts_diterima[]" value=""></td>
                        <td><button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row"><strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong></button></td>
                    </tr>`;

                    $('#barangTableBody').append(newRow);
                });

                $('#modalBarang').modal('hide');
            });

            $(document).on('input', '.kts-permintaan-input', function () {
                let kts = parseFloat($(this).val()) || 0;
                let biaya = parseFloat($(this).data('biaya')) || 0;
                let total = kts * biaya;
                let row = $(this).closest('tr');
                row.find('.jumlah-total-harga').val(total);
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const namaBarangSelect = document.getElementById('namaBarangSelect');
            const deskripsiBarangInput = document.getElementById('deskripsiBarangInput');
            const kuantitasBarangInput = document.getElementById('kuantitasBarangInput');
            const satuanSelect = document.getElementById('satuanSelect');
        
        namaBarangSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            deskripsiBarangInput.value = selectedOption.getAttribute('data-nama') || '';
            kuantitasBarangInput.value = selectedOption.getAttribute('data-kts') || '';
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
    @endsection
@endsection