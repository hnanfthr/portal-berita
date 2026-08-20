<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2,8)),
            'slug' => $this->faker->slug(),
            'excerpt' => $this->faker->paragraph(),
            'body' => $this->faker->paragraphs(mt_rand(5,10), true),
            // PERBAIKAN DISINI: Cuma pilih 1 atau 2 karena user kita cuma 2
            'user_id' => mt_rand(1,2), 
            'category_id' => mt_rand(1,3), // Category kita ada 3, jadi aman 1-3
        ];
    }
}