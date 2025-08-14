<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory {

    public function file_randomizer($files) {
        $random_file = $files->random();
        $file = new UploadedFile (
            $random_file->getPathname(),
            $random_file->getFilename(),
        );
        return $file->store('movies', 'public');
    }
    public function definition(): array {
        $covers = collect(File::files(public_path('storage/covers')));
        $banners = collect(File::files(public_path('storage/banners')));
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
            'cover' => $this->file_randomizer($covers),
            'banner' => $this->file_randomizer($banners),
            'category_id' => Category::inRandomOrder()->first()->id ?? 1,
        ];
    }
}