<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $category) {

            Product::create([
                'name' => $category->name . ' termék 1',
                'percentage' => '40',
                'category_id' => $category->id,
            ]);

            Product::create([
                'name' => $category->name . ' termék 2',
                'percentage' => '40',
                'category_id' => $category->id,
            ]);
        }
    }
}
