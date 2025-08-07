<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiklusPembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SiklusPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'Harian', 'jumlah_hari' => 1],
            ['nama' => 'Mingguan', 'jumlah_hari' => 7],
            ['nama' => '2 Mingguan', 'jumlah_hari' => 14],
            ['nama' => '3 Mingguan', 'jumlah_hari' => 21],
            ['nama' => 'Bulanan', 'jumlah_hari' => 30],
        ];

        foreach ($data as $item) {
            SiklusPembayaran::updateOrCreate(['nama' => $item['nama']], $item);
        }
    }
}
