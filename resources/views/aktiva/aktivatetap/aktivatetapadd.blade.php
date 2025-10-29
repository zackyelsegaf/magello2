@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Aktiva Tetap</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/aktivatetap/save') }}" id="formRekonsiliasi" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Kode Aktiva</label>
                                    <input type="text" class="form-control form-control-sm" name="kode_aktiva" value="{{ $kodeBaru }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tipe Aktiva</label>
                                    <select id="tipeAktivaTetap" class="form-control form-control-sm @error('tipe_aktiva') is-invalid @enderror"  name="tipe_aktiva">
                                        <option {{ old('tipe_aktiva') ? '' : 'selected' }} disabled></option>
                                        @foreach ($tipeAktivaTetap as $items )
                                        <option value="{{ $items->tipe_aktiva_tetap }}"
                                                data-umur_perkiraan="{{ $items->umur_perkiraan }}"
                                                data-nilai_penyusutan="{{ $items->nilai_penyusutan }}">
                                                {{ $items->tipe_aktiva_tetap }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Deskripsi Aktiva</label>
                                    <input type="text"class="form-control form-control-sm @error('deskripsi_aktiva') is-invalid @enderror" name="deskripsi_aktiva" value="{{ old('deskripsi_aktiva') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tanggal Penggunaan</label>
                                    <input type="date" class="form-control form-control-sm @error('tgl_penggunaan') is-invalid @enderror"name="tgl_penggunaan" value="{{ old('tgl_penggunaan') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tanggal Akuisisi</label>
                                    <input type="date" class="form-control form-control-sm @error('tgl_akuisisi') is-invalid @enderror"name="tgl_akuisisi" value="{{ old('tgl_akuisisi') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#detail">Aktiva Tetap</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Pengeluaran</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#memo">Memo</a>
                            </li>
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">
                        <div class="container mt-4">
                            <!-- Umur Perkiraan -->
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label">Umur Perkiraan</label>
                                <div class="col-sm-3">
                                    <input id="umurPerkiraan" type="number" name="tahun" class="form-control form-control-sm" placeholder="0" value="{{ old('tahun') }}">
                                    <div class="form-text">Th</div>
                                </div>
                                <div class="col-sm-3">
                                    <input type="number" name="bulan" class="form-control form-control-sm" placeholder="0" value="{{ old('bulan') }}">
                                    <div class="form-text">Bulan</div>
                                </div>
                                <div class="col-sm-3">
                                    <input id="nilaiPenyusutan" type="text" name="depresiasi" class="form-control form-control-sm" placeholder="0" value="{{ old('depresiasi') }}">
                                    <div class="form-text">%</div>
                                </div>
                                <div class="col-sm-3" style="display: none;">
                                    <input type="text" name="umur_perkiraan" class="form-control form-control-sm" placeholder="0" value="{{ old('umur_perkiraan') }}">
                                    <div class="form-text">Umur Perkiraan Bulan</div>
                                </div>
                            </div>
                            <!-- Metode Penyusutan -->
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-danger">* Metode Penyusutan</label>
                                <div class="col-sm-3">
                                    <select id="metode_penyusutan" class="form-control form-control-sm @error('metode_penyusutan') is-invalid @enderror"  name="metode_penyusutan">
                                    <option {{ old('metode_penyusutan') ? '' : 'selected' }} disabled></option>
                                    @foreach ($penyusutan as $items )
                                    <option value="{{ $items->nama_penyusutan }}"
                                        @if($items->nama_penyusutan == 'Tidak Menyusut') selected @endif>{{ $items->nama_penyusutan }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <!-- Akun Aktiva -->
                            <div class="mb-3 row">
                                <label class="col-sm-3 col-form-label text-danger">* Akun Aktiva</label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm @error('akun_aktiva') is-invalid @enderror"  name="akun_aktiva">
                                    <option {{ old('akun_aktiva') ? '' : 'selected' }} disabled></option>
                                    @foreach ($akunAktiva as $items )
                                    <option value="{{ $items->nama_akun_indonesia }}">{{ $items->nama_akun_indonesia }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <div class="mb-3 row akun-aktiva-wrapper" style="display: none;">
                                <label class="col-sm-3 col-form-label text-danger">* Akun Akumulasi Penyusutan </label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" name="akun_akumulasi">
                                    <option {{ old('akun_akumulasi') ? '' : 'selected' }} disabled></option>
                                    @foreach ($akunAktivaAP as $items )
                                    <option value="{{ $items->nama_akun_indonesia }}">{{ $items->nama_akun_indonesia }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                            <div class="mb-3 row akun-aktiva-wrapper" style="display: none;">
                                <label class="col-sm-3 col-form-label text-danger">* Akun Biaya Penyusutan</label>
                                <div class="col-sm-3">
                                    <select class="form-control form-control-sm" name="akun_biaya_penyusutan">
                                    <option {{ old('akun_biaya_penyusutan') ? '' : 'selected' }} disabled></option>
                                    @foreach ($akunAktivaBP as $items )
                                    <option value="{{ $items->nama_akun_indonesia }}">{{ $items->nama_akun_indonesia }}</option>
                                    @endforeach
                                </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="padding-bottom: 15px;" id="dokumen" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <i class="fa fa-exclamation-triangle mr-2"></i><strong>Halo {{ Auth::user()->name }}, </strong> Setelah pilih barang, jangan lupa isi kuantitas pesanannya!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="row float-right mr-0">
                                        <button type="button" class="btn btn-primary buttonedit mb-3" data-toggle="modal" data-target="#modalBarang">
                                            <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                                        </button>
                                    </div>
                                    <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content my-rounded-2">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Pilih Akun</h5>
                                                    <button type="button" class="close" data-dismiss="modal">
                                                        <span>&times;</span>
                                                    </button>
                                                </div>
                                                <div id="filterBox" class="mb-3">
                                                    <div class="card m-3 text-white">
                                                        <div class="form-group mb-1">
                                                            <input type="text" name="no_akun" id="no_akun" class="form-control form-control-sm" placeholder="No Akun">
                                                        </div>
                                                        <div class="form-group mb-1">
                                                            <input type="text" name="nama_akun_indonesia" id="nama_akun_indonesia" class="form-control form-control-sm" placeholder="Nama Akun">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="table-responsive">
                                                        <table class="datatable table table-striped table-bordered table-hover table-center mb-0" id="tabelPilihBarang" style="margin: 0; border-collapse: collapse; width: 100%;">
                                                            <thead class="thead-dark">
                                                                <tr style="padding: 0; margin: 0;">
                                                                    <th style="padding: 7px; text-align: center;"><input type="checkbox" id="checkAll"></th>
                                                                    <th style="padding: 4px;">No. Akun</th>
                                                                    <th style="padding: 4px;">Nama Akun</th>
                                                                    <th style="padding: 4px;">Saldo</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($akun as $item)
                                                                    <tr style="padding: 0; margin: 0;">
                                                                        <td style="padding: 4px; text-align: center;">
                                                                            <input type="checkbox" class="check-barang"
                                                                                data-id="{{ $item->no_akun }}"
                                                                                data-nama="{{ $item->nama_akun_indonesia }}"
                                                                                data-saldo="{{ $item->saldo_akun || '' }}">
                                                                        </td>
                                                                        <td style="padding: 4px;">{{ $item->no_akun }}</td>
                                                                        <td style="padding: 4px;">{{ $item->nama_akun_indonesia }}</td>
                                                                        <td style="padding: 4px;">{{ $item->saldo_akun || '' }}</td>
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
                                        <table class="table table-striped table-bordered table-hover table-center mb-0" id="DataBarangAddSatuan">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>No. Akun</th>
                                                    <th>Tanggal</th>
                                                    <th>Deskripsi</th>
                                                    <th>Nilai</th>
                                                    <th>Rekonsiliasi</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody id="barangTableBody">
                                                @if(old('no_akun'))
                                                    @foreach(old('no_akun') as $index => $no_akun)
                                                        <tr class="barang-row">
                                                            <td><input style="width: 170px;" type="text" name="no_akun[]" value="{{ $no_akun }}" class="form-control form-control-sm" readonly></td>
                                                            <td><input style="width: 170px;" type="date" name="tanggal[]" value="{{ old('tanggal')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                            <td><input style="width: 170px;" type="text" name="deskripsi[]" value="{{ old('deskripsi')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                            <td><input style="width: 170px;" type="text" name="nilai[]" value="{{ old('nilai')[$index] ?? '' }}" class="form-control form-control-sm"></td>
                                                            <td>
                                                                <div class="checkbox-wrapper-4">
                                                                    <input type="hidden" name="rekonsiliasi_check[{{ $index }}]" value="0">
                                                                    <input class="inp-cbx" name="rekonsiliasi_check[{{ $index }}]" id="rekonsiliasi_check_{{ $index }}" type="checkbox" value="1"
                                                                        {{ old('rekonsiliasi_check')[$index] ?? false ? 'checked' : '' }}>
                                                                    <label class="cbx" for="rekonsiliasi_check_{{ $index }}">
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
                                                                <button style="width: 170px;" type="button" class="btn btn-primary buttonedit2 mr-2 remove-row">
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
                                <div class="row mt-3">
                                    <div class="col-md-3">
                                        <label>Biaya Aktiva</label>
                                        <input type="number" class="form-control form-control-sm text-end" name="biaya_aktiva" value="{{ old('biaya_aktiva') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Nilai Penyusutan</label>
                                        <input type="number" class="form-control form-control-sm text-end" name="nilai_penyusutan" value="{{ old('nilai_penyusutan') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Nilai Buku</label>
                                        <input type="number" class="form-control form-control-sm text-end" name="nilai_buku" value="{{ old('nilai_buku') }}" />
                                    </div>
                                    <div class="col-md-3">
                                        <label>Nilai Sisa</label>
                                        <input type="number" class="form-control form-control-sm text-end" name="nilai_sisa" value="{{ old('nilai_sisa') }}" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="memo" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    {{-- <label>Memo</label> --}}
                                                    <textarea class="form-control form-control-sm" name="memo" value="{{ old('memo') }}">{{ old('memo') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <a href="{{ route('aktivatetap/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2">
                                    <i class="fas fa-chevron-left mr-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary buttonedit">
                                    <i class="fas fa-save mr-2"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
    <script>
        $(function() {
            $('#datetimepicker3').datetimepicker({
                format: 'LT'
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tipeAktivaTetap = document.getElementById('tipeAktivaTetap');
            const umurPerkiraan = document.getElementById('umurPerkiraan');
            const nilaiPenyusutan = document.getElementById('nilaiPenyusutan');

            tipeAktivaTetap.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];

                umurPerkiraan.value = selectedOption.getAttribute('data-umur_perkiraan') || '';
                nilaiPenyusutan.value = selectedOption.getAttribute('data-nilai_penyusutan') || '';
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const metodePenyusutanSelect = document.getElementById("metode_penyusutan");
            const akunAktivaWrappers = document.querySelectorAll(".akun-aktiva-wrapper");

            function toggleAkunAktivaFields() {
                const selectedValue = metodePenyusutanSelect.value.trim();

                if (selectedValue && selectedValue !== "Tidak Menyusut") {
                    akunAktivaWrappers.forEach(wrapper => wrapper.style.display = "flex");
                } else {
                    akunAktivaWrappers.forEach(wrapper => wrapper.style.display = "none");
                }
            }

            metodePenyusutanSelect.addEventListener("change", toggleAkunAktivaFields);

            toggleAkunAktivaFields();
        });
    </script>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function () {
            const checkboxTutup = document.querySelectorAll('input[id^="rekonsiliasi_check_"]');

            function updateStatus() {
                let checkedCount = 0;

                checkboxTutup.forEach(cb => {
                    if (cb.checked && cb.value === "1") {
                        checkedCount++;
                    }
                });

            }

            updateStatus();

            checkboxTutup.forEach(cb => {
                cb.addEventListener('change', updateStatus);
            });
        });
    </script> --}}

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('rekonsiliasi_check');
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
            const tahunInput = document.querySelector('input[name="tahun"]');
            const bulanInput = document.querySelector('input[name="bulan"]');
            const depresiasiInput = document.querySelector('input[name="depresiasi"]');
            const umurPerkiraanInput = document.querySelector('input[name="umur_perkiraan"]');

            function hitungUmurDanDepresiasi() {
                const tahun = parseInt(tahunInput.value) || 0;
                const bulan = parseInt(bulanInput.value) || 0;

                const totalBulan = (tahun * 12) + bulan;
                umurPerkiraanInput.value = totalBulan;

                const umurTahun = totalBulan / 12;

                if (umurTahun > 0) {
                    const depresiasi = (1 / umurTahun) * 100;
                    depresiasiInput.value = depresiasi.toFixed(2);
                } else {
                    depresiasiInput.value = 0;
                }
            }

            tahunInput.addEventListener('input', hitungUmurDanDepresiasi);
            bulanInput.addEventListener('input', hitungUmurDanDepresiasi);
        });
    </script>
    <script>
        $(document).ready(function() {
        function fetchFilteredData() {
            $.ajax({
                url: "{{ route('get-akuns-data') }}",
                method: 'GET',
                data: {
                        no_akun: $('#no_akun').val(),
                        nama_akun_indonesia: $('#nama_akun_indonesia').val()
                    },
                success: function(response) {
                    let tbody = '';
                    response.forEach(item => {
                        tbody += `
                            <tr>
                                <td style="text-align: center;">
                                    <input type="checkbox" class="check-barang"
                                        data-id="${item.no_akun}"
                                        data-nama="${item.nama_akun_indonesia}"
                                        data-saldo="${item.saldo_akun || ''}"
                                </td>
                                <td>${item.no_akun}</td>
                                <td>${item.nama_akun_indonesia}</td>
                                <td>${item.saldo_akun || ''}</td>
                            </tr>
                        `;
                    });
                    $('#tabelPilihBarang tbody').html(tbody);
                }
            });
        }

        $('#no_akun, #nama_akun_indonesia').on('keyup change', function() {
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
                let selectedAkun = $('.check-barang:checked');
                if (selectedAkun.length === 0) {
                    alert("Pilih minimal satu pesanan terlebih dahulu.");
                    return;
                }

                selectedAkun.each(function () {
                    let no_akun = $(this).data('id');

                    $.ajax({
                        url: '/get-detail-akun',
                        method: 'GET',
                        data: { no_akun: no_akun },
                        success: function (data) {
                            data.forEach(item => {
                                let newRow = `
                                <tr class="barang-row">
                                    <td><input style="width: 170px;" type="text" class="form-control form-control-sm" name="no_akun[]" value="${item.no_akun}" readonly></td>
                                    <td><input style="width: 170px;" type="date" class="form-control form-control-sm" name="tanggal[]" value=""></td>
                                    <td><input style="width: 170px;" type="text" class="form-control form-control-sm" name="deskripsi[]" value="${item.nama_akun_indonesia}"></td>
                                    <td><input style="width: 170px;" type="text" class="form-control form-control-sm" name="nilai[]" value=""></td>
                                    <td>
                                        <div class="checkbox-wrapper-4">
                                            <input type="checkbox" class="inp-cbx rekonsiliasi-check" name="rekonsiliasi_check[]" value="1" id="rekonsiliasi_check_${item.no_akun}">
                                            <label class="cbx" for="rekonsiliasi_check_${item.no_akun}">
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
                        },
                        error: function () {
                            alert("Gagal mengambil data detail pesanan.");
                        }
                    });
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
        function hitungTotalNilai() {
            let total = 0;

            $('input[name="nilai[]"]').each(function () {
                let val = parseFloat($(this).val().replace(/,/g, '')) || 0;
                total += val;
            });

            $('input[name="biaya_aktiva"]').val(total);
            $('input[name="nilai_buku"]').val(total);
        }

        $(document).on('input', 'input[name="nilai[]"]', function () {
            hitungTotalNilai();
        });

        $(document).on('click', '#tambahBarangTerpilih', function () {
            setTimeout(() => {
                hitungTotalNilai();
            }, 500);
        });

        $(document).on('click', '.remove-row', function () {
            setTimeout(() => {
                hitungTotalNilai();
            }, 100);
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#formRekonsiliasi').on('submit', function () {
                $('input.rekonsiliasi-check').each(function () {
                    $(this).val($(this).prop('checked') ? '1' : '0');
                    $(this).prop('checked', true);
                });
            });
        });
    </script>


@endsection
@endsection
