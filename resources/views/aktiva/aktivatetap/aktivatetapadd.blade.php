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
            <form action="{{ route('form/aktivatetap/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Kode Aktiva</label>
                                    <input type="text" class="form-control form-control-sm @error('kode_aktiva') is-invalid @enderror"name="kode_aktiva" value="{{ old('kode_aktiva') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tipe Akun</label>
                                    <select id="tipeAktivaTetap" class="form-control form-control-sm @error('tipe_akun') is-invalid @enderror"  name="tipe_akun">
                                        <option {{ old('tipe_akun') ? '' : 'selected' }} disabled></option>
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
                                    <input type="text"class="form-control form-control-sm @error('deskripsi') is-invalid @enderror"name="deskripsi" value="{{ old('deskripsi') }}">
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
                                    <input type="date" class="form-control form-control-sm @error('tanggal_penggunaan') is-invalid @enderror"name="tanggal_penggunaan" value="{{ old('tanggal_penggunaan') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tanggal Akuisisi</label>
                                    <input type="date" class="form-control form-control-sm @error('tanggal_akuisisi') is-invalid @enderror"name="tanggal_akuisisi" value="{{ old('tanggal_akuisisi') }}">
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
                            <form>
                                <!-- Umur Perkiraan -->
                                <div class="mb-3 row">
                                    <label class="col-sm-3 col-form-label">Umur Perkiraan</label>
                                    <div class="col-sm-3">
                                        <input id="umurPerkiraan" type="number" class="form-control form-control-sm" placeholder="0">
                                        <div class="form-text">Th</div>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="number" class="form-control form-control-sm" placeholder="0">
                                        <div class="form-text">Bulan</div>
                                    </div>
                                    <div class="col-sm-3">
                                        <input id="nilaiPenyusutan" type="number" class="form-control form-control-sm" placeholder="0">
                                        <div class="form-text">%</div>
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
                                        <select class="form-control form-control-sm @error('akun_aktiva') is-invalid @enderror"  name="akun_aktiva">
                                        <option {{ old('akun_aktiva') ? '' : 'selected' }} disabled></option>
                                        @foreach ($akunAktivaAP as $items )
                                        <option value="{{ $items->nama_akun_indonesia }}">{{ $items->nama_akun_indonesia }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="mb-3 row akun-aktiva-wrapper" style="display: none;">
                                    <label class="col-sm-3 col-form-label text-danger">* Akun Biaya Penyusutan</label>
                                    <div class="col-sm-3">
                                        <select class="form-control form-control-sm @error('akun_aktiva') is-invalid @enderror"  name="akun_aktiva">
                                        <option {{ old('akun_aktiva') ? '' : 'selected' }} disabled></option>
                                        @foreach ($akunAktivaBP as $items )
                                        <option value="{{ $items->nama_akun_indonesia }}">{{ $items->nama_akun_indonesia }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div id="dokumen" class="tab-pane fade">
                        <div class="container mt-4 mb-4">    
                            <div class="table-responsive mt-3">
                                <table class="table table-bordered">
                                    <thead class="table-secondary">
                                        <tr>
                                            <th>No. Akun</th>
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                            <th>Nilai</th>
                                            <th>Rekonsiliasi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" class="form-control form-control-sm" /></td>
                                            <td><input type="date" class="form-control form-control-sm" /></td>
                                            <td><input type="text" class="form-control form-control-sm" /></td>
                                            <td><input type="number" class="form-control form-control-sm text-end" value="0" />
                                            </td>
                                            <td class="text-center">
                                                <input type="checkbox" class="form-check-input mt-2" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Footer Summary -->
                            <div class="row mt-3">
                                <div class="col-md-3">
                                    <label>Biaya Aktiva</label>
                                    <input type="number" class="form-control form-control-sm text-end" value="0" />
                                </div>
                                <div class="col-md-3">
                                    <label>Nilai Penyusutan</label>
                                    <input type="number" class="form-control form-control-sm text-end" value="0" />
                                </div>
                                <div class="col-md-3">
                                    <label>Nilai Buku</label>
                                    <input type="number" class="form-control form-control-sm text-end" value="0" />
                                </div>
                                <div class="col-md-3">
                                    <label>Nilai Sisa</label>
                                    <input type="number" class="form-control form-control-sm text-end" value="0" />
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
                                                    <textarea class="form-control form-control-sm @error('memo') is-invalid @enderror" name="memo" value="{{ old('memo') }}">{{ old('memo') }}</textarea>
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
                                <button type="submit" class="btn btn-primary buttonedit"><i
                                        class="fa fa-check mr-2"></i>Simpan</button>
                                <a href="{{ route('aktivatetap/list/page') }}"
                                    class="btn btn-primary float-left veiwbutton ml-3"><i
                                        class="fas fa-chevron-left mr-2"></i>Batal</a>
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

@endsection
@endsection
