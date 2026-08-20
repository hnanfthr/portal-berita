<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->word(), // Nama kategori random (1 kata)
            'slug' => $this->faker->unique()->slug(), // Slug random
        ];
    }
}