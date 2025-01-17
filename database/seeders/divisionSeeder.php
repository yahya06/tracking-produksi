<?php

namespace Database\Seeders;

use App\Models\division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class divisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisis = [
            ['name' => 'Cutting'],
            ['name' => 'Sablon'],
            ['name' => 'Bordir'],
            ['name' => 'RnD'],
            ['name' => 'Sewing Custom'],
            ['name' => 'Sewing Qonita'],
            ['name' => 'Sewing Toheto'],
            ['name' => 'Lubang/Pasang Kancing'],
            ['name' => 'QC'],
            ['name' => 'Packing'],
        ];

        foreach($divisis as $divisi){
            division::create($divisi);
        }
    }
}
