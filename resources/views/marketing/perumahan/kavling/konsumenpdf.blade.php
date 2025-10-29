<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Konsumen - {{ $booking->konsumen->nama_1 ?? '-' }}</title>    
    <style>
        body{ 
            font-family: sans-serif; 
            font-size: 12px; 
            margin: 8mm 8mm; 
            line-height: 1.45; 
        }
        /* #DetailKonsumenList th,
        #DetailKonsumenList td {
            padding: 5px 10px !important;
            font-size: 13px;
            border: 1.5px solid #adb7be;
            vertical-align: middle;
        } */
        .text-center{
            text-align: center;
        }
        .kop{ 
            text-align:center; 
            margin-bottom: 10px; 
        }
        .kop .title{ 
            font-size: 16px; 
            font-weight: 700; 
            text-transform: uppercase; 
        }
        .base-color{
            color: #075697;
        }
        .line{ 
            border-top: 1.5px solid #075697; 
            margin: 0;
            padding: 0;
        }
        .judul{ 
            text-align:center; 
            margin: 8px 0 18px; 
            color: #075697;
        }
        .judul .head{ 
            font-size: 14px; 
            font-weight: 700; 
            text-decoration: underline; 
        }
        .meta{ 
            margin: 1px 15px 10px; 
        }
        .meta table{ 
            width:100%; 
            border-collapse: collapse; 
        }
        .meta{ 
            padding: 4px 0; 
            vertical-align: top; 
        }
        .isi{ 
            text-align: justify; 
        }
        .ttd{ 
            width:100%; 
            margin-top: 28px; 
        }
        .ttd{ 
            width:50%; 
            vertical-align: top; 
        }
        .small{ 
            font-size: 11px; 
            color:#333; 
        }
        .box{ 
            border:1px solid #444; 
            padding:8px 10px; 
            border-radius:4px; 
            margin-top:8px; 
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 0; 
        }
        .text-left{
            text-align: left;
        }
        .text-right{
            text-align: right;
            margin: 0;
            padding: 0;
        }
        .kecil{
            font-size: 11px;
        }
        .kecil-1{
            font-size: 9px;
        }
        .imageku{
            width: 50px;
        }
        #DetailKonsumenList 
        { 
            border-collapse: collapse; 
            width:100%; 
        }
        #DetailKonsumenList th, 
        #DetailKonsumenList td 
        { 
            padding:5px 10px; 
            border:1.5px solid #adb7be; 
        }
        
        .section-title th 
        { 
            background:#f8f9fa; 
            text-align:left; 
            font-weight:700; 
        }
        tr, td, th 
        { 
            page-break-inside: avoid; 
        }
    </style>
