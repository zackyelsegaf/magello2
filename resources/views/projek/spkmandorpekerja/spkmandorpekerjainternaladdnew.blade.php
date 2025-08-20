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
                        <form action="">
                            @csrf
                            <div class="modal-body">
                                <div class="form-group mb-1">
                                    <label for="nama_pekerja" class="form-label fw-bold">Nama</label>
                                    <input type="text" name="nama_pekerja" id="nama_pekerja"
                                        class="form-control form-control-sm" placeholder="Nama">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="alamat_pekerja" class="form-label fw-bold">Alamat</label>
                                    <input type="text" name="alamat_pekerja" id="alamat_pekerja"
                                        class="form-control form-control-sm" placeholder="Alamat">
                                </div>
                                <div class="form-group mb-1">
                                    <label for="telepon_pekerja" class="form-label fw-bold">Nomor Telepon</label>
                                    <input type="number" name="telepon_pekerja" id="telepon_pekerja"
                                        class="form-control form-control-sm" placeholder="Nomor Telepon">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button id="tambahPekerja" type="button" class="btn btn-primary"><i
                                        class="fas fa-save mr-2"></i>
                                    Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('spkmandorpekerja/list/page') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="nomor_pengajuan" class="form-label fw-bold">Nomor</label>
                        <input type="text" id="nomor_pengajuan" name="nomor_pengajuan" class="form-control"
                            value="{{ old('nomor_pengajuan') }}" placeholder="Nomor Pengajuan">
                    </div>

                    <div class="col-md-4">
                        <label for="pekerja" class="form-label fw-bold">Pekerja</label>
                        <select class="form-control @error('pekerja') is-invalid @enderror" name="pekerja" id="pekerja">
                            <option value="">-- Pekerja --</option>
                        </select>
                    </div>

                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-primary buttonedit" data-toggle="modal"
                            data-target="#modalPekerja">
                            <strong><i class="fa-regular fa-user mr-2 ml-1"></i>Tambah Pekerja</strong>
                        </button>
                    </div>

                    <div class="col-md-4">
                        <label for="judul" class="form-label fw-bold">Judul</label>
                        <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul') }}"
                            placeholder="Judul">
                    </div>

                    <div class="col-md-4">
                        <label for="tanggal_mulai" class="form-label fw-bold">Tanggal Mulai</label>
                        <input type="text" id="tanggal_mulai" name="tanggal_mulai" class="form-control datetimepicker"
                            value="{{ old('tanggal_mulai') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="lama_pengerjaan" class="form-label fw-bold">Lama Pengerjaan (hari)</label>
                        <input type="number" id="lama_pengerjaan" name="lama_pengerjaan" class="form-control"
                            value="{{ old('lama_pengerjaan') }}" placeholder="Durasi">
                    </div>

                    <div class="col-md-4">
                        <label for="tanggal_spk" class="form-label fw-bold">Tanggal SPK</label>
                        <input type="text" id="tanggal_spk" name="tanggal_spk" class="form-control datetimepicker"
                            value="{{ old('tanggal_spk') }}">
                    </div>

                    <div class="col-md-4">
                        <label for="siklus_pembayaran" class="form-label fw-bold">Siklus Pembayaran</label>
                        <select class="form-control @error('siklus_pembayaran') is-invalid @enderror" name="siklus_pembayaran" id="siklus_pembayaran">
                            <option value="">-- Siklus Pembayaran --</option>
                            <option value="Harian" {{ old('siklus_pembayaran') == 'Harian' ? 'selected' : '' }}>Harian</option>
                            <option value="Mingguan" {{ old('siklus_pembayaran') == 'Mingguan' ? 'selected' : '' }}>Mingguan</option>
                            <option value="2 Mingguan" {{ old('siklus_pembayaran') == '2 Mingguan' ? 'selected' : '' }}>2 Mingguan</option>
                            <option value="3 Mingguan" {{ old('siklus_pembayaran') == '3 Mingguan' ? 'selected' : '' }}>3 Mingguan</option>
                            <option value="Bulanan" {{ old('siklus_pembayaran') == 'Bulanan' ? 'selected' : '' }}>Bulanan</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label for="surat_perintah" class="form-label fw-bold">Surat Perintah Pembangunan</label>
                        <select class="form-control @error('surat_perintah') is-invalid @enderror"
                            name="surat_perintah" id="surat_perintah">
                            <option value="">-- Surat Perintah Pembangunan --</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="Kapling" class="form-label">Kapling</label>
                        <input type="text" id="Kapling" name="Kapling" class="form-control"
                            rows="2">{{ old('Kapling') }}</input>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Lampiran</label>
                            <input type="text" class="form-control form-control-sm " name="fileupload_1"
                                placeholder="Link dokumen Anda" value="{{ old('fileupload_1') }}">
                            @error('fileupload_1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
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

                                                <!-- Kapling -->
                                                <div class="form-group mb-1">
                                                    <label for="kapling" class="form-label fw-bold">Kapling</label>
                                                    <select name="kapling" id="kapling" class="form-control form-control-sm">
                                                        <option value="">-- Pilih Kapling --</option>
                                                    </select>
                                                </div>

                                                <!-- Pekerjaan -->
                                                <div class="form-group mb-1">
                                                    <label for="pekerjaan" class="form-label fw-bold">Pekerjaan</label>
                                                    <input type="text" name="pekerjaan" id="pekerjaan" class="form-control form-control-sm" placeholder="Pekerjaan">
                                                </div>

                                                <!-- Upah -->
                                                <div class="form-group mb-1">
                                                    <label for="upah" class="form-label fw-bold">Upah</label>
                                                    <input type="number" name="upah" id="upah" class="form-control form-control-sm" placeholder="Upah">
                                                </div>

                                                <!-- Retensi -->
                                                <div class="form-group mb-1">
                                                    <label for="retensi" class="form-label fw-bold">Retensi (%)</label>
                                                    <input type="number" name="retensi" id="retensi" class="form-control form-control-sm" placeholder="Retensi (%)">
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
                                            <button type="button" class="btn btn-primary buttonedit mb-3"
                                                data-toggle="modal" data-target="#modal">
                                                <strong><i class="fas fa-cube mr-2 ml-1"></i>Tambah</strong>
                                            </button>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-center">
                                                    <p class="font-weight-bold mb-0 h5">LIST FEE</p>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-12 mr-1">
                                                <div class="text-center">
                                                    <p class="font-weight-light">Silahkan masukkan poin - poin RAP & RAB</p>
                                                </div>
                                            </div> --}}
                                        </div>

                                        <div class="table-responsive">
                                            <table
                                                class="table table-striped table-bordered table-hover table-center mb-0">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Kapling</th>
                                                        <th>Pekerjaan </th>
                                                        <th>Upah</th>
                                                        <th>Retensi (%)</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="TableBody"></tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="dokumen" class="tab-pane fade">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="editor" style="height: 200px;"></div>
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
    <script>
    ClassicEditor.create(document.querySelector('#editor'), {
        toolbar: [
            'heading','|','bold','italic','underline','link',
            'bulletedList','numberedList','|',
            'blockQuote','insertTable','imageUpload','mediaEmbed','|',
            'undo','redo','codeBlock'
        ]
    }).catch(console.error);
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tambahBtn = document.getElementById('tambahTerpilih');
            const tambahPekerjaBtn = document.getElementById('tambahPekerja');
            const tableBody = document.getElementById('TableBody');

            tambahPekerjaBtn.addEventListener('click', function() {
                const nama = document.getElementById('nama_pekerja').value;
                const alamat = document.getElementById('alamat_pekerja').value;
                const telepon = document.getElementById('telepon_pekerja').value;

                ['nama_pekerja', 'alamat_pekerja', 'telepon_pekerja'].forEach(id => {
                    document.getElementById(id).value = '';
                });
                $('#modalPekerja').modal('hide');

            })
            // data tabel
            tambahBtn.addEventListener('click', function() {
                const kapling = document.getElementById('kapling').value;
                const pekerjaan = document.getElementById('pekerjaan').value;
                const upah = document.getElementById('upah').value;
                const retensi = document.getElementById('retensi').value;

                // Bikin baris baru
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td><input type="text" name="kapling[]" value="${kapling}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="pekerjaan[]" value="${pekerjaan}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="upah[]" value="${upah}" class="form-control form-control-sm" readonly></td>
                    <td><input type="text" name="retensi[]" value="${retensi}" class="form-control form-control-sm" readonly></td>
                    <td>
                        <button type="button" style="width: 120px;" class="btn btn-primary buttonedit2 mr-2 remove-row">
                            <strong><i class="fas fa-trash-alt mr-3"></i>Hapus</strong>
                        </button>
                    </td>
                `;

                tableBody.appendChild(row);

                // Reset input modal
                ['kapling', 'pekerjaan', 'upah', 'retensi'].forEach(id => {
                    document.getElementById(id).value = '';
                });

                // Tutup modal
                $('#modal').modal('hide');
            });

            // Event hapus baris
            tableBody.addEventListener('click', function(e) {
                if (e.target.closest('.remove-row')) {
                    e.target.closest('tr').remove();
                }
            });
        });
    </script>
@endsection
@endsection
