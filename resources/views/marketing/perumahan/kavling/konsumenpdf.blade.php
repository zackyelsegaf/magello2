<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Konsumen - {{ $booking->konsumen->nama_konsumen ?? '-' }}</title>    
    <style>
        body{ 
            font-family: sans-serif; 
            font-size: 12px; 
            margin: 8mm 8mm; 
            line-height: 1.45; 
        }
        #DetailKonsumenList th,
        #DetailKonsumenList td {
            padding: 5px 10px !important;
            font-size: 13px;
            border: 1.5px solid #adb7be;
            vertical-align: middle;
        }
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
        <table class="table table-bordered mb-0" id="DetailKonsumenList">
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
                    <td>{{ $booking->kapling->cluster->nama_cluster ?? '-' }}</td>
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
                    <td>{{ $booking->konsumen->nama_konsumen ?? '-' }}</td>
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
        </table>
    </div>
    <p class="small" style="margin-top: 24px;">
        Dokumen ini dihasilkan otomatis oleh sistem pada {{ \Illuminate\Support\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}.
    </p>
</body>
</html>
