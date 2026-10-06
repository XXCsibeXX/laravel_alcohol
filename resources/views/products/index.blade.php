@extends('layouts.app')

@section('content')

  <h1>Termékek</h1>
  <a href="{{ route('products.create') }}">Új termék</a>
  @foreach($products as $product)
    <p>
        {{ $product->name }} |
        {{ $product->percentage }}% |
        {{ $product->category->name }}
    </p>
    <form action="{{ route('products.destroy', $product->id) }}" method="POST">
      <a href="{{ route('products.edit', $product->id) }}">Szerkesztés</a>
      @csrf
      @method('DELETE')
      <button type="submit">Törlés</button>
    </form>
  @endforeach

@endsection
