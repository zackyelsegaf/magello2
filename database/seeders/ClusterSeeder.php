<?php

namespace Database\Seeders;

use App\Models\Cluster;
use Illuminate\Database\Seeder;
use Laravolt\Indonesia\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ClusterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama' => 'TORANG PE PERUM', 'kota' => 'Minahasa', 'hp' => '123456789', 'luas' => 10000, 'unit' => 100],
            ['nama' => 'COBA JO', 'kota' => 'Minahasa', 'hp' => '123123132', 'luas' => 100000, 'unit' => 500],
            ['nama' => 'Perum BHR', 'kota' => 'Bekasi', 'hp' => '0872763162163', 'luas' => 5000, 'unit' => 50],
            ['nama' => 'Perumahan GML', 'kota' => 'Minahasa Utara', 'hp' => '', 'luas' => 10000, 'unit' => 100000],
            ['nama' => 'Cluster baru regency', 'kota' => 'Bandung', 'hp' => '782326362632', 'luas' => 1000, 'unit' => 10],
            ['nama' => 'Perumahan SHM', 'kota' => 'Ngawi', 'hp' => '08215152512', 'luas' => 10000, 'unit' => 100],
            ['nama' => 'Harmoni Telluwanua', 'kota' => 'Palopo', 'hp' => '+6285341853355', 'luas' => 12, 'unit' => 140],
            ['nama' => 'Harmoni Karang-Karangan', 'kota' => 'Luwu', 'hp' => '+6285341853355', 'luas' => 21, 'unit' => 250],
            ['nama' => 'Rancaekek Kencana', 'kota' => 'Seribu', 'hp' => '08881338279', 'luas' => 21, 'unit' => 99],
            ['nama' => 'SiMandor', 'kota' => 'Garut', 'hp' => '089680814114', 'luas' => 1000, 'unit' => 10],
            ['nama' => 'Askana Java', 'kota' => 'Garut', 'hp' => '081344268340', 'luas' => 1000, 'unit' => 20],
            ['nama' => 'Grand Majalaya City', 'kota' => 'Bandung', 'hp' => '082198021663', 'luas' => 33758, 'unit' => 245],
            ['nama' => 'Kantor Nusa Wiyasa Group', 'kota' => 'Garut', 'hp' => '089680839888', 'luas' => 1000, 'unit' => 1],
            ['nama' => "The Cipanas Villa's", 'kota' => 'Garut', 'hp' => '0811966456', 'luas' => 7652, 'unit' => 39],
            ['nama' => 'Griya Puspita Asri', 'kota' => 'Garut', 'hp' => '+6281 1223 0671', 'luas' => 1685841, 'unit' => 127],
        ];

        foreach ($data as $item) {
            $city = City::where('name', 'like', '%' . $item['kota'] . '%')->first();

            if (!$city) {
                echo "❌ Kota tidak ditemukan: {$item['kota']}\n";
                continue;
            }

            Cluster::create([
                'nama_cluster'   => $item['nama'],
                'no_hp'          => $item['hp'],
                'luas_tanah'     => $item['luas'],
                'total_unit'     => $item['unit'],
                'kota_code'      => $city->code,
                'provinsi_code'  => $city->province_code,
            ]);
        }
    }
}
