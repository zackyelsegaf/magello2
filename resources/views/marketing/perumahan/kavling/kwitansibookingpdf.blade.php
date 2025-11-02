<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Invoice - {{ $booking->nomor_referensi }}</title>    
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
            border: 1px solid black; 
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
        .meta{ 
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

        .padding-default{
            padding: 15px;
        }

        .line-2{ 
            border-bottom: 0.5px solid black; 
            margin: 0;
            padding: 0;
        }

        td{
            padding-bottom: 8px;
        }

        .padding-small{
            padding-bottom: 8px;
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
    <div class="line padding-default">
        <table style="width:100%; text-align:center;">
            <tr>
                <td>
                    <img class="imageku" src="{{ public_path('assets/img/logo_EA7.svg') }}">
                </td>
                <td class="padding-small">
                    <h3 class="text-right base-color">Kwitansi</h3>
                    <p class="text-right kecil-1 base-color"><strong>Tanda Bukti Pembayaran Unit</strong></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h3 class="text-center base-color">No. {{ $booking->nomor_referensi }}</h3>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 150px"><strong>Tanggal</strong></td>
                <td style="width: 10px;">:</td>
                <td style="width: 440px;" class="line-2">{{ $tanggalSppHuman ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 150px"><strong>Telah Diterima Dari</strong></td>
                <td style="width: 10px;">:</td>
                <td style="width: 440px;" class="line-2">{{ $booking->booking->konsumen->nama_1 ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 150px"><strong>Sejumlah Uang</strong></td>
                <td style="width: 10px;">:</td>
                <td style="width: 440px;" class="line-2">{{ 'Rp ' . number_format($booking->nominal_pembayaran ?? 0, 0, '.', ',') ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 150px"><strong>Terbilang</strong></td>
                <td style="width: 10px;">:</td>
                <td style="width: 440px;" class="line-2"></td>
            </tr>
            <tr>
                <td style="width: 150px"><strong>Untuk Pembayaran</strong></td>
                <td style="width: 10px;">:</td>
                <td style="width: 440px;" class="line-2">{{ $booking->jenis->nama }} Di {{ $booking->booking->kapling->cluster->nama_cluster ?? '-' }} {{ $booking->booking->kapling->blok_kapling ?? '-' }}/{{ $booking->booking->kapling->nomor_unit_kapling ?? '-' }}</td>
            </tr>
        </table>
    </div>
    
    <p class="small" style="margin-top: 24px;">
        Dokumen ini dihasilkan otomatis oleh sistem pada {{ \Illuminate\Support\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}.
    </p>
</body>
</html>
