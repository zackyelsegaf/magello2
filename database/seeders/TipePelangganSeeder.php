<?php

namespace Database\Seeders;

use App\Models\TipePelanggan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipePelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipePelanggan = [
            'Wirausaha',
            'KOMERSIL',
            'ASN/PNS',
            'TNI',
            'POLRI',
            'BUMN',
            'Karyawan Swasta',
            'Guru/Dosen/Pengajar'
        ];

        foreach ($tipePelanggan as $nama) {
            TipePelanggan::create(['nama' => $nama]);
        }
    }
}
