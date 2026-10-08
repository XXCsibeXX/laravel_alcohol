<form action="{{ $action }}" method="POST" class="form">
    @csrf
    @if ($method !== 'POST')
        @method($method)
    @endif

    <div class="field">
        <label for="name">Kategória neve</label>
        <input type="text" name="name" id="name" value="{{ old('name', $category?->name) }}"
               placeholder="pl. Whisky" maxlength="255" required autofocus
               @class(['is-invalid' => $errors->has('name')])>
        @error('name')
            <p class="field-error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary"><x-icon name="check" /> Mentés</button>
        <a href="{{ route('categories.index') }}" class="btn btn-link">Mégse</a>
    </div>
</form>
