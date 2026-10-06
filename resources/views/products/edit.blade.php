@extends('layouts.app')

@section('content')
<h1>Termék módosítása</h1>

  <form action="{{ route('products.update', $product->id) }}" method="POST">
      @csrf
      @method('patch')
      <label for="name">Termék neve</label>
      <input type="text" name="name" id="name" value="{{ old('name',  $product->name) }}" required>
      <label for="name">Alkoholtartalom</label>
      <input type="text" name="percentage" id="percentage" value="{{ old('percentage' , $product->percentage) }}" required>
      <label for="name">Kategória</label>
      <select name="category_id" id="category_id">
      @foreach($categories as $category)
        <option value="{{ $category->id }} " @selected(old('category_id', $product->category_id))>{{ $category->name }}</option>
      @endforeach
      </select>
      <button type="submit">Mentés</button>
      <a href="{{ route('products.index') }}">Mégse</a>
  </form>
@endsection
