<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($departemenId) ? 'Edit' : 'Tambah' }} Data Departemen</h3>
                </div>
            </div>
        </div>
        <form wire:submit.prevent='save'>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>No</label>
                                <input type="text" class="form-control @error('departemen_id') is-invalid @enderror" wire:model="departemen_id">
                                @foreach ($errors->get('departemen_id') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div> 
                            <div class="form-group">
                                <label>Nama Departemen</label>
                                <input type="text" class="form-control @error('nama_departemen') is-invalid @enderror" wire:model="nama_departemen">
                                @foreach ($errors->get('nama_departemen') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Nama Kontak</label>
                                <input type="text" class="form-control @error('nama_kontak') is-invalid @enderror" wire:model="nama_kontak">
                                @foreach ($errors->get('nama_kontak') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" wire:model="deskripsi"></textarea>
                                @foreach ($errors->get('deskripsi') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Tipe</label>
                                <select class="form-control @error('tipe_departemen') is-invalid @enderror" wire:model="tipe_departemen">
                                    <option selected> --Pilih Tipe-- </option>
                                    @foreach ($tipe as $items )
                                        <option value="{{ $items->nama }}">{{ $items->nama }}</option>
                                    @endforeach
                                </select>
                                @foreach ($errors->get('tipe_departemen') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
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
            <div class="page-header">
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                            <a href="{{ route('departemen/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>