@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Akun</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/akun/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row formtype">
                            <div class="col-md-6">                
                                <div class="form-group">
                                    <label>Tipe Akun</label>
                                    <select id="tipe_id" class="tomselect @error('tipe_id') is-invalid @enderror" name="tipe_id">
                                        <option selected disabled> --Pilih Tipe Akun-- </option>
                                        @foreach ($tipe_akun as $items )
                                            <option value="{{ $items->id }}" data-label="{{ $items->nama }}">{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                    @error('tipe_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>                              
                                <div class="form-group">
                                    <label>No. Akun</label>
                                    <input type="text" class="form-control form-control-sm  @error('no_akun') is-invalid @enderror" name="no_akun" value="{{ old('no_akun') }}">
                                    @error('no_akun')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Akun (Indonesia)</label>
                                    <textarea class="form-control form-control-sm @error('nama_akun_indonesia') is-invalid @enderror" name="nama_akun_indonesia" value="{{ old('nama_akun_indonesia') }}">{{ old('nama_akun_indonesia') }}</textarea>
                                    @error('nama_akun_indonesia')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Akun (English)</label>
                                    <textarea class="form-control form-control-sm"  name="nama_akun_inggris" value="{{ old('nama_akun_inggris') }}">{{ old('nama_akun_inggris') }}</textarea>
                                </div>
                                <div class="form-group" id="mata_uang_id">
                                    <label>Mata Uang</label>
                                    <select name="mata_uang_id" class="tomselect @error('mata_uang_id') is-invalid @enderror">
                                        <option value="" disabled selected> --Pilih Mata Uang-- </option>
                                        @foreach ($mata_uang as $m)
                                        <option value="{{ $m->id }}" data-nilai-tukar="{{ $m->nilai_tukar }}">
                                            {{ $m->nama }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('mata_uang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="sub_akun_check">Sub Akun Dari</label>
                                    <label class="switch">
                                        <input type="hidden" name="sub_akun_check" value="0">
                                        <input type="checkbox" name="sub_akun_check" id="sub_akun_check" value="1" {{ old('sub_akun_check') ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                                <div class="form-group" id="tipe_akun_form" style="display: none;">
                                    {{-- <label>Subdari</label> --}}
                                    <select class="tomselect" name="parent_id">
                                        <option selected disabled> --Pilih Sub-- </option>
                                        @foreach ($nama_akun as $items )
                                            <option value="{{ $items->id }}">{{ $items->no_akun .' - '. $items->nama_akun_indonesia }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" id="saldo_akun">
                                    <label>Saldo</label>
                                    <input type="text" class="form-control form-control-sm rupiah" name="saldo_akun" value="{{ old('saldo_akun') }}">
                                </div>
                                <div class="form-group" id="tanggal">
                                    <label>Tanggal</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control form-control-sm  datetimepicker" name="tanggal" value="{{ old('tanggal') }}"> 
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dihentikan">Dihentikan</label>
                                    <label class="switch">
                                        <input type="hidden" name="dihentikan" value="0">
                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan') ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                                <a href="{{ route('akun/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
@section('script') 
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("sub_akun_check");
            const tipeAkunForm = document.getElementById("tipe_akun_form");

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
        document.addEventListener('DOMContentLoaded', function () {
            const tipeAkunSelect = document.getElementById('tipe_id');
            const mataUangGroup = document.getElementById('mata_uang_id');
            const saldoGroup = document.getElementById('saldo_akun');
            const tanggalGroup = document.getElementById('tanggal');

            function toggleFields() {
                const selectedValue = tipeAkunSelect.value;

                if (selectedValue === '5' || selectedValue === '6') {
                    mataUangGroup.style.display = 'none';
                    saldoGroup.style.display = 'none';
                    tanggalGroup.style.display = 'none';
                } else if (selectedValue === '2' || selectedValue === '7') {
                    mataUangGroup.style.display = '';
                    saldoGroup.style.display = 'none';
                    tanggalGroup.style.display = 'none';
                } else if (selectedValue === '3' || selectedValue === '4' || selectedValue === '8' || selectedValue === '9' || selectedValue === '10' || selectedValue === '11' || selectedValue === '15' || selectedValue === '13' || selectedValue === '14' || selectedValue === '12') {
                    mataUangGroup.style.display = 'none';
                    saldoGroup.style.display = '';
                    tanggalGroup.style.display = '';
                } else {
                    mataUangGroup.style.display = '';
                    saldoGroup.style.display = '';
                    tanggalGroup.style.display = '';
                }
            }

            // Jalankan saat select berubah
            tipeAkunSelect.addEventListener('change', toggleFields);

            // Jalankan saat pertama kali halaman dimuat (jika ada old value)
            toggleFields();
        });
    </script>   
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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