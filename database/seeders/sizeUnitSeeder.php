<?php

namespace Database\Seeders;

use App\Models\sizeUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class sizeUnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $unitSizes = [
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
        ];
        foreach($unitSizes as $unitSize){
            sizeUnit::create($unitSize);
        }
    }
}
