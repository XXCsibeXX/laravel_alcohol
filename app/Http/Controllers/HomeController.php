<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->orderBy('name')
            ->get();

        $products = Product::with('category')->get();

        $stats = [
            'categories' => $categories->count(),
            'products'   => $products->count(),
            'average'    => $products->isEmpty() ? 0 : round($products->avg(fn ($p) => (float) $p->percentage), 1),
            'strongest'  => $products->sortByDesc(fn ($p) => (float) $p->percentage)->first(),
        ];

        $latest = $products->sortByDesc('id')->take(5);

        return view('welcome', compact('categories', 'stats', 'latest'));
    }
}
