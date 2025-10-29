@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- CSS tema -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah SPK Mandor/Pekerja Internal</h3>
                    </div>
                </div>
            </div>

            {{-- Modal Pekerja --}}
            <div class="modal fade" id="modalPekerja" tabindex="-1" role="dialog" aria-labelledby="modalLabelPekerja"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content my-rounded-2">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Pekerja</h5>
                            <button type="button" class="close" data-dismiss="modal">
                                <span>&times;</span>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('form/spkmandorpekerja/save') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-1">
                                    <label for="nama_pekerja" class="form-label fw-bold">Nama</label>
                                    <input type="text" name="nama_pekerja" id="nama_pekerja"
                                        class="form-control form-control-sm" placeholder="Nama">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="alamat" class="form-label fw-bold">Alamat</label>
                                    <input type="text" name="alamat" id="alamat"
                                        class="form-control form-control-sm" placeholder="Alamat">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="no_hp" class="form-label fw-bold">Nomor Telepon</label>
                                    <input type="number" name="no_hp" id="no_hp"
                                        class="form-control form-control-sm" placeholder="Nomor Telepon">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="tambahPekerja" type="button" class="btn btn-primary buttonedit"><i class="fas fa-save mr-2"></i>Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('form/spkmandorpekerja/save') }}" enctype="multipart/form-data">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nomor_spk" class="form-label fw-bold">Nomor</label>
                        <input type="text" id="nomor_spk" name="nomor_spk" class="form-control form-control-sm font-weight-bold" value="{{ $nomorPreview }}" placeholder="Nomor Pengajuan" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="pekerja_id" class="form-label fw-bold">Pekerja</label>
                        <select class="tomselect @error('pekerja_id') is-invalid @enderror" name="pekerja_id" id="pekerja_id" placeholder="Pilih Pekerja">
                            <option {{ old('pekerja_id') ? '' : 'selected' }} disabled></option>
                            @foreach($pekerja as $items)
                            <option value="{{ $items->id }}">{{ $items->nama_pekerja }}  ({{ $items->no_hp }})</option>
                            @endforeach
                        </select>
                        @error('pekerja_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-primary buttonedit" data-toggle="modal"
                            data-target="#modalPekerja">
                            <strong><i class="fas fa-user-tie mr-2"></i>Tambah Pekerja</strong>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <label for="judul_spk" class="form-label fw-bold">Judul</label>
                        <input type="text" id="judul_spk" name="judul_spk" class="form-control form-control-sm @error('judul_spk') is-invalid @enderror" value="{{ old('judul_spk') }}" placeholder="Judul">
                        @error('judul_spk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4" style="display: none;">
                        <label for="status_spk" class="form-label fw-bold">Status</label>
                        <input type="text" id="status_spk" name="status_spk" class="form-control form-control-sm" value="1" placeholder="Status">
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal_mulai" class="form-label fw-bold">Tanggal Mulai</label>
                        <input type="text" id="tanggal_mulai" name="tanggal_mulai" class="form-control form-control-sm datetimepicker @error('tanggal_mulai') is-invalid @enderror" value="{{ old('tanggal_mulai') }}">
                        @error('tanggal_mulai')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="lama_pengerjaan" class="form-label fw-bold">Lama Pengerjaan (hari)</label>
                        <input type="number" id="lama_pengerjaan" name="lama_pengerjaan" class="form-control form-control-sm @error('lama_pengerjaan') is-invalid @enderror" value="{{ old('lama_pengerjaan') }}" placeholder="Durasi">
                        @error('lama_pengerjaan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal_spk" class="form-label fw-bold">Tanggal SPK</label>
                        <input type="text" id="tanggal_spk" name="tanggal_spk" class="form-control form-control-sm datetimepicker @error('tanggal_spk') is-invalid @enderror" value="{{ old('tanggal_spk') }}">
                        @error('tanggal_spk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="siklus_pembayaran" class="form-label fw-bold">Siklus Pembayaran</label>
                        <select class="tomselect @error('siklus_pembayaran') is-invalid @enderror" name="siklus_pembayaran" id="siklus_pembayaran">
                            <option value="">-- Siklus Pembayaran --</option>
                            <option value="Harian" {{ old('siklus_pembayaran') == 'Harian' ? 'selected' : '' }}>Harian</option>
                            <option value="Mingguan" {{ old('siklus_pembayaran') == 'Mingguan' ? 'selected' : '' }}>Mingguan</option>
                            <option value="2 Mingguan" {{ old('siklus_pembayaran') == '2 Mingguan' ? 'selected' : '' }}>2 Mingguan</option>
                            <option value="3 Mingguan" {{ old('siklus_pembayaran') == '3 Mingguan' ? 'selected' : '' }}>3 Mingguan</option>
                            <option value="Bulanan" {{ old('siklus_pembayaran') == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                        </select>
                        @error('siklus_pembayaran')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label for="spp_id" class="form-label fw-bold">Surat Perintah Pembangunan</label>
                        <select class="tomselect @error('spp_id') is-invalid @enderror" id="spp_id" name="spp_id" data-placeholder="Pilih cluster...">
                            <option {{ old('spp_id') ? '' : 'selected' }} disabled></option>
                            @foreach($spp as $items)
                            <option value="{{ $items->id }}">{{ $items->nomor_spp }} - {{ $items->tanggal_spp }} - {{ $items->instruksi }}</option>
                            @endforeach
                        </select>
                        @error('spp_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4">
                        <label style="display: none;" for="Kapling" class="form-label">Kapling</label>
                        <input style="display: none;" type="text" name="dibuat_oleh" class="form-control" rows="2" value="{{ Auth::user()->name }}"></input>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-2">
                            <label for="fileupload">Lampiran</label>
                            <div class="custom-file">
                                <input type="file" id="fileupload" name="fileupload" class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                <label class="custom-file-label">Pilih File</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <label for="kapling" class="form-label fw-bold">Kapling</label>
                        <select class="tomselect @error('kapling_id') is-invalid @enderror" id="kapling" name="kapling_id[]" multiple data-placeholder="Pilih kapling...">
                            <option {{ old('kapling_id') ? '' : 'selected' }} disabled></option>
                            @foreach($spp as $items)
                            <option value="{{ $items->id }}">{{ $items->nomor_spp }} - {{ $items->tanggal_spp }} - {{ $items->instruksi }}</option>
                            @endforeach
                        </select>
                        @error('kapling_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        {{-- Modal --}}
                        <div class="modal fade" id="modal" tabindex="-1" role="dialog"
                            aria-labelledby="modalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content my-rounded-2">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Item SPK Mandor/Pekerja</h5>
                                        <button type="button" class="close" data-dismiss="modal">
                                            <span>&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="filterBox" class="mb-3">
                                            <div class="card m-3">
                                                <div class="form-group mb-1">
                                                    <label for="kaplingItem" class="form-label fw-bold">Kapling</label>
                                                    <select class="tomselect" id="kaplingItem" name="nama_kapling" data-placeholder="Pilih kapling...">
                                                        <option {{ old('nama_kapling') ? '' : 'selected' }} disabled></option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                                                    <input type="text" name="pekerjaan" id="pekerjaan" class="form-control form-control-sm" placeholder="Pekerjaan">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="upah" class="form-label fw-bold">Upah</label>
                                                    <input type="number" name="upah" id="upah" class="form-control form-control-sm" placeholder="Upah">
                                                </div>
                                                <div class="form-group mb-1">
                                                    <label for="retensi" class="form-label fw-bold">Retensi (%)</label>
                                                    <input type="number" name="retensi" id="retensi" class="form-control form-control-sm" value="5" placeholder="Retensi (%)">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary buttonedit" id="tambahTerpilih">
                                            <i class="fas fa-paper-plane mr-2"></i> Tambah ke Form
                                        </button>
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
                                <a class="nav-link active" data-toggle="tab" href="#detail">Upah</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#dokumen">Dokumen</a>
                            </li>
                        </ul>
                    </div>
                    <div id="detail" class="tab-pane fade show active">
                        <div class="card">
                            <div class="card-body">
                                <div class="row float-right mr-0">
                                    <button type="button" class="btn btn-primary buttonedit mb-3" id="tambahFeeRow">
                                        <strong><i class="fas fa-cube mr-3 ml-1"></i>Tambah</strong>
                                    </button>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="text-center">
                                            <p class="font-weight-bold mb-0 h5">LIST FEE</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive mt-3">
                                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                        <i class="fa fa-exclamation-triangle mr-2"></i>
                                        Setelah pilih SPP & kapling, tambahkan fee per pekerja per kapling.
                                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                    </div>

                                    <table class="table table-striped table-bordered table-hover table-center mb-0" id="FeeTable">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th>Kapling</th>
                                            <th>Pekerjaan</th>
                                            <th>Upah</th>
                                            <th>Retensi (%)</th>
                                            <th>Aksi</th>
                                        </tr>
                                        </thead>
                                        <tbody id="feeTableBody">
                                        @if(old('fee'))
                                            @foreach(old('fee') as $i => $row)
                                            <tr class="fee-row">
                                                <td style="min-width:220px">
                                                <select class="form-control form-control-sm select-kapling"></select>
                                                {{-- yang disimpan: NAMA kapling --}}
                                                <input type="hidden" name="fee[{{ $i }}][nama_kapling]" value="{{ $row['nama_kapling'] ?? '' }}" class="input-nama-kapling">
                                                </td>
                                                <td><input style="width: 200px;" type="text"   name="fee[{{ $i }}][pekerjaan]" class="form-control form-control-sm input-pekerjaan" value="{{ $row['pekerjaan'] ?? '' }}"></td>
                                                <td><input style="width: 200px;" type="text" name="fee[{{ $i }}][upah]"      class="form-control form-control-sm rupiah input-upah"      value="{{ $row['upah'] ?? '' }}" min="0" step="1"></td>
                                                <td><input style="width: 100px;" type="text" name="fee[{{ $i }}][retensi]"   class="form-control form-control-sm input-retensi"   value="{{ $row['retensi'] ?? 5 }}" min="0" max="100" step="1"></td>
                                                <td>
                                                <button style="width: 100px;" type="button" class="btn btn-primary buttonedit2 mr-2 remove-fee-row">
                                                    <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                                                </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="dokumen" class="tab-pane fade">
                        <div class="card">
                            <div class="card-body">
                                <div id="editor" style="height: 200px;">
                                    <ol>
                                        <li>
                                            Item pekerjaan, bobot prosentase pekerjaan, volume pekerjaan, gambar kerja dan Rencana Kerja dan Syarat — Syarat (RKS) merupakan bagian yang tidak terpisahkan dari Surat Perintah Kerja (SPK) ini.
                                        </li>
                                        <li>
                                            Keterlambatan terhadap penyelesaian pekerjaan (100%), sesuai dengan Surat Perjanjian Kerjasama pasal 4 butir 2, akan dikenakan denda 0,2% dari Nilai Pekerjaan untuk setiap minggunya.
                                        </li>
                                        <li>
                                            Apabila dalam masa pelaksanaan pekerjaan ada perubahan — perubahan secara teknis, maka akan diatur dan dituangkan dalam bentuk SPK Tambahan, yang akan diberitahukan oleh Pihak I.
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="page-header">
                    <div class="mb-15 row align-items-center">
                        <div class="col">
                            <div class="">
                                <a href="{{ route('spkmandorpekerja/list/page') }}" class="btn btn-primary float-left veiwbutton mr-2">
                                    <i class="fas fa-chevron-left mr-2"></i>Batal
                                </a>
                                <button type="submit" class="btn btn-primary buttonedit">
                                    <i class="fas fa-save mr-2"></i>Simpan
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
    <!-- Script CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        (function(){
            const el = document.querySelector('#editor');
            if (!el) return;
            ClassicEditor.create(el, {
                toolbar: [
                'heading','|','bold','italic','underline','link',
                'bulletedList','numberedList','|',
                'blockQuote','insertTable','imageUpload','mediaEmbed','|',
                'undo','redo','codeBlock'
                ]
            }).catch(console.error);
        })();
    </script>
    <script>
        $(function () {
            const cleaveMap = new WeakMap();

            document.querySelectorAll('form').forEach(function (form) {
                form.addEventListener('submit', function () {
                form.querySelectorAll('input.rupiah').forEach(function (el) {
                    const inst = cleaveMap.get(el);
                    if (inst) el.value = inst.getRawValue();
                });
                });
            });

            let feeIndex = $('#feeTableBody .fee-row').length;

            function getSelectedKaplingNames() {
                const el = document.getElementById('kapling');
                const ts = el && el.tomselect ? el.tomselect : null;
                if (!ts) return [];
                return ts.items.map(id => (ts.options[id]?.text || id)); // ambil NAMA (label)
            }

            function fillKaplingOptions($select, selectedName) {
                const names = getSelectedKaplingNames();
                $select.empty();
                $select.append(`<option value="" disabled ${selectedName ? '' : 'selected'}>-- Pilih kapling (dari SPP) --</option>`);
                names.forEach(nm => {
                const sel = (nm === selectedName) ? 'selected' : '';
                $select.append(`<option value="${nm}" ${sel}>${nm}</option>`);
                });
                $select.prop('disabled', names.length === 0);
            }

            function addFeeRow(prefill = {}) {
                const idx = feeIndex++;
                const rowHtml = `
                <tr class="fee-row">
                    <td style="min-width:220px">
                    <select class="form-control form-control-sm select-kapling"></select>
                    <input type="hidden" name="fee[${idx}][nama_kapling]" class="input-nama-kapling" value="${prefill.nama_kapling || ''}">
                    </td>
                    <td><input style="width: 200px;" type="text"   name="fee[${idx}][pekerjaan]" class="form-control form-control-sm input-pekerjaan" value="${prefill.pekerjaan || ''}"></td>
                    <td><input style="width: 200px;" type="text"   name="fee[${idx}][upah]"      class="form-control form-control-sm rupiah input-upah"  value="${prefill.upah || ''}"></td>
                    <td><input style="width: 100px;" type="number" name="fee[${idx}][retensi]"   class="form-control form-control-sm input-retensi" value="${prefill.retensi || 5}" min="0" max="100" step="1"></td>
                    <td>
                    <button style="width: 100px;" type="button" class="btn btn-primary buttonedit2 mr-2 remove-fee-row">
                        <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                    </button>
                    </td>
                </tr>`;

                const $row = $(rowHtml);
                $('#feeTableBody').append($row);

                const $sel = $row.find('.select-kapling');
                fillKaplingOptions($sel, prefill.nama_kapling || null);
                $sel.on('change', function(){
                $row.find('.input-nama-kapling').val($(this).val() || '');
                });

                const upahInput = $row.find('.rupiah')[0];
                if (upahInput) {
                    const instance = new Cleave(upahInput, {
                        numeral: true,
                        numeralPositiveOnly: true,
                        numeralDecimalScale: 2,
                        numeralThousandsGroupStyle: 'thousand',
                        numeralDecimalMark: '.',
                        delimiter: ',',
                        prefix: 'Rp ',
                        rawValueTrimPrefix: true
                    });
                    cleaveMap.set(upahInput, instance);
                }
            }

            $('#tambahFeeRow').on('click', function(){
                addFeeRow();
            });

            $(document).on('click', '.remove-fee-row', function(){
                $(this).closest('tr').remove();
            });

            const tsKap = document.getElementById('kapling')?.tomselect || null;
            if (tsKap) {
                tsKap.on('change', function(){
                $('#feeTableBody .fee-row').each(function(){
                    const $row = $(this);
                    const currentName = $row.find('.select-kapling').val() || $row.find('.input-nama-kapling').val();
                    fillKaplingOptions($row.find('.select-kapling'), currentName || null);
                });
                });
            }

            $('#feeTableBody .fee-row').each(function(){
                const $row = $(this);
                const selectedName = $row.find('.input-nama-kapling').val() || '';
                fillKaplingOptions($row.find('.select-kapling'), selectedName);

                const upahInput = $row.find('.rupiah')[0];
                if (upahInput && !cleaveMap.get(upahInput)) {
                const instance = new Cleave(upahInput, {
                    numeral: true,
                    numeralPositiveOnly: true,
                    numeralDecimalScale: 2,
                    numeralThousandsGroupStyle: 'thousand',
                    numeralDecimalMark: '.',
                    delimiter: ',',
                    prefix: 'Rp ',
                    rawValueTrimPrefix: true
                });
                cleaveMap.set(upahInput, instance);
                }
            });

            if (!$('#feeTableBody .fee-row').length) addFeeRow();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.custom-file-input').forEach(function (inp) {
                inp.addEventListener('change', function (e) {
                const f = e.target.files && e.target.files[0];
                const label = inp.nextElementSibling;
                if (f && label && label.classList.contains('custom-file-label')) {
                    label.textContent = f.name;
                }
                });
            });
        });
    </script>
@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
        const tsPekerja          = new TomSelect('#pekerja_id', {create:false, searchField:['text']});
        const tsSpp              = new TomSelect('#spp_id', {create:false, searchField:['text']});
        const tsSiklusPembayaran = new TomSelect('#siklus_pembayaran', {create:false, searchField:['text']});
        const tsKapling          = new TomSelect('#kapling',    {create:false, searchField:['text'], plugins:['remove_button'], maxItems: null}); // multiple
        // const tsKaplingItem      = new TomSelect('#kaplingItem',    {create:false, searchField:['text'], plugins:['remove_button'], maxItems: null});

        document.getElementById('tambahPekerja').addEventListener('click', function(){
            const nama_pekerja   = document.getElementById('nama_pekerja').value.trim();
            const alamat = document.getElementById('alamat').value.trim();
            const no_hp  = document.getElementById('no_hp').value.trim();
            if(!nama_pekerja || !no_hp){ alert('Nama & No HP wajib.'); return; }

            fetch("{{ route('spkmandorpekerja/store-ajax') }}", {
            method: 'POST',
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json','Content-Type':'application/json'},
            body: JSON.stringify({nama_pekerja, alamat, no_hp})
            })
            .then(r => r.json())
            .then(json => {
            tsPekerja.addOption({value: String(json.id), text: json.text});
            tsPekerja.addItem(String(json.id));
            $('#modalPekerja').modal('hide');
            document.getElementById('nama_pekerja').value='';
            document.getElementById('alamat').value='';
            document.getElementById('no_hp').value='';
            })
            .catch(() => alert('Gagal menyimpan pekerja'));
        });

        tsSpp.on('change', function(value){
            if(!value){
                tsKapling.clear(true);
                tsKapling.disable();
                return;
            }
            fetch("{{ route('spk/kapling-by-spp') }}?spp_id="+encodeURIComponent(value))
            .then(r => r.json())
            .then(list => {
                tsKapling.clearOptions();
                list.forEach(opt => tsKapling.addOption({value:String(opt.id), text:opt.text}));
                tsKapling.enable();
            })
            .catch(() => { alert('Gagal memuat kapling'); tsKapling.disable(); });
        });
        tsKapling.disable();
        });
    </script>
@endpush
@endsection
