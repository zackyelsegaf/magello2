<?php

namespace Database\Seeders;

use App\Models\StatusPengajuan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusPengajuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusPengajuan = [
            'Single Income',
            'Join Income',
        ];

        foreach ($statusPengajuan as $nama) {
            StatusPengajuan::create(['nama' => $nama]);
        }
    }
}
