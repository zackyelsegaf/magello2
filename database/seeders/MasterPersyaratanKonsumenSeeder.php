<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use App\Models\TipePembayaran;
use Illuminate\Database\Seeder;
use App\Models\MasterPersyaratanKonsumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasterPersyaratanKonsumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'kreditkpr' => [
                'SBOM',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
                'FC Buku Tabungan',
                'NPWP',
                'Slip Gaji',
                'Surat Keterangan Kerja',
                'Rekening Koran',
                'Surat Keterangan Belum Memiliki Rumah',
                'Surat Keterangan Usaha (Wiraswasta)',
                'Neraca Keuangan (Wiraswasta)',
            ],
            'tunai' => [
                'Pas Photo 3x4',
                'Surat Perjanjian Tunai',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
            ],
            'tunai-bertahap' => [
                'Surat Perjanjian Tunai Bertahap',
                'Kartu Tanda Penduduk (KTP)',
                'Kartu Keluarga (KK)',
                'Pas Photo 3x4',
            ],
        ];

        foreach ($data as $tipeSlug => $items) {
            $tipe = TipePembayaran::where('slug', $tipeSlug)->first();

            if ($tipe) {
                foreach ($items as $item) {
                    MasterPersyaratanKonsumen::updateOrCreate(
                        ['slug' => Str::slug($item)],
                        [
                            'nama' => $item,
                            'tipe_pembayaran_id' => $tipe->id,
                            'tipe_input' => true,
                        ]
                    );
                }
            }
        }
    }
}
