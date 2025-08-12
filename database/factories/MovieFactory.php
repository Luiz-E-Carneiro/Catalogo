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
        $trailer_links = collect([
            "https://youtu.be/TcMBFSGVi1c?si=F-76Gs3zqWCgA48r",
            "https://youtu.be/W_H7_tDHFE8?si=yg-ykhDthwOpM_n9",
            "https://youtu.be/CwXOrWvPBPk?si=o9SZDX4LlCP9_caE",
            "https://youtu.be/mqqft2x_Aa4?si=XEvxWnWOoH35ACoj",
            "https://youtu.be/xjDjIWPwcPU?si=02U_NkpqeHllO9fE",
            "https://youtu.be/i6avfCqKcQo?si=Daofuk8T4dtN5OkX",
            "https://youtu.be/eTjDsENDZ6s?si=OoEpUC6EVeL3SfI3",
            "https://youtu.be/BcDK7lkzzsU?si=sIpkRVrZB-08Lx_v",
            "https://youtu.be/zAGVQLHvwOY?si=0cVhUuuh9FmnU_f_",
            "https://youtu.be/lg5hj2c5Nkk?si=2LI-e7C3bEVsgztV",
            "https://youtu.be/E4K7JgPJ8-s?si=9oKXDr4hUO-KUxfT",
            "https://youtu.be/DDgoDooApwM?si=uGLMWhfvQcXRSGA1",
        ]);

        return [
            'title' => fake()->sentence(3),
            'synopsis' => fake()->paragraph(),
            'publisher' => fake()->sentence(2),
            'year' => fake()->numberBetween(1980, 2025),
            'rating' => fake()->randomFloat(1, 0, 10), // 0.0 a 10.0
            'link' => $trailer_links->random(),
            'cover' => $covers->isNotEmpty() ? $covers->random() : null,
            'banner' => $banners->isNotEmpty() ? $banners->random() : null,
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
        ];
    }
}