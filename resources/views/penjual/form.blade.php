<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($penjualId) ? 'Edit' : 'Tambah' }} Data Penjual</h3>
                </div>
            </div>
        </div>
        <form wire:submit.prevent='save'>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Depan</label>
                                <input type="text" class="form-control @error('nama_depan_penjual') is-invalid @enderror" wire:model="nama_depan_penjual">
                                @foreach ($errors->get('nama_depan_penjual') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nama Belakang</label>
                                <input type="text" class="form-control @error('nama_belakang_penjual') is-invalid @enderror" wire:model="nama_belakang_penjual">
                                @foreach ($errors->get('nama_belakang_penjual') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Jabatan</label>
                                <input type="text" class="form-control @error('jabatan') is-invalid @enderror" wire:model="jabatan">
                            </div>
                            <div class="form-group">
                                <label for="dihentikan">Dihentikan</label>
                                <label class="switch">
                                    <input type="hidden" wire:model="dihentikan" value="0">
                                    <input type="checkbox" wire:model="dihentikan" id="dihentikan" value="1" @checked($dihentikan)>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content profile-tab-cont">
                <div class="profile-menu">
                    <ul class="nav nav-tabs nav-tabs-solid">
                        <li class="nav-item"> 
                            <a class="nav-link @if($activeTab == 'detail') active @endif" data-toggle="tab" href="#detail">Detail</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link @if($activeTab == 'dokumen') active @endif" data-toggle="tab" href="#dokumen">Dokumen</a> 
                        </li>
                        <li class="nav-item"> 
                            <a class="nav-link @if($activeTab == 'memo') active @endif" data-toggle="tab" href="#memo">Memo</a> 
                        </li>
                    </ul>
                </div>
                <div id="detail" class="tab-pane fade @if($activeTab == 'detail') show active @endif">
                    <div class="card">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Change Password</h5> --}}
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Kantor 1</label>
                                                <input type="text" class="form-control @error('no_kantor_1_penjual') is-invalid @enderror" wire:model="no_kantor_1_penjual">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>No. Kantor 2</label>
                                                    <input type="text" class="form-control @error('no_kantor_2_penjual') is-invalid @enderror" wire:model="no_kantor_2_penjual">
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>No. Ekstensi 1</label>
                                                <input type="text" class="form-control @error('no_ekstensi_1_penjual') is-invalid @enderror" wire:model="no_ekstensi_1_penjual">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div class="form-group">
                                                    <label>No. Ekstensi 2</label>
                                                    <input type="text" class="form-control @error('no_ekstensi_2_penjual') is-invalid @enderror" wire:model="no_ekstensi_2_penjual">
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label>No. HP</label>
                                        <input type="text" class="form-control @error('no_hp_penjual') is-invalid @enderror" wire:model="no_hp_penjual">
                                    </div>
                                    <div class="form-group">
                                        <label>No. Telp Rumah</label>
                                        <input type="text" class="form-control @error('no_telp_penjual') is-invalid @enderror" wire:model="no_telp_penjual">
                                    </div>
                                    <div class="form-group">
                                        <label>No. Fax</label>
                                        <input type="text" class="form-control @error('no_fax_penjual') is-invalid @enderror" wire:model="no_fax_penjual">
                                    </div>
                                    <div class="form-group">
                                        <label>Pager</label>
                                        <input type="text" class="form-control @error('pager_penjual') is-invalid @enderror" wire:model="pager_penjual">
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control @error('email_penjual') is-invalid @enderror" wire:model="email_penjual">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="card card-table">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover table-center mb-0" id="PenjualAddList">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Dari Penjualan</th>
                                                    <th>Sampai Penjualan</th>
                                                    <th>Persentase %</th>
                                                    <th>Nilai Tetap</th>
                                                    <th>Berdasarkan</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="dokumen" class="tab-pane fade @if($activeTab == 'dokumen') show active @endif">
                    <div class="card">
                        <div class="card-body">
                            <div class="page-header">
                                <div class="row float-right">
                                    <button type="button" id="fileuploads_btn_add" class="btn btn-primary buttonedit1 float-right" wire:click='addField()'>
                                        <i class="fa fa-plus mr-2"></i>Tambah Field
                                    </button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="memo" class="tab-pane fade @if($activeTab == 'memo') show active @endif">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row formtype">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Memo</label>
                                                <textarea class="form-control @error('memo') is-invalid @enderror" wire:model="memo"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-header">
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-check mr-2"></i>Simpan</button>
                            <a href="{{ route('penjual/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>