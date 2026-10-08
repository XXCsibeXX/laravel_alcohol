@php
    // Kiválasztott kategória: előbb a hibás beküldés utáni érték, aztán a termék saját kategóriája,
    // végül a ?category=ID paraméter (a kategóriák oldaláról érkezve).
    $selected = old('category_id', $product?->category_id ?? request('category'));
@endphp

@if ($categories->isEmpty())
    <div class="alert alert-error">
        <x-icon name="alert" />
        <span>Termék felvételéhez előbb hozz létre legalább egy <a href="{{ route('categories.create') }}">kategóriát</a>.</span>
    </div>
@endif

<form action="{{ $action }}" method="POST" class="form">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="field">
        <label for="name">Termék neve</label>
        <input type="text" name="name" id="name" value="{{ old('name', $product?->name) }}"
               placeholder="pl. Soproni Ászok" maxlength="255" required autofocus
               @class(['is-invalid' => $errors->has('name')])>
        @error('name')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label for="percentage">Alkoholtartalom</label>
        <div class="input-suffix">
            <input type="text" name="percentage" id="percentage" inputmode="decimal"
                   value="{{ old('percentage', $product?->percentage) }}" placeholder="pl. 4,5" required
                   @class(['is-invalid' => $errors->has('percentage')])>
            <span>%</span>
        </div>
        @error('percentage')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label for="category_id">Kategória</label>
        <select name="category_id" id="category_id" required @class(['is-invalid' => $errors->has('category_id')])>
            <option value="" disabled @selected(! $selected)>Válassz kategóriát…</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected((string) $selected === (string) $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><x-icon name="check" /> Mentés</button>
        <a href="{{ route('products.index') }}" class="btn btn-link">Mégse</a>
    </div>
</form>
