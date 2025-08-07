<div id="filterBox" {{ $attributes->merge(['class' => '']) }}>
    <div class="card rounded-sm p-3 bg-dark text-white">
        {{-- Bagian: Pencarian --}}
        <div class="form-group mb-2">
            <label class="font-weight-bold" for="keyword">Pencarian</label>
            <input type="text" class="form-control form-control-sm" id="keyword" name="quoteno"
                placeholder="No. {{ $submodul }}">
        </div>
        <x-form.input-field name="description" label="" placeholder="Tulis deskripsi..." class="mb-2" />

        {{-- Bagian: Pelanggan --}}
        <x-select2.search placeholder="Nama Pelanggan..." name="pelanggan_id" label="Pelanggan" :options="$pelanggans"
            {{-- gunakan seperti ini --}} />

        {{-- Bagian: Mata Uang --}}
        <x-select2.search placeholder="Mata Uang..." name="matauang_id" label="Mata Uang" :options="$matauangs" />

        {{-- Bagian: Filter Tanggal --}}
        <div class="form-group mt-3 mb-2" x-data="{ useDate: false }" x-init="$watch('useDate', value => {
            if (value) {
                setTimeout(() => {
                    $('#date_from').datepicker({ format: 'dd/mm/yyyy', autoclose: true });
                    $('#date_to').datepicker({ format: 'dd/mm/yyyy', autoclose: true });
                }, 10);
            }
        })">
            <label class="font-weight-bold">Tanggal</label>
            <div class="d-flex align-items-center">
                <input type="checkbox" id="filterTanggal" name="use_date" class="mr-2" x-model="useDate">
                <label for="filterTanggal" class="mb-0">Filter Tanggal</label>
            </div>
            <div x-show="useDate" x-cloak>
                <div class="row mt-2">
                    <div class="col">
                        <input type="text" readonly class="form-control form-control-sm" placeholder="Dari"
                            name="date_from" id="date_from"
                            value="{{ date('d/m/Y', strtotime('first day of this month')) }}">
                    </div>
                </div>
                <div class="row mt-2">
                    <div class="col">
                        <input type="text" readonly class="form-control form-control-sm" placeholder="Sampai"
                            name="date_to" id="date_to" value="{{ date('d/m/Y') }}">
                    </div>
                </div>
            </div>
        </div>


        {{-- Bagian: Status --}}
        <div class="form-group">
            <label class="font-weight-bold">Status</label>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="status[]" value="closed" id="statusClosed">
                <label class="form-check-label font-weight-bolder" for="statusClosed">Ditutup</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="status[]" value="proceed" id="statusProceed">
                <label class="form-check-label font-weight-bolder" for="statusProceed">Diterima</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="status[]" value="diproses" id="statusDiproses">
                <label class="form-check-label font-weight-bolder" for="statusDiproses">Diproses</label>
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" name="status[]" value="menunggu" id="statusMenunggu">
                <label class="form-check-label font-weight-bolder" for="statusMenunggu">Menunggu</label>
            </div>
        </div>

        {{-- Bagian: Catatan Audit --}}
        <div class="form-group">
            <label class="font-weight-bold">Catatan Audit</label>
            @foreach (['Catatan Pemeriksaan', 'Belum Catatan Pemeriksaan', 'Disetujui', 'Belum Disetujui', 'Tindak Lanjut', 'Belum Tindak Lanjut', 'Urgent', 'Tidak Urgent'] as $i => $label)
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="audit_notes[]"
                        value="{{ \Str::slug($label, '_') }}" id="auditNote{{ $i }}">
                    <label class="form-check-label font-weight-bolder"
                        for="auditNote{{ $i }}">{{ $label }}</label>
                </div>
            @endforeach

        </div>


        {{-- Bagian: Easy Branch --}}
        {{-- <x-select2.search placeholder="&lt;Semua Pengguna&gt;" name="easy_branch" label="Easy Branch"
            :options="[
                '001' => 'Cabang A',
                '002' => 'Cabang B',
                '003' => 'Cabang C',
            ]" /> --}}
    </div>
</div>

@push('scripts')
@endpush

{{-- Optional: Script to toggle date range --}}
