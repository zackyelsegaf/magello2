<?php

namespace Database\Seeders;

use App\Models\Syarat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SyaratSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Syarat::create([
            'nama' => 'C.O.D',
            'batas_hutang' => 0,
            'cash_on_delivery' => true,
            'persentase_diskon' => 0,
            'periode_diskon' => 0,
        ]);

        Syarat::create([
            'nama' => 'Net 30',
            'batas_hutang' => 30,
            'cash_on_delivery' => false,
            'persentase_diskon' => 0,
            'periode_diskon' => 0,
        ]);

        Syarat::create([
            'nama' => 'Net 45',
            'batas_hutang' => 45,
            'cash_on_delivery' => false,
            'persentase_diskon' => 0,
            'periode_diskon' => 0,
        ]);
    }
}
