<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table("categories")->insert([
            ["name" => "Ação"],
            ["name" => "Aventura"],
            ["name" => "Animação"],
            ["name" => "Biografia"],
            ["name" => "Comédia"],
            ["name" => "Crime"],
            ["name" => "Documentário"],
            ["name" => "Drama"],
            ["name" => "Família"],
            ["name" => "Fantasia"],
            ["name" => "Film Noir"],
            ["name" => "História"],
            ["name" => "Terror"],
            ["name" => "Música"],
            ["name" => "Musical"],
            ["name" => "Mistério"],
            ["name" => "Romance"],
            ["name" => "Ficção Científica"],
            ["name" => "Curta-metragem"],
            ["name" => "Esporte"],
            ["name" => "Super-herói"],
            ["name" => "Suspense"],
            ["name" => "Guerra"],
            ["name" => "Faroeste"],
        ]);
    }
}
