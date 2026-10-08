@extends('layouts.app')

@section('title', 'Új termék')

@section('content')
    <a href="{{ route('products.index') }}" class="back"><x-icon name="arrow-left" /> Vissza a termékekhez</a>

    <div class="form-card">
        <h1>Új termék</h1>
        <p class="muted">Add meg a termék nevét, alkoholtartalmát és kategóriáját.</p>

        @include('products._form', [
            'product' => null,
            'action'  => route('products.store'),
            'method'  => 'POST',
        ])
    </div>
@endsection
