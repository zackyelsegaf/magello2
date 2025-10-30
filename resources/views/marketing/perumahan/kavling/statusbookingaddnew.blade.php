@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Update Status</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 px-2">
                    <div class="timeline">
                        <div class="timeline-container primary">
                            {{-- <div class="timeline-icon">
                                <i class="fas fa-dot-circle"></i>
                            </div> --}}
                            <div class="card my-rounded-2">
                                <div class="col-12 border col-md-12 px-0 my-rounded-2">
                                    <a href="#" class="d-block text-reset my-rounded-2 tl-link" data-target="panel-pemberkasan">
                                        <div class="d-flex align-items-center flex-nowrap bg-white my-rounded-2 p-3">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-info rounded mr-3 py-4 px-4 text-white">
                                                <div class="timeline-icons">
                                                    <i class="fas fa-book"></i>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="text-dark font-weight-bold text-truncate"><h6>Pemberkasan</h6></div>
                                                @if($detailPemberkasan)
                                                    <h6 class="text-muted font-weight-bold mt-1 d-block">{{ \Illuminate\Support\Carbon::parse($detailPemberkasan->tanggal_pemberkasan)->locale('id')->isoFormat('dddd, D MMMM Y') }}</h6>
                                                @endif
                                            </div>
                                            <div class="w-200">
                                                @if($has0)
                                                    <span class="ml-2 badge badge-{{ $isAktif0 ? 'primary' : 'success' }}">
                                                    {{ $isAktif0 ? 'Status saat ini' : 'Selesai' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-container primary">
                            {{-- <div class="timeline-icon">
                                <i class="fas fa-dot-circle"></i>
                            </div> --}}
                            <div class="card my-rounded-2">
                                <div class="col-12 border col-md-12 px-0 my-rounded-2">
                                    <a href="#" class="d-block text-reset my-rounded-2 tl-link" data-target="panel-proses-ke-bank">
                                        <div class="d-flex align-items-center flex-nowrap bg-white my-rounded-2 p-3">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-info rounded mr-3 py-4 px-4 text-white">
                                                <div class="timeline-icons">
                                                    <i class="fas fa-university"></i>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="text-dark font-weight-bold text-truncate"><h6>Proses Ke Bank</h6></div>
                                                @if($detailProses)
                                                    <h6 class="text-muted font-weight-bold mt-1 d-block">{{ \Illuminate\Support\Carbon::parse($detailProses->tanggal_masuk_bank)->locale('id')->isoFormat('dddd, D MMMM Y') }}</h6>
                                                @endif
                                            </div>
                                            <div class="w-200">
                                                @if($has1)
                                                    <span class="ml-2 badge badge-{{ $isAktif1 ? 'primary' : 'success' }}">
                                                    {{ $isAktif1 ? 'Status saat ini' : 'Selesai' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-container primary">
                            {{-- <div class="timeline-icon">
                                <i class="fas fa-dot-circle"></i>
                            </div> --}}
                            <div class="card my-rounded-2">
                                <div class="col-12 border col-md-12 px-0 my-rounded-2">
                                    <a href="#" class="d-block text-reset my-rounded-2 tl-link" data-target="panel-analisa-bank">
                                        <div class="d-flex align-items-center flex-nowrap bg-white my-rounded-2 p-3">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-info rounded mr-3 py-4 px-4 text-white">
                                                <div class="timeline-icons">
                                                    <i class="fas fa-search"></i>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="text-dark font-weight-bold text-truncate"><h6>Analisa Bank</h6></div>
                                                @if($detailAnalisa)
                                                    <h6 class="text-muted font-weight-bold mt-1 d-block">{{ \Illuminate\Support\Carbon::parse($detailAnalisa->tanggal_masuk_analisa_bank)->locale('id')->isoFormat('dddd, D MMMM Y') }}</h6>
                                                @endif
                                            </div>
                                            <div class="w-200">
                                                @if($has2)
                                                    <span class="ml-2 badge badge-{{ $isAktif2 ? 'primary' : 'success' }}">
                                                    {{ $isAktif2 ? 'Status saat ini' : 'Selesai' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-container primary">
                            {{-- <div class="timeline-icon">
                                <i class="fas fa-dot-circle"></i>
                            </div> --}}
                            <div class="card my-rounded-2">
                                <div class="col-12 border col-md-12 px-0 my-rounded-2">
                                    <a href="#" class="d-block text-reset my-rounded-2 tl-link" data-target="panel-sp3k">
                                        <div class="d-flex align-items-center flex-nowrap bg-white my-rounded-2 p-3">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-info rounded mr-3 py-4 px-4 text-white">
                                                <div class="timeline-icons">
                                                    <i class="fas fa-clipboard-check"></i>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="text-dark font-weight-bold text-truncate"><h6>SP3K</h6></div>
                                                @if($detailSp3k)
                                                    <h6 class="text-muted font-weight-bold mt-1 d-block">{{ \Illuminate\Support\Carbon::parse($detailSp3k->tanggal_sp3k)->locale('id')->isoFormat('dddd, D MMMM Y') }}</h6>
                                                @endif
                                            </div>
                                            <div class="w-200">
                                                @if($has3)
                                                    <span class="ml-2 badge badge-{{ $isAktif3 ? 'primary' : 'success' }}">
                                                    {{ $isAktif3 ? 'Status saat ini' : 'Selesai' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-container primary">
                            {{-- <div class="timeline-icon">
                                <i class="fas fa-dot-circle"></i>
                            </div> --}}
                            <div class="card my-rounded-2">
                                <div class="col-12 border col-md-12 px-0 my-rounded-2">
                                    <a href="#" class="d-block text-reset my-rounded-2 tl-link" data-target="panel-akad-kredit">
                                        <div class="d-flex align-items-center flex-nowrap bg-white my-rounded-2 p-3">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-info rounded mr-3 py-4 px-4 text-white">
                                                <div class="timeline-icons">
                                                    <i class="fas fa-edit"></i>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="text-dark font-weight-bold text-truncate"><h6>Akad Kredit</h6></div>
                                                @if($detailAkad)
                                                    <h6 class="text-muted font-weight-bold mt-1 d-block">{{ \Illuminate\Support\Carbon::parse($detailAkad->tanggal_akad)->locale('id')->isoFormat('dddd, D MMMM Y') }}</h6>
                                                @endif
                                            </div>
                                            <div class="w-200">
                                                @if($has4)
                                                    <span class="ml-2 badge badge-{{ $isAktif4 ? 'primary' : 'success' }}">
                                                    {{ $isAktif4 ? 'Status saat ini' : 'Selesai' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-container primary">
                            {{-- <div class="timeline-icon">
                                <i class="fas fa-dot-circle"></i>
                            </div> --}}
                            <div class="card my-rounded-2">
                                <div class="col-12 border col-md-12 px-0 my-rounded-2">
                                    <a href="#" class="d-block text-reset my-rounded-2 tl-link" data-target="panel-ajb">
                                        <div class="d-flex align-items-center flex-nowrap bg-white my-rounded-2 p-3">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-info rounded mr-3 py-4 px-4 text-white">
                                                <div class="timeline-icons">
                                                    <i class="fas fa-edit"></i>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="text-dark font-weight-bold text-truncate"><h6>AJB (Akad Jual Beli)</h6></div>
                                                @if($detailAjb)
                                                    <h6 class="text-muted font-weight-bold mt-1 d-block">{{ \Illuminate\Support\Carbon::parse($detailAjb->tanggal_ajb)->locale('id')->isoFormat('dddd, D MMMM Y') }}</h6>
                                                @endif
                                            </div>
                                            <div class="w-200">
                                                @if($has5)
                                                    <span class="ml-2 badge badge-{{ $isAktif5 ? 'primary' : 'success' }}">
                                                    {{ $isAktif5 ? 'Status saat ini' : 'Selesai' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-container primary">
                            {{-- <div class="timeline-icon">
                                <i class="fas fa-dot-circle"></i>
                            </div> --}}
                            <div class="card my-rounded-2">
                                <div class="col-12 border col-md-12 px-0 my-rounded-2">
                                    <a href="#" class="d-block text-reset my-rounded-2 tl-link" data-target="panel-ditolak-bank">
                                        <div class="d-flex align-items-center flex-nowrap bg-white my-rounded-2 p-3">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-info rounded mr-3 py-4 px-4 text-white">
                                                <div class="timeline-icons">
                                                    <div class="timeline-icons">
                                                </div>
                                                    <i class="fas fa-times-circle"></i>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="text-dark font-weight-bold text-truncate"><h6>Ditolak Bank</h6></div>
                                                @if($detailDitolakBank)
                                                    <h6 class="text-muted font-weight-bold mt-1 d-block">{{ \Illuminate\Support\Carbon::parse($detailDitolakBank->tanggal_ditolak)->locale('id')->isoFormat('dddd, D MMMM Y') }}</h6>
                                                @endif
                                            </div>
                                            <div class="w-200">
                                                @if($has6)
                                                    <span class="ml-2 badge badge-{{ $isAktif6 ? 'primary' : 'success' }}">
                                                    {{ $isAktif6 ? 'Status saat ini' : 'Selesai' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="timeline-container primary">
                            {{-- <div class="timeline-icon">
                                <i class="fas fa-dot-circle"></i>
                            </div> --}}
                            <div class="card my-rounded-2">
                                <div class="col-12 border col-md-12 px-0 my-rounded-2">
                                    <a href="#" class="d-block text-reset my-rounded-2 tl-link" data-target="panel-mundur">
                                        <div class="d-flex align-items-center flex-nowrap bg-white my-rounded-2 p-3">
                                            <div class="d-inline-flex align-items-center justify-content-center bg-info rounded mr-3 py-4 px-4 text-white">
                                                <div class="timeline-icons">
                                                    <i class="fas fa-hiking"></i>
                                                </div>
                                            </div>
                                            <div class="w-100">
                                                <div class="text-dark font-weight-bold text-truncate"><h6>Mundur</h6></div>
                                                @if($detailMundur)
                                                    <h6 class="text-muted font-weight-bold mt-1 d-block">{{ \Illuminate\Support\Carbon::parse($detailMundur->tanggal_mundur)->locale('id')->isoFormat('dddd, D MMMM Y') }}</h6>
                                                @endif
                                            </div>
                                            <div class="w-200">
                                                @if($has7)
                                                    <span class="ml-2 badge badge-{{ $isAktif7 ? 'primary' : 'success' }}">
                                                    {{ $isAktif7 ? 'Status saat ini' : 'Selesai' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 px-2">
                    <div class="timeline-2">
                        <div class="row-cols-1">
                            <form method="POST" action="{{ route('booking.status-update.pemberkasan.store', $booking) }}">
                                @csrf
                                <div class="col px-0 mb-3 timeline-panel" id="panel-pemberkasan">
                                    <div class="timeline-container primary">
                                        {{-- <div class="timeline-icon mr-2">
                                            <i class="fas fa-book text-white"></i>
                                        </div> --}}
                                        <h3 class="font-weight-bold mb-3">Pemberkasan</h3>
                                        <div class="border bg-white my-rounded-2 p-3">
                                            <div class="form-group mb-2">
                                                <label class="d-flex align-items-center"><span>Tanggal Pemberkasan</span></label>
                                                <input type="text" name="tanggal_pemberkasan" class="form-control form-control-sm datetimepicker @error('tanggal_pemberkasan') is-invalid @enderror" value="{{ old('tanggal_pemberkasan', $tanggalPemberkasan ?? '') }}">
                                                @error('tanggal_pemberkasan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Catatan</label>
                                                <textarea name="catatan_pemberkasan" rows="2" class="form-control @error('catatan_pemberkasan') is-invalid @enderror">{{ old('catatan_pemberkasan', $detailPemberkasan->catatan_pemberkasan ?? '') }}</textarea>
                                                @error('catatan_pemberkasan')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="text-right pt-1 pb-5">
                                                <button type="submit" class="btn btn-primary buttonedit4 btn-remove ml-2" name="action" value="save">
                                                    <strong><i class="fas fa-save mr-2"></i>Simpan Data</strong>
                                                </button>
                                                <button type="submit" class="btn btn-outline-primary buttonedit5 text-dark btn-remove" name="action" value="set">
                                                    <strong><i class="fas fa-cog mr-2"></i>Set Status</strong>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('booking.status-update.proses.store', $booking) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col px-0 mb-3 timeline-panel" id="panel-proses-ke-bank">
                                    <div class="timeline-container warning-custom">
                                        {{-- <div class="timeline-icon">
                                            <i class="fas fa-university text-white"></i>
                                        </div> --}}
                                        <h3 class="font-weight-bold mb-3">Proses ke Bank</h3>
                                        <div class="border bg-white my-rounded-2 p-3">
                                            <div class="form-group mb-2">
                                                <label>Tanggal Masuk Proses Bank</label>
                                                <input type="text" name="tanggal_masuk_bank" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_masuk_bank', $tanggalProses ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Nama Bank</label>
                                                <input type="text" name="nama_bank_proses" class="form-control form-control-sm" value="{{  old('nama_bank_proses', $detailProses->nama_bank_proses ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Catatan</label>
                                                <textarea name="catatan_proses" rows="2" class="form-control">{{ old('catatan_proses', $detailProses->catatan_proses ?? '') }}</textarea>
                                            </div>
                                            <div class="text-right pt-1 pb-5">
                                                <button type="submit" class="btn btn-primary buttonedit4 btn-remove ml-2" name="action" value="save">
                                                    <strong><i class="fas fa-save mr-3"></i>Simpan Data</strong>
                                                </button>
                                                <button type="submit" class="btn btn-primary buttonedit5 text-dark btn-remove" name="action" value="set">
                                                    <strong><i class="fas fa-cog mr-3"></i>Set Status</strong>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('booking.status-update.analisa.store', $booking->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col px-0 mb-3 timeline-panel" id="panel-analisa-bank">
                                    <div class="timeline-container warning-custom">
                                        {{-- <div class="timeline-icon">
                                            <i class="fas fa-search text-white"></i>
                                        </div> --}}
                                        <h3 class="font-weight-bold mb-3">Analisa Bank</h3>
                                        <div class="border bg-white my-rounded-2 p-3">
                                            <div class="form-group mb-2">
                                                <label>Tanggal Masuk Analisa Bank</label>
                                                <input type="text" name="tanggal_masuk_analisa_bank" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_masuk_analisa_bank', $tanggalAnalisa ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Nama Bank</label>
                                                <input type="text" name="nama_bank_analisa" class="form-control form-control-sm" value="{{ old('nama_bank_analisa', $detailAnalisa->nama_bank_analisa ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Catatan</label>
                                                <textarea name="catatan_analisa" rows="2" class="form-control">{{ old('catatan_analisa', $detailAnalisa->catatan_analisa ?? '') }}</textarea>
                                            </div>
                                            <div class="text-right pt-1 pb-5">
                                                <button type="submit" class="btn btn-primary buttonedit4 btn-remove ml-2" name="action" value="save">
                                                    <strong><i class="fas fa-save mr-3"></i>Simpan Data</strong>
                                                </button>
                                                <button type="submit" class="btn btn-primary buttonedit5 text-dark btn-remove" name="action" value="set">
                                                    <strong><i class="fas fa-cog mr-3"></i>Set Status</strong>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('booking.status-update.sp3k.store', $booking->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col px-0 mb-3 timeline-panel" id="panel-sp3k">
                                    <div class="timeline-container success-custom">
                                        {{-- <div class="timeline-icon">
                                            <i class="fas fa-clipboard-check text-white"></i>
                                        </div> --}}
                                        <h3 class="font-weight-bold mb-3">SP3K</h3>
                                        <div class="border bg-white my-rounded-2 p-3">
                                            <div class="form-group mb-2">
                                                <label>Nomor SP3K</label>
                                                <input type="text" name="nomor_sp3k" class="form-control form-control-sm" value="{{ old('nomor_sp3k', $detailSp3k->nomor_sp3k ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Tanggal SP3K</label>
                                                <input type="text" name="tanggal_sp3k" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_sp3k', $tanggalSp3k ?? '') }}">
                                            </div>
                                            {{-- <div class="form-group mb-2">
                                                <label>Upload File SP3K</label>
                                                <div class="custom-file">
                                                    <input type="file" name="file_sp3k"
                                                        class="custom-file-input" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                    <label class="custom-file-label">Pilih File</label>
                                                </div>
                                                <small class="d-block mt-1">
                                                    File lama:<a class="btn btn-primary buttonedit4" href="" target="_blank"><strong><i class="fas fa-file mr-2 ml-1"></i></strong>Download File</a>
                                                </small>
                                            </div> --}}
                                            <div class="form-group mb-2">
                                                @if($arsip0 && $arsip0->isNotEmpty())
                                                    @foreach($arsip0 as $a)
                                                        <div class="form-group mb-5">
                                                            @if($a['file_url'])
                                                                <label>File Arsip</label>
                                                                <small class="d-block mt-1">
                                                                    <a class="btn btn-primary buttonedit-sm mr-2" href="{{ $a['file_url'] }}" target="_blank"><strong><i class="fas fa-file mr-2"></i></strong>Download File{{-- $a['original_name'] ?? 'lihat' --}}</a>
                                                                    <a href="{{ route('booking/file/delete', $a['id']) }}" class="btn btn-primary buttonedit2-sm"><i class="fas fa-trash-alt mr-2"></i>Hapus</a>
                                                                </small>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="form-group mb-2">
                                                        <label for="file_sp3k">File Arsip</label>
                                                        <div class="custom-file">
                                                            <input type="file" id="file_sp3k" name="file_sp3k" class="custom-file-input" value="{{ old('file_sp3k', $detailSp3k->file_sp3k ?? '')  }}" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <div class="alert alert-info mt-2" role="alert">
                                                        <i class="fas fa-info mr-2"></i>Tidak ada file yang diunggah.
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Plafond Acc</label>
                                                <input type="text" name="plafond_sp3k" class="form-control form-control-sm rupiah" value="{{ old('plafond_sp3k', $detailSp3k->plafond_sp3k ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Cicilan per Bulan</label>
                                                <input type="text" name="cicilan_sp3k" class="form-control form-control-sm rupiah" value="{{ old('cicilan_sp3k', $detailSp3k->cicilan_sp3k ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Tenor</label>
                                                <input type="text" name="tenor_sp3k" class="form-control form-control-sm" value="{{ old('tenor_sp3k', $detailSp3k->tenor_sp3k ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Bank</label>
                                                <input type="text" name="bank_sp3k" class="form-control form-control-sm" value="{{ old('bank_sp3k', $detailSp3k->bank_sp3k ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Program Subsidi</label>
                                                <input type="text" name="program_subsidi" class="form-control form-control-sm" value="{{ old('program_subsidi', $detailSp3k->program_subsidi ?? '') }}">
                                            </div>
                                            <div class="text-right pt-1 pb-5">
                                                <button type="submit" class="btn btn-primary buttonedit4 btn-remove ml-2" name="action" value="save">
                                                    <strong><i class="fas fa-save mr-3"></i>Simpan Data</strong>
                                                </button>
                                                <button type="submit" class="btn btn-primary buttonedit5 text-dark btn-remove" name="action" value="set">
                                                    <strong><i class="fas fa-cog mr-3"></i>Set Status</strong>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('booking.status-update.akad.store', $booking->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col px-0 mb-3 timeline-panel" id="panel-akad-kredit">
                                    <div class="timeline-container success-custom">
                                        {{-- <div class="timeline-icon">
                                            <i class="fas fa-edit text-white"></i>
                                        </div> --}}
                                        <h3 class="font-weight-bold mb-3">Akad Kredit</h3>
                                        <div class="border bg-white my-rounded-2 p-3">
                                            <div class="form-group mb-2">
                                                <label>Tanggal Akad</label>
                                                <input type="text" name="tanggal_akad" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_akad', $tanggalAkad  ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Bank</label>
                                                <input type="text" name="nama_akad" class="form-control form-control-sm" value="{{ old('nama_akad', $detailAkad->nama_akad  ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Plafond Acc</label>
                                                <input type="text" name="plafond_akad" class="form-control form-control-sm rupiah" value="{{ old('plafond_akad', $detailAkad->plafond_akad  ?? '') }}">
                                            </div>
                                            <div class="text-right pt-1 pb-5">
                                                <button type="submit" class="btn btn-primary buttonedit4 btn-remove ml-2" name="action" value="save">
                                                    <strong><i class="fas fa-save mr-3"></i>Simpan Data</strong>
                                                </button>
                                                <button type="submit" class="btn btn-primary buttonedit5 text-dark btn-remove" name="action" value="set">
                                                    <strong><i class="fas fa-cog mr-3"></i>Set Status</strong>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('booking.status-update.ajb.store', $booking->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col px-0 mb-3 timeline-panel" id="panel-ajb">
                                    <div class="timeline-container success-custom">
                                        {{-- <div class="timeline-icon">
                                            <i class="fas fa-edit text-white"></i>
                                        </div> --}}
                                        <h3 class="font-weight-bold mb-3">AJB (Akad Jual Beli)</h3>
                                        <div class="border bg-white my-rounded-2 p-3">
                                            <div class="form-group mb-2">
                                                <label>Tanggal AJB</label>
                                                <input type="text" name="tanggal_ajb" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_ajb', $tanggalAjb ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Catatan</label>
                                                <textarea name="catatan_ajb" rows="2" class="form-control">{{  old('catatan_ajb', $detailAjb->catatan_ajb ?? '') }}</textarea>
                                            </div>
                                            <div class="text-right pt-1 pb-5">
                                                <button type="submit" class="btn btn-primary buttonedit4 btn-remove ml-2" name="action" value="save">
                                                    <strong><i class="fas fa-save mr-3"></i>Simpan Data</strong>
                                                </button>
                                                <button type="submit" class="btn btn-primary buttonedit5 text-dark btn-remove" name="action" value="set">
                                                    <strong><i class="fas fa-cog mr-3"></i>Set Status</strong>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('booking.status-update.ditolak.store', ['booking' => $booking->id]) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col px-0 mb-3 timeline-panel" id="panel-ditolak-bank">
                                    <div class="timeline-container danger-custom">
                                        {{-- <div class="timeline-icon">
                                            <i class="fas fa-times-circle text-white"></i>
                                        </div> --}}
                                        <h3 class="font-weight-bold mb-3">Ditolak Bank</h3>
                                        <div class="border bg-white my-rounded-2 p-3">
                                            <div class="form-group mb-2">
                                                <label>Tanggal Ditolak</label>
                                                <input type="text" name="tanggal_ditolak" class="form-control form-control-sm datetimepicker" value="">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Alasan Penolakan</label>
                                                <textarea name="alasan_ditolak" rows="2" class="form-control"></textarea>
                                            </div>
                                            <div class="form-group mb-2">
                                                @if($arsip1 && $arsip1->isNotEmpty())
                                                    @foreach($arsip as $a)
                                                        <div class="form-group mb-5">
                                                            @if($a['file_url'])
                                                                <label>File Arsip</label>
                                                                <small class="d-block mt-1">
                                                                    <a class="btn btn-primary buttonedit-sm mr-2" href="{{ $a['file_url'] }}" target="_blank"><strong><i class="fas fa-file mr-2"></i></strong>Download File{{-- $a['original_name'] ?? 'lihat' --}}</a>
                                                                    <a href="{{ route('booking/file/delete', $a['id']) }}" class="btn btn-primary buttonedit2-sm"><i class="fas fa-trash-alt mr-2"></i>Hapus</a>
                                                                </small>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                @else
                                                    <div class="form-group mb-2">
                                                        <label for="file_ditolak">File Arsip</label>
                                                        <div class="custom-file">
                                                            <input type="file" id="file_ditolak" name="file_ditolak" class="custom-file-input" value="{{ old('file_ditolak', $detailDitolakBank->file_ditolak ?? '')  }}" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx">
                                                            <label class="custom-file-label">Pilih File</label>
                                                        </div>
                                                    </div>
                                                    <div class="alert alert-info mt-2" role="alert">
                                                        <i class="fas fa-info mr-2"></i>Tidak ada file yang diunggah.
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="text-right pt-1 pb-5">
                                                <button type="submit" class="btn btn-primary buttonedit4 btn-remove ml-2" name="action" value="save">
                                                    <strong><i class="fas fa-save mr-3"></i>Simpan Data</strong>
                                                </button>
                                                <button type="submit" class="btn btn-primary buttonedit5 text-dark btn-remove" name="action" value="set">
                                                    <strong><i class="fas fa-cog mr-3"></i>Set Status</strong>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <form method="POST" action="{{ route('booking.status-update.mundur.store', $booking->id) }}" enctype="multipart/form-data">
                                @csrf
                                <div class="col px-0 mb-3 timeline-panel" id="panel-mundur">
                                    <div class="timeline-container info">
                                        {{-- <div class="timeline-icon">
                                            <i class="fas fa-hiking text-white"></i>
                                        </div> --}}
                                        <h3 class="font-weight-bold mb-3">Mundur</h3>
                                        <div class="border bg-white my-rounded-2 p-3">
                                            <div class="form-group mb-2">
                                                <label>Tanggal Mundur</label>
                                                <input type="text" name="tanggal_mundur" class="form-control form-control-sm datetimepicker" value="{{ old('tanggal_mundur', $tanggalMundur ?? '') }}">
                                            </div>
                                            <div class="form-group mb-2">
                                                <label>Alasan Mundur</label>
                                                <textarea name="alasan_mundur" rows="2" class="form-control">{{ old('alasan_mundur', $detailMundur->alasan_mundur ?? '') }}</textarea>
                                            </div>
                                            <div class="text-right pt-1 pb-5">
                                                <button type="submit" class="btn btn-primary buttonedit4 btn-remove ml-2" name="action" value="save">
                                                    <strong><i class="fas fa-save mr-3"></i>Simpan Data</strong>
                                                </button>
                                                <button type="submit" class="btn btn-primary buttonedit5 text-dark btn-remove" name="action" value="set">
                                                    <strong><i class="fas fa-cog mr-3"></i>Set Status</strong>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="mb-4 row align-items-center">
                                <div class="col">
                                    <a href="{{ route('booking/list/page') }}" class="btn btn-primary mr-2 buttonedit">
                                        <i class="fas fa-chevron-left mr-2"></i> kembali
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @section('script')
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
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
                container.querySelectorAll('input.rupiah').forEach(initCleave);
            };

            document.querySelectorAll('input.rupiah').forEach(initCleave);

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
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const metodePembayaranSelect = document.getElementById('metode_pembayaran_id');
            const biayaKonsumen_1 = document.getElementById('biaya_konsumen_1');
            const bK_0 = document.getElementById('bk_0');
            const bK_1 = document.getElementById('bk_1');
            const bK_3 = document.getElementById('bk_3');
            const bK_4 = document.getElementById('bk_4');
            const bK_5 = document.getElementById('bk_5');
            const bK_6 = document.getElementById('bk_6');
            const bK_7 = document.getElementById('bk_7');
            const bK_8 = document.getElementById('bk_8');
            const bK_2 = document.getElementById('bk_2');
            const bK_9 = document.getElementById('bk_9');
            const bK_10 = document.getElementById('bk_10');
            const dokumen_1 = document.getElementById('dokumen_1');
            const dK_0 = document.getElementById('dk_0');
            const dK_1 = document.getElementById('dk_1');
            const dK_2 = document.getElementById('dk_2');
            const dokumen_2 = document.getElementById('dokumen_2');
            const dK_3 = document.getElementById('dk_3');
            const dK_4 = document.getElementById('dk_4');
            const dokumen_3 = document.getElementById('dokumen_3');
            const dK_5 = document.getElementById('dk_5');
            const dK_6 = document.getElementById('dk_6');
            const dokumen_4 = document.getElementById('dokumen_4');
            const dK_7 = document.getElementById('dk_7');
            const dK_8 = document.getElementById('dk_8');
            const dokumen_5 = document.getElementById('dokumen_5');
            const dK_9 = document.getElementById('dk_9');
            const dK_10 = document.getElementById('dk_10');
            const dokumen_6 = document.getElementById('dokumen_6');
            const dK_11 = document.getElementById('dk_11');
            const dK_12 = document.getElementById('dk_12');

            function toggleFields() {
                const selectedValue = metodePembayaranSelect.value;

                if (selectedValue === 'Cash Keras') {
                    biayaKonsumen_1.style.display = '';
                    bK_0.style.display = '';
                    bK_1.style.display = '';
                    bK_3.style.display = 'none';
                    bK_4.style.display = '';
                    bK_5.style.display = '';
                    bK_6.style.display = '';
                    bK_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_2.style.display = '';
                    bK_9.style.display = '';
                    bK_10.style.display = 'none';
                    dokumen_1.style.display = '';
                        dK_0.style.display = 'none';
                        dK_1.style.display = '';
                        dK_2.style.display = '';
                    dokumen_2.style.display = '';
                        dK_3.style.display = '';
                        dK_4.style.display = '';
                    dokumen_3.style.display = 'none';
                        dK_5.style.display = 'none';
                        dK_6.style.display = 'none';
                    dokumen_4.style.display = 'none';
                        dK_7.style.display = 'none';
                        dK_8.style.display = 'none';
                    dokumen_5.style.display = 'none';
                        dK_9.style.display = 'none';
                        dK_10.style.display = 'none';
                    dokumen_6.style.display = 'none';
                        dK_11.style.display = 'none';
                        dK_12.style.display = 'none';
                } else if (selectedValue === 'Cash Bertahap') {
                    biayaKonsumen_1.style.display = '';
                    bK_0.style.display = '';
                    bK_1.style.display = '';
                    bK_3.style.display = 'none';
                    bK_4.style.display = '';
                    bK_5.style.display = '';
                    bK_6.style.display = '';
                    bK_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_2.style.display = '';
                    bK_9.style.display = 'none';
                    bK_10.style.display = '';
                    dokumen_1.style.display = '';
                        dK_0.style.display = 'none';
                        dK_1.style.display = '';
                        dK_2.style.display = '';
                    dokumen_2.style.display = '';
                        dK_3.style.display = '';
                        dK_4.style.display = '';
                    dokumen_3.style.display = 'none';
                        dK_5.style.display = 'none';
                        dK_6.style.display = 'none';
                    dokumen_4.style.display = 'none';
                        dK_7.style.display = 'none';
                        dK_8.style.display = 'none';
                    dokumen_5.style.display = 'none';
                        dK_9.style.display = 'none';
                        dK_10.style.display = 'none';
                    dokumen_6.style.display = 'none';
                        dK_11.style.display = 'none';
                        dK_12.style.display = 'none';
                } else if (selectedValue === 'KPR') {
                    biayaKonsumen_1.style.display = '';
                    bK_0.style.display = '';
                    bK_1.style.display = '';
                    bK_2.style.display = 'none';
                    bK_3.style.display = '';
                    bK_4.style.display = '';
                    bK_5.style.display = '';
                    bK_6.style.display = '';
                    bK_7.style.display = '';
                    bK_8.style.display = '';
                    bK_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    dokumen_1.style.display = '';
                        dK_0.style.display = '';
                        dK_1.style.display = 'none';
                        dK_2.style.display = '';
                    dokumen_2.style.display = '';
                        dK_3.style.display = '';
                        dK_4.style.display = '';
                    dokumen_3.style.display = '';
                        dK_5.style.display = '';
                        dK_6.style.display = '';
                    dokumen_4.style.display = '';
                        dK_7.style.display = '';
                        dK_8.style.display = '';
                    dokumen_5.style.display = '';
                        dK_9.style.display = '';
                        dK_10.style.display = '';
                    dokumen_6.style.display = '';
                        dK_11.style.display = '';
                        dK_12.style.display = '';
                } else {
                    biayaKonsumen_1.style.display = 'none';
                    bK_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    dokumen_1.style.display = 'none';
                        dK_0.style.display = 'none';
                        dK_1.style.display = 'none';
                        dK_2.style.display = 'none';
                    dokumen_2.style.display = 'none';
                        dK_3.style.display = 'none';
                        dK_4.style.display = 'none';
                    dokumen_3.style.display = 'none';
                        dK_5.style.display = 'none';
                        dK_6.style.display = 'none';
                    dokumen_4.style.display = 'none';
                        dK_7.style.display = 'none';
                        dK_8.style.display = 'none';
                    dokumen_5.style.display = 'none';
                        dK_9.style.display = 'none';
                        dK_10.style.display = 'none';
                    dokumen_6.style.display = 'none';
                        dK_11.style.display = 'none';
                        dK_12.style.display = 'none';
                }
            }
            metodePembayaranSelect.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var tlLinks = document.querySelectorAll('.tl-link');
            var panels  = document.querySelectorAll('.timeline-panel');

            function showPanel(panelId, clickedLink) {

                panels.forEach(function (p) { p.classList.add('d-none'); });

                var target = document.getElementById(panelId);
                if (target) target.classList.remove('d-none');

                document.querySelectorAll('.timeline .card').forEach(function(card){
                card.classList.remove('border', 'border-primary');
                });
                var card = clickedLink.closest('.card');
                if (card) card.classList.add('border', 'border-primary');
            }

            // Set default aktif = Pemberkasan saat load
            showPanel('panel-pemberkasan', document.querySelector('.tl-link[data-target="panel-pemberkasan"]') || document.body);

            tlLinks.forEach(function (a) {
                a.addEventListener('click', function (e) {
                e.preventDefault();
                var targetId = a.getAttribute('data-target');
                if (targetId) showPanel(targetId, a);
                });
            });
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
                container.querySelectorAll('input.rupiah').forEach(initCleave);
            };

            document.querySelectorAll('input.rupiah').forEach(initCleave);

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
@endsection
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
@endsection
