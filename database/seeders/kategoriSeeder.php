<?php

namespace Database\Seeders;

use App\Models\kategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategories = [
            ['name' => 'Baju Anak'],
            ['name' => 'PDL/PDH/Korsa/Kemeja'],
            ['name' => 'Kemko']
        ];

        foreach($kategories as $kategori){
            kategori::create($kategori);
        }
    }
}
