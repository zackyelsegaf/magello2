<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Akun;
use App\Models\TipeAkun;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataUangId = 1;

        // Ambil mapping nama -> tipe_id dari DB
        $tipeMap = TipeAkun::pluck('id', 'nama')->toArray();

        // === Akun Manual (Kas - Persediaan) ===
        $akunMap = [];

        $kas = Akun::create([
            'no_akun' => '11001',
            'nama_akun_indonesia' => 'Kas',
            'tipe_id' => $tipeMap['Kas/Bank'] ?? null,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);
        $akunMap['11001'] = $kas->id;

        Akun::create([
            'no_akun' => '11001.01',
            'nama_akun_indonesia' => 'Kas Manado - IDR',
            'tipe_id' => $tipeMap['Kas/Bank'] ?? null,
            'parent_id' => $kas->id,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);

        Akun::create([
            'no_akun' => '11001.02',
            'nama_akun_indonesia' => 'Kas - Kotamobagu -IDR',
            'tipe_id' => $tipeMap['Kas/Bank'] ?? null,
            'parent_id' => $kas->id,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);


        $bank = Akun::create([
            'no_akun' => '11002',
            'nama_akun_indonesia' => 'Bank',
            'tipe_id' => $tipeMap['Kas/Bank'] ?? null,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $akunMap['11002'] = $bank->id;

        $subBank = [
            '11002.01' => 'Bank BTN Manado - IDR',
            '11002.02' => 'Bank BTN Kotamobagu - IDR',
            '11002.03' => 'Bank BRI Manado - IDR',
            '11002.04' => 'Bank BRI Kotamobagu - IDR',
            '11002.05' => 'Bank BRI Tondano - IDR',
            '11002.06' => 'Bank BSI Manado - IDR',
            '11002.07' => 'Bank BSI Kotamobagu - IDR',
            '11002.08' => 'Bank BNI Manado - IDR',
            '11002.09' => 'Bank BNI Kotamobagu - IDR',
            '11002.10' => 'Bank Mandiri Manado - IDR',
        ];

        foreach ($subBank as $no => $nama) {
            Akun::create([
                'no_akun' => $no,
                'nama_akun_indonesia' => $nama,
                'tipe_id' => $tipeMap['Kas/Bank'] ?? null,
                'parent_id' => $bank->id,
                'mata_uang_id' => $mataUangId,
                'saldo_akun' => '0',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        $piutang = Akun::create([
            'no_akun' => '11003',
            'nama_akun_indonesia' => 'Piutang Dagang [Customer]',
            'tipe_id' => $tipeMap['Piutang Usaha'] ?? null,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        $akunMap['11003'] = $piutang->id;

        Akun::create([
            'no_akun' => '11003.01',
            'nama_akun_indonesia' => 'Piutang Dagang - IDR',
            'tipe_id' => $tipeMap['Piutang Usaha'] ?? null,
            'parent_id' => $piutang->id,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);

        Akun::create([
            'no_akun' => '11003.02',
            'nama_akun_indonesia' => 'Uang Muka Pembelian - IDR',
            'tipe_id' => $tipeMap['Piutang Usaha'] ?? null,
            'parent_id' => $piutang->id,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);

        $lain = Akun::create([
            'no_akun' => '11004',
            'nama_akun_indonesia' => 'Piutang Lain-lain',
            'tipe_id' => $tipeMap['Aktiva Lancar Lainnya'] ?? null,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);
        $akunMap['11004'] = $lain->id;

        Akun::create([
            'no_akun' => '11004.01',
            'nama_akun_indonesia' => 'Piutang Direksi',
            'tipe_id' => $tipeMap['Aktiva Lancar Lainnya'] ?? null,
            'parent_id' => $lain->id,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);

        Akun::create([
            'no_akun' => '11004.02',
            'nama_akun_indonesia' => 'Piutang Karyawan',
            'tipe_id' => $tipeMap['Aktiva Lancar Lainnya'] ?? null,
            'parent_id' => $lain->id,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);

        Akun::create([
            'no_akun' => '11004.99',
            'nama_akun_indonesia' => 'Piutang Lain-lain',
            'tipe_id' => $tipeMap['Aktiva Lancar Lainnya'] ?? null,
            'parent_id' => $lain->id,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);

        $cadangan = Akun::create([
            'no_akun' => '11005',
            'nama_akun_indonesia' => 'Cadangan Kerugian Piutang',
            'tipe_id' => $tipeMap['Piutang Usaha'] ?? null,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);
        $akunMap['11005'] = $cadangan->id;

        Akun::create([
            'no_akun' => '11005.01',
            'nama_akun_indonesia' => 'Cadangan Kerugian Piutang Dagang IDR',
            'tipe_id' => $tipeMap['Piutang Usaha'] ?? null,
            'parent_id' => $cadangan->id,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);

        Akun::create([
            'no_akun' => '11005.02',
            'nama_akun_indonesia' => 'Cadangan Kerugian Piutang Non Dagang IDR',
            'tipe_id' => $tipeMap['Piutang Usaha'] ?? null,
            'parent_id' => $cadangan->id,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);

        $persediaan = Akun::create([
            'no_akun' => '11006',
            'nama_akun_indonesia' => 'Persediaan',
            'tipe_id' => $tipeMap['Persediaan'] ?? null,
            'mata_uang_id' => $mataUangId,
            'saldo_akun' => '0',
        ]);
        $akunMap['11006'] = $persediaan->id;

        $subPersediaan = [
            '11006.01' => 'Persediaan Bahan Baku',
            '11006.02' => 'Persediaan Bahan Baku Pembantu',
            '11006.03' => 'Persediaan Bahan Setengah Jadi',
            '11006.04' => 'Persediaan Barang Jadi',
            '11006.05' => 'Persediaan Barang Terkirim',
            '11006.06' => 'Persediaan Dalam Proses [WIP]',
            '11006.07' => 'Persediaan Pesanan [Job Costing]',
            '11006.08' => 'Persediaan Aksesoris',
            '11006.10' => 'Persediaan Lain-lain',
            '11006.11' => 'Persediaan Barang Rusak',
            '11006.12' => 'Persediaan Barang Konsinyasi',
        ];

        foreach ($subPersediaan as $no => $nama) {
            Akun::create([
                'no_akun' => $no,
                'nama_akun_indonesia' => $nama,
                'tipe_id' => $tipeMap['Persediaan'] ?? null,
                'parent_id' => $persediaan->id,
                'mata_uang_id' => $mataUangId,
                'saldo_akun' => '0',
            ]);
        }

        // === Akun Lanjutan (otomatis berdasarkan array) ===
        $akunData = [
            ['11004', 'Piutang Lain-lain', 'Aktiva Lancar Lainnya', null],
            ['11004.01', 'Piutang Direksi', 'Aktiva Lancar Lainnya', '11004'],
            ['11004.02', 'Piutang Karyawan', 'Aktiva Lancar Lainnya', '11004'],
            ['11004.99', 'Piutang Lain-lain', 'Aktiva Lancar Lainnya', '11004'],

            ['11007', 'Pajak Dibayar Dimuka', 'Aktiva Lancar Lainnya', null],
            ['11007.01', 'PPh Masukan', 'Aktiva Lancar Lainnya', '11007'],
            ['11007.02', 'PPh 22 (Import)', 'Aktiva Lancar Lainnya', '11007'],
            ['11007.03', 'PPh 23 Final', 'Aktiva Lancar Lainnya', '11007'],
            ['11007.04', 'Angsuran PPh Pasal 25', 'Aktiva Lancar Lainnya', '11007'],

            ['11008', 'Biaya Dibayar Dimuka', 'Aktiva Lancar Lainnya', null],
            ['11008.01', 'Sewa Dibayar Dimuka', 'Aktiva Lancar Lainnya', '11008'],
            ['11008.02', 'Asuransi Dibayar Dimuka', 'Aktiva Lancar Lainnya', '11008'],

            ['11009', 'Akun Silang', 'Aktiva Lancar Lainnya', null, '0'],
            ['11070.1', 'PPN Masukan', 'Aktiva Lancar Lainnya', null],
            ['11070.2', 'PPh 23 Pembelian', 'Aktiva Lancar Lainnya', null],

            ['11100', 'Transaksi Aktiva Tetap', 'Aktiva Lancar Lainnya', null],
            ['11111', 'Perlengkapan', 'Aktiva Lancar Lainnya', null],
            ['11111.01', 'Perlengkapan Kantor', 'Aktiva Lancar Lainnya', '11111'],
            ['11111.02', 'Perlengkapan Jasa', 'Aktiva Lancar Lainnya', '11111'],
            ['11112', 'PPN Lebih/Kurang Bayar', 'Aktiva Lancar Lainnya', null],

            ['12001', 'Aktiva Tetap', 'Aktiva Tetap', null],
            ['12001.01', 'Tanah', 'Aktiva Tetap', '12001'],
            ['12001.02', 'Bangunan', 'Aktiva Tetap', '12001'],
            ['12001.03', 'Kendaraan', 'Aktiva Tetap', '12001'],
            ['12001.04', 'Peralatan & Furniture Kantor', 'Aktiva Tetap', '12001'],
            ['12001.05', 'Peralatan Proyek', 'Aktiva Tetap', '12001'],

            ['12002', 'Aktiva Tetap Tak Berwujud', 'Aktiva Tetap', null],
            ['12002.01', 'Merk Dagang', 'Aktiva Tetap', '12002'],
            ['12002.02', 'Hak Cipta', 'Aktiva Tetap', '12002'],
            ['12002.03', 'Goodwill', 'Aktiva Tetap', '12002'],

            ['12003', 'Akumulasi Penyusutan & Amortisasi', 'Akumulasi Penyusutan', null],
            ['12003.01', 'Akumulasi Peny. Bangunan', 'Akumulasi Penyusutan', '12003'],
            ['12003.02', 'Akumulasi Peny. Kendaraan', 'Akumulasi Penyusutan', '12003'],
            ['12003.03', 'Akumulasi Peny. Mesin & Peralatan', 'Akumulasi Penyusutan', '12003'],
            ['12003.04', 'Akumulasi Peny. Peralatan', 'Akumulasi Penyusutan', '12003'],

            ['13001', 'Investasi Saham', 'Aktiva Lancar Lainnya', null],

            ['14001', 'Aktiva Lain-lain', 'Aktiva Lancar Lainnya', null],
            ['14001.01', 'Piutang Pemegang Saham', 'Aktiva Lancar Lainnya', '14001'],
            ['14001.02', 'Pendapatan Yang Akan Ditagih', 'Aktiva Lancar Lainnya', '14001'],
            ['14001.03', 'Aktiva Pajak Tangguhan', 'Aktiva Lancar Lainnya', '14001'],

            ['210301', 'PPN Keluaran', 'Aktiva Lancar Lainnya', null, '0'],
            ['210302', 'PPH 23 Penjualan', 'Aktiva Lancar Lainnya', null],

            ['21001.01', 'Hutang Dagang [Vendor]', 'Hutang Usaha', null],
            ['21001.01.01', 'Biaya BPHTB User Akad KPR Bank', 'Hutang Usaha', '21001.01'],
            ['21001.01.02', 'Biaya Administrasi Akad KPR Bank User', 'Hutang Usaha', '21001.01'],
            ['21001.01.03', 'Biaya Blokir Angsuran KPR Bank User', 'Hutang Usaha', '21001.01'],
            ['21001.01.04', 'Hutang Dagang - IDR', 'Hutang Usaha', '21001.01'],
            ['21001.02', 'Uang Muka Penjualan - IDR', 'Hutang Usaha', null],

            ['21002', 'Hutang Lain-lain', 'Hutang Lancar Lainnya', null],
            ['21002.01', 'Hutang Direksi & Karyawan', 'Hutang Lancar Lainnya', '21002'],
            ['21002.02', 'Hutang Bunga', 'Hutang Lancar Lainnya', '21002'],
            ['21002.03', 'Hutang Pajak Tangguhan', 'Hutang Lancar Lainnya', '21002'],
            ['21002.04', 'Hutang Deviden', 'Hutang Lancar Lainnya', '21002'],
            ['21002.99', 'Hutang Lain-lain', 'Hutang Lancar Lainnya', '21002'],

            ['21003', 'Hutang Pajak', 'Hutang Lancar Lainnya', null],
            ['21003.01', 'PPn Keluaran', 'Hutang Lancar Lainnya', '21003'],
            ['21003.02', 'PPn Barang Mewah (PPnBM)', 'Hutang Lancar Lainnya', '21003'],
            ['21003.03', 'PPh Pasal 21 Karyawan', 'Hutang Lancar Lainnya', '21003'],
            ['21003.04', 'PPh Pasal 21 Pihak Luar', 'Hutang Lancar Lainnya', '21003'],
            ['21003.05', 'PPh Pasal 22', 'Hutang Lancar Lainnya', '21003'],
            ['21003.06', 'PPh Pasal 23 Final', 'Hutang Lancar Lainnya', '21003'],
            ['21003.07', 'PPh Pasal 25', 'Hutang Lancar Lainnya', '21003'],
            ['21003.08', 'PPh Pasal 26', 'Hutang Lancar Lainnya', '21003'],
            ['21003.09', 'PPh Pasal 29', 'Hutang Lancar Lainnya', '21003'],

            ['21004', 'Biaya Yang Masih Harus Dibayar', 'Hutang Lancar Lainnya', null],
            ['21004.01', 'Bunga Yang Masih Harus Dibayar', 'Hutang Lancar Lainnya', '21004'],
            ['21004.02', 'Gaji Yang Masih Harus Dibayar', 'Hutang Lancar Lainnya', '21004'],

            ['21005', 'Pendapatan Diterima Dimuka', 'Hutang Lancar Lainnya', null],

            ['21006', 'Hutang Bank', 'Hutang Lancar Lainnya', null],
            ['21006.01', 'Hutang Lancar Bank', 'Hutang Lancar Lainnya', '21006'],
            ['21006.01.01', 'Hutang Bank - Bank BTN Manado - IDR', 'Hutang Lancar Lainnya', '21006.01'],
            ['21006.01.02', 'Hutang Bank - Bank BTN Kotamobagu - IDR', 'Hutang Lancar Lainnya', '21006.01'],
            ['21006.01.03', 'Hutang Bank - Bank BRI Manado - IDR', 'Hutang Lancar Lainnya', '21006.01'],
            ['21006.01.04', 'Hutang Bank - Bank BRI Tondano - IDR', 'Hutang Lancar Lainnya', '21006.01'],

            ['21006.02', 'Hutang Leasing', 'Hutang Lancar Lainnya', '21006'],
            ['21006.02.01', 'Hutang Leasing - BRI Manado Leasing', 'Hutang Lancar Lainnya', '21006.02'],
            ['21006.02.02', 'Hutang Leasing - Maybank Manado Leasing', 'Hutang Lancar Lainnya', '21006.02'],

            ['21008', 'Penerimaan Barang Belum Tertagih', 'Hutang Lancar Lainnya', null],

            ['31001', 'OPENING BALANCE EQUITY', 'Ekuitas', null],
            ['31002', 'Modal Saham', 'Ekuitas', null],
            ['31003', 'Modal Ditempatkan', 'Ekuitas', null],
            ['31004', 'Modal Disetor', 'Ekuitas', null],

            ['31005', 'Agio/Disagio Saham', 'Ekuitas', null],
            ['31005.01', 'Agio Saham', 'Ekuitas', '31005'],
            ['31005.02', 'Disagio Saham', 'Ekuitas', '31005'],

            ['31006', 'Deviden', 'Ekuitas', null],
            ['32001', 'Laba Ditahan', 'Ekuitas', null],

            ['41001', 'Penjualan Usaha', 'Pendapatan', null],
            ['41001.01', 'Penjualan Rumah Subsidi', 'Pendapatan', '41001'],
            ['41001.02', 'Penjualan Komersil', 'Pendapatan', '41001'],
            ['41001.03', 'Penjualan Lain-lain', 'Pendapatan', '41001'],
            ['41001.04', 'Penjualan Barang Rusak', 'Pendapatan', '41001'],
            ['41001.05', 'UTJ (Uang Tanda Jadi) Rumah - Boking Fee Rumah', 'Pendapatan', '41001'],
            ['41001.06', 'Uang Muka Rumah Posisi Depan', 'Pendapatan', '41001'],
            ['41001.07', 'Uang Muka Rumah Posisi Tengah', 'Pendapatan', '41001'],
            ['41001.08', 'Uang Muka Rumah Posisi Belakang', 'Pendapatan', '41001'],
            ['41001.09', 'Pembayaran Air GML', 'Pendapatan', '41001'],

            ['41002', 'Retur Penjualan', 'Pendapatan', null],
            ['41002.01', 'Retur Penjualan Rumah Subsidi', 'Pendapatan', '41002'],
            ['41002.02', 'Retur Penjualan Rumah Komersil', 'Pendapatan', '41002'],
            ['41002.03', 'Retur Penjualan Lain-lain', 'Pendapatan', '41002'],
            ['41002.04', 'Retur Penjualan Barang Rusak', 'Pendapatan', '41002'],

            ['41003', 'Diskon Penjualan', 'Pendapatan', null],
            ['41003.01', 'Diskon Penjualan Faktur', 'Pendapatan', '41003'],
            ['41003.02', 'Diskon Penjualan Barang', 'Pendapatan', '41003'],

            ['41004', 'Pendapatan Jasa', 'Pendapatan', null],

            ['51001', 'Harga Pokok Penjualan', 'Harga Pokok Penjualan', null],
            ['51001.01', 'HPP Rumah', 'Harga Pokok Penjualan', '51001'],
            ['51001.02', 'HPP Lain-lain', 'Harga Pokok Penjualan', '51001'],
            ['51001.03', 'HPP Barang Rusak', 'Harga Pokok Penjualan', '51001'],
            ['51001.04', 'Potongan Pembelian', 'Harga Pokok Penjualan', '51001'],
            ['51001.05', 'Biaya Angkut Pembelian', 'Harga Pokok Penjualan', '51001'],
            ['51001.06', 'Variance', 'Harga Pokok Penjualan', '51001'],
            ['51001.07', 'Gratis Biaya BPHTB Akad KPR User', 'Harga Pokok Penjualan', '51001'],
            ['51001.08', 'Gratis Biaya Administrasi Akad KPR Bank', 'Harga Pokok Penjualan', '51001'],
            ['51001.09', 'Gratis Biaya Notaris Akad KPR Bank', 'Harga Pokok Penjualan', '51001'],
            ['51001.10', 'Gratis Biaya Blokir Angsuran Akad KPR Bank', 'Harga Pokok Penjualan', '51001'],
            ['51001.11', 'Bonus Peralatan Rumah Tangga Akad KPR Bank', 'Harga Pokok Penjualan', '51001'],

            ['51002', 'Biaya Buruh', 'Harga Pokok Penjualan', null],
            ['51002.01', 'Upah Tukang', 'Harga Pokok Penjualan', '51002'],
            ['51002.02', 'Lembur', 'Harga Pokok Penjualan', '51002'],
            ['51002.03', 'THR', 'Harga Pokok Penjualan', '51002'],
            ['51002.04', 'Bonus', 'Harga Pokok Penjualan', '51002'],
            ['51002.05', 'Tunjangan Pengobatan', 'Harga Pokok Penjualan', '51002'],
            ['51002.06', 'Tunjangan Transportasi', 'Harga Pokok Penjualan', '51002'],
            ['51002.07', 'Tunjangan Makan', 'Harga Pokok Penjualan', '51002'],
            ['51002.08', 'Tunjangan PPh ps.21', 'Harga Pokok Penjualan', '51002'],

            ['51003', 'Biaya Overhead', 'Harga Pokok Penjualan', null],
            ['51003.01', 'Biaya Angkutkan Kantor', 'Harga Pokok Penjualan', '51003'],
            ['51003.02', 'Biaya Listrik/Air kantor', 'Harga Pokok Penjualan', '51003'],
            ['51003.03', 'Biaya Telepon/Fax Kantor', 'Harga Pokok Penjualan', '51003'],
            ['51003.04', 'Biaya Pos/Kurir', 'Harga Pokok Penjualan', '51003'],
            ['51003.05', 'Biaya Seragam Kantor', 'Harga Pokok Penjualan', '51003'],
            ['51003.06', 'Biaya Asuransi Kantor', 'Harga Pokok Penjualan', '51003'],
            ['51003.07', 'Biaya Pajak Bumi Bangunan Kantor', 'Harga Pokok Penjualan', '51003'],
            ['51003.08', 'Biaya Keamanan kantor', 'Harga Pokok Penjualan', '51003'],

            ['51003.09.01', 'Biaya Penyusutan Bangunan Kantor', 'Harga Pokok Penjualan', '51003'],
            ['51003.09.02', 'Biaya Penyusutan Kendaraan Kantor', 'Harga Pokok Penjualan', '51003'],
            ['51003.09.03', 'Biaya Penyusutan Mesin & Peralatan Kantor', 'Harga Pokok Penjualan', '51003'],

            ['51003.10', 'Biaya Kendaraan/Transport', 'Harga Pokok Penjualan', '51003'],
            ['51003.11', 'Biaya Bahan Bakar/Parkir', 'Harga Pokok Penjualan', '51003'],
            ['51003.12', 'Biaya Surat/Pajak Kendaraan', 'Harga Pokok Penjualan', '51003'],
            ['51003.13', 'Biaya Pemeliharaan/Perbaikan', 'Harga Pokok Penjualan', '51003'],
            ['51003.99', 'Biaya Lain-lain Kantor', 'Harga Pokok Penjualan', '51003'],

            ['61000', 'Biaya Sales & Marketing', 'Beban', null],
            ['61000.01', 'Biaya Jamuan', 'Beban', '61000'],
            ['61000.02', 'Biaya Hadiah', 'Beban', '61000'],
            ['61000.03', 'Biaya Sumbangan', 'Beban', '61000'],
            ['61000.04', 'Biaya Representasi', 'Beban', '61000'],
            ['61000.05', 'Biaya Promosi & Iklan', 'Beban', '61000'],
            ['61000.06', 'Biaya Fee & Komisi', 'Beban', '61000'],
            ['61000.07', 'Biaya Sample Barang', 'Beban', '61000'],
            ['61000.08', 'Biaya Sales Lain-lain', 'Beban', '61000'],

            ['62000', 'Biaya Administrasi & Umum', 'Beban', null],
            ['62000.01', 'Biaya Gaji Karyawan Kantor', 'Beban', '62000'],
            ['62000.02', 'Biaya Lembur', 'Beban', '62000'],
            ['62000.03', 'Biaya THR', 'Beban', '62000'],
            ['62000.04', 'Biaya Bonus', 'Beban', '62000'],
            ['62000.05', 'Biaya Tunjangan Pengobatan', 'Beban', '62000'],
            ['62000.06', 'Biaya Tunjangan Transportasi', 'Beban', '62000'],
            ['62000.07', 'Biaya Tunjangan Makan', 'Beban', '62000'],
            ['62000.08', 'Biaya Tunjangan PPh ps.21', 'Beban', '62000'],

            ['62000.09', 'Biaya Perjalanan Dinas', 'Beban', '62000'],
            ['62000.09.01', 'Biaya Ticket & Airport Tax', 'Beban', '62000.09'],
            ['62000.09.02', 'Biaya Fiskal Luar Negeri', 'Beban', '62000.09'],
            ['62000.09.03', 'Biaya Visa/Paspor', 'Beban', '62000.09'],
            ['62000.09.04', 'Biaya Hotel', 'Beban', '62000.09'],
            ['62000.09.05', 'Biaya Transport Lokal', 'Beban', '62000.09'],
            ['62000.09.06', 'Biaya Makan & Minum', 'Beban', '62000.09'],
            ['62000.09.07', 'Biaya Uang Saku', 'Beban', '62000.09'],
            ['62000.09.08', 'Biaya Komunikasi', 'Beban', '62000.09'],

            ['62000.10', 'Biaya Kendaraan/Transport', 'Beban', '62000'],
            ['62000.10.01', 'Biaya Bahan Bakar / Parkir', 'Beban', '62000.10'],
            ['62000.10.02', 'Biaya Surat/Pajak Kendaraan', 'Beban', '62000.10'],
            ['62000.10.03', 'Biaya Pemeliharaan/Perbaikan', 'Beban', '62000.10'],
            ['62000.10.04', 'Biaya Asuransi Kendaraan', 'Beban', '62000.10'],
            ['62000.10.99', 'Biaya Kendaraan/Transport Lain-lain', 'Beban', '62000.10'],

            ['62000.11', 'Biaya Kantor', 'Beban', '62000'],
            ['62000.11.01', 'Biaya Alat Tulis Kantor', 'Beban', '62000.11'],
            ['62000.11.02', 'Biaya Perlengkapan Kantor', 'Beban', '62000.11'],
            ['62000.11.03', 'Biaya Photocopy', 'Beban', '62000.11'],
            ['62000.11.04', 'Biaya Telepon/Fax Kantor', 'Beban', '62000.11'],
            ['62000.11.05', 'Biaya Pos/Kurir', 'Beban', '62000.11'],
            ['62000.11.06', 'Biaya Seragam', 'Beban', '62000.11'],
            ['62000.11.07', 'Biaya Listrik/Air', 'Beban', '62000.11'],
            ['62000.11.08', 'Biaya Sewa Kantor', 'Beban', '62000.11'],
            ['62000.11.09', 'Biaya Asuransi', 'Beban', '62000.11'],
            ['62000.11.10', 'Biaya Pajak Bumi Bangunan Kantor', 'Beban', '62000.11'],
            ['62000.11.11', 'Biaya Sanksi/Denda pajak', 'Beban', '62000.11'],
            ['62000.11.12', 'Biaya Keamanan Kantor', 'Beban', '62000.11'],

            ['62000.12', 'Biaya Pembinaan Pegawai', 'Beban', '62000'],
            ['62000.12.01', 'Biaya Beasiswa', 'Beban', '62000.12'],
            ['62000.12.02', 'Biaya Penelitian', 'Beban', '62000.12'],
            ['62000.12.03', 'Biaya Jasa Konsultan', 'Beban', '62000.12'],
            ['62000.12.04', 'Biaya Seminar/Kursus', 'Beban', '62000.12'],
            ['62000.12.05', 'Biaya Olahraga/Rekreasi', 'Beban', '62000.12'],

            ['62000.13', 'Biaya Penyusutan / Amortisasi', 'Beban', '62000'],
            ['62000.13.01', 'Biaya Penyusutan Bangunan', 'Beban', '62000.13'],
            ['62000.13.02', 'Biaya Penyusutan Kendaraan', 'Beban', '62000.13'],
            ['62000.13.03', 'Biaya Penyusutan Peralatan', 'Beban', '62000.13'],
            ['62000.13.04', 'Biaya Amortisasi Aktiva Tak Berwujud', 'Beban', '62000.13'],

            ['62000.14', 'Biaya Perakitan', 'Beban', '62000'],
            ['62000.15', 'Biaya Potong', 'Beban', '62000'],
            ['62000.16', 'Biaya Lain-lain', 'Beban', '62000'],

            ['7100', 'Laba/Rugi Terealisir', 'Beban', null],
            ['7100.01', 'Laba/Rugi Terealisir IDR', 'Beban', '7100'],

            ['71000', 'Biaya Non Operasional', 'Beban Lainnya', null],
            ['71000.01', 'Biaya Bunga Bank', 'Beban Lainnya', '71000'],
            ['71000.02', 'Biaya Bunga Leasing', 'Beban Lainnya', '71000'],
            ['71000.03', 'Biaya Administrasi Bank', 'Beban Lainnya', '71000'],
            ['71000.04', 'Kerugian Piutang', 'Beban Lainnya', '71000'],
            ['71000.05', 'Koreksi Rugi Tahun Lalu', 'Beban Lainnya', '71000'],
            ['71000.06', 'Rugi/Laba Revaluasi Aktiva Tetap', 'Beban Lainnya', '71000'],
            ['71000.07', 'Rugi/Laba Terealisasi Selisih Kurs', 'Beban Lainnya', '71000'],
            ['71000.08', 'Rugi/Laba Tak Terealisasi Selisih Kurs', 'Beban Lainnya', '71000'],
            ['71000.99', 'Biaya Lain-lain Non-Operasional', 'Beban Lainnya', '71000'],

            ['7200', 'Laba/Rugi Belum Terealisir', 'Beban', null],
            ['7200.01', 'Laba/Rugi Belum Terealisir IDR', 'Beban', '7200'],

            ['81000', 'Pendapatan Lain-lain', 'Pendapatan Lainnya', null],
            ['81000.01', 'Pendapatan Bunga', 'Pendapatan Lainnya', '81000'],
            ['81000.01.01', 'Pendapat Bunga - Bank', 'Pendapatan Lainnya', '81000.01'],
            ['81000.01.02', 'Pendapat Bunga - Deposito', 'Pendapatan Lainnya', '81000.01'],
            ['81000.01.03', 'Pendapat Bunga - Piutang Dagang', 'Pendapatan Lainnya', '81000.01'],
            ['81000.01.04', 'Pendapat Bunga - Piutang Non Dagang', 'Pendapatan Lainnya', '81000.01'],
            ['81000.02', 'Laba/Rugi Penjualan Aktiva Tetap', 'Pendapatan Lainnya', '81000'],
            ['81000.03', 'Laba/Rugi Selisih Kurs', 'Pendapatan Lainnya', '81000'],
            ['81000.04', 'Deviden/Bagian Laba (Penyertaan Modal)', 'Pendapatan Lainnya', '81000'],
            ['81000.05', 'Koreksi Laba Tahun Sebelumnya', 'Pendapatan Lainnya', '81000'],
            ['81000.06', 'Bantuan/Sumbangan/Zakat/Hibah', 'Pendapatan Lainnya', '81000'],
            ['81000.99', 'Pendapatan Lain-lain', 'Pendapatan Lainnya', '81000'],

            ['90000', 'Pajak Penghasilan', 'Beban Lainnya', null],
            ['90000.01', 'Pajak Penghasilan Badan', 'Beban Lainnya', '90000'],
            ['90000.02', 'Pajak Penghasilan Final PPh 23', 'Beban Lainnya', '90000'],

            ['9998', 'Barang Dalam Perjalanan', 'Aktiva Lancar Lainnya', null],
            ['9999', 'Barang Dalam Perjalanan', 'Aktiva Lancar Lainnya', null],
        ];


        foreach ($akunData as $row) {
            [$noAkun, $namaAkun, $tipeNama, $parentNoAkun, $saldo] = array_pad($row, 5, '0');

            $tipeId = $tipeMap[$tipeNama] ?? null;
            $parentId = $parentNoAkun ? ($akunMap[$parentNoAkun] ?? null) : null;

            $akun = Akun::create([
                'no_akun' => $noAkun,
                'nama_akun_indonesia' => $namaAkun,
                'tipe_id' => $tipeId,
                'parent_id' => $parentId,
                'mata_uang_id' => $mataUangId,
                'saldo_akun' => $saldo,
            ]);

            $akunMap[$noAkun] = $akun->id;
        }
    }
}
