<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Ação',
            'Comédia',
            'Drama',
            'Terror',
            'Suspense',
            'Ficção Científica',
            'Animação',
            'Documentário',
            'Romance',
            'Fantasia',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
