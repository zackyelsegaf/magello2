<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($jasaId) ? 'Edit' : 'Tambah' }} Data Jasa Pengiriman</h3>
                </div>
            </div>
        </div>
        <form wire:submit.prevent='save'>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row formtype">
                        <div class="col-md-4"> 
                            <div class="form-group">
                                <label>Nama Jasa</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror" wire:model="nama">
                                @foreach ($errors->get('nama') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                            <div class="form-group">
                                <label>Jasa Pengiriman</label>
                                <select class="form-control @error('jasa_pengiriman') is-invalid @enderror" wire:model="jasa_pengiriman">
                                    <option value="" selected>-- Pilih Jasa Pengiriman --</option>
                                    <option value="JNE">JNE</option>
                                    <option value="Indonesia">Indonesia</option>
                                    <option value="JNT">JNT</option>
                                    <option value="SICepat">SICepat</option>
                                    <option value="Tiki">Tiki</option>
                                    <option value="AnterAja">AnterAja</option>
                                    <option value="Wahana">Wahana</option>
                                    <option value="Ninja">Ninja</option>
                                    <option value="Lion">Lion</option>
                                    <option value="Express">Express</option>
                                    <option value="Express">Express</option>
                                    <option value="Express">Express</option>
                                    <option value="Logistics">Logistics</option>
                                    <option value="Express">Express</option>
                                    <option value="Express">Express</option>
                                    <option value="KGXpress">KGXpress</option>
                                    <option value="Express">Express</option>
                                    <option value="Express">Express</option>
                                </select>
                                @foreach ($errors->get('jasa_pengiriman') as $err)
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
                            <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-check mr-2"></i>Simpan</button>
                            <a href="{{ route('jasapengiriman/list/page') }}" class="btn btn-primary float-left veiwbutton ml-3"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>