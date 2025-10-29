@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Departemen</h3>
                    </div>
                </div>
            </div>
            <form action="{{ route('departemen/update', $Departemen->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row formtype">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>No</label>
                                    <input type="text" class="form-control form-control-sm " id="departemen_id" name="departemen_id" value="{{ $Departemen->departemen_id }}">
                                     @error('departemen_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Departemen</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_departemen') is-invalid @enderror"name="nama_departemen" value="{{ $Departemen->nama_departemen }}">
                                     @error('nama_departemen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Nama Kontak</label>
                                    <input type="text" class="form-control form-control-sm  @error('nama_kontak') is-invalid @enderror"name="nama_kontak" value="{{ $Departemen->nama_kontak }}">
                                     @error('nama_kontak')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea class="form-control form-control-sm  @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi') }}">{{ $Departemen->deskripsi }}</textarea>
                                     @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label>Tipe</label>
                                    <select class="form-control form-control-sm  @error('tipe_departemen') is-invalid @enderror"  name="tipe_departemen">
                                        <option selected disabled {{ old('tipe_departemen', $Departemen->tipe_departemen) ? '' : 'selected' }}> --Pilih Tipe-- </option>
                                        @foreach ($tipe_departemen as $items )
                                            <option value="{{ $items->nama }}" {{ old('tipe_departemen', $Departemen->tipe_departemen) == $items->nama ? 'selected' : '' }}>{{ $items->nama }}</option>
                                        @endforeach
                                    </select>
                                     @error('tipe_departemen')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group">
                                    <label for="dihentikan">Dihentikan</label>
                                    <label class="switch">
                                        <input type="hidden" name="dihentikan" value="0">
                                        <input type="checkbox" name="dihentikan" id="dihentikan" value="1" {{ old('dihentikan', $Departemen->dihentikan) ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="ml-2" id="dihentikan-status">{{ old('dihentikan', $Departemen->dihentikan) ? 'Aktif' : 'Tidak Aktif' }}</span>
                                         @error('dihentikan')<div class="invalid-feedback">{{ $message }}</div>@enderror

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <a href="{{ route('departemen/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2">
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
