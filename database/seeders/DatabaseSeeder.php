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
        \App\Models\User::factory()->create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
        ]);

        // Panggil seeder lain
        $this->call([
            RolePermissionSeeder::class,
            TipeAkunSeeder::class,
            TipeBarangSeeder::class,
            TipeDepartemenSeeder::class,
            TipePelangganSeeder::class,
            TipePersediaanSeeder::class,
            StatusPengajuanSeeder::class,
            StatusKeluargaSeeder::class,
            StatusPemasokSeeder::class,
            ReligionSeeder::class,
            MataUangSeeder::class,
            SatuanSeeder::class,
            RoomTypeSeeder::class,
            MetodePenyusutanSeeder::class,
            // AkunAktivaSeeder::class,
            // AkunAkumulasiPenyusutanSeeder::class,
            JenisHargaSeeder::class,
            MetodePenyesuaianSeeder::class,
            NilaiPembulatanSeeder::class,
            SumberNilaiAsalSeeder::class,
            AkunSeeder::class,
            AkunBiayaPenyusutanSeeder::class,
        ]);
    }
}
