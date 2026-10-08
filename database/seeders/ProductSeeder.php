<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Kategória neve => [termék neve, alkoholtartalom %] (közelítő értékek).
     */
    const PRODUCTS = [
        'Sör'   => [['Soproni Ászok', '4.5'], ['Heineken', '5'], ['Guinness Draught', '4.2']],
        'Vodka' => [['Absolut', '40'], ['Smirnov Red', '37.5'], ['Finlandia', '40']],
        'Bor'   => [['Egri Bikavér', '13'], ['Tokaji Furmint', '12.5'], ['Villányi Cabernet Sauvignon', '13.5']],
        'Gin'   => [['Bombay Sapphire', '40'], ['Beefeater', '40'], ['Tanqueray', '43.1']],
        'Cider' => [['Strongbow', '4.5'], ['Somersby', '4.5'], ['Rekorderlig', '4']],
    ];

    public function run(): void
    {
        foreach (self::PRODUCTS as $categoryName => $items) {
            $category = Category::where('name', $categoryName)->first();

            if (! $category) {
                continue;
            }

            foreach ($items as [$name, $percentage]) {
                Product::create([
                    'name'        => $name,
                    'percentage'  => $percentage,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}
