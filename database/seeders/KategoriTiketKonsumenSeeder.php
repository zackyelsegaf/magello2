<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\KategoriTiketKonsumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriTiketKonsumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Lainnya',
            'Komplain',
            'Laporan',
            'Saran',
            'Pertanyaan',
        ];

        foreach ($kategori as $nama) {
            KategoriTiketKonsumen::create([
                'nama' => $nama,
                'slug' => Str::slug($nama),
            ]);
        }
    }
}
