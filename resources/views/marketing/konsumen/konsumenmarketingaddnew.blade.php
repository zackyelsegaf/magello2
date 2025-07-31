@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Konsumen</h3>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('prospek/list/page') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="klaster" class="form-label fw-bold">Nama Klaster</label>
                        <select class="form-control @error('klaster') is-invalid @enderror" name="klaster" id="klaster">
                            <option value="">--Nama Klaster--</option>
                            <option value="1">Test</option>
                            {{-- Isi opsi --}}
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="warm_meter" class="form-label fw-bold">Status Pengajuan</label>
                        <select class="form-control @error('warm_meter') is-invalid @enderror" name="warm_meter"
                            id="warm_meter">
                            <option value="">--Status Pengajuan--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="nik" class="form-label fw-bold">NIK</label>
                        <input type="number" id="nik" name="nik" class="form-control"
                            value="{{ old('nik') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nama" class="form-label fw-bold">Nama</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            value="{{ old('nama') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="nomor_hp" class="form-label fw-bold">Nomor HP</label>
                        <input type="number" id="nomor_hp" name="nomor_hp" class="form-control"
                            value="{{ old('nomor_hp') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="jenis_kelamin" class="form-label fw-bold">Jenis Kelamin</label>
                        <select class="form-control @error('jenis_kelamin') is-invalid @enderror" name="jenis_kelamin"
                            id="jenis_kelamin">
                            <option value="">--Jenis Kelamin--</option>
                            <option value="L">Laki-Laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="provinsi_ktp" class="form-label fw-bold">Provinsi KTP</label>
                        <select class="form-control @error('provinsi_ktp') is-invalid @enderror" name="provinsi_ktp"
                            id="provinsi_ktp">
                            <option value="">--Provinsi KTP--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="kota_ktp" class="form-label fw-bold">Kota KTP</label>
                        <select class="form-control @error('kota_ktp') is-invalid @enderror" name="kota_ktp" id="kota_ktp">
                            <option value="">--Kota KTP--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="kecamatan" class="form-label fw-bold">Kecamatan</label>
                        <input type="text" id="kecamatan" name="kecamatan" class="form-control"
                            value="{{ old('kecamatan') }}">
                    </div>
                    <div class="col-md-4">
                        <label for="kelurahan" class="form-label fw-bold">Kelurahan</label>
                        <input type="text" id="kelurahan" name="kelurahan" class="form-control"
                            value="{{ old('kelurahan') }}">
                    </div>
                    <div class="col-12">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="2">{{ old('alamat') }}</textarea>
                    </div>
                    <div class="col-md-4">
                        <label for="sumber_prospek" class="form-label fw-bold">Pekerjaan</label>
                        <select class="form-control @error('sumber_prospek') is-invalid @enderror" name="sumber_prospek"
                            id="sumber_prospek">
                            <option value="">--Pekerjaan--</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Marketing</label>
                        <div class="form-control d-flex flex-wrap gap-2" id="tags-input">
                            <input type="text" id="tagInput" class="border-0 flex-grow-1"
                                value="Tester">
                        </div>
                    </div>
                </div>

                <!-- Tabs -->
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item">
                                <a id="tab-data" class="nav-link active" data-toggle="tab" href="#data">Data
                                    Suami/Istri</a>
                            </li>
                            <li class="nav-item">
                                <a id="tab-booking" class="nav-link" data-bs-toggle="tab" href="#booking">Booking</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#link">Link dengan EA7</a>
                            </li>
                        </ul>
                    </div>

                    <div id="data" class="tab-pane fade show active">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label fw-bold">NIK Pasangan</label>
                                <input type="number" name="nik_pasangan" class="form-control"
                                    value="{{ old('nik_pasangan') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nama Pasangan</label>
                                <input type="text" name="nama_pasangan" class="form-control"
                                    value="{{ old('nama_pasangan') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Nomor HP Pasangan</label>
                                <input type="number" name="hp_pasangan" class="form-control"
                                    value="{{ old('hp_pasangan') }}">
                            </div>
                        </div>
                    </div>

                    <div id="booking" class="tab-pane fade">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="pilih_unit76uyh" class="form-label fw-bold">Pilih Unit</label>
                                <select class="form-control @error('pilih_unit') is-invalid @enderror" name="pilih_unit"
                                    id="pilih_unit">
                                    <option value="">--Pilih Unit--</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="booking_fee" class="form-label fw-bold">Booking Fee</label>
                                <input type="number" id="booking_fee" name="booking_fee" class="form-control"
                                    value="{{ old('booking_fee') }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold">Tanggal Booking</label>
                                <input type="date" class="form-control form-control-sm" name="tanggal_booking"
                                    value="{{ old('tanggal_booking') }}">
                            </div>
                        </div>
                    </div>

                    <div id="link" class="tab-pane fade">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="link_email" class="form-label fw-bold">email</label>
                                <input type="text" name="link_email" class="form-control"
                                    value="{{ old('link_email') }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary buttonedit">
                            <i class="fa fa-check mr-2"></i>Simpan
                        </button>
                        <a href="{{ route('konsumenmarketing/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3">
                            <i class="fas fa-chevron-left mr-2"></i>Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Deklarasi semua elemen yang digunakan
        const tabBooking = document.getElementById('tab-booking');
        const klasterSelect = document.getElementById('klaster');
        const tabDataLink = document.querySelector('a[href="#data"]');
        const tabBookingLink = document.querySelector('a[href="#booking"]');

        tabBooking.addEventListener('click', function (e) {
            const klasterValue = klasterSelect.value;

            if (!klasterValue) {
                e.preventDefault();

                // Tampilkan alert
                Swal.fire({
                    icon: 'error',
                    text: 'Silakan pilih Nama Klaster terlebih dahulu!',
                    confirmButtonColor: '#8c54ff',
                    timer: 2500,
                    showConfirmButton: true
                });

                // Nonaktifkan semua tab dan kontennya
                document.querySelectorAll('.nav-link, .tab-pane').forEach(el => {
                    el.classList.remove('active', 'show');
                });

                // Aktifkan kembali tab #data
                const tabData = new bootstrap.Tab(tabDataLink);
                tabData.show();
            } else {
                // Klaster terisi, buka tab booking
                const tabBookingTab = new bootstrap.Tab(tabBookingLink);
                tabBookingTab.show();
            }
        });
    });
</script>


    </div>
@endsection
