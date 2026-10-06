@extends('layouts.app')

@section('content')

  <h1>Kategóriák</h1>

  @foreach($categories as $category)
      <p>{{ $category->name }}</p>
      <form method="POST" action="{{ route('categories.destroy', $category->id) }}">
      <a href="{{ route('categories.edit', $category->id) }}">Szerkesztés</a>
      @csrf
      @method('DELETE')
      <button type="submit">Törlés</button>
      </form>
  @endforeach

@endsection