@extends('layouts.app')

@section('title', __('Új termék létrehozása'))

@section('content')
<h1>Új termék</h1>

  <form action="{{ route('products.store') }}" method="POST">
      @csrf

      <label for="name">Termék neve</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}" required>
      <label for="name">Alkoholtartalom</label>
      <input type="text" name="percentage" id="percentage" value="{{ old('percentage') }}" required>
      <label for="name">Kategória</label>
      <select name="category_id" id="category_id">
      @foreach($categories as $category)
        <option value="{{ $category->id }}">{{ $category->name }}</option>
      @endforeach
      </select>
     

      <button type="submit">Mentés</button>
      <a href="{{ route('categories.index') }}">Mégse</a>
  </form>
@endsection