<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();

        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'percentage' => ['required', 'string', 'max:20'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('status', 'Termék létrehozva!');
    }

    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'percentage' => ['required', 'string', 'max:20'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('status', 'Termék frissítve!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('status', 'Termék törölve!');
    }
}