@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah Surat Perintah Pembangunan</h3>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('suratperintahpembangunan/list/page') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-bold">Instruksi</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="instruksi" id="instruksi_marketing"
                            value="marketing" checked>
                        <label class="form-check-label" for="instruksi_marketing">Marketing (Konsumen)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="instruksi" id="instruksi_manajemen"
                            value="manajemen">
                        <label class="form-check-label" for="instruksi_manajemen">Manajemen (Stok)</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="no_spp" class="form-label fw-bold">Nomor SPP</label>
                    <input type="text" id="no_spp" name="no_spp" class="form-control" placeholder="Nomor SPP"
                        value="{{ old('no_spp', '') }}">
                </div>

                <div class="mb-3">
                    <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" class="form-control" value="{{ old('tanggal') }}">
                </div>

                <div class="mb-3">
                    <label for="kapling" class="form-label fw-bold">Kapling</label>
                    <select id="kapling" name="kapling" class="form-control select2">
                        <option value="">Pilih 1 Kapling</option>
                        {{-- @foreach ($listKapling as $kapling)
                        <option value="{{ $kapling->id }}">{{ $kapling->kode_kavling }}</option>
                    @endforeach --}}
                    </select>
                </div>

                <div class="mb-3">
                    <label for="catatan" class="form-label fw-bold">Catatan</label>
                    <textarea id="catatan" name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
                </div>

                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit">
                                <i class="fa fa-check mr-2"></i>Simpan
                            </button>
                            <a href="{{ route('kategoritiketkostumer/list/page') }}"
                                class="btn btn-primary float-left veiwbutton ml-3">
                                <i class="fas fa-chevron-left mr-2"></i>Batal
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@push('scripts')
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: 'Pilih 1 Kapling',
                allowClear: true
            });
        });
    </script>
@endpush
