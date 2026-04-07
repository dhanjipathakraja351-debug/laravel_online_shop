<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ===== USER =====
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // ===== ADMIN =====
        \App\Models\Admin::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456')
        ]);

        // ===== CATEGORIES + SUBCATEGORIES =====
        $data = [
            'Electronics' => ['Mobiles','Laptops','Tablets'],
            'Fashion' => ['Shirts','Shoes','Jeans'],
            'Home Appliances' => ['TV','Washing Machine','AC'],
        ];

        foreach ($data as $categoryName => $subs) {

            $category = Category::create([
                'name' => $categoryName,
                'slug' => Str::slug($categoryName),
                'status' => 1
            ]);

            foreach ($subs as $sub) {
                Subcategory::create([
                    'name' => $sub,
                    'slug' => Str::slug($sub),
                    'category_id' => $category->id,
                    'status' => 1
                ]);
            }
        }

        // ===== BRANDS =====
        $brandsList = ['Apple','Samsung','Nike','Adidas','Sony'];

        foreach ($brandsList as $brand) {
            Brand::create([
                'name' => $brand,
                'slug' => Str::slug($brand),
                'status' => 1
            ]);
        }

        // ===== PRODUCTS =====
        $categories = Category::with('subCategories')->get();
        $brands = Brand::all();

        foreach ($categories as $category) {

            foreach ($category->subCategories as $sub) {

                for ($i = 1; $i <= 5; $i++) {

                    $title = $sub->name . ' Product ' . $i;

                    // ✅ CORRECT IMAGE LOGIC (SUBCATEGORY BASED)
                    switch ($sub->name) {
                        case 'Mobiles':
                            $image = 'mobile.jpg';
                            break;

                        case 'Laptops':
                            $image = 'laptop.jpg';
                            break;

                        case 'Tablets':
                            $image = 'tablet.jpg';
                            break;

                        case 'Shirts':
                            $image = 'shirt.jpg';
                            break;

                        case 'Shoes':
                            $image = 'shoes.jpg';
                            break;

                        case 'Jeans':
                            $image = 'jeans.jpg';
                            break;

                        case 'TV':
                            $image = 'tv.jpg';
                            break;

                        case 'Washing Machine':
                            $image = 'washing-machine.jpg';
                            break;

                        case 'AC':
                            $image = 'ac.jpg';
                            break;

                        default:
                            $image = 'default.jpg';
                    }

                    Product::create([
                        'title' => $title,
                        'slug' => Str::slug($title),

                        'description' => 'Best quality ' . $title,

                        'price' => rand(100, 1000),
                        'compare_price' => rand(1000, 1500),

                        'category_id' => $category->id,
                        'sub_category_id' => $sub->id,
                        'brand_id' => $brands->random()->id,

                        'status' => 1,
                        'is_featured' => rand(0,1),

                        'sku' => strtoupper(Str::random(8)),
                        'track_qty' => 1,
                        'qty' => rand(1,50),

                        // ✅ FINAL IMAGE
                        'image' => $image,
                    ]);
                }
            }
        }
    }
}