@extends('layouts.app')

@section('title', __('Új kategória létrehozása'))

@section('content')
<h1>Új kategória</h1>

  <form action="{{ route('counties.store') }}" method="POST">
      @csrf

      <label for="name">Kategória neve</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}" required>

      <button type="submit">Mentés</button>
      <a href="{{ route('categories.index') }}">Mégse</a>
  </form>
@endsection