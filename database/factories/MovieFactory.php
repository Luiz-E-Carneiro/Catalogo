<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;
use App\Models\Category;

class MovieFactory extends Factory
{
    public function definition(): array
    {
        $coversDir = public_path('storage/cover');
        $bannersDir = public_path('storage/banner');

        $covers = collect(File::files($coversDir))->map(fn($file) => 'storage/covers/' . $file->getFilename());
        $banners = collect(File::files($bannersDir))->map(fn($file) => 'storage/banners/' . $file->getFilename());

        return [
            'title'       => $this->faker->sentence(3),
            'synopsis'    => $this->faker->paragraph(),
            'year'        => $this->faker->numberBetween(1980, 2025),
            'rating'      => $this->faker->randomFloat(1, 0, 10), // 0.0 a 10.0
            'link'        => 'https://www.youtube.com/watch?v=' . $this->faker->regexify('[A-Za-z0-9_-]{11}'),
            'cover'       => $covers->isNotEmpty() ? $covers->random() : null,
            'banner'      => $banners->isNotEmpty() ? $banners->random() : null,
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
        ];
    }
}