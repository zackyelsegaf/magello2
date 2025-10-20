<?php

namespace Database\Seeders;

use App\Models\JenisDokumenPersyaratan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisDokumenPersyaratanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['urutan'=>1,  'kode'=>'SBOM',    'nama'=>'SBOM'],
            ['urutan'=>2,  'kode'=>'KTP',     'nama'=>'Kartu Tanda Penduduk (KTP)'],
            ['urutan'=>3,  'kode'=>'KK',      'nama'=>'Kartu Keluarga (KK)'],
            ['urutan'=>4,  'kode'=>'FOTO34',  'nama'=>'Pas Photo 3x4'],
            ['urutan'=>5,  'kode'=>'BUKTAB',  'nama'=>'FC Buku Tabungan'],
            ['urutan'=>6,  'kode'=>'NPWP',    'nama'=>'NPWP'],
            ['urutan'=>7,  'kode'=>'SLPGJI',  'nama'=>'Slip Gaji'],
            ['urutan'=>8,  'kode'=>'SKKERJA', 'nama'=>'Surat Keterangan Kerja'],
            ['urutan'=>9,  'kode'=>'REKKOR',  'nama'=>'Rekening Koran'],
            ['urutan'=>10, 'kode'=>'SKBMH',   'nama'=>'Surat Keterangan Belum Memiliki Rumah'],
            ['urutan'=>11, 'kode'=>'SKU',     'nama'=>'Surat Keterangan Usaha (Wiraswasta)'],
            ['urutan'=>12, 'kode'=>'NERACA',  'nama'=>'Neraca Keuangan (Wirausaha)'],
            ['urutan'=>13, 'kode'=>'SPCB',    'nama'=>'Surat Perjanjian Cash Bertahap'],
        ];

        foreach ($items as $it) {
            JenisDokumenPersyaratan::updateOrCreate(
                ['urutan' => $it['urutan']],
                $it
            );
        }
    }
}
