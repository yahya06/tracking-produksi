<?php

namespace Database\Seeders;

use App\Models\product;
use App\Models\size;
use App\Models\sizeUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class sizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productId  = product::all('id')->random();
        $unitSizeId   = sizeUnit::all('id')->random();
        size::factory()->count(10)->create([
            'product_id'    => $productId,
            'size_unit_id'  => $unitSizeId,
        ]);
    }
}
