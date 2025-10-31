<?php

namespace Database\Seeders;

use App\Models\BiayaPembayaran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BiayaPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $biayaPembayaran = [
            'Booking Fee',
            'Uang Muka',
            'Biaya Kelebihan Tanah',
            'Biaya Penambahan Bangunan',
            'Biaya Lainnya',
            'Biaya Akad Kredit',
            'Biaya Penambahan Fasilitas',
            'Penerimaan KPR dari Bank',
        ];

        foreach ($biayaPembayaran as $nama) {
            BiayaPembayaran::create(['nama' => $nama]);
        }
    }
}
