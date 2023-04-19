<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        $categories = Category::factory()->count(5)->create();

        $products = Product::factory()->count(10)->create();

        foreach ($products as $product) {
            $selectedCategories = $categories->random(rand(1, 3))->pluck('id');
            $product->categories()->attach($selectedCategories);
        }
    }
}
