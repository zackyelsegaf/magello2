<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">Tambah Konsumen</h3>
                </div>
            </div>
        </div>

        <form wire:submit.prevent='save'>
            <div class="row mb-3">
                <div class="col-md-4 mb-2">
                    <label for="klaster" class="form-label fw-bold">
                        <strong class="text-danger h3 align-middle">*</strong>&nbsp;Nama Klaster
                    </label>
                    <div wire:ignore>
                        <select class="form-control" wire:model="cluster" id="klaster">
                            <option value="" selected>--Nama Klaster--</option>
                            @foreach ($data_cluster as $items )
                                <option value="{{ $items->nama_cluster }}">{{ $items->nama_cluster }}</option>
                            @endforeach
                        </select>
                    </div>
                    @foreach ($errors->get('cluster') as $err)
                        <div class="invalid-feedback d-block">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label for="warm_meter" class="form-label fw-bold">
                        <strong class="text-danger h3 align-middle">*</strong>&nbsp;Status Pengajuan
                    </label>
                    <select class="form-control @error('status_pengajuan') is-invalid @enderror" wire:model="status_pengajuan"
                        id="warm_meter">
                        <option value="">--Status Pengajuan--</option>
                        @foreach ($data_status_pengajuan as $items )
                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                        @endforeach
                    </select>
                    @foreach ($errors->get('status_pengajuan') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label for="nik" class="form-label fw-bold">
                        <strong class="text-danger h3 align-middle">*</strong>&nbsp;NIK
                    </label>
                    <input type="number" id="nik" wire:model="nik_konsumen" class="form-control @error('nik_konsumen') is-invalid @enderror">
                    @foreach ($errors->get('nik_konsumen') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label for="nama" class="form-label fw-bold">
                        <strong class="text-danger h3 align-middle">*</strong>&nbsp;Nama
                    </label>
                    <input type="text" id="nama" wire:model="nama_konsumen" class="form-control @error('nama_konsumen') is-invalid @enderror">
                    @foreach ($errors->get('nama_konsumen') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label for="nomor_hp" class="form-label fw-bold">
                        <strong class="text-danger h3 align-middle">*</strong>&nbsp;Nomor HP
                    </label>
                    <input type="number" id="nomor_hp" wire:model="no_hp" class="form-control @error('no_hp') is-invalid @enderror">
                    @foreach ($errors->get('no_hp') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label for="jenis_kelamin" class="form-label fw-bold">
                        <strong class="text-danger h3 align-middle">*</strong>&nbsp;Jenis Kelamin
                    </label>
                    <select class="form-control @error('jenis_kelamin') is-invalid @enderror" wire:model="jenis_kelamin"
                        id="jenis_kelamin">
                        <option value="">--Jenis Kelamin--</option>
                        @foreach ($data_jenis_kelamin as $items )
                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                        @endforeach
                    </select>
                    @foreach ($errors->get('jenis_kelamin') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2" wire:ignore>
                    <label for="provinsi_ktp" class="form-label fw-bold">Provinsi KTP</label>
                    <select class="form-control @error('provinsi') is-invalid @enderror" wire:model="provinsi"
                        id="provinsi_ktp">
                        <option value="" selected>--Provinsi KTP--</option>
                        @foreach ($data_provinsi as $items )
                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                        @endforeach
                    </select>
                    @foreach ($errors->get('provinsi') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2" wire:ignore>
                    <label for="kota_ktp" class="form-label fw-bold">Kota KTP</label>
                    <select class="form-control @error('kota') is-invalid @enderror" wire:model="kota" id="kota_ktp">
                        <option value="" selected>--Kota KTP--</option>
                        @foreach ($data_kota as $items )
                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                        @endforeach
                    </select>
                    @foreach ($errors->get('kota') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label for="kecamatan" class="form-label fw-bold">Kecamatan</label>
                    <input type="text" id="kecamatan" wire:model="kecamatan" class="form-control @error('kecamatan') is-invalid @enderror">
                    @foreach ($errors->get('kecamatan') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label for="kelurahan" class="form-label fw-bold">Kelurahan</label>
                    <input type="text" id="kelurahan" wire:model="kelurahan" class="form-control @error('kelurahan') is-invalid @enderror">
                    @foreach ($errors->get('kelurahan') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-12 mb-2">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea id="alamat" wire:model="alamat_konsumen" class="form-control" rows="2"></textarea>
                    @foreach ($errors->get('alamat_konsumen') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label for="sumber_prospek" class="form-label fw-bold">
                        <strong class="text-danger h3 align-middle">*</strong>&nbsp;Pekerjaan
                    </label>
                    <select class="form-control @error('pekerjaan') is-invalid @enderror" wire:model="pekerjaan"
                        id="sumber_prospek">
                        <option value="">--Pekerjaan--</option>
                        @foreach ($data_pekerjaan as $items )
                            <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                        @endforeach
                    </select>
                    @foreach ($errors->get('pekerjaan') as $err)
                        <div class="invalid-feedback">{{ $err }}</div>
                    @endforeach
                </div>
                <div class="col-md-4 mb-2">
                    <label class="form-label mb-3">Marketing</label>
                    <input type="text" wire:model='marketing' id="tagInput" class="form-control" readonly>
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
                    <div class="row mb-3 mt-2">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">NIK Pasangan</label>
                            <input type="number" wire:model="nik_pasangan" class="form-control @error('nik_pasangan') is-invalid @enderror">
                            @foreach ($errors->get('nik_pasangan') as $err)
                                <div class="invalid-feedback">{{ $err }}</div>
                            @endforeach
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nama Pasangan</label>
                            <input type="text" wire:model="nama_pasangan" class="form-control @error('nama_pasangan') is-invalid @enderror">
                            @foreach ($errors->get('nama_pasangan') as $err)
                                <div class="invalid-feedback">{{ $err }}</div>
                            @endforeach
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nomor HP Pasangan</label>
                            <input type="number" wire:model="no_hp_pasangan" class="form-control @error('no_hp_pasangan') is-invalid @enderror">
                            @foreach ($errors->get('no_hp_pasangan') as $err)
                                <div class="invalid-feedback">{{ $err }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="booking" class="tab-pane fade">
                    <div class="row mb-3 mt-2">
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
                    <div class="row mb-3 mt-2">
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
</div>
@push('scripts')
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

        $(document).ready(function() {
            $('#klaster').select2();
            $('#provinsi_ktp').select2();
            $('#kota_ktp').select2();
    
            $('#klaster').on('change', function(e){
                var data = $(this).select2('val')
                @this.set('cluster', data)
            });
            $('#provinsi_ktp').on('change', function(e){
                var data = $(this).select2('val')
                @this.set('provinsi', data)
            });
            $('#kota_ktp').on('change', function(e){
                var data = $(this).select2('val')
                @this.set('kota', data)
            });
        });

    </script>
@endpush