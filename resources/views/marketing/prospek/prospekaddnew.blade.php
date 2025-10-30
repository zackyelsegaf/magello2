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
                    <select class="tomselect @error('cluster') is-invalid @enderror" wire:model="cluster" id="klaster" wire:ignore>
                        <option value="">--Nama Klaster--</option>
                        @foreach ($data_cluster as $items)
                            <option value="{{ $items->nama_cluster }}"
                                @selected($cluster === $items->nama_cluster)>
                                {{ $items->nama_cluster }}
                            </option>
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
                    <select class="tomselect @error('ditugaskan_ke') is-invalid @enderror" wire:model="ditugaskan_ke" id="ditugaskan_ke" wire:ignore>
                        <option value="">--Ditugaskan Ke--</option>
                        @foreach ($data_user as $items)
                            <option value="{{ $items->name }}"
                                @selected($ditugaskan_ke === $items->name)>
                                {{ $items->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4" wire:ignore>
                    <label for="sumber_prospek" class="form-label fw-bold">Sumber Prospek</label>
                    <select class="tomselect @error('sumber_prospek') is-invalid @enderror" wire:model="sumber_prospek" id="sumber_prospek" wire:ignore>
                        <option value="">--Sumber Prospek--</option>
                        @foreach (['Google Organik','Instagram Organik','Facebook Organik','Iklan Facebook','Iklan Google','Iklan Instagram','Brosur','Relasi','Marketing'] as $opt)
                            <option value="{{ $opt }}" @selected($sumber_prospek === $opt)>{{ $opt }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4" wire:ignore>
                    <label for="warm_meter" class="form-label fw-bold">Warm Meter</label>
                    <select class="tomselect @error('warm_meter') is-invalid @enderror" wire:model="warm_meter" id="warm_meter" wire:ignore>
                        <option value="">--Warm Meter--</option>
                        @foreach (['Cold','Warm','Hot'] as $wm)
                            <option value="{{ $wm }}" @selected($warm_meter === $wm)>{{ $wm }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Tags</label>
                    <select id="tagInput" wire:model="tags" multiple wire:ignore>
                        @foreach (($allTags ?? $tags ?? []) as $item)
                            <option value="{{ $item }}" @selected(in_array($item, (array)$tags, true))>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-15 row align-items-center">
                <div class="col">
                    <div class="">
                        <a href="{{ route('prospek/list/page') }}"
                            class="btn btn-primary float-left mr-2 buttonedit">
                            <i class="fas fa-chevron-left mr-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-primary buttonedit">
                            <i class="fa fa-save mr-2"></i>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('select.tomselect').forEach(function (el) {
                new TomSelect(el,{
                    create: true,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tagInput = document.getElementById('tagInput');
            new TomSelect(tagInput, {
                create: true,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });
        });
    </script>
@endpush