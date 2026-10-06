@extends('layouts.app')

@section('content')
<h1>Kategória módosítása</h1>

  <form action="{{ route('categories.update', $category->id) }}" method="POST">
      @csrf
      @method('patch')
      <label for="name">Kategória neve</label>
      <input type="text" name="name" id="name" value="{{ old('name',  $category->name) }}" required>

      <button type="submit">Mentés</button>
      <a href="{{ route('categories.index') }}">Mégse</a>
  </form>
@endsection