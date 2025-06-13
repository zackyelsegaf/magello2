<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\ModulUtama\Aktiva\AkunBiayaPenyusutan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AkunBiayaPenyusutanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $items = [
            'HPP Rumah',
            'HPP Lain-lain',
            'HPP Barang Rusak',
            'Potongan Pembelian',
            'Biaya Angkut Pembelian',
            'Variance',
            'Gratis Biaya BPHTB Akad KPR User',
            'Gratis Biaya Administrasi Akad KPR Bank',
            'Gratis Biaya Notaris Akad KPR Bank',
            'Gratis Biaya Blokir Angsuran Akad Bank',
            'Bonus Peralatan Rumah Tangga Akad KPR Bank',
            'Upah Tukang',
            'Lembur',
            'THR',
            'Bonus',
            'Tunjangan Pengobatan',
            'Tunjangan Transportasi',
            'Tunjangan Makan',
            'Tunjangan PPH ps.21',
            'Biaya Angkutan Kantor',
            'Biaya Listrik/Air Kantor',
            'Biaya Telepon/Fax Kantor',
            'Biaya Pos/Kurir',
            'Biaya Seragam Kantor',
            'Biaya Asuransi Kantor',
            'Biaya Pajak Bumi Bangunan Kantor',
            'Biaya Keamanan Kantor',
            'Biaya Penyusutan Bangunan Kantor',
            'Biaya Penyusutan Kendaraan Kantor',
            'Biaya Penyusutan Mesin & Peralatan Kantor',
            'Biaya Kendaraan/Transport',
            'Biaya Bahan Bakar/Parkir',
            'Biaya Surat/Pajak Kendaraan',
            'Biaya Pemeliharaan/Perbaikan',
            'Biaya Lain-lain Kantor',
            'Biaya Jamuan',
            'Biaya Hadiah',
            'Biaya Sumbangan',
            'Biaya Representasi',
            'Biaya Promosi & Iklan',
            'Biaya Fee & Komisi',
            'Biaya Sample Barang',
            'Biaya Gaji Karyawan Kantor',
            'Biaya Lembur',
            'Biaya THR',
            'Biaya Bonus',
            'Biaya Tunjangan Pengobatan',
            'Biaya Tunjangan Transportasi',
            'Biaya Tunjangan Makan',
            'Biaya Tunjangan PPH ps.21',
            'Biaya Ticket & Airport Tax',
            'Biaya Fiskal Luar Negeri',
            'Biaya Visa/Paspor',
            'Biaya Hotel',
            'Biaya Transportasi Lokal',
            'Biaya Makan & Minum',
            'Biaya Uang Saku',
            'Biaya Komunikasi',
            'Biaya Bahan Bakar / Parkir',
            'Biaya Asuransi Kendaraan',
            'Biaya Kendaraan/Transport lain-lain',
            'Biaya Alat Tulis Kantor',
            'Biaya Perlengkapan Kantor',
            'Biaya Photocopy',
            'Biaya Seragam',
            'Biaya Listrik/Air',
            'Biaya Asuransi',
            'Biaya Saksi/Denda Pajak',
            'Biaya Beasiswa',
            'Biaya Penelitian',
            'Biaya Jasa Konsultan',
            'Biaya Seminar/Kursus',
            'Biaya Olahraga/Rekreasi',
            'Biaya Penyusutan Bangunan',
            'Biaya Penyusutan Kendaraan',
            'Biaya Penyusutan Peralatan',
            'Biaya Amortisasi Aktiva Tak Berwujud',
            'Biaya Perakitan',
            'Biaya Potong',
            'Biaya Lain-lain',
            'Laba/Rugi Terealisir IDR',
            'Laba/Rugi Belum Terealisir IDR',
        ];

        foreach ($items as $item) {
            AkunBiayaPenyusutan::create([
                'nama' => $item,
                'slug' => Str::slug($item),
            ]);
        }
    }
}
