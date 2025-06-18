<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ModulUtama\Aktiva\AkunAktiva;
use Illuminate\Database\Seeder;
use Database\Seeders\MetodePenyusutanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Panggil seeder lain
        $this->call([
            RolePermissionSeeder::class,
            MetodePenyusutanSeeder::class,
            AkunAktivaSeeder::class,
            AkunAkumulasiPenyusutanSeeder::class,
            AkunBiayaPenyusutanSeeder::class,
            JenisHargaSeeder::class,
            MetodePenyesuaianSeeder::class,
            NilaiPembulatanSeeder::class,
            SumberNilaiAsalSeeder::class,
        ]);
    }
}
