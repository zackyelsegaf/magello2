<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">Tambah Prospek</h3>
                </div>
            </div>
        </div>

        <form wire:submit.prevent='save'>
            <!-- Section 1: Form Header -->
            <div class="row mb-3">
                <div class="col-md-4" wire:ignore>
                    <label for="klaster" class="form-label fw-bold">Nama Klaster</label>
                    <select class="form-control @error('cluster') is-invalid @enderror" wire:model="cluster" id="klaster">
                        <option value="">--Nama Klaster--</option>
                        @foreach ($data_cluster as $items )
                            <option value="{{ $items->nama_cluster }}">{{ $items->nama_cluster }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="nama" class="form-label fw-bold">Nama</label>
                    <input type="text" id="nama" wire:model="nama" class="form-control @error('nama') is-invalid @enderror">
                </div>
                <div class="col-md-4">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" id="email" wire:model="email" class="form-control @error('email') is-invalid @enderror">
                </div>
                <div class="col-md-4">
                    <label for="nomor_hp" class="form-label fw-bold">Nomor Hp</label>
                    <input type="number" id="nomor_hp" wire:model="no_hp" class="form-control @error('no_hp') is-invalid @enderror">
                </div>
                <div class="col-md-4" wire:ignore>
                    <label for="ditugaskan_ke" class="form-label fw-bold">Ditugaskan Ke</label>
                    <select class="form-control @error('ditugaskan_ke') is-invalid @enderror" wire:model="ditugaskan_ke" id="ditugaskan_ke">
                        <option value="">--Ditugaskan Ke--</option>
                        @foreach ($data_user as $items )
                            <option value="{{ $items->name }}">{{ $items->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4" wire:ignore>
                    <label for="sumber_prospek" class="form-label fw-bold">Sumber Prospek</label>
                    <select class="form-control @error('sumber_prospek') is-invalid @enderror" wire:model="sumber_prospek" id="sumber_prospek">
                        <option value="">--Sumber Prospek--</option>
                        <option value="Google Organik">Google Organik</option>
                        <option value="Instagram Organik">Instagram Organik</option>
                        <option value="Facebook Organik">Facebook Organik</option>
                        <option value="Iklan Facebook">Iklan Facebook</option>
                        <option value="Iklan Google">Iklan Google</option>
                        <option value="Iklan Instagram">Iklan Instagram</option>
                        <option value="Brosur">Brosur</option>
                        <option value="Relasi">Relasi</option>
                        <option value="Marketing">Marketing</option>
                    </select>
                </div>
                <div class="col-md-4" wire:ignore>
                    <label for="warm_meter" class="form-label fw-bold">Warm Meter</label>
                    <select class="form-control @error('warm_meter') is-invalid @enderror" wire:model="warm_meter" id="warm_meter">
                        <option value="">--Warm Meter--</option>
                        <option value="Cold">Cold</option>
                        <option value="Warm">Warm</option>
                        <option value="Hot">Hot</option>
                    </select>
                </div>
                <div class="col-md-4" wire:ignore>
                    <label class="form-label">Tags</label>
                    <select class="form-control" wire:model="tags" id="tagInput" multiple>
                        @foreach ($tags as $item)
                            <option value="{{ $item }}">{{ $item }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-15 row align-items-center">
                <div class="col">
                    <div class="">
                        <button type="submit" class="btn btn-primary buttonedit">
                            <i class="fa fa-check mr-2"></i>Simpan
                        </button>
                        <a href="{{ route('prospek/list/page') }}"
                            class="btn btn-primary float-left veiwbutton ml-3">
                            <i class="fas fa-chevron-left mr-2"></i>Batal
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#tagInput').select2({
                placeholder: 'Ketik lalu tekan Enter',
                multiple: true,
                tags: true,
            });
            $('#klaster').select2();
            $('#ditugaskan_ke').select2();
            $('#sumber_prospek').select2();
            $('#warm_meter').select2();

            $('#tagInput').on('change', function(e){
                var data = $(this).select2('val')
                @this.set('tags', data)
            });
            $('#klaster').on('change', function(e){
                var data = $(this).select2('val')
                @this.set('cluster', data)
            });
            $('#ditugaskan_ke').on('change', function(e){
                var data = $(this).select2('val')
                @this.set('ditugaskan_ke', data)
            });
            $('#sumber_prospek').on('change', function(e){
                var data = $(this).select2('val')
                @this.set('sumber_prospek', data)
            });
            $('#warm_meter').on('change', function(e){
                var data = $(this).select2('val')
                @this.set('warm_meter', data)
            });
        });
    </script>
@endpush