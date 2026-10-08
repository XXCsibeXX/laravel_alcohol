@extends('layouts.app')

@section('title', 'Kezdőlap')

@section('content')
    <section class="hero">
        <div class="hero-text">
            <span class="eyebrow">Italkatalógus</span>
            <h1>Üdv az Alkohol Katalógusban!</h1>
            <p>Kategóriák és termékek egy helyen: böngészd, keresd, bővítsd a kínálatot néhány kattintással.</p>
            <div class="hero-actions">
                <a href="{{ route('products.create') }}" class="btn btn-primary"><x-icon name="plus" /> Új termék</a>
                <a href="{{ route('categories.index') }}" class="btn btn-light">Kategóriák böngészése</a>
            </div>
        </div>
        <div class="hero-art" aria-hidden="true">
            <span class="art art-1"><x-icon name="beer" /></span>
            <span class="art art-2"><x-icon name="wine" /></span>
            <span class="art art-3"><x-icon name="martini" /></span>
        </div>
    </section>

    <section class="stats">
        <div class="stat">
            <span class="stat-icon"><x-icon name="tag" /></span>
            <div>
                <strong>{{ $stats['categories'] }}</strong>
                <span>kategória</span>
            </div>
        </div>
        <div class="stat">
            <span class="stat-icon"><x-icon name="wine" /></span>
            <div>
                <strong>{{ $stats['products'] }}</strong>
                <span>termék</span>
            </div>
        </div>
        <div class="stat">
            <span class="stat-icon"><x-icon name="percent" /></span>
            <div>
                <strong>{{ number_format($stats['average'], 1, ',', '') }}%</strong>
                <span>átlagos alkoholtartalom</span>
            </div>
        </div>
        <div class="stat">
            <span class="stat-icon"><x-icon name="flame" /></span>
            <div>
                <strong>{{ $stats['strongest'] ? $stats['strongest']->percentage_label : '–' }}</strong>
                <span>{{ $stats['strongest'] ? 'a legerősebb: ' . $stats['strongest']->name : 'még nincs termék' }}</span>
            </div>
        </div>
    </section>

    <section class="grid-2">
        <div class="card">
            <h2 class="card-title">Termékek kategóriánként</h2>

            @php $max = max(1, $categories->max('products_count') ?? 0); @endphp

            @forelse ($categories as $category)
                <div class="bar-row">
                    <span class="bar-label"><x-icon :name="$category->icon" /> {{ $category->name }}</span>
                    <div class="bar-track">
                        <span class="bar-fill" style="width: {{ round(($category->products_count / $max) * 100) }}%"></span>
                    </div>
                    <span class="bar-value">{{ $category->products_count }}</span>
                </div>
            @empty
                <p class="muted">Még nincs kategória. <a href="{{ route('categories.create') }}">Hozz létre egyet!</a></p>
            @endforelse
        </div>

        <div class="card">
            <h2 class="card-title">Legutóbb hozzáadott termékek</h2>

            <ul class="plain-list">
                @forelse ($latest as $product)
                    <li>
                        <span class="prod-icon"><x-icon :name="$product->category->icon" /></span>
                        <div class="grow">
                            <strong>{{ $product->name }}</strong>
                            <span class="muted small">{{ $product->category->name }}</span>
                        </div>
                        <span class="badge">{{ $product->percentage_label }}</span>
                    </li>
                @empty
                    <li class="muted">Még nincs termék. <a href="{{ route('products.create') }}">Vegyél fel egyet!</a></li>
                @endforelse
            </ul>
        </div>
    </section>
@endsection
