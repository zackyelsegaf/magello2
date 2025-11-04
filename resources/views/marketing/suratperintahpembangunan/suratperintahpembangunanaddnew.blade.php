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
            <form method="POST" action="{{ route('form/suratperintahpembangunan/save') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label fw-bold">Instruksi</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="instruksi" id="instruksi_konsumen" value="konsumen" checked>
                        <label class="form-check-label" for="instruksi_konsumen">Marketing (Konsumen)</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="instruksi" id="instruksi_stok" value="stok">
                        <label class="form-check-label" for="instruksi_stok">Manajemen (Stok)</label>
                    </div>
                    <input type="hidden" name="konsumen" id="konsumen_val" value="1">
                    <input type="hidden" name="stok" id="stok_val" value="0">
                    @error('konsumen')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    @error('stok')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="nomor_spp" class="form-label fw-bold">Nomor SPP</label>
                    <input type="text" id="nomor_spp" class="form-control form-control-sm font-weight-bold" value="{{ $nomorPreview }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="tanggal_spp" class="form-label fw-bold">Tanggal SPP</label>
                    <input type="text" id="tanggal_spp" name="tanggal_spp" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_spp') }}">
                    @error('tanggal_spp')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <select id="select-tags" multiple placeholder="Pilih Kapling" name="kapling_id[]">
                        @foreach($cluster as $clusterId => $items)
                            <optgroup label="{{ $items->first()->nama_cluster }}">
                                @foreach($items as $k)
                                    @if($k->kapling_id)
                                        <option value="{{ $k->kapling_id }}">
                                            {{ $k->blok_kapling }} - {{ $k->nomor_unit_kapling }} \ {{ $k->nama_cluster }} - {{ $k->konsumen_nama  }}
                                        </option>
                                    @endif
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                    @error('kapling_id')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                    @error('kapling_id.*')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="mb-3">
                    <label for="catatan" class="form-label fw-bold">Catatan</label>
                    <textarea id="catatan" name="catatan" class="form-control" rows="3">{{ old('catatan') }}</textarea>
                    @error('catatan')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <a href="{{ route('suratperintahpembangunan/list/page') }}" class="btn btn-primary mr-2 buttonedit">
                            <i class="fas fa-chevron-left mr-2"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary buttonedit">
                            <i class="fa fa-save mr-2"></i> Simpan
                        </button>
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
            new TomSelect("#select-tags", {
                plugins: ['remove_button'],
                create: false,
                searchField: ['text']
            });

            const ts = document.getElementById('select-tags')?.tomselect;

            function setInstruksiMode(mode){
            if(mode === 'konsumen'){
                $('#konsumen_val').val(1); $('#stok_val').val(0);
                if (ts?.setMaxItems) ts.setMaxItems(1);
                if (ts && ts.items.length > 1) ts.setValue([ts.items[0]], true);
            }else{
                $('#konsumen_val').val(0); $('#stok_val').val(1);
                if (ts?.setMaxItems) ts.setMaxItems(null);
            }
            }

            $('input[name="instruksi"]').on('change', function(){
            setInstruksiMode($(this).val());
            });

            if (ts){
            ts.on('item_add', function(){
                if ($('input[name="instruksi"]:checked').val() === 'konsumen' && ts.items.length > 1){
                ts.setValue([ts.items[0]], true);
                }
            });
            }

            setInstruksiMode($('input[name="instruksi"]:checked').val());

            function syncInstruksi(val){
                const isKonsumen = (val === 'konsumen');
                document.getElementById('konsumen_val').value = isKonsumen ? '1' : '0';
                document.getElementById('stok_val').value     = isKonsumen ? '0' : '1';
            }

            document.querySelectorAll('input[name="instruksi"]').forEach(r => {
                r.addEventListener('change', (e) => syncInstruksi(e.target.value));
            });

            syncInstruksi(document.querySelector('input[name="instruksi"]:checked').value);
        });
    </script>
@endpush
@endsection
