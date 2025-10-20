<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($statusId) ? 'Edit' : 'Tambah' }} Data Status Pemasok</h3>
                </div>
            </div>
        </div>
        <form wire:submit.prevent='save'>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Status Pemasok</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" wire:model="nama">
                                @foreach ($errors->get('nama') as $err)
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
                            <a href="{{ route('statuspemasok/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>