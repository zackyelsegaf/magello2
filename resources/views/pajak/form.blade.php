<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($pajakId) ? 'Edit' : 'Tambah' }} Data Pajak</h3>
                </div>
            </div>
        </div>
        <form wire:submit.prevent='save'>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Kode</label>
                                <input type="text" class="form-control @error('kode') is-invalid @enderror" wire:model="kode" placeholder="Kode pajak pelanggan">
                                @foreach ($errors->get('kode') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" wire:model="nama" placeholder="Nama pajak">
                                @foreach ($errors->get('nama') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Nilai</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('nilai_persentase') is-invalid @enderror" wire:model="nilai_persentase" placeholder="Persentase Pajak">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @foreach ($errors->get('nilai_persentase') as $err)
                                        <div class="invalid-feedback">{{ $err }}</div>
                                    @endforeach
                                </div>                                
                            </div>
                            <div class="form-group">
                                <label>Akun Pajak Penjualan</label>
                                <select class="form-control" wire:model="akun_pajak_penjualan_id">
                                    <option selected> --Pilih Akun-- </option>
                                    @foreach ($akun as $items )
                                        <option value="{{ $items->id }}">{{ $items->no_akun .' '. $items->nama_akun_indonesia }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Akun Pajak Pembelian</label>
                                <select class="form-control" wire:model="akun_pajak_pembelian_id">
                                    <option selected> --Pilih Akun-- </option>
                                    @foreach ($akun as $items )
                                        <option value="{{ $items->id }}">{{ $items->no_akun .' '. $items->nama_akun_indonesia }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" wire:model="deskripsi"></textarea>
                                @foreach ($errors->get('deskripsi') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
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
                            <a href="{{ route('pajak/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>