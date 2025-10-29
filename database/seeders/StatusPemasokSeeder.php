<?php

namespace Database\Seeders;

use App\Models\StatusPemasok;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusPemasokSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statusPemasok = [
            'Belum Kawin',
            'Kawin',
            'Duda',
            'Janda'
        ];

        foreach ($statusPemasok as $nama) {
            StatusPemasok::create(['nama' => $nama]);
        }
    }
}
