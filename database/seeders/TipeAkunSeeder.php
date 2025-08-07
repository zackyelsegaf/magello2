<?php

namespace Database\Seeders;

use App\Models\TipeAkun;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TipeAkunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipeAkun = [
            'Kas/Bank',
            'Piutang Usaha',
            'Persediaan',
            'Aktiva Lancar Lainnya',
            'Aktiva Tetap',
            'Akumulasi Penyusutan',
            'Hutang Usaha',
            'Hutang Lancar Lainnya',
            'Hutang Jangka Panjang',
            'Ekuitas',
            'Pendapatan',
            'Harga Pokok Penjualan',
            'Beban',
            'Beban Lainnya',
            'Pendapatan Lainnya',
        ];

        foreach ($tipeAkun as $nama) {
            TipeAkun::create(['nama' => $nama]);
        }
    }
}
