@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- CSS tema -->
        <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Tambah SPK Mandor/Pekerja SubCon</h3>
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
            <form method="POST" action="{{ route('form/spkmandorpekerjasubcon/save') }}" enctype="multipart/form-data">
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
                            <option value="{{ $items->id }}" {{ old('pekerja_id') == $items->id ? 'selected' : '' }}>{{ $items->nama_pekerja }}  ({{ $items->no_hp }})</option>
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
                        <input type="text" id="status_spk" name="status_spk" class="form-control form-control-sm" value="0" placeholder="Status">
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
                        <label for="spp_id" class="form-label fw-bold">Surat Perintah Pembangunan</label>
                        <select class="tomselect @error('spp_id') is-invalid @enderror" id="spp_id" name="spp_id" data-placeholder="Pilih cluster...">
                            <option {{ old('spp_id') ? '' : 'selected' }} disabled></option>
                            @foreach($spp as $items)
                            <option value="{{ $items->id }}" {{ old('spp_id') == $items->id ? 'selected' : '' }}>{{ $items->nomor_spp }} - {{ $items->tanggal_spp }} - {{ $items->instruksi }}</option>
                            @endforeach
                        </select>
                        @error('spp_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div style="display: none;" class="col-md-4">
                        <label for="Kapling" class="form-label">Kapling</label>
                        <input type="text" name="dibuat_oleh" class="form-control" rows="2" value="{{ Auth::user()->name }}"></input>
                    </div>
                    <div class="col-md-4">
                        <label for="tipe_pembayaran" class="form-label fw-bold">Tipe Pembayaran Subcon</label>
                        <select class="tomselect" name="tipe_pembayaran" id="tipe_pembayaran">
                            <option value="">-- Tipe Pembayaran Subcon --</option>
                            <option value="Full Financiering" {{ old('tipe_pembayaran') == 'Full Financiering' ? 'selected' : '' }}>Full Financiering</option>
                            <option value="Termin By Progress" {{ old('tipe_pembayaran') == 'Termin By Progress' ? 'selected' : '' }}>Termin By Progress</option>
                        </select>
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
                                        <strong><i class="fas fa-cube mr-3 ml-1"></i>Tambah Termin</strong>
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
                                    <table class="table table-borderless table-center mb-0" id="FeeTable">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>Kapling</th>
                                                <th>Termin</th>
                                                <th>% Pekerjaan</th>
                                                <th>% Pembayaran</th>
                                                <th>Nilai</th>
                                                <th>Retensi (%)</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="3">
                                                    <small><strong>Nilai Perjanjian Untuk</strong></small>
                                                    <input type="text" id="nominal_perjanjian" name="nominal_perjanjian" class="form-control form-control-sm nilai-perjanjian @error('nominal_perjanjian') is-invalid @enderror" value="{{ old('nominal_perjanjian') }}" placeholder="Durasi">
                                                    @error('nominal_perjanjian')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror                                                
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody id="feeTableBody">
                                        @if(old('fee'))
                                            @foreach(old('fee') as $i => $row)
                                            <tr class="fee-row">
                                                <td style="min-width:220px"><input type="hidden" name="fee[{{ $i }}][nama_kapling]" value="{{ old("fee.$i.nama_kapling") }}" class="form-control-plaintext font-weight-bold input-nama-kapling" readonly></td>
                                                <td><input style="width: 100px" type="text" name="fee[{{ $i }}][nama_termin]" class="form-control form-control-sm" value="{{ old("fee.$i.nama_termin") }}"></td>
                                                <td><input style="width: 90px;" type="text" name="fee[{{ $i }}][persen_pekerjaan]" class="form-control form-control-sm" value="{{ old("fee.$i.persen_pekerjaan") }}"></td>
                                                <td><input style="width: 90px;" type="text" name="fee[{{ $i }}][persen_pembayaran]" class="form-control form-control-sm" value="{{ old("fee.$i.persen_pembayaran") }}"></td>
                                                <td><input style="width: 150px;" type="text" name="fee[{{ $i }}][nilai_termin]" class="form-control form-control-sm rupiah nilai-termin" value="{{ old("fee.$i.nilai_termin") }}" min="0" step="1"></td>
                                                <td><input style="width: 100px;" type="text" name="fee[{{ $i }}][retensi]" class="form-control form-control-sm input-retensi" value="{{ old("fee.$i.retensi", 5) }}" min="0" max="100" step="1"></td>
                                                <td>
                                                <button style="width: 100px;" type="button" class="btn btn-primary buttonedit2 mr-2 remove-fee-row">
                                                    <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                                                </button>
                                                </td>
                                            </tr>
                                            @endforeach
                                        @endif
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <th colspan="3" class="fw-bold text-right">Total</th>
                                                <td colspan="1">
                                                    <input style="width: 90px;" type="text" name="total_persentase_pembayaran" class="form-control-plaintext text-right" value="{{ old('total_persentase_pembayaran') }}" placeholder="0%" readonly>
                                                </td>
                                                <td colspan="1">
                                                    <input style="width: 150px;" type="text" name="total_nilai_termin" class="form-control-plaintext text-right" value="{{ old('total_nilai_termin') }}"  placeholder="Rp 0" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th colspan="3" class="fw-bold text-right">Grand Total</th>
                                                <td colspan="1">
                                                    <input style="width: 90px;" type="text" name="grand_total_persentase_pembayaran" class="form-control-plaintext font-weight-bold text-right" value="{{ old('grand_total_persentase_pembayaran') }}" placeholder="0%" readonly>
                                                </td>
                                                <td colspan="1">
                                                    <input style="width: 150px;" type="text" name="grand_total_nilai_termin" class="form-control-plaintext font-weight-bold text-right" value="{{ old('grand_total_nilai_termin') }}"  placeholder="Rp 0" readonly>
                                                </td>
                                            </tr>
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
            function getRawNumber($input){
                const v = ($input.val()||'').toString().replace(/[^\d.-]/g,'');
                return parseFloat(v) || 0;
            }

            function getNominalPerjanjian(){
                return getRawNumber($('#nominal_perjanjian'));
            }

            function getKaplingNames(){
                const el = document.getElementById('kapling');
                const ts = el && el.tomselect ? el.tomselect : null;
                if (ts) return ts.items.map(id => (ts.options[id]?.text || id));
                const arr = [];
                $('#kapling option:selected').each(function(){ arr.push($(this).text()); });
                return arr;
            }
            function getKaplingLabel(){ return getKaplingNames().join(', '); }
            function updateNamaKaplingAll(){
                const label = getKaplingLabel();
                $('#feeTableBody .fee-row .input-nama-kapling').val(label);
            }

            let feeIndex = $('#feeTableBody .fee-row').length;

            function addFeeRow(prefill = {}){
                if ($('#feeTableBody .fee-row').length >= 5) { alert('Maksimal 5 termin!'); return; }
                const idx = feeIndex++;
                const rowHtml = `
                <tr class="fee-row">
                    <td style="min-width:150px">
                        <input type="text" name="fee[${idx}][nama_kapling]" class="form-control-plaintext font-weight-bold input-nama-kapling" value="${prefill.nama_kapling||''}" readonly>
                    </td>
                    <td><input style="width:100px" type="text" name="fee[${idx}][nama_termin]" class="form-control form-control-sm" readonly></td>
                    <td><input style="width:90px" type="number" name="fee[${idx}][persen_pekerjaan]" class="form-control form-control-sm" value="${prefill.persen_pekerjaan||''}"></td>
                    <td><input style="width:90px" type="number" name="fee[${idx}][persen_pembayaran]" class="form-control form-control-sm persen-pembayaran" value="${prefill.persen_pembayaran||''}"></td>
                    <td><input style="width:150px" type="number" name="fee[${idx}][nilai_termin]" class="form-control form-control-sm nilai-termin" value="${prefill.nilai_termin||''}" readonly></td>
                    <td><input style="width:100px" type="number" name="fee[${idx}][retensi]" class="form-control form-control-sm input-retensi" value="${prefill.retensi??5}" min="0" max="100" step="1"></td>
                    <td>
                        <button type="button" class="btn btn-primary buttonedit2 mr-2 remove-fee-row" style="width:100px">
                            <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                        </button>
                    </td>
                </tr>`;
                $(rowHtml).appendTo('#feeTableBody');
                reindexTermin();
                recalcTotals();
                applyPaymentModeUI(); 
            }

            function reindexTermin(){
                $('#feeTableBody .fee-row').each(function(i){
                    $(this).find('[name*="[nama_termin]"]').val('Termin ' + (i+1));
                });
            }

            function recalcTotals(){
                const mode = $('#tipe_pembayaran').val();
                const nominal = getNominalPerjanjian();
                let tp = 0, tn = 0;

                $('#feeTableBody .fee-row').each(function(){
                    const $r = $(this);
                    const $nilai = $r.find('.nilai-termin');
                    const $pemb  = $r.find('[name*="[persen_pembayaran]"]');
                    const $pekj  = $r.find('[name*="[persen_pekerjaan]"]');

                    if (mode === 'Full Financiering'){
                        $pekj.val(100);
                        tn += getRawNumber($nilai);
                        tp = 100;
                    } else {
                        const p = parseFloat($pemb.val()) || 0;
                        const v = (nominal * p) / 100;
                        $nilai.prop('readonly', true).val(v);
                        tp += p; tn += v;
                    }
                });

                $('input[name="total_persentase_pembayaran"]').val(mode==='Full Financiering'?100:tp);
                $('input[name="grand_total_persentase_pembayaran"]').val(mode==='Full Financiering'?100:tp);
                $('input[name="total_nilai_termin"]').val(tn);
                $('input[name="grand_total_nilai_termin"]').val(tn);
            }

            function applyPaymentModeUI(){
                const mode = $('#tipe_pembayaran').val();
                if(mode === 'Full Financiering'){
                    const $nom = $('#nominal_perjanjian');
                    $nom.hide(); $nom.closest('td, th, div.form-group, div, .col-md-*, .col-*, .input-group').hide();

                    const rows = $('#feeTableBody .fee-row');
                    if(rows.length === 0) addFeeRow();
                    if(rows.length > 1){ rows.slice(1).remove(); reindexTermin(); }

                    $('#FeeTable th:nth-child(4), #FeeTable td:nth-child(4), #FeeTable th:nth-child(7), #FeeTable td:nth-child(7)').hide();

                    const $row = $('#feeTableBody .fee-row').first();
                    $row.find('.input-nama-kapling').val(getKaplingLabel());
                    $row.find('[name*="[nama_termin]"]').val('Pekerjaan Full Financiering').prop('readonly',true);
                    $row.find('[name*="[persen_pekerjaan]"]').val(100).prop('readonly',true);
                    $row.find('.nilai-termin').prop('readonly',false);
                    $row.find('[name*="[retensi]"]').val(function(_,v){return v||5;});
                    $row.find('[name*="[persen_pembayaran]"]').val('').prop('disabled',true);

                    $('#tambahFeeRow').hide();
                    $('.remove-fee-row').hide();
                }else{
                    const $nom = $('#nominal_perjanjian');
                    $nom.show(); $nom.closest('td, th, div.form-group, div, .col-md-*, .col-*, .input-group').show();
                    // $('#nominal_perjanjian').show().closest('div').show();
                    $('#FeeTable th:nth-child(4), #FeeTable td:nth-child(4), #FeeTable th:nth-child(7), #FeeTable td:nth-child(7)').show();

                    $('#feeTableBody .fee-row').each(function(){
                        $(this).find('[name*="[nama_termin]"]').prop('readonly',true);
                        $(this).find('[name*="[persen_pekerjaan]"]').prop('readonly',false);
                        $(this).find('.nilai-termin').prop('readonly',true);
                        $(this).find('[name*="[retensi]"]').val(function(_,v){return v||5;});
                        $(this).find('[name*="[persen_pembayaran]"]').prop('disabled',false);
                        $(this).find('.input-nama-kapling').val(getKaplingLabel());
                    });

                    $('#tambahFeeRow').show();
                    $('.remove-fee-row').show();
                }
                recalcTotals();
            }

            $('#tambahFeeRow').on('click', function(){ addFeeRow(); updateNamaKaplingAll(); });
            $(document).on('click', '.remove-fee-row', function(){
                $(this).closest('tr').remove();
                reindexTermin();
                recalcTotals();
                updateNamaKaplingAll();
                applyPaymentModeUI();
            });
            $(document).on('input', '.persen-pembayaran', recalcTotals);
            $(document).on('input change', '.nilai-termin', function () {
                if ($('#tipe_pembayaran').val() === 'Full Financiering') recalcTotals();
            });
            $('#nominal_perjanjian').on('input', recalcTotals);
            $('#tipe_pembayaran').on('change', applyPaymentModeUI);

            const tsKap = document.getElementById('kapling')?.tomselect || null;
            if (tsKap) tsKap.on('change', updateNamaKaplingAll);
            else $('#kapling').on('change', updateNamaKaplingAll);

            if (!$('#feeTableBody .fee-row').length) addFeeRow();
            updateNamaKaplingAll();
            applyPaymentModeUI();
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cleaveMap = new WeakMap();
            window.__cleaveMap = cleaveMap;

            function initCleave(el) {
                if (!el || el.classList.contains('cleave-initialized')) return;
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
                el.classList.add('cleave-initialized');
                cleaveMap.set(el, instance);
            }

            window.initCleaveIn = function(container) {
                container.querySelectorAll('input.nilai-perjanjian').forEach(initCleave);
            };

            document.querySelectorAll('input.nilai-perjanjian').forEach(initCleave);

            document.querySelectorAll('form').forEach(function (form) {
                form.addEventListener('submit', function () {
                    form.querySelectorAll('input.nilai-perjanjian').forEach(function (el) {
                        const inst = cleaveMap.get(el);
                        if (inst) el.value = inst.getRawValue();
                    });
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
        const tsTipePembayaran   = new TomSelect('#tipe_pembayaran', {create:false, searchField:['text']});
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
