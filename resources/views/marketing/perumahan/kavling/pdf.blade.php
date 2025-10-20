<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Pemesanan Rumah - {{ $booking->suratPemesananRumah->nomor_spr }}</title>    
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
            <td style="padding-right: 130px;">
                <h3 class="text-left"><strong>SURAT PEMESANAN RUMAH</strong></h3>
            </td>
            <td style="padding-top: 0px;">
                <p class="text-right">Tgl. {{ $tanggalSppHuman }}</p>
            </td>
        </tr>
    </table>
    <div style="padding-bottom: 25px;" class="text-left">No.  {{ $booking->suratPemesananRumah->nomor_spr }}</div>
    <div class="isi">
       Yang bertandatangan dibawah ini:
    </div>
    <div class="meta" style="margin-bottom: 15px;">
        <table>
            <tr>
                <td style="width: 100px;"><strong>NIK KTP</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $booking->konsumen->nik_konsumen ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 100px"><strong>Nama Lengkap</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $booking->konsumen->nama_konsumen ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 100px"><strong>Tempat/Tgl Lahir</strong></td>
                <td style="width: 10px;">:</td>
                <td></td>
            </tr>
            <tr>
                <td style="width: 100px"><strong>Jenis Kelamin</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $booking->konsumen->gender->nama }}</td>
            </tr>
            <tr>
                <td style="width: 100px"><strong>Alamat KTP</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $booking->konsumen->alamat_konsumen }}</td>
            </tr>
            <tr>
                <td style="width: 100px"><strong>No. HP</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $booking->konsumen->no_hp }}</td>
            </tr>
            <tr>
                <td style="width: 100px"><strong>Email</strong></td>
                <td style="width: 10px;">:</td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="isi">
        Dengan ini memesan untuk membeli sebidang kavling dengan rumah diatasnya di lokasi sebagai berikut: 
    </div>
    <div class="meta" style="margin-bottom: 15px;">
        <table>
            <tr>
                <td style="width: 100px"><strong>Perumahan</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $booking->kapling->cluster->nama_cluster ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 100px"><strong>Blok/Kavling No</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $booking->kapling->blok_kapling ?? '-' }}/{{ $booking->kapling->nomor_unit_kapling ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 100px"><strong>Luas Bangunan</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $booking->kapling->luas_bangunan . ' m2' ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 100px"><strong>Luas Tanah</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ $booking->kapling->luas_tanah . ' m2' ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 100px"><strong>Harga Jual</strong></td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($booking->kapling->harga_kapling ?? 0, 0, '.', ',') ?? '-' }}</td>
            </tr>
        </table>
    </div>
    <div class="isi">
        Pembelian akan dilakukan secara Cash dengan perincian sebagai berikut: <br>
       <div style="font-size: 14px;"><strong>A. Total Dibayar Dimuka</strong></div>
    </div>
    <div class="meta" style="margin-top: 0px;">
        @php
            $sumFields = [
                'booking_fee',
                'biaya_lainnya',
                'total_penjualan_cash',
                'uang_muka',
                'biaya_administrasi',
                'biaya_akad_kredit',
                'biaya_kelebihan_tanah',
                'biaya_penambahan_bangunan',
                'biaya_penambahan_fasilitas',
                'cicilan_cash',
            ];
            $grandTotal = 0;
            foreach ($sumFields as $f) {
                $grandTotal += (int)($costs->{$f} ?? 0);
            }
        @endphp
        <table>
            <tr>
                <td style="width: 5px;">1.</td>
                <td style="width: 165px;">Booking Fee</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->booking_fee ?? 0, 0, '.', ',') ?? '-' }}</td>
            </tr>
            <tr>
                <td style="width: 20px;">2.</td>
                <td style="width: 165px;">Biaya Lainnya</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->biaya_lainnya ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr>
            <tr>
                <td style="width: 20px;">3.</td>
                <td style="width: 165px;">Total Penjualan Cash</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->total_penjualan_cash ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr>
            <tr>
                <td style="width: 20px;">4.</td>
                <td style="width: 165px;">Uang Muka</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->uang_muka ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr>
            <tr>
                <td style="width: 20px;">5.</td>
                <td style="width: 165px;">Biaya Administrasi</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->biaya_administrasi ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr>
            <tr>
                <td style="width: 20px;">6.</td>
                <td style="width: 165px;">Biaya Akad Kredit</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->biaya_akad_kredit ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr>
            <tr>
                <td style="width: 20px;">7.</td>
                <td style="width: 165px;">Biaya Kelebihan Tanah</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->biaya_kelebihan_tanah ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr>
            <tr>
                <td style="width: 20px;">8.</td>
                <td style="width: 165px;">Biaya Penambahan Bangunan</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->biaya_penambahan_bangunan ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr>
            <tr>
                <td style="width: 20px;">9.</td>
                <td style="width: 165px;">Biaya Penambahan Fasilitas</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->biaya_penambahan_fasilitas ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr>
            {{-- <tr>
                <td style="width: 20px;">10.</td>
                <td style="width: 165px;">Penerimaan KPR</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->penerimaan_kpr ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr> --}}
            <tr>
                <td style="width: 20px;">11.</td>
                <td style="width: 165px;">Cicilan Cash</td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($costs->cicilan_cash ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr>
            <tr>
                <td style="width: 20px;"></td>
                <td style="width: 165px;"><i><strong>Jumlah Yang Harus Dibayar</strong></i></td>
                <td style="width: 10px;">:</td>
                <td>{{ 'Rp ' . number_format($grandTotal, 0, '.', ',') ?? 'Rp 0' }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <td style="width: 20px;"></td>
                <td style="width: 50px; vertical-align: top;">Terbilang</td>
                <td style="width: 10px; vertical-align: top;">:</td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="isi">
       <div style="font-size: 14px;"><strong>B. Detail Cicilan</strong></div>
    </div>
    <div class="meta" style="margin-bottom: 15px;">
        <table class="table table-bordered mb-0" id="DetailKonsumenList">
            <thead>
                <tr style="background-color: #f8f9fa !important;">
                    <th width="5">No.</th>
                    <th>Uraian Cicilan</th>
                    <th>Jumlah</th>
                    <th>Rencana Pembayaran</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <tr>
                    <td>1.</td>
                    <td>Total KPR / Pelunasan ke Bank</td>
                    <td class="text-right">{{ 'Rp ' . number_format($costs->penerimaan_kpr ?? 0, 0, '.', ',') ?? 'Rp 0' }}</td>
                    <td class="text-center">Bank</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="isi">
        <h4><strong>SYARAT DAN KETENTUAN</strong></h4>
    </div>
    <div class="meta">
        <table>
            <tr>
                <td style="width: 20px; vertical-align: top;">1.</td>
                <td>Booking Fee di bayarkan ketika sudah menentukan posisi unit</td>
            </tr>
            <tr>
                <td style="width: 20px; vertical-align: top;">2.</td>
                <td>Uang Muka / Dp dibayarkan ketika Dokumen persyaratan lengkap di serahkan ke Developer *( Maximal 2 Minggu Setelah Booking ).</td>
            </tr>
            <tr>
                <td style="width: 20px; vertical-align: top;">3.</td>
                <td>Biaya Proses Akad Kredit dan kelebihan tanah *( Bila ada ) di lunasi kepada Developer Setelah mendapatkan informasi permohonan KPR sudah di setujui oleh Pihak Bank ( SP3/SP3K )</td>
            </tr>
            <tr>
                <td style="width: 20px; vertical-align: top;">4.</td>
                <td>Apabila Permohonan KPR di tolak oleh pihak Bank, maka dana yang telah di setorkan kepada Developer akan di potong sebesar Rp 500.000 ( Lima Ratus Ribu Rupiah )</td>
            </tr>
            <tr>
                <td style="width: 20px; vertical-align: top;">5.</td>
                <td>Apabila Pemohon KPR mengundurkan diri karena alasan pribadi, maka dana yang telah di setorkan kepada Developer akan di potong sebesar 50%.</td>
            </tr>
            <tr>
                <td style="width: 20px; vertical-align: top;">6.</td>
                <td>Apabila pemohon KPR sulit bekerja sama dalam hal Administrasi dan pemenuhan dokumen yang di perlukan pihak Bank maka Developer berkewenangan untuk memutus sepihak, dan pemohon KPR di anggap mengundurkan diri</td>
            </tr>
            <tr>
                <td style="width: 20px; vertical-align: top;">7.</td>
                <td>Pemohon KPR yang sudah berjalan tidak bisa melakukan pengalihan nama kepada orang lain sebelum melakukan prosedur pengunduran diri terlebih dahulu.</td>
            </tr>
            <tr>
                <td style="width: 20px; vertical-align: top;">8.</td>
                <td>Apabila terjadi perubahan Bank pemberi KPR dan program KPR yang di sebabkan oleh adanya perubahan ketentuan Pemerintah / Bank, maka pemohon KPR harus Kooperatif dalam hal perubahan tsb</td>
            </tr>
            <tr>
                <td style="width: 20px; vertical-align: top;">9.</td>
                <td>Ketentuan lainnya yang belum di atur akan disampaikan kemudian</td>
            </tr>
        </table>
    </div>
    <div class="isi">
        Selain menyetujui semua keterangan diatas, saya/kami menyetujui sepenuhnya syarat-syarat dan ketentuan yang tercantum pada Pemesanan Rumah ini.
    </div>
    <p class="kecil text-right" style="margin-right: 15px; margin-top: 10px;"></p>
    <table style="width:100%; text-align:center;">
        <tr style="vertical-align: top;">
            <td>
                <p style="padding-bottom: 0px;">Mengetahui,</p>
                <p style="padding-bottom: 70px; font-size: 12px;">PT Anugrah Magello Nusantara</p>
                <p style="padding-bottom: 0;">_______________________</p>
                <p class="kecil"><i>{{ $disetujuiOleh ?? '' }}</i></p>
            </td>
            <td>
                <p style="padding-bottom: 0px;">{{ $booking->suratPemesananRumah->lokasi_pemesanan }}, {{ $tanggalSppHuman }}</p>
                <p style="padding-bottom: 70px; font-size: 12px;">Pemesan,</p>
                <p style="padding-bottom: 0;">_______________________</p>
                <p class="kecil"><i>{{ $booking->konsumen->nama_konsumen ?? '-' }}</i></p>
            </td>
        </tr>
    </table>
    <p class="small" style="margin-top: 24px;">
        Dokumen ini dihasilkan otomatis oleh sistem pada {{ \Illuminate\Support\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM Y') }}.
    </p>
</body>
</html>
