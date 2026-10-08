@extends('layouts.app')

@section('title', 'Termék módosítása')

@section('content')
    <a href="{{ route('products.index') }}" class="back"><x-icon name="arrow-left" /> Vissza a termékekhez</a>

    <div class="form-card">
        <h1>Termék módosítása</h1>
        <p class="muted">Szerkeszd a(z) „{{ $product->name }}” adatait.</p>

        @include('products._form', [
            'product' => $product,
            'action'  => route('products.update', $product->id),
            'method'  => 'PUT',
        ])
    </div>
@endsection
