<?php

namespace Database\Seeders;

use App\Models\MataUang;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MataUangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mataUangExist = ['IDR'];

        MataUang::create([
            'kode' => 'IDR',
            'nama' => 'Rupiah Indonesia',
        ]);

        MataUang::factory(10)->make()->each(function($matauang) use(&$mataUangExist){
            if(!in_array($matauang->kode, $mataUangExist)){
                $matauang->save();
                $mataUangExist[] = $matauang->kode;
            }
        });
    }
}
