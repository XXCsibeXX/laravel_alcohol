<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $needle     = $request->input('needle');
        $categoryId = $request->input('category');

        $products = Product::with('category')
            ->when($needle, fn ($q) => $q->where('name', 'like', "%{$needle}%"))
            ->when($categoryId, fn ($q) => $q->where('category_id', $categoryId))
            ->orderBy('name')
            ->get();

        $categories = Category::orderBy('name')->get();

        return view('products.index', compact('products', 'categories', 'needle', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        Product::create($this->validated($request));

        return redirect()
            ->route('products.index')
            ->with('success', 'Termék létrehozva!');
    }

    public function edit(Product $product)
    {
        $categories = Category::orderBy('name')->get();

        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $product->update($this->validated($request));

        return redirect()
            ->route('products.index')
            ->with('success', 'Termék frissítve!');
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Termék törölve!');
    }

    /**
     * Közös validáció létrehozáshoz és módosításhoz.
     * A tizedesvesszőt (4,5) tizedespontra cseréljük, hogy a magyar beírás is működjön.
     */
    private function validated(Request $request): array
    {
        $request->merge([
            'percentage' => str_replace(',', '.', trim((string) $request->input('percentage'))),
        ]);

        return $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'percentage'  => ['required', 'numeric', 'between:0,100'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);
    }
}
