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
                        <form method="POST" action="{{ route('spkmandorpekerjainternal/update', $updateSpk->id) }}" enctype="multipart/form-data">                            
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
            <form method="POST" action="{{ route('spkmandorpekerjainternal/update', $updateSpk->id) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{ $updateSpk->id }}">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nomor_spk" class="form-label fw-bold">Nomor</label>
                        <input type="text" id="nomor_spk" name="nomor_spk" class="form-control form-control-sm font-weight-bold" value="{{ old('nomor_spk', $updateSpk->nomor_spk) }}" placeholder="Nomor Pengajuan" readonly>
                    </div>
                    <div class="col-md-4">
                        <label for="pekerja_id" class="form-label fw-bold">Pekerja</label>
                        <select class="tomselect" name="pekerja_id" id="pekerja_id" placeholder="Pilih Pekerja">
                            <option disabled {{ old('pekerja_id', $updateSpk->pekerja_id ?? '') ? '' : 'selected' }}>-- Pilih Pekerja --</option>
                            @foreach($pekerja as $items)
                                <option value="{{ $items->id }}" {{ old('pekerja_id', $updateSpk->pekerja_id ?? '') == $items->id ? 'selected' : '' }}>
                                    {{ $items->nama_pekerja }} ({{ $items->no_hp }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-primary buttonedit" data-toggle="modal"
                            data-target="#modalPekerja">
                            <strong><i class="fas fa-user-tie mr-2"></i>Tambah Pekerja</strong>
                        </button>
                    </div>
                    <div class="col-md-4">
                        <label for="judul_spk" class="form-label fw-bold">Judul</label>
                        <input type="text" id="judul_spk" name="judul_spk" class="form-control form-control-sm" value="{{ old('judul_spk', $updateSpk->judul_spk) }}" placeholder="Judul">
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal_mulai" class="form-label fw-bold">Tanggal Mulai</label>
                        <input type="text" id="tanggal_mulai" name="tanggal_mulai" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_mulai', $updateSpk->tanggal_mulai) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="lama_pengerjaan" class="form-label fw-bold">Lama Pengerjaan (hari)</label>
                        <input type="number" id="lama_pengerjaan" name="lama_pengerjaan" class="form-control form-control-sm" value="{{ old('lama_pengerjaan', $updateSpk->lama_pengerjaan) }}" placeholder="Durasi">
                    </div>
                    <div class="col-md-4">
                        <label for="tanggal_spk" class="form-label fw-bold">Tanggal SPK</label>
                        <input type="text" id="tanggal_spk" name="tanggal_spk" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_spk', $updateSpk->tanggal_spk) }}">
                    </div>
                    <div class="col-md-4">
                        <label for="siklus_pembayaran" class="form-label fw-bold">Siklus Pembayaran</label>
                        <select class="tomselect" name="siklus_pembayaran" id="siklus_pembayaran">
                            <option {{ old('tipe_model', $updateSpk->siklus_pembayaran) ? '' : 'selected' }} disabled>-- Siklus Pembayaran --</option>
                            <option value="Harian" {{ old('siklus_pembayaran', $updateSpk->siklus_pembayaran) == 'Harian' ? 'selected' : '' }}>Harian</option>
                            <option value="Mingguan" {{ old('siklus_pembayaran', $updateSpk->siklus_pembayaran) == 'Mingguan' ? 'selected' : '' }}>Mingguan</option>
                            <option value="2 Mingguan" {{ old('siklus_pembayaran', $updateSpk->siklus_pembayaran) == '2 Mingguan' ? 'selected' : '' }}>2 Mingguan</option>
                            <option value="3 Mingguan" {{ old('siklus_pembayaran', $updateSpk->siklus_pembayaran) == '3 Mingguan' ? 'selected' : '' }}>3 Mingguan</option>
                            <option value="Bulanan" {{ old('siklus_pembayaran', $updateSpk->siklus_pembayaran) == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="spp_id" class="form-label fw-bold">Surat Perintah Pembangunan</label>
                        <select id="spp_id" name="spp_id" class="tomselect">
                            @foreach($spp as $row)
                                <option value="{{ $row->id }}" {{ $row->id == $updateSpk->spp_id ? 'selected' : '' }}>
                                {{ $row->nomor_spp }} - {{ $row->tanggal_spp }} - {{ $row->instruksi }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label style="display: none;" for="Kapling" class="form-label">Kapling</label>
                        <input style="display: none;" type="text" name="dibuat_oleh" class="form-control" rows="2" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="col-md-4">
                        @if($arsip && $arsip->isNotEmpty())
                            @foreach($arsip as $a)
                                <div class="form-group mb-2">
                                    @if($a['file_url'])
                                        <label>File Arsip</label>
                                        <small class="d-block mt-1">
                                            <a class="btn btn-primary buttonedit-sm mr-2" href="{{ $a['file_url'] }}" target="_blank"><strong><i class="fas fa-file mr-2"></i></strong>Download File{{-- $a['original_name'] ?? 'lihat' --}}</a>
                                            <a class="btn btn-primary buttonedit2-sm" href="{{ route('spkmandorpekerjainternal/file/delete', $a['id']) }}" ><i class="fas fa-trash-alt mr-2"></i>Hapus</a>
                                        </small>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            <div class="form-group mb-2">
                                <label>File Arsip</label>
                                <div class="custom-file">
                                    <input type="file" name="fileupload" class="custom-file-input" value="{{ old('fileupload', $updateSpk->fileupload)  }}" accept=".pdf,.jpg,.jpeg,.png">
                                    <label class="custom-file-label">Pilih File</label>
                                </div>
                            </div>
                            <div class="alert alert-info mt-2" role="alert">
                                <i class="fas fa-info mr-2"></i>Tidak ada file yang diunggah.
                            </div>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <label for="kapling" class="form-label fw-bold">Kapling</label>
                        <select id="kapling" name="kapling_id[]" class="tomselect" multiple>
                        @foreach($kaplingOptions as $opt)
                            <option value="{{ $opt->id }}" {{ in_array($opt->id, $selectedKaplingIds->toArray()) ? 'selected' : '' }}>
                            {{ $opt->text }}
                            </option>
                        @endforeach
                        </select>
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
                                                    @forelse($feeRows as $i => $fee)
                                                        <tr class="fee-row">
                                                        <td style="min-width:220px">
                                                            {{-- tampilkan apa adanya, tidak pakai select --}}
                                                            <input type="text" class="form-control form-control-sm show-nama" 
                                                                value="{{ $fee->nama_kapling }}" readonly>
                                                            {{-- tetap kirim ke server --}}
                                                            <input type="hidden" name="fee[{{ $i }}][nama_kapling]" 
                                                                class="input-nama-kapling" value="{{ $fee->nama_kapling }}">
                                                        </td>
                                                        <td><input type="text"   name="fee[{{ $i }}][pekerjaan]" class="form-control form-control-sm" value="{{ $fee->pekerjaan }}"></td>
                                                        <td><input type="text"   name="fee[{{ $i }}][upah]"      class="form-control form-control-sm rupiah" value="{{ $fee->upah }}"></td>
                                                        <td><input type="number" name="fee[{{ $i }}][retensi]"   class="form-control form-control-sm" value="{{ $fee->retensi ?? 5 }}" min="0" max="100"></td>
                                                        <td><button type="button" class="btn btn-sm btn-danger remove-fee-row">Hapus</button></td>
                                                        </tr>
                                                    @empty
                                                        {{-- kalau kosong biarin JS yang nambah baris pertama --}}
                                                    @endforelse
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
                    </div>
                </div>
                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-check mr-2"></i> Simpan
                        </button>
                        <a href="{{ route('spkmandorpekerja/list/page') }}" class="btn btn-primary ml-3">
                            <i class="fas fa-chevron-left mr-2"></i> Batal
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
@section('script')
    <!-- Script Quill -->
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
    <script>
        $(function () {
        const tsKap = document.getElementById('kapling')?.tomselect || null;
        const selectedNames = () => (tsKap ? tsKap.items.map(v => tsKap.options[v]?.text || v) : []);

        let feeIndex = $('#feeTableBody .fee-row').length || 0;

        function fillOptions($select, selectedName) {
            const names = selectedNames();
            $select.empty().append(`<option value="" disabled ${selectedName?'':'selected'}>-- Pilih kapling (dari SPP) --</option>`);
            names.forEach(nm => $select.append(`<option value="${nm}" ${nm===selectedName?'selected':''}>${nm}</option>`));
            $select.prop('disabled', names.length === 0);
        }

        function addFeeRow(prefill = {}) {
            const idx  = feeIndex++;
            const name = prefill.nama_kapling || '';

            const $row = $(`
            <tr class="fee-row">
                <td style="min-width:220px">
                <select class="form-control form-control-sm select-kapling"></select>
                <input type="hidden" name="fee[${idx}][nama_kapling]" class="input-nama-kapling" value="${name}">
                </td>
                <td><input type="text"   name="fee[${idx}][pekerjaan]" class="form-control form-control-sm" value="${prefill.pekerjaan||''}"></td>
                <td><input type="text"   name="fee[${idx}][upah]"      class="form-control form-control-sm rupiah" value="${prefill.upah||''}"></td>
                <td><input type="number" name="fee[${idx}][retensi]"   class="form-control form-control-sm" value="${prefill.retensi||5}" min="0" max="100"></td>
                <td><button type="button" class="btn btn-sm btn-danger remove-fee-row">Hapus</button></td>
            </tr>
            `);

            $('#feeTableBody').append($row);

            const $sel = $row.find('.select-kapling');
            fillOptions($sel, name);
            $sel.on('change', function(){ $row.find('.input-nama-kapling').val(this.value || ''); });

            if (window.Cleave) {
            new Cleave($row.find('.rupiah')[0], {
                numeral: true,
                numeralPositiveOnly: true,
                numeralDecimalScale: 2,
                numeralThousandsGroupStyle: 'thousand',
                numeralDecimalMark: '.',
                delimiter: ',',
                prefix: 'Rp ',
                rawValueTrimPrefix: true
            });
            }
        }

        $('#tambahFeeRow').on('click', () => addFeeRow());

        $(document).on('click', '.remove-fee-row', function () {
            $(this).closest('tr').remove();
        });

        tsKap?.on('change', () => {
            $('#feeTableBody .select-kapling').each(function(){
            const current = $(this).closest('tr').find('.input-nama-kapling').val() || '';
            fillOptions($(this), selectedNames().includes(current) ? current : '');
            });
        });

        if (window.Cleave) {
            $('#feeTableBody .fee-row .rupiah').each(function(){
            new Cleave(this, {
                numeral: true,
                numeralPositiveOnly: true,
                numeralDecimalScale: 2,
                numeralThousandsGroupStyle: 'thousand',
                numeralDecimalMark: '.',
                delimiter: ',',
                prefix: 'Rp ',
                rawValueTrimPrefix: true
            });
            });
        }

        if (!$('#feeTableBody .fee-row').length) addFeeRow();

        $('form').on('submit', function(){
            $(this).find('input.rupiah').each(function(){
            this.value = (this.value || '').replace(/[^0-9]/g,'');
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
