@extends('layouts.app')

@section('title', 'Új kategória')

@section('content')
    <a href="{{ route('categories.index') }}" class="back"><x-icon name="arrow-left" /> Vissza a kategóriákhoz</a>

    <div class="form-card">
        <h1>Új kategória</h1>
        <p class="muted">Add meg az alkoholfajta nevét.</p>

        @include('categories._form', [
            'category' => null,
            'action'   => route('categories.store'),
            'method'   => 'POST',
        ])
    </div>
@endsection
