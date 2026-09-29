<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $needle = $request->input('needle');

        $query = Category::with('products');

        if ($needle) {
            $query->where(function ($q) use ($needle) {
                // Szűrés County.name mezőre
                $q->where('name', 'like', "%{$needle}%")
                // Szűrés City.name mezőre (kapcsolt táblában)
                ->orWhereHas('products', function ($categoryQuery) use ($needle) {
                    $categoryQuery->where('name', 'like', "%{$needle}%");
                });
            });
    }

    $categories = $query->get();

    return view('categories.index', compact('categories', 'needle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category = Category::create($validated);
        $categories = Category::all();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Alkohol kategória létrehozva!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
        // API: return response()->json($county);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $category->update($validated);

        $categories = Category::all();

        return redirect()
            ->route('categories.index')
            ->with('success', 'Alkohol kategória frissítve!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()
            ->route('categories.index')
            ->with('status', 'Kategória törölve!');
    }
}
