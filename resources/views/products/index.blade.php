@extends('layouts.app')

@section('title', 'Termékek')

@section('content')
    <div class="page-head">
        <div>
            <h1>Termékek</h1>
            <p class="muted">{{ $products->count() }} termék a listában.</p>
        </div>
        <a href="{{ route('products.create') }}" class="btn btn-primary"><x-icon name="plus" /> Új termék</a>
    </div>

    <form method="GET" action="{{ route('products.index') }}" class="toolbar">
        <div class="search">
            <x-icon name="search" />
            <input type="search" name="needle" value="{{ $needle }}" placeholder="Keresés a termék neve alapján…">
        </div>

        <select name="category" aria-label="Kategória szűrő" onchange="this.form.submit()">
            <option value="">Minden kategória</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) $categoryId === (string) $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-ghost">Szűrés</button>
        @if ($needle || $categoryId)
            <a href="{{ route('products.index') }}" class="btn btn-link">Szűrők törlése</a>
        @endif
    </form>

    @if ($products->isEmpty())
        <div class="empty">
            <x-icon name="wine" />
            <h2>Nincs megjeleníthető termék</h2>
            <p class="muted">Próbálj másik keresést, vagy vegyél fel egy új terméket.</p>
        </div>
    @else
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Termék</th>
                        <th>Kategória</th>
                        <th>Alkoholtartalom</th>
                        <th class="col-actions"><span class="sr-only">Műveletek</span></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>
                                <div class="prod-name">
                                    <span class="prod-icon"><x-icon :name="$product->category->icon" /></span>
                                    <strong>{{ $product->name }}</strong>
                                </div>
                            </td>
                            <td><span class="badge">{{ $product->category->name }}</span></td>
                            <td>
                                <div class="abv">
                                    <div class="meter" title="{{ $product->percentage_label }}">
                                        <span class="meter-fill strength-{{ $product->strength }}" style="width: {{ $product->percentage_width }}%"></span>
                                    </div>
                                    <strong>{{ $product->percentage_label }}</strong>
                                </div>
                            </td>
                            <td class="col-actions">
                                <div class="row-actions">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-ghost btn-sm btn-icon" title="Szerkesztés" aria-label="Szerkesztés">
                                        <x-icon name="pencil" />
                                    </a>
                                    <form method="POST" action="{{ route('products.destroy', $product->id) }}"
                                          data-confirm="Biztosan törlöd a(z) „{{ $product->name }}” terméket?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger-ghost btn-sm btn-icon" title="Törlés" aria-label="Törlés">
                                            <x-icon name="trash" />
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
