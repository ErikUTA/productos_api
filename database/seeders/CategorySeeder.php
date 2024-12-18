<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate([
            'name' => 'Electrodomestico',
        ]);
        Category::firstOrCreate([
            'name' => 'Ropa',
        ]);
        Category::firstOrCreate([
            'name' => 'VideoJuego',
        ]);
        Category::firstOrCreate([
            'name' => 'Comida',
        ]);
    }
}
