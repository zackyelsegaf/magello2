@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Mata Uang</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('pemasok/update', $Pemasok->id) }}" method="POST" enctype="multipart/form-data">
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
                                                    <input type="text" class="form-control form-control-sm" id="pemasok_id" name="pemasok_id" value="{{ $Pemasok->pemasok_id }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Pemasok</label>
                                                    <input type="text" class="form-control form-control-sm  @error('nama') is-invalid @enderror" name="nama" value="{{ $Pemasok->nama }}">
                                                    @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control form-control-sm  @error('status_pemasok_id') is-invalid @enderror" name="status_pemasok_id">
                                                        <option selected disabled {{ old('status_pemasok_id', $Pemasok->status_pemasok_id) ? '' : 'selected' }}> --Pilih Status-- </option>
                                                        @foreach ($data as $items)
                                                            <option value="{{ $items->id }}" {{ old('status_pemasok_id', $Pemasok->status_pemasok_id) == $items->id ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('status_pemasok_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="dihentikan">Dihentikan</label>
                                                    <label class="switch">
                                                        <input type="hidden" name="dihentikan" value="0">
                                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan', $Pemasok->dihentikan) ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <span class="ml-2" id="dihentikan-status">{{ old('dihentikan', $Pemasok->dihentikan) ? 'Aktif' : 'Tidak Aktif' }}</span>
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
                                                    <input type="text" class="form-control form-control-sm" name="fileupload_1" placeholder="Link dokumen Anda" value="{{ $Pemasok->fileupload_1 }}">
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
                                <a class="nav-link active" data-toggle="tab" href="#info">Info</a>
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
                                                    <textarea class="form-control form-control-sm  @error('alamat_1') is-invalid @enderror" name="alamat_1">{{ old('alamat_1', $Pemasok->alamat_1) }}</textarea>
                                                    @error('alamat_1')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat 2</label>
                                                    <textarea class="form-control form-control-sm" name="alamat_2">{{ old('alamat_2', $Pemasok->alamat_2) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak 1</label>
                                                    <textarea class="form-control form-control-sm" name="alamatpajak_1">{{ old('alamatpajak_1', $Pemasok->alamatpajak_1) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Alamat Pajak 2</label>
                                                    <textarea class="form-control form-control-sm" name="alamatpajak_2">{{ old('alamatpajak_2', $Pemasok->alamatpajak_2) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>Provinsi</label>
                                                    <select class="form-control form-control-sm  @error('provinsi') is-invalid @enderror" name="provinsi">
                                                        <option selected disabled {{ old('provinsi', $Pemasok->provinsi) ? '' : 'selected' }}> --Pilih Provinsi-- </option>
                                                        @foreach ($provinsi as $items )
                                                            <option value="{{ $items->nama }}" {{ old('provinsi', $Pemasok->provinsi) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('123456')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Kota</label>
                                                    <select class="form-control form-control-sm  @error('kota') is-invalid @enderror"  name="kota">
                                                        <option selected disabled {{ old('kota', $Pemasok->kota) ? '' : 'selected' }}> --Pilih Kota-- </option>
                                                        @foreach ($kota as $items )
                                                            <option value="{{ $items->nama }}" {{ old('kota', $Pemasok->kota) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    @error('123456')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Negara</label>
                                                    <select class="form-control form-control-sm"  name="negara">
                                                        <option selected disabled {{ old('negara', $Pemasok->negara) ? '' : 'selected' }}> --Pilih Negara-- </option>
                                                        @foreach ($negara as $items )
                                                            <option value="{{ $items->nama }}" {{ old('negara', $Pemasok->negara) == $items->nama ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Kode Pos</label>
                                                    <input type="text" class="form-control form-control-sm" name="kode_pos" value="{{ $Pemasok->kode_pos }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Kontak</label>
                                                    <input type="text" class="form-control form-control-sm" name="kontak" value="{{ $Pemasok->kontak }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>No. Telp</label>
                                                    <input type="text" class="form-control form-control-sm" name="no_telp" value="{{ $Pemasok->no_telp }}">
                                                </div><div class="form-group">
                                                    <label>No. FAX</label>
                                                    <input type="text" class="form-control form-control-sm"  name="no_fax" value="{{ $Pemasok->no_fax }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email</label>
                                                    <input type="text" class="form-control form-control-sm" name="email" value="{{ $Pemasok->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label>Website</label>
                                                    <input type="text" class="form-control form-control-sm" name="website" value="{{ $Pemasok->website }}">
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
                                                    <input type="text" class="form-control form-control-sm  @error('npwp') is-invalid @enderror" name="npwp" value="{{ $Pemasok->npwp }}">
                                                    @error('npwp')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 1</label>
                                                    <select class="form-control form-control-sm  @error('pajak_1_id') is-invalid @enderror" name="pajak_1_id" id="pajak_1_id">
                                                        <option value="" {{ old('pajak_1_id', $Pemasok->pajak_1_id) ? '' : 'selected' }}> --Pilih Pajak 1-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->id }}" {{ old('pajak_1_id', $Pemasok->pajak_1_id) == $items->id ? 'selected' : '' }}>
                                                                {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                        <input type="hidden" name="pajak_1_check" id="pajak_1_check" value="{{ old('pajak_1', $Pemasok->pajak_1) ? '1' : '0' }}">
                                                    </select>
                                                    @error('pajak_1_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Pajak 2</label>
                                                    <select class="form-control form-control-sm  @error('pajak_2_id') is-invalid @enderror"  name="pajak_2_id">
                                                        <option value="" {{ old('pajak_2_id', $Pemasok->pajak_2_id) ? '' : 'selected' }}> --Pilih Pajak 2-- </option>
                                                        @foreach ($pajak as $items )
                                                            <option value="{{ $items->id }}" {{ old('pajak_2_id', $Pemasok->pajak_2_id) == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    <input type="hidden" name="pajak_2_check" id="pajak_2_check" value="{{ old('pajak_2', $Pemasok->pajak_2) ? '1' : '0' }}">
                                                    @error('pajak_2_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Syarat</label>
                                                    <select class="form-control form-control-sm  @error('syarat_id') is-invalid @enderror"  name="syarat_id">
                                                        <option selected disabled  {{ old('syarat_id', $Pemasok->syarat_id) ? '' : 'selected' }}> --Pilih Syarat-- </option>
                                                        @foreach ($syarat as $items )
                                                            <option value="{{ $items->id }}" {{ old('syarat_id', $Pemasok->syarat_id) == $items->id ? 'selected' : '' }}>{{ $items->nama }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('syarat_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Mata Uang</label>
                                                    <select id="namaBarangSelect" class="form-control form-control-sm  @error('mata_uang_id') is-invalid @enderror"  name="mata_uang_id">
                                                        <option disabled  {{ old('mata_uang_id', $Pemasok->mata_uang_id) ? '' : 'selected' }}> --Pilih Mata Uang-- </option>
                                                        @foreach ($mata_uang as $items )
                                                            <option value="{{ $items->id }}"
                                                                    data-nilai-tukar="{{ $items->nilai_tukar }}"
                                                                    {{ old('mata_uang_id', $Pemasok->mata_uang_id) == $items->id ? 'selected' : '' }}>
                                                                    {{ $items->nama }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                    <input id="nilaiTukarInput" type="text" class="form-control form-control-sm " name="nilai_tukar" value="{{ $Pemasok->nilai_tukar }}" style="display: none;">
                                                    @error('mata_uang_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Saldo Awal</label>
                                                            <input type="text" id="saldo_awal" class="form-control form-control-sm  @error('saldo_awal') is-invalid @enderror" name="saldo_awal" value="{{ 'Rp ' . number_format($Pemasok->saldo_awal, 0, ',', '.') }}">
                                                            @error('saldo_awal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>Tanggal</label>
                                                            <div class="cal-icon">
                                                                <input type="text" class="form-control form-control-sm  datetimepicker @error('tanggal') is-invalid @enderror" name="tanggal" value="{{ $Pemasok->tanggal }}">
                                                                @error('tanggal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Deskripsi</label>
                                                    <textarea class="form-control form-control-sm" name="deskripsi">{{ old('deskripsi', $Pemasok->deskripsi) }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label>No. PKP</label>
                                                    <input type="text" class="form-control form-control-sm" name="no_pkp" value="{{ $Pemasok->no_pkp }}">
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    {{-- <label>Memo</label> --}}
                                                    <textarea class="form-control form-control-sm" name="memo">{{ old('memo', $Pemasok->memo) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary buttonedit">Update</button>
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const selectPajak = document.getElementById('pajak_1_id');
            const selectPajak2 = document.getElementById('pajak_2_id');
            const hiddenInput = document.getElementById('pajak_1_check');
            const hiddenInput2 = document.getElementById('pajak_2_check');

            function updateHiddenInput() {
                if (selectPajak.value && selectPajak.value !== "") {
                    hiddenInput.value = "1";
                } else {
                    hiddenInput.value = "0";
                }
            }

            function updateHiddenInput2() {
                if (selectPajak2.value && selectPajak2.value !== "") {
                    hiddenInput2.value = "1";
                } else {
                    hiddenInpu2t.value = "0";
                }
            }

            selectPajak.addEventListener('change', updateHiddenInput);
            selectPajak2.addEventListener('change', updateHiddenInput2);

            updateHiddenInput();
            updateHiddenInput2();
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
        document.addEventListener('DOMContentLoaded', function () {
            const checkbox = document.getElementById('dihentikan');
            const statusText = document.getElementById('dihentikan-status');

            function updateStatusText() {
                statusText.textContent = checkbox.checked ? 'Ya' : 'Tidak';
            }

            updateStatusText();

            checkbox.addEventListener('change', updateStatusText);
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
