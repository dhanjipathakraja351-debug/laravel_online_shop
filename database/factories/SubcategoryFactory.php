<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SubcategoryFactory extends Factory
{
    public function definition(): array
    {
        $name = $this->faker->word();

        return [
            'name' => $name,
            'slug' => Str::slug($name),

            'category_id' => \App\Models\Category::inRandomOrder()->value('id'),

            'status' => 1,
        ];
    }
}