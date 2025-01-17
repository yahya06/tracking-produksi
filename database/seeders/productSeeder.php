<?php

namespace Database\Seeders;

use App\Models\kategori;
use App\Models\product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategoriId = kategori::all('id')->random();

        product::factory(5)->create([
            'kategori_id' => $kategoriId
        ]);
    }
}
