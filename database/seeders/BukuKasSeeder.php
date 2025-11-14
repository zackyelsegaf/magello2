<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BukuKasSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_kas' => 'Kas Utama',
                'keterangan' => 'Kas operasional utama',
                'saldo_awal' => 5000000, // contoh 5.000.000
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kas' => 'Kas Toko',
                'keterangan' => 'Kas khusus toko/lokasi A',
                'saldo_awal' => 2000000,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_kas' => 'Kas Proyek',
                'keterangan' => 'Kas untuk proyek/klien tertentu',
                'saldo_awal' => 0,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        foreach ($data as $row) {
            DB::table('buku_kas')->updateOrInsert(
                ['nama_kas' => $row['nama_kas']],
                [
                    'keterangan' => $row['keterangan'],
                    'saldo_awal' => $row['saldo_awal'],
                    'created_at' => $row['created_at'],
                    'updated_at' => $row['updated_at']
                ]
            );
        }
    }
}
