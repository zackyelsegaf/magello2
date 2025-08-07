<?php

namespace Database\Seeders;

use App\Models\Cluster;
use App\Models\UnitPropertie;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UnitPropertieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clusters = Cluster::pluck('id', 'nama_cluster');

        $data = [
            [
                'cluster_id' => $clusters['Perum BHR'] ?? 1,
                'tipe_model' => 1, // Kapling
                'blok' => 'A1',
                'nomor_unit' => '06',
                'jumlah_lantai' => 1,
                'luas_tanah' => 72.00,
                'luas_bangunan' => 36.00,
                'harga' => 173000000,
                'spesifikasi' => 'bata merah',
                'nama_fasilitas' => null,
                'status_penjualan' => 2,
            ],
            [
                'cluster_id' => $clusters['Perumahan SHM'] ?? 2,
                'tipe_model' => 2, // Fasum
                'blok' => 'B10',
                'nomor_unit' => '2',
                'jumlah_lantai' => 1,
                'luas_tanah' => 100.00,
                'luas_bangunan' => 100.00,
                'harga' => 0,
                'spesifikasi' => 'bagus',
                'nama_fasilitas' => 'Musola',
                'status_penjualan' => 3,
            ],
            [
                'cluster_id' => $clusters['Natawiria Residence'] ?? 3,
                'tipe_model' => 3, // Fasos
                'blok' => 'H',
                'nomor_unit' => '1',
                'jumlah_lantai' => 1,
                'luas_tanah' => 100.00,
                'luas_bangunan' => 100.00,
                'harga' => 0,
                'spesifikasi' => '-',
                'nama_fasilitas' => 'Masjid',
                'status_penjualan' => 3,
            ],
        ];

        foreach ($data as $item) {
            UnitPropertie::create($item);
        }
    }
}
