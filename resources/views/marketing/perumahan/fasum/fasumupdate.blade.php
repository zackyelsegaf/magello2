@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Edit Fasum</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('fasum/update', $updateFasum->id) }}" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="kluster" class="form-label fw-bold">Kluster</label>
                        <select class="tomselect @error('cluster_id') is-invalid @enderror" name="cluster_id" id="kluster" data-placeholder="Pilih cluster...">
                            <option selected disabled></option>
                            @foreach ($cluster as $items )
                            <option value="{{ $items->id }}" {{ old('cluster_id', $updateFasum->cluster_id) == $items->id ? 'selected' : '' }}>{{ $items->nama_cluster }}</option>
                            @endforeach
                        </select>
                        @error('cluster_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="tipe_model" class="form-label fw-bold">Tipe Model</label>
                        <input type="text" id="tipe_model" name="tipe_model" class="form-control" value="{{ old('tipe_model', $updateFasum->tipe_model) }}" placeholder="Tipe Model" readonly>
                    </div>

                    <div class="col-md-4">
                        <label for="blok" class="form-label fw-bold">Blok</label>
                        <input type="text" id="blok" name="blok_fasum" class="form-control @error('blok_fasum') is-invalid @enderror" value="{{ old('blok_fasum', $updateFasum->blok_fasum) }}" placeholder="Blok">
                        @error('blok_fasum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="nomor_unit" class="form-label fw-bold">Nomor Unit</label>
                        <input type="number" id="nomor_unit" name="nomor_unit_fasum" class="form-control @error('nomor_unit_fasum') is-invalid @enderror" value="{{ old('nomor_unit_fasum', $updateFasum) }}" placeholder="Nomor Unit">
                        @error('nomor_unit_fasum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="jumlah_lantai" class="form-label fw-bold">Jumlah Lantai</label>
                        <input type="number" id="jumlah_lantai" name="jumlah_lantai" class="form-control @error('jumlah_lantai') is-invalid @enderror" value="{{ old('jumlah_lantai', $updateFasum->jumlah_lantai) }}" placeholder="Jumlah Lantai">
                        @error('jumlah_lantai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="luas_tanah" class="form-label fw-bold">Luas Tanah (m²)</label>
                        <input type="number" id="luas_tanah" name="luas_tanah" class="form-control @error('luas_tanah') is-invalid @enderror" value="{{ old('luas_tanah', $updateFasum->luas_tanah) }}" placeholder="Luas Tanah (m²)">
                        @error('luas_tanah')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="luas_bangunan" class="form-label fw-bold">Luas Bangunan (m²)</label>
                        <input type="number" id="luas_bangunan" name="luas_bangunan" class="form-control @error('luas_bangunan') is-invalid @enderror" value="{{ old('luas_bangunan', $updateFasum->luas_bangunan) }}" placeholder="Luas Bangunan (m²)">
                    </div>

                    <div class="col-md-4">
                        <label for="rap_rab" class="form-label fw-bold">RAP & RAB</label>
                        <select class="tomselect @error('rap_rab_id') is-invalid @enderror" name="rap_rab_id" id="rap_rab" data-placeholder="Pilih rap & rab...">
                            <option selected disabled></option>
                            @foreach ($rap_rab as $items )
                            <option value="{{ $items->id }}" {{ old('rap_rab_id', $updateFasum->rap_rab_id) == $items->id ? 'selected' : '' }}>{{ $items->judul_rap }}</option>
                            @endforeach
                        </select>
                        @error('rap_rab_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label for="harga" class="form-label fw-bold">Harga</label>
                        <input type="text" id="harga" name="harga_fasum" class="form-control rupiah @error('harga_fasum') is-invalid @enderror" value="{{ old('harga_fasum', $updateFasum->harga_fasum) }}" placeholder="Harga">
                        @error('harga_fasum')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label for="spesifikasi" class="form-label">Spesifikasi</label>
                        <textarea id="spesifikasi" class="form-control @error('spesifikasi') is-invalid @enderror" name="spesifikasi" rows="2">{{ old('spesifikasi', $updateFasum->spesifikasi) }}</textarea>
                        @error('spesifikasi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="tab-content profile-tab-cont">
                    <div class="profile-menu">
                        <ul class="nav nav-tabs nav-tabs-solid">
                            <li class="nav-item"> 
                                <a class="nav-link active font-weight-bold" data-toggle="tab" href="#rincian">Data Arsip Fasum {{ $detail->blok_fasum . "-" . $detail->nomor_unit_fasum . "/" . $detail->nama_cluster}}</a> 
                            </li>
                        </ul>
                    </div>
                    <div style="padding-bottom:15px;" id="rincian" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="row" id="arsip_loop">
                                    @php $i = 1; @endphp
                                    @foreach($arsip as $a)
                                        <div class="col-md-6 arsip-item mb-3" id="arsipRow_{{ $i }}">
                                            <input type="hidden" name="arsip_id_{{ $i }}" value="{{ $a['id'] }}">
                                            <input type="hidden" name="arsip_delete_{{ $i }}" value="0">

                                            <div class="border bg-white my-rounded-2 p-3">
                                                <div class="form-group mb-2">
                                                    <label for="arsip_nama_{{ $i }}">Nama Arsip</label>
                                                    <input type="text" id="arsip_nama_{{ $i }}" name="nama_arsip_{{ $i }}" class="form-control form-control-sm" value="{{ $a['nama_arsip'] }}">
                                                </div>

                                                <div class="form-group mb-2">
                                                    <label for="arsip_nomor_{{ $i }}">Nomor Arsip</label>
                                                    <input type="text" id="arsip_nomor_{{ $i }}" name="nomor_arsip_{{ $i }}" class="form-control form-control-sm" value="{{ $a['nomor_arsip'] }}">
                                                </div>

                                                <div class="form-group mb-2">
                                                    <label for="arsip_tanggal_{{ $i }}">Tanggal Arsip</label>
                                                    <input type="date" id="arsip_tanggal_{{ $i }}" name="tanggal_arsip_{{ $i }}" class="form-control form-control-sm" value="{{ $a['tanggal_arsip'] }}">
                                                </div>

                                                <div class="form-group mb-2">
                                                    <label for="arsip_file_{{ $i }}">File Arsip</label>
                                                    <div class="custom-file">
                                                        <input type="file" id="arsip_file_{{ $i }}" name="file_arsip_{{ $i }}" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png">
                                                        <label class="custom-file-label">Pilih File</label>
                                                    </div>
                                                    @if($a['file_url'])
                                                        <small class="d-block mt-1">
                                                            File lama:<a class="btn btn-primary buttonedit4" href="{{ $a['file_url'] }}" target="_blank"><strong><i class="fas fa-file mr-2 ml-1"></i></strong>Download File{{-- $a['original_name'] ?? 'lihat' --}}</a>
                                                        </small>
                                                    @endif
                                                </div>

                                                <div class="form-group mb-2">
                                                    <label for="arsip_keterangan_{{ $i }}">Keterangan</label>
                                                    <textarea id="arsip_keterangan_{{ $i }}" name="keterangan_arsip_{{ $i }}" rows="2" class="form-control form-control-sm" placeholder="Catatan">{{ $a['keterangan_arsip'] }}</textarea>
                                                </div>

                                                {{-- <div class="text-right pt-1 pb-5">
                                                    <button type="button" class="btn btn-primary buttonedit3 btn-remove" onclick="flagDelete({{ $i }})">
                                                        <strong><i class="fas fa-trash-alt mr-2"></i>Hapus</strong>
                                                    </button>
                                                </div> --}}
                                            </div>
                                        </div>
                                        @php $i++; @endphp
                                    @endforeach
                                </div>
                                <div class="row" id="arsip_cols" data-seed-defaults="{{ ($arsip->count() ?? 0) == 0 ? '1' : '0' }}">
                                    <div class="col-md-6" id="arsip_left"></div>
                                    <div class="col-md-6" id="arsip_right"></div>
                                </div>
                                <input type="hidden" id="arsip_counter" name="arsip_counter" value="{{ max(1, ($arsip->count() ?? 0)) }}">
                                <button type="button" class="btn btn-primary buttonedit mb-3 mr-3" id="arsip_btn_add">
                                    <strong><i class="fas fa-paper-plane mr-2 ml-1"></i>Tambah Arsip</strong>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check mr-2"></i> Simpan
                        </button>
                        <a href="{{ route('fasum/list/page') }}" class="btn btn-primary ml-3">
                            <i class="fas fa-chevron-left mr-2"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- TomSelect
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
@section('script')
    <script>
        (function(){
            const maxFields = 50;
            const leftCol  = document.getElementById('arsip_left');
            const rightCol = document.getElementById('arsip_right');
            const btnAdd   = document.getElementById('arsip_btn_add');
            const counter  = document.getElementById('arsip_counter');

            function countItems(colEl){ return colEl.querySelectorAll('.arsip-item').length; }
            function pickColumn(){ return (countItems(leftCol) <= countItems(rightCol)) ? leftCol : rightCol; }

            function wireFileLabel(scope){
                (scope.querySelectorAll ? scope.querySelectorAll('.custom-file-input') : [scope]).forEach(inp => {
                const lbl = inp && inp.parentElement ? inp.parentElement.querySelector('.custom-file-label') : null;
                if (!inp || !lbl) return;
                if (inp.files && inp.files.length) lbl.textContent = inp.files[0].name;
                inp.addEventListener('change', function(){
                    lbl.textContent = (this.files && this.files.length) ? this.files[0].name : 'Pilih File';
                });
                });
            }

            function addRow(nameDefault = '', targetCol = null){
                let i = parseInt(counter.value||'0',10) + 1;
                if (i > maxFields) { alert('Maksimal '+maxFields+' arsip'); return; }

                const wrap = document.createElement('div');
                wrap.className = 'arsip-item mb-3';
                wrap.id = 'arsipRow_'+i;

                wrap.innerHTML = `
                <input type="hidden" name="arsip_delete_${i}" value="0">
                <div class="border bg-white my-rounded-2 p-3">
                    <div class="form-group mb-2">
                    <label for="arsip_nama_${i}">Nama</label>
                    <input type="text" id="arsip_nama_${i}" name="nama_arsip_${i}" class="form-control form-control-sm" value="${nameDefault}">
                    </div>
                    <div class="form-group mb-2">
                    <label for="arsip_nomor_${i}">Nomor</label>
                    <input type="text" id="arsip_nomor_${i}" name="nomor_arsip_${i}" class="form-control form-control-sm">
                    </div>
                    <div class="form-group mb-2">
                    <label for="arsip_tanggal_${i}">Tanggal</label>
                    <input type="date" id="arsip_tanggal_${i}" name="tanggal_arsip_${i}" class="form-control form-control-sm">
                    </div>
                    <div class="form-group mb-2">
                    <label for="arsip_file_${i}">File</label>
                    <div class="custom-file">
                        <input type="file" id="arsip_file_${i}" name="file_arsip_${i}" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                        <label class="custom-file-label">Pilih File</label>
                    </div>
                    </div>
                    <div class="form-group mb-2">
                    <label for="arsip_keterangan_${i}">Keterangan</label>
                    <textarea id="arsip_keterangan_${i}" name="keterangan_arsip_${i}" rows="2" class="form-control form-control-sm" placeholder="Catatan"></textarea>
                    </div>
                    <div class="text-right pt-1 pb-5">
                    <button type="button" class="btn btn-primary buttonedit3 btn-remove">
                        <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                    </button>
                    </div>
                </div>
                `;

                wrap.querySelector('.btn-remove').addEventListener('click', function(){
                wrap.remove();
                });

                (targetCol || pickColumn()).appendChild(wrap);
                counter.value = i;

                wireFileLabel(wrap);
            }

            if (btnAdd) btnAdd.addEventListener('click', function(){ addRow(); });

            document.addEventListener('DOMContentLoaded', function(){
                wireFileLabel(document.getElementById('arsip_cols'));

                const seedFlag = (document.getElementById('arsip_cols')?.dataset.seedDefaults === '1');
                if (!seedFlag) return;

                const REQUIRED = ['IMB','SHGB','SHM','PBB'];
                const targetCols = [leftCol, leftCol, rightCol, rightCol];
                REQUIRED.forEach((name, idx) => addRow(name, targetCols[idx] || pickColumn()));
            });
        })();
    </script>
@endsection
@endsection
