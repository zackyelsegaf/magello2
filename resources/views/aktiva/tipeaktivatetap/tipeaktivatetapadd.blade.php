@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Tipe Aktiva Tetap</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/tipeaktivatetap/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tipe Aktiva Tetap</label>
                                    <input type="text" class="form-control form-control-sm @error('tipe_aktiva_tetap') is-invalid @enderror" name="tipe_aktiva_tetap" value="{{ old('tipe_aktiva_tetap') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Tipe Aktiva Tetap pajak</label>
                                    <select id="tipeAktivaTetapPajak" class="form-control form-control-sm @error('tipe_aktiva_tetap_pajak') is-invalid @enderror" name="tipe_aktiva_tetap_pajak">
                                        <option {{ old('tipe_aktiva_tetap_pajak') ? '' : 'selected' }} disabled></option>
                                        @foreach ($tipeAktivaTetapPajak as $items )
                                            <option value="{{ $items->tipe_aktiva_tetap_pajak }}"
                                                    data-penyusutan="{{ $items->metode_penyusutan }}"
                                                    data-umur_perkiraan="{{ $items->umur_perkiraan }}"
                                                    data-nilai_penyusutan="{{ $items->nilai_penyusutan }}">
                                                    {{ $items->tipe_aktiva_tetap_pajak }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><strong class="text-danger h3 align-middle">*</strong>&nbsp;Metode Penyusutan</label>
                                    <select id="metodePenyusutan" class="form-control form-control-sm @error('metode_penyusutan') is-invalid @enderror" name="metode_penyusutan">
                                        <option {{ old('metode_penyusutan') ? '' : 'selected' }} disabled></option>
                                        @foreach ($penyusutan as $items )
                                        <option value="{{ $items->nama_penyusutan }}">
                                            {{ $items->nama_penyusutan }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Umur Perkiraan</label>
                                    <input type="text" id="umurPerkiraan" class="form-control form-control-sm" name="umur_perkiraan" value="{{ old('umur_perkiraan') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Nilai Penyusutan</label>
                                    <input type="text" id="nilaiPenyusutan" class="form-control form-control-sm" name="nilai_penyusutan" value="{{ old('nilai_penyusutan') }}">
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
                                <a href="{{ route('tipeaktivatetap/list/page') }}"
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
            const tipeAktivaTetapPajak = document.getElementById('tipeAktivaTetapPajak');
            const metodePenyusutan = document.getElementById('metodePenyusutan');
            const umurPerkiraan = document.getElementById('umurPerkiraan');
            const nilaiPenyusutan = document.getElementById('nilaiPenyusutan');

            tipeAktivaTetapPajak.addEventListener('change', function () {
                const selectedOption = this.options[this.selectedIndex];

                metodePenyusutan.value = selectedOption.getAttribute('data-penyusutan') || '';
                umurPerkiraan.value = selectedOption.getAttribute('data-umur_perkiraan') || '';
                nilaiPenyusutan.value = selectedOption.getAttribute('data-nilai_penyusutan') || '';
            });
        });
    </script>
@endsection
@endsection
