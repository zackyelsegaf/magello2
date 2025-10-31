<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\ModulUtama\Aktiva\AkunAktiva;
use Database\Seeders\MetodePenyusutanSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        User::factory()->create([
            'name' => 'Superadmin',
            'email' => 'superadmin@gmail.com',
        ]);

        \App\Models\Barang::factory()->count(50)->create();

        // Panggil seeder lain
        $this->call([
            RolePermissionSeeder::class,
            \Laravolt\Indonesia\Seeds\DatabaseSeeder::class,
            TipeAkunSeeder::class,
            TipeBarangSeeder::class,
            TipeDepartemenSeeder::class,
            TipePelangganSeeder::class,
            TipePersediaanSeeder::class,
            StatusPengajuanSeeder::class,
            StatusKeluargaSeeder::class,
            StatusPemasokSeeder::class,
            ReligionSeeder::class,
            GenderSeeder::class,
            GolonganDarahSeeder::class,
            MataUangSeeder::class,
            SatuanSeeder::class,
            GudangSeeder::class,
            LevelHargaSeeder::class,
            KategoriBarangSeeder::class,
            RoomTypeSeeder::class,
            MetodePenyusutanSeeder::class,
            BiayaPembayaranSeeder::class,
            ProyekSeeder::class,
            ClusterSeeder::class,
            SyaratSeeder::class,
            // AkunAktivaSeeder::class,
            // AkunAkumulasiPenyusutanSeeder::class,
            JenisHargaSeeder::class,
            UnitBarangSeeder::class,
            MetodePenyesuaianSeeder::class,
            NilaiPembulatanSeeder::class,
            SumberNilaiAsalSeeder::class,
            AkunSeeder::class,
            PajakSeeder::class,
            PemasokSeeder::class,
            PenjualSeeder::class,
            PelangganSeeder::class,
            MasterBiayaLahanSeeder::class,
            DataLahanSeeder::class,
            UnitPropertieSeeder::class,
            AkunBiayaPenyusutanSeeder::class,
            KategoriTiketKonsumenSeeder::class,
            TipePembayaranSeeder::class,
            KategoriPembayaranSeeder::class,
            MasterPersyaratanKonsumenSeeder::class,
            MasterBiayaKonsumenSeeder::class,
            PekerjaSeeder::class,
            SiklusPembayaranSeeder::class,
            BarangSeeder::class,
            JenisBiayaKonsumenSeeder::class,
            JenisDokumenPersyaratanSeeder::class,
            NegaraSeeder::class,
            ProvinsiSeeder::class,
            KotaSeeder::class
        ]);
    }
}
