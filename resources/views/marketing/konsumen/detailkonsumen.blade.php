@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title mt-5">Detail Konsumen</h3>
                    </div>
                </div>
            </div>

            {{-- Formulir penyimpanan --}}
            <form method="POST" action="{{ route('konsumen/detail', $konsumen->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="card card-table">
                    <div class="card-body">
                        @if($konsumen->detail)
                        <div class="table-responsive">
                            <table class="table table-bordered mb-0" id="DetailKonsumenList">
                                <thead>
                                    <tr class="text-center bg-light">
                                        <th colspan="2">DATA CALON KONSUMEN / INFORMASI PEMESAN</th>
                                    </tr>
                                    <tr class="bg-white">
                                        <th colspan="2">DATA DIRI CALON KONSUMEN</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td width="40">Customer dari Perumahan/Cluster</td>
                                        <td>{{ $konsumen->cluster->nama_cluster ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Email</td>
                                        <td>{{ $konsumen->email ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Status Pengajuan</td>
                                        <td>{{ $konsumen->status_pengajuan->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Nama Lengkap</td>
                                        <td>{{ $konsumen->nama_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Provinsi KTP</td>
                                        <td>{{ ($konsumen->province)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kota KTP</td>
                                        <td>{{ ($konsumen->city)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kelurahan KTP</td>
                                        <td>{{ ($konsumen->village)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kecamatan KTP</td>
                                        <td>{{ ($konsumen->district)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Alamat KTP</td>
                                        <td>{{ $konsumen->alamat_konsumen ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Provinsi Domisili</td>
                                        <td>{{ ($konsumen->province1)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kota Domisili</td>
                                        <td>{{ ($konsumen->city1)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kelurahan Domisili</td>
                                        <td>{{ ($konsumen->village1)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kecamatan Domisili</td>
                                        <td>{{ ($konsumen->district1)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Alamat Domisili</td>
                                        <td>{{ $konsumen->alamat_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Tempat Lahir</td>
                                        <td>{{ $konsumen->tempat_lahir_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Tanggal Lahir</td>
                                        <td>{{ $konsumen->tanggal_lahir_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">NIK KTP</td>
                                        <td>{{ $konsumen->nik_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">No NPWP</td>
                                        <td>{{ $konsumen->npwp_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Pekerjaan</td>
                                        <td>{{ $konsumen->pekerjaan->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">No TLP</td>
                                        <td>{{ $konsumen->no_hp_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Status</td>
                                        <td>{{ $konsumen->pekerjaan->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Jenis Kelamin</td>
                                        <td>{{ $konsumen->gender->nama ?? '-' }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="bg-white">
                                        <th colspan="2">DATA PEKERJAAN CALON KONSUMEN ( KARYAWAN )</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td width="40">Nama Perusahaan</td>
                                        <td>{{ $konsumen->detail->nama_perusahaan_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Provinsi Perusahaan</td>
                                        <td>{{ ($konsumen->detail->province4)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kota Perusahaan</td>
                                        <td>{{ ($konsumen->detail->city4)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Bidang Usaha</td>
                                        <td>{{ $konsumen->detail->bidang_usaha_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Jabatan</td>
                                        <td>{{ $konsumen->detail->jabatan_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Status Pekerjaan</td>
                                        <td>{{ $konsumen->detail->status_pekerjaan_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Tanggal Mulai Bekerja</td>
                                        <td>{{ $konsumen->detail->tanggal_mulai_kerja_1 ?? '-' }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="bg-white">
                                        <th colspan="2">NOMINAL PENDAPATAN CALON KONSUMEN ( KARYAWAN )</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td width="40">Gaji Pokok</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->gaji_pokok_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Cycle Gaji Pokok</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->cycle_gaji_pokok_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Gaji Tambahan</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->gaji_tambahan_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Daftar Cicilan</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->daftar_cicilan_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="bg-white">
                                        <th colspan="2">DATA USAHA CALON KONSUMEN ( WIRAUSAHA )</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td width="40">Nama Usaha</td>
                                        <td>{{ $konsumen->detail->nama_usaha_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Provinsi Usaha</td>
                                        <td>{{ ($konsumen->detail->province6)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kota Usaha</td>
                                        <td>{{ ($konsumen->detail->city6)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kecamatan Usaha</td>
                                        <td>{{ ($konsumen->detail->village6)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kelurahan Usaha</td>
                                        <td>{{ ($konsumen->detail->district6)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Alamat Usaha</td>
                                        <td>{{ $konsumen->detail->alamat_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Bidang Usaha</td>
                                        <td>{{ $konsumen->detail->bidang_wirausaha_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Lama Usaha</td>
                                        <td>{{ $konsumen->detail->lama_usaha_1 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Legalitas Usaha</td>
                                        <td>{{ $konsumen->detail->legalitas_1 ?? '-' }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="bg-white">
                                        <th colspan="2">NOMINAL PENDAPATAN CALON KONSUMEN ( WIRAUSAHA )</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td width="40">Pendapatan Kotor</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->pendapatan_kotor_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Pendapatan Bersih</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->pendapatan_bersih_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Pendapatan Tambahan</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->pendapatan_tambahan_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Daftar Cicilan</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->daftar_cicilan_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="text-center bg-light">
                                        <th colspan="2">DATA CALON PASANGAN KONSUMEN / INFORMASI PEMESAN</th>
                                    </tr>
                                    <tr class="bg-white">
                                        <th colspan="2">DATA PASANGAN SUAMI/ISTRI</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td width="40">Nama Lengkap</td>
                                        <td>{{ $konsumen->detail->nama_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Provinsi KTP</td>
                                        <td>{{ ($konsumen->detail->province2)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kota KTP</td>
                                        <td>{{ ($konsumen->detail->city2)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kecamatan KTP</td>
                                        <td>{{ ($konsumen->detail->village2)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kelurahan KTP</td>
                                        <td>{{ ($konsumen->detail->district2)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Alamat KTP</td>
                                        <td>{{ $konsumen->detail->alamat_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Provinsi Domisili</td>
                                        <td>{{ ($konsumen->detail->province3)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kota Domisili</td>
                                        <td>{{ ($konsumen->detail->city3)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kelurahan Domisili</td>
                                        <td>{{ ($konsumen->detail->village3)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kecamatan Domisili</td>
                                        <td>{{ ($konsumen->detail->district3)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Alamat Domisili</td>
                                        <td>{{ $konsumen->detail->alamat_3 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Tempat Lahir</td>
                                        <td>{{ $konsumen->detail->tempat_lahir_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Tanggal Lahir</td>
                                        <td>{{ $konsumen->detail->tanggal_lahir_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">NIK KTP</td>
                                        <td>{{ $konsumen->detail->nik_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">No NPWP</td>
                                        <td>{{ $konsumen->detail->npwp_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Pekerjaan</td>
                                        <td>{{ $konsumen->detail->pekerjaan_2->nama ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">No TLP</td>
                                        <td>{{ $konsumen->detail->no_hp_2 ?? '-' }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="bg-white">
                                        <th colspan="2">DATA PEKERJAAN PASANGAN CALON KONSUMEN ( KARYAWAN )</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td width="40">Nama Perusahaan</td>
                                        <td>{{ $konsumen->detail->nama_perusahaan_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Provinsi KTP</td>
                                        <td>{{ ($konsumen->detail->province5)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kota KTP</td>
                                        <td>{{ ($konsumen->detail->city5)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Bidang Usaha</td>
                                        <td>{{ $konsumen->detail->bidang_usaha_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Jabatan</td>
                                        <td>{{ $konsumen->detail->jabatan_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Status Pekerjaan</td>
                                        <td>{{ $konsumen->detail->status_pekerjaan_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Tanggal Mulai Bekerja</td>
                                        <td>{{ $konsumen->detail->tanggal_mulai_kerja_2 ?? '-' }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="bg-white">
                                        <th colspan="2">NOMINAL PENDAPATAN PASANGAN CALON KONSUMEN ( KARYAWAN )</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td width="40">Gaji Pokok</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->gaji_pokok_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Cycle Gaji Pokok</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->cycle_gaji_pokok_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Gaji Tambahan</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->gaji_tambahan_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Daftar Cicilan</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->daftar_cicilan_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="bg-white">
                                        <th colspan="2">DATA USAHA PASANGAN CALON KONSUMEN ( WIRAUSAHA )</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td width="40">Nama Usaha</td>
                                        <td>{{ $konsumen->detail->nama_usaha_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Provinsi Usaha</td>
                                        <td>{{ ($konsumen->detail->province7)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kota Usaha</td>
                                        <td>{{ ($konsumen->detail->city7)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kecamatan Usaha</td>
                                        <td>{{ ($konsumen->detail->province7)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Kelurahan Usaha</td>
                                        <td>{{ ($konsumen->detail->city7)->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Alamat Usaha</td>
                                        <td>{{ $konsumen->detail->alamat_7 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Bidang Usaha</td>
                                        <td>{{ $konsumen->detail->bidang_wirausaha_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Lama Usaha</td>
                                        <td>{{ $konsumen->detail->lama_usaha_2 ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Legalitas Usaha</td>
                                        <td>{{ $konsumen->detail->legalitas_2 ?? '-' }}</td>
                                    </tr>
                                </tbody>
                                <thead>
                                    <tr class="bg-white">
                                        <th colspan="2">NOMINAL PENDAPATAN PASANGAN CALON KONSUMEN ( WIRAUSAHA )</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr>
                                        <td width="40">Pendapatan Kotor</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->pendapatan_kotor_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Pendapatan Bersih</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->pendapatan_bersih_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Pendapatan Tambahan</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->pendapatan_tambahan_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td width="40">Daftar Cicilan</td>
                                        <td>{{ 'Rp ' . number_format($konsumen->detail->daftar_cicilan_wirausaha_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        @else
                            <div class="alert alert-warning mt-4">Detail konsumen belum diisi.</div>
                        @endif
                    </div>
                </div>
                {{-- @if($konsumen->detail)
                    <h5 class="mt-4">Data Pasangan / Pekerjaan (Detail)</h5>

                    <p><strong>Nama Pasangan:</strong> {{ $konsumen->detail->nama_2 ?? '-' }}</p>
                    <p><strong>NIK Pasangan:</strong> {{ $konsumen->detail->nik_2 ?? '-' }}</p>
                    <p><strong>No HP Pasangan:</strong> {{ $konsumen->detail->no_hp_2 ?? '-' }}</p>

                    <p class="mb-0"><strong>Alamat #2:</strong></p>
                    <ul class="mb-3">
                        <li>Provinsi:  {{ optional($konsumen->detail->province2)->name ?? '-' }}</li>
                        <li>Kota/Kab:  {{ optional($konsumen->detail->city2)->name ?? '-' }}</li>
                        <li>Kecamatan: {{ optional($konsumen->detail->district2)->name ?? '-' }}</li>
                        <li>Kelurahan: {{ optional($konsumen->detail->village2)->name ?? '-' }}</li>
                        <li>Alamat:    {{ $konsumen->detail->alamat_2 ?? '-' }}</li>
                    </ul>

                    <p class="mb-0"><strong>Pekerjaan Utama:</strong></p>
                    <ul>
                        <li>Nama Perusahaan: {{ $konsumen->detail->nama_perusahaan_1 ?? '-' }}</li>
                        <li>Bidang Usaha:    {{ $konsumen->detail->bidang_usaha_1 ?? '-' }}</li>
                        <li>Jabatan:         {{ $konsumen->detail->jabatan_1 ?? '-' }}</li>
                        <li>Status Kerja:    {{ $konsumen->detail->status_pekerjaan_1 ?? '-' }}</li>
                        <li>Tanggal Mulai:   {{ $konsumen->detail->tanggal_mulai_kerja_1 ? \Carbon\Carbon::parse($konsumen->detail->tanggal_mulai_kerja_1)->isoFormat('D MMMM Y') : '-' }}</li>
                        <li>Gaji Pokok:      {{ isset($konsumen->detail->gaji_pokok_1) ? 'Rp ' . number_format($konsumen->detail->gaji_pokok_1,0,',','.') : '-' }}</li>
                        <li>Gaji Tambahan:   {{ isset($konsumen->detail->gaji_tambahan_1) ? 'Rp ' . number_format($konsumen->detail->gaji_tambahan_1,0,',','.') : '-' }}</li>
                    </ul>
                @else
                    <div class="alert alert-warning mt-4">Detail konsumen belum diisi.</div>
                @endif --}}
                <div class="mb-4 row align-items-center">
                    <div class="col">
                        <a href="{{ url()->previous() }}" class="btn btn-primary buttonedit mr-2">
                            <i class="fas fa-chevron-left mr-2"></i> Kembali
                        </a>
                        <a href="{{ route('konsumen/detail/pdf', $konsumen->id) }}" class="btn btn-primary buttonedit" target="_blank">
                            <i class="fas fa-print mr-2"></i> Print
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @section('script')
    <script>    
        $(document).ready(function () {
            $('#tambahBarangBtn').click(function () {
                let row = $('.barang-row:first').clone();
    
                row.find('select').val('');
                row.find('input').val('');
                $('#barangTableBody').append(row);
            });
    
            $(document).on('change', '.no-barang-select', function () {
                let selected = $(this).find(':selected');
                let row = $(this).closest('tr');
    
                row.find('.deskripsi-barang-input').val(selected.data('nama'));
                row.find('.kts-barang-input').val(selected.data('kts'));
                row.find('select[name="satuan[]"]').val(selected.data('satuan'));
            });
    
            $(document).on('click', '.remove-row', function () {
                if ($('#barangTableBody .barang-row').length > 1) {
                    $(this).closest('tr').remove();
                } else {
                    alert("Minimal satu barang harus ada.");
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const metodePembayaranSelect = document.getElementById('metode_pembayaran_id');
            const biayaKonsumen_1 = document.getElementById('biaya_konsumen_1');
            const bK_0 = document.getElementById('bk_0');
            const bK_1 = document.getElementById('bk_1');
            const bK_3 = document.getElementById('bk_3');
            const bK_4 = document.getElementById('bk_4');
            const bK_5 = document.getElementById('bk_5');
            const bK_6 = document.getElementById('bk_6');
            const bK_7 = document.getElementById('bk_7');
            const bK_8 = document.getElementById('bk_8');
            const bK_2 = document.getElementById('bk_2');
            const bK_9 = document.getElementById('bk_9');
            const bK_10 = document.getElementById('bk_10');
            const dokumen_1 = document.getElementById('dokumen_1');
            const dK_0 = document.getElementById('dk_0');
            const dK_1 = document.getElementById('dk_1');
            const dK_2 = document.getElementById('dk_2');
            const dokumen_2 = document.getElementById('dokumen_2');
            const dK_3 = document.getElementById('dk_3');
            const dK_4 = document.getElementById('dk_4');
            const dokumen_3 = document.getElementById('dokumen_3');
            const dK_5 = document.getElementById('dk_5');
            const dK_6 = document.getElementById('dk_6');
            const dokumen_4 = document.getElementById('dokumen_4');
            const dK_7 = document.getElementById('dk_7');
            const dK_8 = document.getElementById('dk_8');
            const dokumen_5 = document.getElementById('dokumen_5');
            const dK_9 = document.getElementById('dk_9');
            const dK_10 = document.getElementById('dk_10');
            const dokumen_6 = document.getElementById('dokumen_6');
            const dK_11 = document.getElementById('dk_11');
            const dK_12 = document.getElementById('dk_12');

            function toggleFields() {
                const selectedValue = metodePembayaranSelect.value;

                if (selectedValue === 'Cash Keras') {
                    biayaKonsumen_1.style.display = '';
                    bK_0.style.display = '';
                    bK_1.style.display = '';
                    bK_3.style.display = 'none';
                    bK_4.style.display = '';
                    bK_5.style.display = '';
                    bK_6.style.display = '';
                    bK_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_2.style.display = '';
                    bK_9.style.display = '';
                    bK_10.style.display = 'none';
                    dokumen_1.style.display = '';
                        dK_0.style.display = 'none';
                        dK_1.style.display = '';
                        dK_2.style.display = '';
                    dokumen_2.style.display = '';
                        dK_3.style.display = '';
                        dK_4.style.display = '';
                    dokumen_3.style.display = 'none';
                        dK_5.style.display = 'none';
                        dK_6.style.display = 'none';
                    dokumen_4.style.display = 'none';
                        dK_7.style.display = 'none';
                        dK_8.style.display = 'none';
                    dokumen_5.style.display = 'none';
                        dK_9.style.display = 'none';
                        dK_10.style.display = 'none';
                    dokumen_6.style.display = 'none';
                        dK_11.style.display = 'none';
                        dK_12.style.display = 'none';
                } else if (selectedValue === 'Cash Bertahap') {
                    biayaKonsumen_1.style.display = '';
                    bK_0.style.display = '';
                    bK_1.style.display = '';
                    bK_3.style.display = 'none';
                    bK_4.style.display = '';
                    bK_5.style.display = '';
                    bK_6.style.display = '';
                    bK_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_2.style.display = '';
                    bK_9.style.display = 'none';
                    bK_10.style.display = '';
                    dokumen_1.style.display = '';
                        dK_0.style.display = 'none';
                        dK_1.style.display = '';
                        dK_2.style.display = '';
                    dokumen_2.style.display = '';
                        dK_3.style.display = '';
                        dK_4.style.display = '';
                    dokumen_3.style.display = 'none';
                        dK_5.style.display = 'none';
                        dK_6.style.display = 'none';
                    dokumen_4.style.display = 'none';
                        dK_7.style.display = 'none';
                        dK_8.style.display = 'none';
                    dokumen_5.style.display = 'none';
                        dK_9.style.display = 'none';
                        dK_10.style.display = 'none';
                    dokumen_6.style.display = 'none';
                        dK_11.style.display = 'none';
                        dK_12.style.display = 'none';
                } else if (selectedValue === 'KPR') {
                    biayaKonsumen_1.style.display = '';
                    bK_0.style.display = '';
                    bK_1.style.display = '';
                    bK_2.style.display = 'none';
                    bK_3.style.display = '';
                    bK_4.style.display = '';
                    bK_5.style.display = '';
                    bK_6.style.display = '';
                    bK_7.style.display = '';
                    bK_8.style.display = '';
                    bK_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    dokumen_1.style.display = '';
                        dK_0.style.display = '';
                        dK_1.style.display = 'none';
                        dK_2.style.display = '';
                    dokumen_2.style.display = '';
                        dK_3.style.display = '';
                        dK_4.style.display = '';
                    dokumen_3.style.display = '';
                        dK_5.style.display = '';
                        dK_6.style.display = '';
                    dokumen_4.style.display = '';
                        dK_7.style.display = '';
                        dK_8.style.display = '';
                    dokumen_5.style.display = '';
                        dK_9.style.display = '';
                        dK_10.style.display = '';
                    dokumen_6.style.display = '';
                        dK_11.style.display = '';
                        dK_12.style.display = '';
                } else {
                    biayaKonsumen_1.style.display = 'none';
                    bK_0.style.display = 'none';
                    bK_1.style.display = 'none';
                    bK_3.style.display = 'none';
                    bK_4.style.display = 'none';
                    bK_5.style.display = 'none';
                    bK_6.style.display = 'none';
                    bK_7.style.display = 'none';
                    bK_8.style.display = 'none';
                    bK_2.style.display = 'none';
                    bK_9.style.display = 'none';
                    bK_10.style.display = 'none';
                    dokumen_1.style.display = 'none';
                        dK_0.style.display = 'none';
                        dK_1.style.display = 'none';
                        dK_2.style.display = 'none';
                    dokumen_2.style.display = 'none';
                        dK_3.style.display = 'none';
                        dK_4.style.display = 'none';
                    dokumen_3.style.display = 'none';
                        dK_5.style.display = 'none';
                        dK_6.style.display = 'none';
                    dokumen_4.style.display = 'none';
                        dK_7.style.display = 'none';
                        dK_8.style.display = 'none';
                    dokumen_5.style.display = 'none';
                        dK_9.style.display = 'none';
                        dK_10.style.display = 'none';
                    dokumen_6.style.display = 'none';
                        dK_11.style.display = 'none';
                        dK_12.style.display = 'none';
                }
            }
            metodePembayaranSelect.addEventListener('change', toggleFields);
            toggleFields();
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            const fee = document.getElementById('booking_fee');
            const ids = ['diskon_cb_0', 'jadwal_cb_0'];
            const tabDataLink = document.getElementById('diskon_0');
            const tabBookingLink = document.getElementById('jadwal_tabel_0');

            function guard(e){
                if (!(fee.value || '').trim() || fee.value === '0') {
                e.preventDefault();
                e.currentTarget.checked = false;
                Swal.fire({
                    icon: 'error',
                    text: 'Silakan isi Booking Fee terlebih dahulu!',
                    confirmButtonColor: '#8c54ff',
                    timer: 2500,
                    showConfirmButton: true
                });
                if (tabDataLink) new bootstrap.Tab(tabDataLink).show?.();
                fee.focus();
                } else if (tabBookingLink) {
                new bootstrap.Tab(tabBookingLink).show?.();
                }
            }

            ids.forEach(id => document.getElementById(id)?.addEventListener('click', guard));
        });
    </script> --}}
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Uncheck semua checkbox di blok yg field nominal-nya kosong/0 saat load
            document.querySelectorAll('[id^="bk_"]').forEach(wrap => {
                const field = wrap.querySelector('input[type="text"]');
                if (!field || !(field.value || '').trim() || field.value === '0') {
                wrap.querySelectorAll('.custom-control-input').forEach(cb => cb.checked = false);
                }
            });

            // Cekal centang jika nominal belum diisi (berlaku untuk semua checkbox di setiap bk_*)
            document.querySelectorAll('[id^="bk_"] .custom-control-input').forEach(cb => {
                cb.addEventListener('click', function (e) {
                const wrap  = e.currentTarget.closest('[id^="bk_"]');
                const field = wrap.querySelector('input[type="text"]'); // ambil input nominal di blok tsb
                const val   = (field && field.value || '').trim();

                if (!val || val === '0') {
                    e.preventDefault();
                    e.currentTarget.checked = false;
                    Swal.fire({
                    icon: 'error',
                    text: 'Silakan isi nominal terlebih dahulu!',
                    confirmButtonColor: '#8c54ff',
                    timer: 2500,
                    showConfirmButton: true
                    });
                    field && field.focus();
                }
                });
            });
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('[id^="bk_"]').forEach(w => {
                const f = w.querySelector('input[type="text"]');
                if (!f || !f.value.trim() || f.value.trim() === '0') {
                w.querySelectorAll('.custom-control-input').forEach(cb => cb.checked = false);
                }
            });

            document.addEventListener('click', e => {
                if (!e.target.classList.contains('custom-control-input')) return;

                const w = e.target.closest('[id^="bk_"]');
                const f = w && w.querySelector('input[type="text"]');

                if (!f || !f.value.trim() || f.value.trim() === '0') {
                e.preventDefault();
                e.target.checked = false;
                Swal.fire({
                    icon: 'error',
                    text: 'Silakan isi nominal terlebih dahulu!',
                    confirmButtonColor: '#8c54ff',
                    timer: 2500,
                    showConfirmButton: true
                });
                f && f.focus();
                }
            });
        });
    </script>
    {{-- <script>
        document.addEventListener("DOMContentLoaded", function() {
            const checkbox_diskon = document.getElementById("diskon_cb_0");
            const diskonInput = document.getElementById("diskon_0");
            const checkbox_jadwal = document.getElementById("jadwal_cb_0");
            const jadwalTabel = document.getElementById("jadwal_tabel_0");

            function toggleDiskonInput() {
                if (checkbox_diskon.checked) {
                    diskonInput.style.display = "block";
                } else {
                    diskonInput.style.display = "none";
                }
            }

            function toggleJadwalTabel() {
                if (checkbox_jadwal.checked) {
                    jadwalTabel.style.display = "block";
                } else {
                    jadwalTabel.style.display = "none";
                }
            }

            toggleDiskonInput();
            toggleJadwalTabel();

            checkbox_diskon.addEventListener("change", toggleDiskonInput);
            checkbox_jadwal.addEventListener("change", toggleJadwalTabel);
        });
    </script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const show = (el, on) => { if (el) el.style.display = on ? 'block' : 'none'; };
            document.querySelectorAll('[id^="diskon_cb_"]').forEach(cb => {
                const i = cb.id.replace('diskon_cb_', '');
                const target = document.getElementById('diskon_' + i);
                const sync = () => show(target, cb.checked);
                sync();
                cb.addEventListener('change', sync);
            });

            document.querySelectorAll('[id^="jadwal_cb_"]').forEach(cb => {
                const i = cb.id.replace('jadwal_cb_', '');
                const target = document.getElementById('jadwal_tabel_' + i);
                const sync = () => show(target, cb.checked);
                sync();
                cb.addEventListener('change', sync);
            });
        });
    </script>

@endsection
@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // --- TomSelect
            document.querySelectorAll('select.tomselect').forEach(function (el) {
                new TomSelect(el, {
                    create: false,
                    sortField: { field: "text", direction: "asc" }
                });
            });

            const cleaveMap = new WeakMap();

            document.querySelectorAll('input.rupiah').forEach(function (el) {
                const instance = new Cleave(el, {
                    numeral: true,
                    numeralPositiveOnly: true,
                    numeralDecimalScale: 2,
                    numeralThousandsGroupStyle: 'thousand',
                    numeralDecimalMark: '.',
                    delimiter: ',',
                    prefix: 'Rp ',
                    rawValueTrimPrefix: true
                });
                cleaveMap.set(el, instance);
            });

            document.querySelectorAll('form').forEach(function (form) {
                form.addEventListener('submit', function () {
                    form.querySelectorAll('input.rupiah').forEach(function (el) {
                        const inst = cleaveMap.get(el);
                        if (inst) el.value = inst.getRawValue();
                    });
                });
            });
        });
    </script>
@endpush
@endsection
