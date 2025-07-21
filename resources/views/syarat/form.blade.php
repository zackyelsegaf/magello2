<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($syaratId) ? 'Edit' : 'Tambah' }} Data Syarat Pembayaran</h3>
                </div>
            </div>
        </div>
        <form wire:submit.prevent='save'>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Nama Syarat</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" wire:model="nama">
                                @foreach ($errors->get('nama') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Batas Hutang</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('batas_hutang') is-invalid @enderror" wire:model="batas_hutang">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Hari</span>
                                    </div>
                                    @foreach ($errors->get('batas_hutang') as $err)
                                        <div class="invalid-feedback">{{ $err }}</div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="cash_on_delivery">Cash on Delivery</label>
                                <label class="switch">
                                    <input type="hidden" wire:model="cash_on_delivery" value="0">
                                    <input type="checkbox" wire:model="cash_on_delivery" id="cash_on_delivery" value="1" @checked($cash_on_delivery == 1)>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="form-group">
                                <h7 class="font-weight-bold">Jika dibayar pada batas periode diskon</h7>
                                <label>Persentase</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('persentase_diskon') is-invalid @enderror" wire:model="persentase_diskon">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    @foreach ($errors->get('persentase_diskon') as $err)
                                        <div class="invalid-feedback">{{ $err }}</div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Periode Diskon</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('periode_diskon') is-invalid @enderror" wire:model="periode_diskon">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Hari</span>
                                    </div>
                                    @foreach ($errors->get('periode_diskon') as $err)
                                        <div class="invalid-feedback">{{ $err }}</div>
                                    @endforeach
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
                            <a href="{{ route('syarat/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>