</head>
<body>
    {{-- @php
        $luasBangunan = $cluster
            ->flatten(1)
            ->whereIn('kapling_id', $selectedKaplingIds ?? [])
            ->map(function ($k) {
                return $k->luas_bangunan ?? '';
            })
            ->implode(', ');
        $luasTanah = $cluster
            ->flatten(1)
            ->whereIn('kapling_id', $selectedKaplingIds ?? [])
            ->map(function ($k) {
                return $k->luas_tanah ?? '';
            })
            ->implode(', ');
        $dibuatOleh = $cluster
            ->flatten(1)
            ->whereIn('kapling_id', $selectedKaplingIds ?? [])
            ->map(function ($k) {
                return $k->dibuat_oleh ?? '';
            })
            ->implode(', ');
        $disetujuiOleh = $cluster
            ->flatten(1)
            ->whereIn('kapling_id', $selectedKaplingIds ?? [])
            ->map(function ($k) {
                return $k->disetujui_oleh ?? '';
            })
            ->implode(', ');
    @endphp --}}
    <table style="width:100%; text-align:center; ">
        <tr>
            <td style="padding-right: 100px;">
                <img class="imageku" src="{{ public_path('assets/img/logo_EA7.svg') }}">
            </td>
            <td>
                <h2 class="text-center base-color"><strong>Easy Accounting</strong></h2>
            </td>
            <td>
                <p class="text-right kecil-1 base-color">Jl. Ahmad Yani No. 12, Bandung 45519</p>
                <p class="text-right kecil-1 base-color"><strong>Telp. (022) 7889621</strong></p>
            </td>
        </tr>
    </table>
    <div class="line"></div>
    <table style="width:100%;">
        <tr>
            <td>
                <h3 class="text-center"><strong>Detail Konsumen</strong></h3>
            </td>
        </tr>
    </table>
    <div class="meta" style="margin-bottom: 15px;">
        {{-- <table class="table table-bordered mb-0" id="DetailKonsumenList">
            <thead>
                <tr class="text-center" style="background-color: #f8f9fa !important;">
                    <th colspan="2">DATA CALON KONSUMEN / INFORMASI PEMESAN</th>
                </tr>
                <tr class="bg-white text-left">
                    <th colspan="2">DATA DIRI CALON KONSUMEN</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr>
                    <td width="40">Customer dari Perumahan/Cluster</td>
                    <td>{{ $booking->konsumen->cluster->nama_cluster ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Email</td>
                    <td>{{ $booking->konsumen->email ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Status Pengajuan</td>
                    <td>{{ $booking->konsumen->status_pengajuan->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Nama Lengkap</td>
                    <td>{{ $booking->konsumen->nama_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Provinsi KTP</td>
                    <td>{{ $provinceSelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kota KTP</td>
                    <td>{{ $citySelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kelurahan KTP</td>
                    <td>{{ $districtSelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kecamatan KTP</td>
                    <td>{{ $villageSelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Alamat KTP</td>
                    <td>{{ $booking->konsumen->alamat_konsumen ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Provinsi Domisili</td>
                    <td>{{ $provinceSelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kota Domisili</td>
                    <td>{{ $citySelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kelurahan Domisili</td>
                    <td>{{ $districtSelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kecamatan Domisili</td>
                    <td>{{ $villageSelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Alamat Domisili</td>
                    <td>{{ $booking->konsumen->alamat_konsumen ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Tempat Lahir</td>
                    <td>{{ $citySelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Tanggal Lahir</td>
                    <td>{{ $citySelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">NIK KTP</td>
                    <td>{{ $booking->konsumen->nik_konsumen ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">No NPWP</td>
                    <td>{{ $citySelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Pekerjaan</td>
                    <td>{{ $booking->konsumen->pekerjaan->nama ?? '-' }}</td>
                </tr>
                
                <tr>
                    <td width="40">No TLP</td>
                    <td>{{ $booking->konsumen->no_hp ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Status</td>
                    <td>{{ $citySelected->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Jenis Kelamin</td>
                    <td>{{ $booking->konsumen->gender->nama ?? '-' }}</td>
                </tr>
            </tbody>
        </table> --}}

        @if($booking->konsumen->detail)
        <table id="DetailKonsumenList">
            <tbody class="bg-white">
                <tr class="text-center" style="background-color: #f8f9fa !important;">
                    <th colspan="2">DATA CALON KONSUMEN / INFORMASI PEMESAN</th>
                </tr>
                <tr class="section-title">
                    <th colspan="2">DATA DIRI CALON KONSUMEN</th>
                </tr>
                <tr>
                    <td width="40">Customer dari Perumahan/Cluster</td>
                    <td>{{ $booking->konsumen->cluster->nama_cluster ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Email</td>
                    <td>{{ $booking->konsumen->email ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Status Pengajuan</td>
                    <td>{{ $booking->konsumen->status_pengajuan->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Nama Lengkap</td>
                    <td>{{ $booking->konsumen->nama_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Provinsi KTP</td>
                    <td>{{ ($booking->konsumen->province)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kota KTP</td>
                    <td>{{ ($booking->konsumen->city)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kelurahan KTP</td>
                    <td>{{ ($booking->konsumen->village)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kecamatan KTP</td>
                    <td>{{ ($booking->konsumen->district)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Alamat KTP</td>
                    <td>{{ $booking->konsumen->alamat_konsumen ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Provinsi Domisili</td>
                    <td>{{ ($booking->konsumen->province1)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kota Domisili</td>
                    <td>{{ ($booking->konsumen->city1)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kelurahan Domisili</td>
                    <td>{{ ($booking->konsumen->village1)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kecamatan Domisili</td>
                    <td>{{ ($booking->konsumen->district1)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Alamat Domisili</td>
                    <td>{{ $booking->konsumen->alamat_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Tempat Lahir</td>
                    <td>{{ $booking->konsumen->tempat_lahir_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Tanggal Lahir</td>
                    <td>{{ $booking->konsumen->tanggal_lahir_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">NIK KTP</td>
                    <td>{{ $booking->konsumen->nik_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">No NPWP</td>
                    <td>{{ $booking->konsumen->npwp_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Pekerjaan</td>
                    <td>{{ $booking->konsumen->pekerjaan->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">No TLP</td>
                    <td>{{ $booking->konsumen->no_hp_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Status</td>
                    <td>{{ $booking->konsumen->pekerjaan->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Jenis Kelamin</td>
                    <td>{{ $booking->konsumen->gender->nama ?? '-' }}</td>
                </tr>
                <tr class="section-title">
                    <th colspan="2">DATA PEKERJAAN CALON KONSUMEN ( KARYAWAN )</th>
                </tr>
                <tr>
                    <td width="40">Nama Perusahaan</td>
                    <td>{{ $booking->konsumen->detail->nama_perusahaan_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Provinsi Perusahaan</td>
                    <td>{{ ($booking->konsumen->detail->province4)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kota Perusahaan</td>
                    <td>{{ ($booking->konsumen->detail->city4)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Bidang Usaha</td>
                    <td>{{ $booking->konsumen->detail->bidang_usaha_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Jabatan</td>
                    <td>{{ $booking->konsumen->detail->jabatan_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Status Pekerjaan</td>
                    <td>{{ $booking->konsumen->detail->status_pekerjaan_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Tanggal Mulai Bekerja</td>
                    <td>{{ $booking->konsumen->detail->tanggal_mulai_kerja_1 ?? '-' }}</td>
                </tr>
                <tr class="section-title">
                    <th colspan="2">NOMINAL PENDAPATAN CALON KONSUMEN ( KARYAWAN )</th>
                </tr>
                <tr>
                    <td width="40">Gaji Pokok</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->gaji_pokok_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Cycle Gaji Pokok</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->cycle_gaji_pokok_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Gaji Tambahan</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->gaji_tambahan_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Daftar Cicilan</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->daftar_cicilan_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr class="section-title">
                    <th colspan="2">DATA USAHA CALON KONSUMEN ( WIRAUSAHA )</th>
                </tr>
                <tr>
                    <td width="40">Nama Usaha</td>
                    <td>{{ $booking->konsumen->detail->nama_usaha_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Provinsi Usaha</td>
                    <td>{{ ($booking->konsumen->detail->province6)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kota Usaha</td>
                    <td>{{ ($booking->konsumen->detail->city6)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kecamatan Usaha</td>
                    <td>{{ ($booking->konsumen->detail->village6)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kelurahan Usaha</td>
                    <td>{{ ($booking->konsumen->detail->district6)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Alamat Usaha</td>
                    <td>{{ $booking->konsumen->detail->alamat_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Bidang Usaha</td>
                    <td>{{ $booking->konsumen->detail->bidang_wirausaha_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Lama Usaha</td>
                    <td>{{ $booking->konsumen->detail->lama_usaha_1 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Legalitas Usaha</td>
                    <td>{{ $booking->konsumen->detail->legalitas_1 ?? '-' }}</td>
                </tr>
                <tr class="section-title">
                    <th colspan="2">NOMINAL PENDAPATAN CALON KONSUMEN ( WIRAUSAHA )</th>
                </tr>
                <tr>
                    <td width="40">Pendapatan Kotor</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->pendapatan_kotor_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Pendapatan Bersih</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->pendapatan_bersih_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Pendapatan Tambahan</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->pendapatan_tambahan_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Daftar Cicilan</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->daftar_cicilan_1 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr class="text-center" style="background-color: #f8f9fa !important;">
                    <th colspan="2">DATA CALON PASANGAN KONSUMEN / INFORMASI PEMESAN</th>
                </tr>
                <tr class="section-title">
                    <th colspan="2">DATA PASANGAN SUAMI/ISTRI</th>
                </tr>
                <tr>
                    <td width="40">Nama Lengkap</td>
                    <td>{{ $booking->konsumen->detail->nama_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Provinsi KTP</td>
                    <td>{{ ($booking->konsumen->detail->province2)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kota KTP</td>
                    <td>{{ ($booking->konsumen->detail->city2)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kecamatan KTP</td>
                    <td>{{ ($booking->konsumen->detail->village2)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kelurahan KTP</td>
                    <td>{{ ($booking->konsumen->detail->district2)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Alamat KTP</td>
                    <td>{{ $booking->konsumen->detail->alamat_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Provinsi Domisili</td>
                    <td>{{ ($booking->konsumen->detail->province3)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kota Domisili</td>
                    <td>{{ ($booking->konsumen->detail->city3)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kelurahan Domisili</td>
                    <td>{{ ($booking->konsumen->detail->village3)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kecamatan Domisili</td>
                    <td>{{ ($booking->konsumen->detail->district3)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Alamat Domisili</td>
                    <td>{{ $booking->konsumen->detail->alamat_3 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Tempat Lahir</td>
                    <td>{{ $booking->konsumen->detail->tempat_lahir_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Tanggal Lahir</td>
                    <td>{{ $booking->konsumen->detail->tanggal_lahir_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">NIK KTP</td>
                    <td>{{ $booking->konsumen->detail->nik_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">No NPWP</td>
                    <td>{{ $booking->konsumen->detail->npwp_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Pekerjaan</td>
                    <td>{{ $booking->konsumen->detail->pekerjaan_2->nama ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">No TLP</td>
                    <td>{{ $booking->konsumen->detail->no_hp_2 ?? '-' }}</td>
                </tr>
                <tr class="section-title">
                    <th colspan="2">DATA PEKERJAAN PASANGAN CALON KONSUMEN ( KARYAWAN )</th>
                </tr>
                <tr>
                    <td width="40">Nama Perusahaan</td>
                    <td>{{ $booking->konsumen->detail->nama_perusahaan_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Provinsi KTP</td>
                    <td>{{ ($booking->konsumen->detail->province5)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kota KTP</td>
                    <td>{{ ($booking->konsumen->detail->city5)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Bidang Usaha</td>
                    <td>{{ $booking->konsumen->detail->bidang_usaha_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Jabatan</td>
                    <td>{{ $booking->konsumen->detail->jabatan_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Status Pekerjaan</td>
                    <td>{{ $booking->konsumen->detail->status_pekerjaan_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Tanggal Mulai Bekerja</td>
                    <td>{{ $booking->konsumen->detail->tanggal_mulai_kerja_2 ?? '-' }}</td>
                </tr>
                <tr class="section-title">
                    <th colspan="2">NOMINAL PENDAPATAN PASANGAN CALON KONSUMEN ( KARYAWAN )</th>
                </tr>
                <tr>
                    <td width="40">Gaji Pokok</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->gaji_pokok_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Cycle Gaji Pokok</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->cycle_gaji_pokok_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Gaji Tambahan</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->gaji_tambahan_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Daftar Cicilan</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->daftar_cicilan_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr class="section-title">
                    <th colspan="2">DATA USAHA PASANGAN CALON KONSUMEN ( WIRAUSAHA )</th>
                </tr>
                <tr>
                    <td width="40">Nama Usaha</td>
                    <td>{{ $booking->konsumen->detail->nama_usaha_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Provinsi Usaha</td>
                    <td>{{ ($booking->konsumen->detail->province7)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kota Usaha</td>
                    <td>{{ ($booking->konsumen->detail->city7)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kecamatan Usaha</td>
                    <td>{{ ($booking->konsumen->detail->province7)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Kelurahan Usaha</td>
                    <td>{{ ($booking->konsumen->detail->city7)->name ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Alamat Usaha</td>
                    <td>{{ $booking->konsumen->detail->alamat_7 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Bidang Usaha</td>
                    <td>{{ $booking->konsumen->detail->bidang_wirausaha_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Lama Usaha</td>
                    <td>{{ $booking->konsumen->detail->lama_usaha_2 ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Legalitas Usaha</td>
                    <td>{{ $booking->konsumen->detail->legalitas_2 ?? '-' }}</td>
                </tr>
                <tr class="section-title">
                    <th colspan="2">NOMINAL PENDAPATAN PASANGAN CALON KONSUMEN ( WIRAUSAHA )</th>
                </tr>
                <tr>
                    <td width="40">Pendapatan Kotor</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->pendapatan_kotor_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Pendapatan Bersih</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->pendapatan_bersih_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Pendapatan Tambahan</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->pendapatan_tambahan_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
                <tr>
                    <td width="40">Daftar Cicilan</td>
                    <td>{{ 'Rp ' . number_format($booking->konsumen->detail->daftar_cicilan_wirausaha_2 ?? 0, 0, '.', ',') ?? '-' }}</td>
                </tr>
            </tbody>
        </table>
        @else
            <div class="alert alert-warning mt-4">Detail konsumen belum diisi.</div>
        @endif
    </div>
    <p class="small" style="margin-top: 24px;">
        Dokumen ini dihasilkan otomatis oleh sistem pada {{ \Illuminate\Support\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}.
    </p>
</body>
</html>
