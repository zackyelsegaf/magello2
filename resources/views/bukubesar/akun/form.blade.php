<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($akunId) ? 'Edit' : 'Tambah' }} Data Akun</h3>
                </div>
            </div>
        </div>
        <form wire:submit.prevent='save'>
            <div class="row">
                <div class="col-lg-8">
                    <div class="row formtype">
                        <div class="col-md-6">                
                            <div class="form-group">
                                <label>Tipe Akun</label>
                                <select class="form-control @error('tipe_id') is-invalid @enderror" wire:model="tipe_id">
                                    <option selected> --Pilih Tipe Akun-- </option>
                                    @foreach ($tipe_akun as $items )
                                        <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                    @endforeach
                                </select>
                                @foreach ($errors->get('tipe_id') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>                              
                            <div class="form-group">
                                <label>No. Akun</label>
                                <input type="text" class="form-control @error('no_akun') is-invalid @enderror" wire:model="no_akun">
                            </div>
                            <div class="form-group">
                                <label>Nama Akun (Indonesia)</label>
                                <textarea class="form-control derror" wire:model="nama_akun_indonesia">{{ old('nama_akun_indonesia') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nama Akun (English)</label>
                                <textarea class="form-control" wire:model="nama_akun_inggris">{{ old('nama_akun_inggris') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Mata Uang</label>
                                <select class="form-control @error('mata_uang_id') is-invalid @enderror" wire:model="mata_uang_id">
                                    <option selected> --Pilih Mata Uang-- </option>
                                    @foreach ($mata_uang as $items )
                                        <option value="{{ $items->id }}">{{ $items->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_akun_check">Sub Akun Dari</label>
                                <label class="switch">
                                    <input type="hidden" name="sub_akun_check" value="0">
                                    <input type="checkbox" name="sub_akun_check" id="sub_akun_check" value="1" @checked($parent_id != null)>
                                    <span class="slider round"></span>
                                </label>
                            </div>
                            <div class="form-group" id="tipe_akun_form" style="display: none;">
                                {{-- <label>Subdari</label> --}}
                                <select class="form-control" wire:model="parent_id">
                                    <option selected> --Pilih Sub-- </option>
                                    @foreach ($nama_akun as $items )
                                        <option value="{{ $items->id }}">{{ $items->no_akun .' '. $items->nama_akun_indonesia }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Saldo</label>
                                <input type="text" id="saldo_akun" class="form-control @error('saldo_akun') is-invalid @enderror" wire:model="saldo_akun">
                            </div>
                            <div class="form-group">
                                <label>Tanggal</label>
                                <div class="cal-icon">
                                    <input type="text" class="form-control datetimepicker @error('tanggal') is-invalid @enderror" wire:model="tanggal"> 
                                </div>
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
                            <a href="{{ route('akun/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox = document.getElementById("sub_akun_check");
            const tipeAkunForm = document.getElementById("tipe_akun_form");

            function toggleTipeAkunForm() {
                if (checkbox.checked) {
                    tipeAkunForm.style.display = "block";
                } else {
                    tipeAkunForm.style.display = "none";
                }
            }

            toggleTipeAkunForm();

            checkbox.addEventListener("change", toggleTipeAkunForm);
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('saldo_akun');

            input.addEventListener('input', () => {
                let angka = input.value.replace(/\D/g, '');
                input.value = formatRupiah(angka, 'Rp ');
            });

            function formatRupiah(angka, prefix = '') {
                return prefix + angka.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
            }
        });
    </script>    
@endpush