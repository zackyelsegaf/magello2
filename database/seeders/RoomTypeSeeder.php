<?php

namespace Database\Seeders;

use App\Models\RoomType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoomTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $Roomtype = [
            'Single',
            'Double',
            'Quad',
            'King',
            'Suite',
            'Villa',
        ];

        foreach ($Roomtype as $nama) {
            RoomType::create(['room_name' => $nama]);
        }
    }
}
