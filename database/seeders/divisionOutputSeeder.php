<?php

namespace Database\Seeders;

use App\Models\division;
use App\Models\divisionOutput;
use App\Models\product;
use App\Models\size;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class divisionOutputSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $divisiId   = division::all('id')->random();
        $productId  = product::all('id')->random();
        $sizeId     = size::all('id')->random();

        divisionOutput::factory()->count(10)->create([
            'division_id'   => $divisiId,
            'product_id'    => $productId,
            'unit_size_id'  => $sizeId,
        ]);
    }
}
