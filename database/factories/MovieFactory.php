<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class MovieFactory extends Factory
{
    public function definition(): array
    {
        $coversDir = public_path('storage/covers');
        $bannersDir = public_path('storage/banners');

        $covers = collect(File::files($coversDir))->map(fn($file) => 'covers/' . $file->getFilename());
        $banners = collect(File::files($bannersDir))->map(fn($file) => 'banners/' . $file->getFilename());

        return [
            'title' => fake()->sentence(3),
            'synopsis' => fake()->paragraph(),
            'publisher' => fake()->sentence(2),
            'year' => fake()->numberBetween(1980, 2025),
            'rating' => fake()->randomFloat(1, 0, 10), // 0.0 a 10.0
            'link' => 'https://www.youtube.com/watch?v=' . $this->faker->regexify('[A-Za-z0-9_-]{11}'),
            'cover' => $covers->isNotEmpty() ? $covers->random() : null,
            'banner' => $banners->isNotEmpty() ? $banners->random() : null,
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
        ];
    }
}