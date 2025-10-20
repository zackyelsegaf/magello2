<div class="page-wrapper">
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <h3 class="page-title mt-5">{{ isset($anggaranId) ? 'Edit' : 'Tambah' }} Data Anggaran Akun</h3>
                </div>
            </div>
        </div>
        <form wire:submit.prevent='save'>
            <div class="row formtype">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">                
                                <label for="">Akun</label>
                            </div>
                            <div class="col-md-3">                
                                <input type="text" wire:model="no_akun" id="" readonly class="form-control @error('akun_id') is-invalid @enderror">
                            </div>
                            <div class="col-md-6">                
                                <div class="input-group">
                                    <input type="text" wire:model="nama_akun" id="" readonly class="form-control @error('akun_id') is-invalid @enderror">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahAkun">Cari</button>
                                    </div>
                                    @foreach ($errors->get('akun_id') as $err)
                                        <div class="invalid-feedback">{{ $err }}</div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">                
                                <label for="">Tahun</label>
                            </div>
                            <div class="col-md-9">                
                                <input type="number" wire:model="tahun" id="" class="form-control @error('tahun') is-invalid @enderror">
                                @foreach ($errors->get('tahun') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-3">                
                                <label for="">Nilai Saldo Awal</label>
                            </div>
                            <div class="col-md-9">                
                                <input type="text" wire:model="nilai_saldo_awal" id="nilai_saldo_awal" class="form-control @error('nilai_saldo_awal') is-invalid @enderror">
                                @foreach ($errors->get('nilai_saldo_awal') as $err)
                                    <div class="invalid-feedback">{{ $err }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <label for="">Periode:</label>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">1. </label>
                                    <input type="number" wire:model="periode_1" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">2. </label>
                                    <input type="number" wire:model="periode_2" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">3. </label>
                                    <input type="number" wire:model="periode_3" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">4. </label>
                                    <input type="number" wire:model="periode_4" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">5. </label>
                                    <input type="number" wire:model="periode_5" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">6. </label>
                                    <input type="number" wire:model="periode_6" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">7. </label>
                                    <input type="number" wire:model="periode_7" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">8. </label>
                                    <input type="number" wire:model="periode_8" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">9. </label>
                                    <input type="number" wire:model="periode_9" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">10. </label>
                                    <input type="number" wire:model="periode_10" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">11. </label>
                                    <input type="number" wire:model="periode_11" id="" class="form-control">
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex">
                                    <label for="" class="mt-2 mr-3">12. </label>
                                    <input type="number" wire:model="periode_12" id="" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-check mb-5">
                        <input class="form-check-input click-filter" id="tampilkan_peringatan" type="checkbox" wire:model="tampilkan_peringatan" value="1" @checked($tampilkan_peringatan)>
                        <label class="form-check-label" for="tampilkan_peringatan">Tampilkan peringatan jika akun melebih batas anggaran periodenya.</label>
                    </div>
                </div>
            </div>
            <div class="page-header">
                <div class="mb-15 row align-items-center">
                    <div class="col">
                        <div class="">
                            <button type="submit" class="btn btn-primary buttonedit"><i class="fa fa-save mr-2"></i>Simpan</button>
                            <a href="{{ route('anggaranakun/list/page') }}" class="btn btn-primary float-left veiwbutton ml-2"><i class="fas fa-chevron-left mr-2"></i>Batal</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
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
                        return `<button type="button" class="btn btn-primary buttonedit1" wire:click='addAkun(${data})' data-dismiss="modal">
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
                    data: 'tipe_akun',
                    name: 'tipe_akun',
                    orderable: true,
                    searchable: true
                },
                {
                    data: 'mata_uang',
                    name: 'mata_uang',
                    orderable: true,
                    searchable: true
                },
            ]
        });

        $('.key-filter').on('keyup', function(e){
            table.draw()
        });

        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('nilai_saldo_awal');

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