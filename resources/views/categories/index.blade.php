@extends('layouts.app')

@section('title', 'Kategóriák')

@section('content')
    <div class="page-head">
        <div>
            <h1>Kategóriák</h1>
            <p class="muted">Az alkoholfajták csoportjai és a hozzájuk tartozó termékek.</p>
        </div>
        <a href="{{ route('categories.create') }}" class="btn btn-primary"><x-icon name="plus" /> Új kategória</a>
    </div>

    <form method="GET" action="{{ route('categories.index') }}" class="toolbar">
        <div class="search">
            <x-icon name="search" />
            <input type="search" name="needle" value="{{ $needle }}" placeholder="Keresés kategória vagy termék neve alapján…">
        </div>
        <button type="submit" class="btn btn-ghost">Keresés</button>
        @if ($needle)
            <a href="{{ route('categories.index') }}" class="btn btn-link">Szűrő törlése</a>
        @endif
    </form>

    @if ($categories->isEmpty())
        <div class="empty">
            <x-icon name="glass" />
            <h2>Nincs megjeleníthető kategória</h2>
            <p class="muted">
                @if ($needle)
                    A(z) „{{ $needle }}” keresésre nincs találat.
                @else
                    Hozd létre az első kategóriát, és kezdheted a termékek felvitelét.
                @endif
            </p>
        </div>
    @else
        <div class="cat-grid">
            @foreach ($categories as $category)
                @php $count = $category->products->count(); @endphp

                <article class="cat-card">
                    <div class="cat-head">
                        <span class="cat-icon"><x-icon :name="$category->icon" /></span>
                        <div>
                            <h2>{{ $category->name }}</h2>
                            <span class="muted small">{{ $count }} termék</span>
                        </div>
                    </div>

                    <div class="chips">
                        @forelse ($category->products->take(4) as $product)
                            <span class="chip">{{ $product->name }}</span>
                        @empty
                            <span class="muted small">Még nincs termék ebben a kategóriában.</span>
                        @endforelse

                        @if ($count > 4)
                            <span class="chip chip-more">+{{ $count - 4 }}</span>
                        @endif
                    </div>

                    <div class="card-actions">
                        <a href="{{ route('products.index', ['category' => $category->id]) }}" class="btn btn-link btn-sm">Termékek</a>
                        <span class="spacer"></span>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-ghost btn-sm" title="Szerkesztés">
                            <x-icon name="pencil" /> Szerkesztés
                        </a>
                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}"
                              data-confirm="Biztosan törlöd a(z) „{{ $category->name }}” kategóriát? A hozzá tartozó {{ $count }} termék is törlődik!">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger-ghost btn-sm btn-icon" title="Törlés" aria-label="Törlés">
                                <x-icon name="trash" />
                            </button>
                        </form>
                    </div>
                </article>
            @endforeach
        </div>
    @endif
@endsection
