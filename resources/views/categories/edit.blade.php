@extends('layouts.app')

@section('title', 'Kategória módosítása')

@section('content')
    <a href="{{ route('categories.index') }}" class="back"><x-icon name="arrow-left" /> Vissza a kategóriákhoz</a>

    <div class="form-card">
        <h1>Kategória módosítása</h1>
        <p class="muted">Szerkeszd a(z) „{{ $category->name }}” kategória nevét.</p>

        @include('categories._form', [
            'category' => $category,
            'action'   => route('categories.update', $category->id),
            'method'   => 'PUT',
        ])
    </div>
@endsection
