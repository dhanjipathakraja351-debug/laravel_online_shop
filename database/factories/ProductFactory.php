<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        // Get random category
        $category = Category::inRandomOrder()->first();

        // Get subcategory ONLY from that category
        $subCategory = Subcategory::where('category_id', $category->id)
            ->inRandomOrder()
            ->first();

        $brand = Brand::inRandomOrder()->first();

        $title = $this->faker->words(3, true);

        return [
            'title' => $title,
            'slug' => Str::slug($title),

            'description' => $this->faker->sentence(10),

            'price' => $this->faker->numberBetween(100, 1000),
            'compare_price' => $this->faker->numberBetween(1000, 1500),

            'category_id' => $category->id,
            'sub_category_id' => $subCategory->id,
            'brand_id' => $brand->id,

            'status' => 1,
            'is_featured' => $this->faker->boolean(),

            'sku' => strtoupper(Str::random(8)),
            'track_qty' => 1,
            'qty' => $this->faker->numberBetween(1, 50),

            'image' => 'product-' . rand(1,4) . '.jpg',

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}