@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Data Pemasok</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('form/pemasok/save') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#detail">Detail</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a>
                            </li>
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>No</label>
                                                    <input type="text" class="form-control form-control-sm " name="pemasok_id" value="{{ $kodeBaru }}">
                                                    @error('pemasok_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Pemasok</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama') is-invalid @enderror" name="nama" value="{{ old('nama') }}">
                                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control form-control-sm "  name="status">
                                                        <option selected disabled> --Pilih Status-- </option>
                                                        @foreach ($data as $items )
                                                        <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pemasok_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="dihentikan">Dihentikan</label>
                                                    <label class="switch">
                                                        <input type="hidden" name="dihentikan" value="0">
                                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan') ? 'checked' : '' }}>
                                                        @error('dihentikan')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dokumen" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>File 1</label>
                                                    <input type="text" class="form-control form-control-sm " name="fileupload_1" placeholder="Link dokumen Anda" value="{{ old('fileupload_1') }}">
                                                    @error('fileupload_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#info">Info</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#syarat">Syarat</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#memo">Memo</a>
                            </li>
                        </ul>
                    </div>
                    <div id="info" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row formtype">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Alamat 1</label>
                                                    <input type="text" class="form-control form-control-sm  @error('alamat_1') is-invalid @enderror" name="alamat_1" value="{{ old('alamat_1') }}">
                                                    @error('alamat_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat 2</label>
                                                    <input type="text" class="form-control form-control-sm " name="alamat_2" value="{{ old('alamat_2') }}">
                                                    @error('alamat_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak 1</label>
                                                    <input type="text" class="form-control form-control-sm " name="alamatpajak_1" value="{{ old('alamatpajak_1') }}">
                                                    @error('alamatpajak_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak 2</label>
                                                    <input type="text" class="form-control form-control-sm " name="alamatpajak_2" value="{{ old('alamatpajak_2') }}">
                                                    @error('alamatpajak_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <select class="form-control form-control-sm  @error('provinsi') is-invalid @enderror"  name="provinsi">
                                                        <option selected disabled> --Pilih Provinsi-- </option>
                                                        @foreach ($provinsi as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('provinsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kota</label>
                                                    <select class="form-control form-control-sm  @error('kota') is-invalid @enderror"  name="kota">
                                                        <option selected disabled> --Pilih Kota-- </option>
                                                        @foreach ($kota as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('kota')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Negara</label>
                                                    <select class="form-control form-control-sm  @error('negara') is-invalid @enderror"  name="negara">
                                                        <option selected disabled> --Pilih Negara-- </option>
                                                        @foreach ($negara as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('negara')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Pos</label>
                                                    <input type="text" class="form-control form-control-sm  @error('kode_pos') is-invalid @enderror" name="kode_pos" value="{{ old('kode_pos') }}">
                                                    @error('kode_pos')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kontak</label>
                                                    <input type="text" class="form-control form-control-sm " name="kontak" value="{{ old('kontak') }}">
                                                    @error('kontak')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>No. Telp</label>
                                                    <input type="text" class="form-control form-control-sm  @error('no_telp') is-invalid @enderror" name="no_telp" value="{{ old('no_telp') }}">
                                                    @error('no_telp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div><div class="form-group">
                                                    <label>No. FAX</label>
                                                    <input type="text" class="form-control form-control-sm "  name="no_fax" value="{{ old('no_fax') }}">
                                                    @error('no_fax')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control form-control-sm " name="email" value="{{ old('email') }}">
                                                    @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control form-control-sm " name="website" value="{{ old('website') }}">
                                                    @error('website')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="syarat" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                {{-- <h5 class="card-title">Change Password</h5> --}}
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div class="row formtype">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label>NPWP</label>
                                                    <input type="text" class="form-control form-control-sm  @error('npwp') is-invalid @enderror" name="npwp" value="{{ old('npwp') }}">
                                                    @error('npwp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 1</label>
                                                    <select class="form-control form-control-sm  @error('pajak_1') is-invalid @enderror" name="pajak_1" id="pajak_1">
                                                        <option selected disabled> --Pilih Pajak 1-- </option>
                                                        @foreach ($pajak as $items)
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pajak_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    <input type="hidden" name="pajak_1_check" id="pajak_1_check" value="0">
                                                    @error('pajak_1_check')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 2</label>
                                                    <select class="form-control form-control-sm  @error('pajak_2') is-invalid @enderror" name="pajak_2" id="pajak_2">
                                                        <option selected disabled> --Pilih Pajak 2-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('pajak_2')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    <input type="hidden" name="pajak_2_check" id="pajak_2_check" value="0">
                                                    @error('pajak_2_check')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Syarat</label>
                                                    <select class="form-control form-control-sm  @error('syarat') is-invalid @enderror"  name="syarat">
                                                        <option selected disabled> --Pilih Syarat-- </option>
                                                        @foreach ($syarat as $items )
                                                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('syarat')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Mata Uang</label>
                                                    <select id="namaBarangSelect" class="form-control form-control-sm  @error('mata_uang') is-invalid @enderror" name="mata_uang">
                                                        <option {{ old('mata_uang') ? '' : 'selected' }} disabled> --Pilih Mata Uang-- </option>
                                                        @foreach ($mata_uang as $items )
                                                            <option value="{{ $items->nama }}"
                                                                data-nilai-tukar="{{ $items->nilai_tukar }}">
                                                                {{ $items->nama . " - " . $items->nilai_tukar }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('mata_uang')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                    <input id="nilaiTukarInput" type="text" class="form-control form-control-sm " name="nilai_tukar" value="{{ old('nilai_tukar') }}" style="display: none;">
                                                    @error('nilai_tukar')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Saldo Awal</label>
                                                            <input type="text" id="saldo_awal" class="form-control form-control-sm  @error('saldo_awal') is-invalid @enderror" name="saldo_awal" value="{{ old('saldo_awal') }}">
                                                            @error('saldo_awal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control form-control-sm  datetimepicker @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ old('tanggal') }}">
                                                                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control form-control-sm  @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}">{{ old('deskripsi') }}</textarea>
                                                    @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>No. PKP</label>
                                                    <input type="text" class="form-control form-control-sm  @error('no_pkp') is-invalid @enderror" name="no_pkp" value="{{ old('no_pkp') }}">
                                                    @error('no_pkp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                            </div>
                                        </div>
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
                                                    <textarea class="form-control form-control-sm  @error('memo') is-invalid @enderror" name="memo" value="{{ old('memo') }}">{{ old('memo') }}</textarea>
                                                    @error('memo')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-check mr-2"></i>Simpan</button>
                                <a href="{{ route('pemasok/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')
        @if ($errors->any())
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi Kesalahan',
                text: 'Silakan periksa kembali form yang Anda isi.',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectPajak = document.getElementById('pajak_1');
            const hiddenInput = document.getElementById('pajak_1_checked');

            selectPajak.addEventListener('change', function () {
                if (selectPajak.value !== "") {
                    hiddenInput.value = "1";
                } else {
                    hiddenInput.value = "0";
                }
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectPajak = document.getElementById('pajak_1');
            const selectPajak2 = document.getElementById('pajak_2');
            const hiddenInput = document.getElementById('pajak_1_check');
            const hiddenInput2 = document.getElementById('pajak_2_check');

            selectPajak.addEventListener('change', function () {
                if (selectPajak.value && selectPajak.value !== "") {
                    hiddenInput.value = "1";
                } else {
                    hiddenInput.value = "0";
                }
            });

            selectPajak2.addEventListener('change', function () {
                if (selectPajak2.value && selectPajak2.value !== "") {
                    hiddenInput2.value = "1";
                } else {
                    hiddenInput2.value = "0";
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const namaBarangSelect = document.getElementById('namaBarangSelect');
            const nilaiTukarInput = document.getElementById('nilaiTukarInput');

        namaBarangSelect.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            nilaiTukarInput.value = selectedOption.getAttribute('data-nilai-tukar') || '';
        });
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
            const input = document.getElementById('saldo_awal');

            input.addEventListener('input', () => {
                let angka = input.value.replace(/\D/g, '');
                input.value = formatRupiah(angka, 'Rp ');
            });

            input.closest('form').addEventListener('submit', () => {
                input.value = input.value.replace(/\D/g, '');
            });

            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script>

    @endsection
@endsection
