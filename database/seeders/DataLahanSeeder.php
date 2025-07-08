<?php

namespace Database\Seeders;

use App\Models\DataLahan;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DataLahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $data = [
            [
                'nama_tanah' => 'lahan perum BHR',
                'cluster_id' => 3, // Perum BHR
                'tanggal_perolehan' => '2025-04-19',
                'pemasok_id' => 1, // TB. Cahaya Bangunan Poyowa
                'no_hp_tuan_tanah' => '081234123',
                'luas_area' => 1000,
                'harga_per_m2' => 1000000,
                'note' => null,
                'dicatat_sebagai' => true,
            ],
            [
                'nama_tanah' => 'Natawiria Residence',
                'cluster_id' => 15, // Griya Puspita Asri
                'tanggal_perolehan' => '2025-01-18',
                'pemasok_id' => 4, // TB. Harmoni
                'no_hp_tuan_tanah' => '081234123',
                'luas_area' => 10000,
                'harga_per_m2' => 100000,
                'note' => null,
                'dicatat_sebagai' => true,
            ],
            [
                'nama_tanah' => 'Perumahan GML',
                'cluster_id' => 4,
                'tanggal_perolehan' => '2024-05-01',
                'pemasok_id' => 4, // TB. Harmoni
                'no_hp_tuan_tanah' => '081234123',
                'luas_area' => 10000,
                'harga_per_m2' => 100000,
                'note' => null,
                'dicatat_sebagai' => true,
            ],
            [
                'nama_tanah' => 'Cluster baru regency',
                'cluster_id' => 5,
                'tanggal_perolehan' => '2025-01-09',
                'pemasok_id' => 1,
                'no_hp_tuan_tanah' => '081234123',
                'luas_area' => 1000,
                'harga_per_m2' => 500000,
                'note' => null,
                'dicatat_sebagai' => true,
            ],
            [
                'nama_tanah' => 'Rancaekek Kencana',
                'cluster_id' => 9,
                'tanggal_perolehan' => '2024-12-12',
                'pemasok_id' => 6, // Solo Makmur Sembada
                'no_hp_tuan_tanah' => '081234123',
                'luas_area' => 100,
                'harga_per_m2' => 10000,
                'note' => null,
                'dicatat_sebagai' => false,
            ],
            [
                'nama_tanah' => 'Perumahan SHM',
                'cluster_id' => 6,
                'tanggal_perolehan' => '2024-12-11',
                'pemasok_id' => 1,
                'no_hp_tuan_tanah' => '081234123',
                'luas_area' => 1000,
                'harga_per_m2' => 500000,
                'note' => null,
                'dicatat_sebagai' => false,
            ],
            [
                'nama_tanah' => 'Guntur Residence III',
                'cluster_id' => 13,
                'tanggal_perolehan' => '2024-11-01',
                'pemasok_id' => 2, // TB. Agunan
                'no_hp_tuan_tanah' => '081234123',
                'luas_area' => 12,
                'harga_per_m2' => 10000000,
                'note' => null,
                'dicatat_sebagai' => false,
            ],
            [
                'nama_tanah' => 'Harmoni Telluwanua',
                'cluster_id' => 7,
                'tanggal_perolehan' => '2024-09-25',
                'pemasok_id' => 3, // TB. Terang
                'no_hp_tuan_tanah' => '081234123',
                'luas_area' => 12,
                'harga_per_m2' => 10000000,
                'note' => null,
                'dicatat_sebagai' => false,
            ],
            [
                'nama_tanah' => 'The Cipanas Villa\'s',
                'cluster_id' => 14,
                'tanggal_perolehan' => '2023-08-29',
                'pemasok_id' => 5, // PD Alya Putri
                'no_hp_tuan_tanah' => '081234123',
                'luas_area' => 10000,
                'harga_per_m2' => 500000,
                'note' => null,
                'dicatat_sebagai' => false,
            ],
            [
                'nama_tanah' => 'Natawiria Residence',
                'cluster_id' => 15,
                'tanggal_perolehan' => '2023-08-29',
                'pemasok_id' => 6, // Solo Makmur Sembada
                'no_hp_tuan_tanah' => '081234123',
                'luas_area' => 10000,
                'harga_per_m2' => 1000,
                'note' => null,
                'dicatat_sebagai' => false,
            ],
        ];

        foreach ($data as $item) {
            DataLahan::create($item);
        }
    }
}
