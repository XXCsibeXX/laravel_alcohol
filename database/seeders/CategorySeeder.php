<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    const CATEGORIES = [
        'Sör',
        'Vodka',
        'Bor',
        'Gin',
        'Cider',
    ];
    public function run(): void
    {
        foreach (self::CATEGORIES as $name) {
            Category::create([
                'name' => $name,
            ]);
        }
    }
}
