<?php

namespace Database\Seeders;

use App\Models\TipePembayaran;
use Illuminate\Database\Seeder;
use App\Models\KategoriPembayaran;
use App\Models\MasterBiayaKonsumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterBiayaKonsumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = KategoriPembayaran::where('slug', 'biaya')->first();

        $tipeMapping = [
            'KPR' => 'kreditkpr',
            'Cash Keras' => 'tunai',
            'Cash Bertahap' => 'tunai-bertahap',
        ];

        $data = [
            ['nama' => 'Booking Fee', 'tipe' => 'Cash Keras'],
            ['nama' => 'Booking Fee', 'tipe' => 'KPR'],
            ['nama' => 'Booking Fee', 'tipe' => 'Cash Bertahap'],
            ['nama' => 'Uang Muka', 'tipe' => 'KPR'],
            ['nama' => 'Biaya Akad Kredit', 'tipe' => 'KPR'],
            ['nama' => 'Biaya Kelebihan Tanah', 'tipe' => 'KPR'],
            ['nama' => 'Biaya Penambahan Bangunan', 'tipe' => 'KPR'],
            ['nama' => 'Biaya Lainnya', 'tipe' => 'KPR'],
            ['nama' => 'Biaya Administrasi', 'tipe' => 'Cash Keras'],
            ['nama' => 'Uang Muka', 'tipe' => 'Cash Keras'],
            ['nama' => 'Biaya Kelebihan Tanah', 'tipe' => 'Cash Keras'],
            ['nama' => 'Biaya Penambahan Bangunan', 'tipe' => 'Cash Keras'],
            ['nama' => 'Biaya Lainnya', 'tipe' => 'Cash Keras'],
            ['nama' => 'Uang Muka', 'tipe' => 'Cash Bertahap'],
            ['nama' => 'Biaya Kelebihan Tanah', 'tipe' => 'Cash Bertahap'],
            ['nama' => 'Biaya Penambahan Bangunan', 'tipe' => 'Cash Bertahap'],
            ['nama' => 'Biaya Lainnya', 'tipe' => 'Cash Bertahap'],
            ['nama' => 'Penerimaan KPR dari Bank', 'tipe' => 'KPR'],
            ['nama' => 'Cicilan Cash (Bertahap)', 'tipe' => 'Cash Bertahap'],
            ['nama' => 'Total Penjualan Cash', 'tipe' => 'Cash Keras'],
            ['nama' => 'Biaya Penambahan Fasilitas', 'tipe' => 'KPR'],
            ['nama' => 'Biaya Administrasi', 'tipe' => 'Cash Bertahap'],
            ['nama' => 'Diskon', 'tipe' => 'KPR'],
            ['nama' => 'Diskon', 'tipe' => 'Cash Keras'],
            ['nama' => 'Diskon', 'tipe' => 'Cash Bertahap'],
        ];

        foreach ($data as $item) {
            $tipe = TipePembayaran::where('slug', $tipeMapping[$item['tipe']] ?? null)->first();

            MasterBiayaKonsumen::updateOrCreate(
                [
                    'nama' => $item['nama'],
                    'tipe_pembayaran_id' => $tipe?->id,
                    'kategori_pembayaran_id' => $kategori?->id,
                ],
                [
                    'akun_pembayaran_kustomer_debit' => null,
                    'akun_pembayaran_kustomer_kredit' => null,
                    'akun_piutang_debit' => null,
                    'akun_piutang_kredit' => null,
                    'akun_closing_unit_debit' => null,
                    'akun_closing_unit_kredit' => null,
                ]
            );
        }
    }
}
