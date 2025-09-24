<?php

namespace Database\Seeders;

use App\Models\Pekerja;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Faker\Factory as Faker;

class PekerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        for ($i = 0; $i < 20; $i++) {
            Pekerja::create([
                'nama_pekerja' => $faker->name,
                'alamat' => $faker->address,
                'no_hp' => $faker->phoneNumber,
            ]);
        }
    }
}
