<?php

namespace Database\Seeders;

use App\Models\Proyek;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $proyeks = [
            ['kode' => 'GMPA', 'blok' => 'A', 'jumlah' => 16],
            ['kode' => 'GMPB', 'blok' => 'B', 'jumlah' => 16],
            ['kode' => 'GMPC', 'blok' => 'C', 'jumlah' => 21],
            ['kode' => 'GMPD', 'blok' => 'D', 'jumlah' => 29],
            ['kode' => 'GMPE', 'blok' => 'E', 'jumlah' => 9],
            ['kode' => 'GMPG', 'blok' => 'G', 'jumlah' => 28],
            ['kode' => 'GMPH', 'blok' => 'H', 'jumlah' => 28],
            ['kode' => 'GMPI', 'blok' => 'I', 'jumlah' => 23],
            ['kode' => 'GMPJ', 'blok' => 'J', 'jumlah' => 10],
            ['kode' => 'GMPK', 'blok' => 'K', 'jumlah' => 24],
            ['kode' => 'GMPL', 'blok' => 'L', 'jumlah' => 16],
            ['kode' => 'GMPM', 'blok' => 'M', 'jumlah' => 16],
            ['kode' => 'GMPN', 'blok' => 'N', 'jumlah' => 16],
            ['kode' => 'GMPO', 'blok' => 'O', 'jumlah' => 16],
            ['kode' => 'GMPP', 'blok' => 'P', 'jumlah' => 7],
        ];

        $tanggal_to = '2024-01-01';

        foreach ($proyeks as $proyek) {
            for ($i = 1; $i <= $proyek['jumlah']; $i++) {
                $no = str_pad($i, 2, '0', STR_PAD_LEFT);
                $kodeProyek = $proyek['kode'] . $no;
                $blok = $proyek['blok'];
                $namaProyek = "GMP Blok $blok No. $no";
                $deskripsi = "Grand Mutiara Poyowa Blok $blok No. $no";

                Proyek::create([
                    'proyek_id' => $kodeProyek,
                    'nama_proyek' => $namaProyek,
                    'nama_kontak' => null,
                    'tanggal_from' => null,
                    'tanggal_to' => $tanggal_to,
                    'persentase_komplet' => 0,
                    'persentase_komplet_check' => false,
                    'deskripsi' => $deskripsi,
                    'dihentikan' => false,
                    'total_pendapatan' => 0,
                    'total_pendapatan_from' => 0,
                    'total_biaya' => 0,
                    'total_biaya_from' => 0,
                    'total_beban' => 0,
                    'total_beban_from' => 0,
                    'laba_rugi' => 0,
                    'laba_rugi_from' => 0,
                ]);
            }
        }

        // Tambahan proyek khusus (non-blok)
        Proyek::create([
            'proyek_id' => 'GMP-CORJALAN01',
            'nama_proyek' => 'JALAN COR GMP',
            'nama_kontak' => null,
            'tanggal_from' => null,
            'tanggal_to' => $tanggal_to,
            'persentase_komplet' => 0,
            'persentase_komplet_check' => false,
            'deskripsi' => null,
            'dihentikan' => false,
            'total_pendapatan' => 0,
            'total_pendapatan_from' => 0,
            'total_biaya' => 0,
            'total_biaya_from' => 0,
            'total_beban' => 0,
            'total_beban_from' => 0,
            'laba_rugi' => 0,
            'laba_rugi_from' => 0,
        ]);

        Proyek::create([
            'proyek_id' => '0',
            'nama_proyek' => 'NON PROJECT',
            'nama_kontak' => null,
            'tanggal_from' => null,
            'tanggal_to' => $tanggal_to,
            'persentase_komplet' => 0,
            'persentase_komplet_check' => false,
            'deskripsi' => null,
            'dihentikan' => false,
            'total_pendapatan' => 0,
            'total_pendapatan_from' => 0,
            'total_biaya' => 0,
            'total_biaya_from' => 0,
            'total_beban' => 0,
            'total_beban_from' => 0,
            'laba_rugi' => 0,
            'laba_rugi_from' => 0,
        ]);
    }
}
