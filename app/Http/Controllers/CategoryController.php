<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Kategóriák listája, keresés a kategória nevében és a hozzá tartozó termékek nevében.
     */
    public function index(Request $request)
    {
        $needle = $request->input('needle');

        $categories = Category::with(['products' => fn ($q) => $q->orderBy('name')])
            ->when($needle, function ($query) use ($needle) {
                $query->where(function ($q) use ($needle) {
                    // Szűrés a kategória nevére
                    $q->where('name', 'like', "%{$needle}%")
                      // Szűrés a kapcsolt termékek nevére
                      ->orWhereHas('products', function ($productQuery) use ($needle) {
                          $productQuery->where('name', 'like', "%{$needle}%");
                      });
                });
            })
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories', 'needle'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        Category::create($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Alkohol kategória létrehozva!');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category->update($validated);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Alkohol kategória frissítve!');
    }

    public function destroy(Category $category)
    {
        // Figyelem: a products tábla külső kulcsa cascade, a termékek is törlődnek.
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategória törölve!');
    }
}
