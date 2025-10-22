<div class="page-wrapper">
    <div class="content container-fluid">
        <form wire:submit.prevent='save'>
            <div class="page-header mt-5">
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="page-title mb-3">{{ isset($pembayaranId) ? 'Edit' : 'Tambah' }} Pembayaran Lainnya</h3>
                    </div>
                    <div class="col-sm-6 text-right">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input mt-2" wire:model="mata_uang_asing" value="1" id="mataUangAsing" @checked($mata_uang_asing)>
                            <label class="form-check-label mr-4" for="mataUangAsing">Mata Uang Asing</label>
                            <div class="input-group input-group-sm d-inline-block" style="width: 200px">
                                <select name="" id="" class="form-control w-100">
                                    <option value="">Salin Transaksi</option>
                                    <option value="">Simpan Transaksi</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6 d-none d-xl-block"></div>
                    <div class="col-sm-6 col-lg-3 col-xl-2">
                        <label for="inputGmp1" class="form-label mb-1">No. Pembayaran</label>
                        <div class="input-group input-group-sm">
                            <input wire:model='no_pembayaran' type="text" class="form-control" placeholder="Ketik sesuatu..." readonly>
                            <button class="btn btn-outline-secondary btn-sm" type="button" wire:click='refreshKode()'>
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            @foreach ($errors->get('no_pembayaran') as $err)
                                <div class="invalid-feedback">{{ $err }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-xl-2">
                        <label for="inputGmp2" class="form-label mb-1">Tanggal Pembayaran</label>
                        <div class="input-group input-group-sm">
                            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" wire:model="tanggal">
                            @foreach ($errors->get('tanggal') as $err)
                                <div class="invalid-feedback">{{ $err }}</div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3 col-xl-2">
                        <label for="rancangan" class="form-label mb-1">Rancangan</label>
                        <div class="input-group input-group-sm">
                            <select wire:model="rancangan" id="rancangan" class="form-control">
                                <option value="Pembayaran Lainnya">PBL/Pembayaran Lainnya</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content profile-tab-cont">
                <div class="profile-menu">
                    <ul class="nav nav-tabs nav-tabs-solid">
                        <li class="nav-item"> 
                            <a class="nav-link @if($activeTab == 'detail') active @endif" data-toggle="tab" href="#detail">Rincian Akun</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link @if($activeTab == 'dokumen') active @endif" data-toggle="tab" href="#dokumen">Dokumen</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link @if($activeTab == 'catatan_pemeriksaan') active @endif" data-toggle="tab" href="#catatan_pemeriksaan">Rincian Catatan Pemeriksaan</a> 
                        </li>
                    </ul>
                </div>
                <div id="detail" class="tab-pane fade @if($activeTab == 'detail') show active @endif">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-xl-6">
                                    <div class="form-group">
                                        <label>Dibayar Dari</label>
                                        <select wire:model='dibayar_dari_akun_id' class="form-control @error('dibayar_dari_akun_id') is-invalid @enderror">
                                            <option value="">-- Pilih --</option>
                                            @foreach ($akun as $d)
                                                <option value="{{ $d->id }}">{{ $d->nama_akun_indonesia }}</option>
                                            @endforeach
                                        </select>
                                        @foreach ($errors->get('dibayar_dari_akun_id') as $err)
                                            <div class="invalid-feedback">{{ $err }}</div>
                                        @endforeach
                                    </div>
                                    <div class="form-group">
                                        <label>Dibayar Ke</label>
                                        <textarea wire:model="dibayar_ke" id="" cols="30" rows="10" class="form-control"></textarea>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3 col-xl-2">
                                    <label for="inputGmp1" class="form-label mb-1">Nilai Tukar</label>
                                    <div class="input-group input-group-sm">
                                        <input wire:model='nilai_tukar' type="text" class="form-control" readonly>
                                        @foreach ($errors->get('nilai_tukar') as $err)
                                            <div class="invalid-feedback">{{ $err }}</div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3 col-xl-2">
                                    <label for="no_penawaran" class="form-label mb-1">No. Cek</label>
                                    <div class="input-group input-group-sm">
                                        <input id="no_penawaran" wire:model="no_cek" type="text" class="form-control" placeholder="Input No. Cek">
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-3 col-xl-2">
                                    <label for="rancangan" class="form-label mb-1">Jumlah</label>
                                    <div class="input-group input-group-sm">
                                        <input id="jumlah" wire:model="jumlah" type="number" class="form-control" placeholder="Jumlah">
                                    </div>
                                </div>
                            </div>
                            <div class="page-header mb-2">
                                <div class="d-flex justify-content-end">
                                    <button type="button" class="btn btn-primary buttonedit1" data-toggle="modal" data-target="#tambahAkun">
                                        <i class="fa fa-plus mr-2"></i>Tambah Akun
                                    </button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover table-striped table-bordered table-center mb-0">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>No. Akun</th>
                                            <th>Nama Akun</th>
                                            <th>Jumlah</th>
                                            <th>Catatan</th>
                                            <th>Departemen</th>
                                            <th>Proyek</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detail as $i => $item)
                                            @php $akun = $item['akun']; @endphp
                                            <tr>
                                                <td>{{ $akun->no_akun }}</td>
                                                <td>{{ $akun->nama_akun_indonesia }}</td>
                                                <td class="py-0" style="min-width: 200px">
                                                    <div class="input-group input-group-sm">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">Rp</span>
                                                        </div>
                                                        <input type="number" wire:model='detail.{{$i}}.jumlah' class="form-control">
                                                    </div>
                                                </td>
                                                <td class="py-0" style="min-width: 300px">
                                                    <input type="text" wire:model='detail.{{$i}}.catatan' class="form-control">
                                                </td>
                                                <td class="py-0" style="min-width: 200px">
                                                    <select wire:model='detail.{{$i}}.departemen_id' class="form-control">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($departemen as $d)
                                                            <option value="{{ $d->id }}">{{ $d->nama_departemen }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="py-0" style="min-width: 200px">
                                                    <select wire:model='detail.{{$i}}.proyek_id' class="form-control">
                                                        <option value="">-- Pilih --</option>
                                                        @foreach ($proyek as $d)
                                                            <option value="{{ $d->id }}">{{ $d->nama_proyek }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <button class="btn btn-danger btn-sm" type="button" wire:click='hapusDetail({{ $i }})'>Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dokumen" class="tab-pane fade @if($activeTab == 'dokumen') show active @endif">
                    <div class="card">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row float-right">
                                    <button type="button" id="fileuploads_btn_add" class="btn btn-primary buttonedit1 float-right" wire:click='addField'>
                                        <i class="fa fa-plus mr-2"></i>Tambah Field
                                    </button>
                                </div>
                            </div>
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-12" id="fileuploads_loop_add">
                                    <div class="row formtype">
                                        <div class="col-md-6">
                                            @foreach ($dokumens as $i => $dok)
                                                <div class="form-group">
                                                    <label>File {{ $i+1 }}</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" wire:model="dokumens.{{$i}}" placeholder="Link dokumen Anda">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-danger" type="button" wire:click='hapusDokumen({{ $i }})'>Hapus</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                            <div class="form-group">
                                                <label>Deskripsi</label>
                                                <textarea wire:model="deskripsi" id="" cols="30" rows="10" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="catatan_pemeriksaan" class="tab-pane fade @if($activeTab == 'catatan_pemeriksaan') show active @endif">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input click-filter" type="checkbox" id="tindakLanjut" @checked($tindak_lanjut != null)>
                                <label class="form-check-label mr-5" for="tindakLanjut">Tindak Lanjut</label>
                                <input class="form-check-input click-filter" type="checkbox" wire:model='urgent' value="1" id="urgent">
                                <label class="form-check-label mr-5" for="urgent">Urgent</label>
                            </div>
                            <div class="form-group">
                                <textarea wire:model="tindak_lanjut" id="tindak_lanjut" cols="30" rows="10" class="form-control" @disabled($tindak_lanjut == null)></textarea>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input click-filter" type="checkbox" id="catatanPemeriksaan" @checked($catatan_pemeriksaan != null)>
                                <label class="form-check-label mr-5" for="catatanPemeriksaan">Catatan Pemeriksaan</label>
                            </div>
                            <div class="form-group">
                                <textarea wire:model="catatan_pemeriksaan" id="catatan" cols="30" rows="10" class="form-control" @disabled($catatan_pemeriksaan == null)></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-header">
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                            <a href="{{ route('pembayaranlainnya/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="modal fade" tabindex="-1" id="tambahAkun" wire:ignore>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Akun</h5>
                    <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Pencarian</label>
                        <div class="row">
                            <div class="col-6">
                                <input type="text" name="no_akun" class="form-control key-filter" placeholder="Cari berdasarkan ID">
                            </div>
                            <div class="col-6">
                                <input type="text" name="nama_akun" class="form-control key-filter" placeholder="Nama Akun">
                            </div>
                        </div>
                    </div> 
                    <div class="table-responsive">
                        <table class="table table-hover table-striped table-bordered table-center mb-0 w-100" id="AkunList">
                            <thead class="thead-dark">
                                <tr>
                                    <th width="20"></th>
                                    <th>No. Akun</th>
                                    <th>Nama Akun</th>
                                    <th>Tipe Akun</th>
                                    <th>Mata Uang</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        var table = $('#AkunList').DataTable({
            processing: true,
            serverSide: true,
            ordering: true,
            searching: false,
            ajax: {
                url: "{{ route('get-akun-data') }}",
                data: function(d) {
                    d.nama_akun = $('input[name=nama_akun]').val()
                    d.no_akun = $('input[name=no_akun]').val()
                }
            },
            dom: "<'row'<'col-sm-12'B>>" +
                "<'row'<'col-sm-12 mt-3'tr>>" + 
                "<'row'<'col-12 mt-2'l><'col-12'p>>", 
            columns: [{
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `<button type="button" class="btn btn-primary buttonedit1" wire:click='addAkun(${data})'>
                                    <i class="fa fa-plus"></i>
                                </button>`;
                    }
                },
                {
                    data: 'no_akun',
                    name: 'no_akun',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'nama_akun_indonesia',
                    name: 'nama_akun_indonesia',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'tipe_id',
                    name: 'tipe_id',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'mata_uang_id',
                    name: 'mata_uang_id',
                    orderable: true,
                    searchable: true
                },
            ]
        });

        $('.key-filter').on('keyup', function(e){
            table.draw()
        });

        $('#tindakLanjut').change(function(e){
            $('#tindak_lanjut').prop('disabled', !this.checked);
        });
        $('#catatanPemeriksaan').change(function(e){
            $('#catatan').prop('disabled', !this.checked);
        });
    </script>
@endpush