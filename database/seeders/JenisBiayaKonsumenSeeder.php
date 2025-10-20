<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisBiayaKonsumen;

class JenisBiayaKonsumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['urutan'=>1,  'kode'=>'BF',   'nama'=>'Booking Fee'],
            ['urutan'=>2,  'kode'=>'ADM',  'nama'=>'Biaya Administrasi'],
            ['urutan'=>3,  'kode'=>'UM',   'nama'=>'Uang Muka'],
            ['urutan'=>4,  'kode'=>'KLT',  'nama'=>'Biaya Kelebihan Tanah'],
            ['urutan'=>5,  'kode'=>'PENB', 'nama'=>'Biaya Penambahan Bangunan'],
            ['urutan'=>6,  'kode'=>'LAIN', 'nama'=>'Biaya Lainnya'],
            ['urutan'=>7,  'kode'=>'TPC',  'nama'=>'Total Penjualan Cash'],
            ['urutan'=>8,  'kode'=>'CIC',  'nama'=>'Cicilan Cash (Bertahap)'],
            ['urutan'=>9,  'kode'=>'AKAD', 'nama'=>'Biaya Akad Kredit'],
            ['urutan'=>10, 'kode'=>'FAS',  'nama'=>'Biaya Penambahan Fasilitas'],
            ['urutan'=>11, 'kode'=>'KPR',  'nama'=>'Penerimaan KPR dari Bank'],
        ];

        foreach ($items as $it) {
            JenisBiayaKonsumen::updateOrCreate(['urutan'=>$it['urutan']], $it);
        }
    }
}
