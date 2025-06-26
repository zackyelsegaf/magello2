<?php

namespace Database\Seeders;

use App\Models\Gudang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GudangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Gudang::create([
            'nama_gudang' => 'GRAND MUTIARA POYOWA',
            'deskripsi' => null,
            'penanggung_jawab' => null,
            'alamat_gudang_1' => null,
            'alamat_gudang_2' => null,
            'alamat_gudang_3' => null,
        ]);
    }
}
