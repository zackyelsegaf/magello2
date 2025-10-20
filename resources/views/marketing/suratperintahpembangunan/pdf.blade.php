<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Perintah Pembangunan - {{ $spp->nomor_spp }}</title>    
    <style>
        body{ 
            font-family: sans-serif; 
            font-size: 12px; 
            margin: 8mm 8mm; 
            line-height: 1.45; 
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
            margin: 12px 0 16px; 
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
    @php
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
    @endphp
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
            <td style="padding-right: 130px;">
                <h3 class="text-left"><strong>SURAT PERINTAH PEMBANGUNAN</strong></h3>
            </td>
            <td style="padding-top: 0px;">
                <p class="text-right">Tgl. {{ $tanggalSppHuman }}</p>
            </td>
        </tr>
    </table>
    <div class="text-left">No.  {{ $spp->nomor_spp }}</div>
    <div class="meta">
        <table>
            <tr>
                <td style="width: 75px;"><strong>Kepada</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $dibuatOleh ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 75px;"><strong>Dari</strong></td>
                <td style="width: 10px;">:</td>
                <td>
                    {{ $instruksi ?? '-' }}
                </td>
            </tr>
            <tr>
                <td style="width: 75px;"><strong>Perihal</strong></td>
                <td style="width: 10px;">:</td>
                <td>
                    <u>Pembangunan Unit Rumah</u>
                </td>
            </tr>
        </table>
    </div>
    <div class="isi">
        Menunjuk perihal pada pokok surat, maka konsumen dengan detail dibawah ini :
    </div>
    <div class="meta">
        <table>
            <tr>
                <td style="width: 75px;"><strong>Konsumen</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $spp->nama_konsumen }}</td>
            </tr>
            <tr>
                <td style="width: 75px;"><strong>Kapling</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $kaplingHuman ?: '-' }}</td>
            </tr>
            <tr>
                <td style="width: 75px;"><strong>Tipe</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $luasBangunan . ' m²' ?: '-' . ' m²'}}</td>
            </tr>
            <tr>
                <td style="width: 75px;"><strong>Luas</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $luasTanah . ' m²' ?: '-' . ' m²'}}</td>
            </tr>
            <tr>
                <td style="width: 75px;"><strong>Catatan</strong></td>
                <td style="width: 10px;">:</td>
                <td>{!! nl2br(e($spp->catatan ?? 'Tidak ada catatan.')) !!}</td>
            </tr>
        </table>
    </div>
    <div class="isi">
        Mohon untuk segera dilaksanakan Pembangunan Unit Rumah sesuai dengan ketentuan yang berlaku.
    </div>
    <p class="kecil text-right" style="margin-right: 15px; margin-top: 10px;">Bandung, {{ $tanggalSppHuman }}</p>
    <table style="width:100%; text-align:center;">
        <tr style="vertical-align: top;">
            <td>
                <p style="padding-bottom: 70px;">Diterima Oleh,</p>
                <p style="padding-bottom: 0;">_______________________</p>
                {{-- <p class="kecil"><i>Penerima</i></p> --}}
            </td>
            <td>
                <p style="padding-bottom: 70px;">Disetujui Oleh,</p>
                <p style="padding-bottom: 0;">_______________________</p>
                <p class="kecil"><i>{{ $disetujuiOleh ?? '' }}</i></p>
            </td>
            <td>
                <p style="padding-bottom: 70px;">Dibuat Oleh,</p>
                <!-- {{-- <div class="kecil">Bandung, {{ now()->translatedFormat('d F Y') }}</div> --}} -->
                <p style="padding-bottom: 0;">_______________________</p>
                <p class="kecil"><i>{{ $dibuatOleh ?? '' }}</i></p>
            </td>
        </tr>
    </table>
    <p class="small" style="margin-top: 24px;">
        Dokumen ini dihasilkan otomatis oleh sistem pada {{ \Illuminate\Support\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}.
    </p>
</body>
</html>
