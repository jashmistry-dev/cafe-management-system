
@extends('customer.layout')

@section('content')

<h2>Menu - Table {{ $table->table_number }}</h2>

@foreach($menuItems as $item)

<div style="border:1px solid #ccc; padding:10px; margin:10px;">

    <h3>{{ $item->name }}</h3>

    <p>Price: ₹{{ $item->price }}</p>

    <form method="POST" action="{{ route('cart.add') }}">
        @csrf

        <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
        <input type="hidden" name="table_id" value="{{ $table->id }}">

        <button type="submit">Add to Cart</button>

    </form>

</div>

@endforeach

<a href="{{ route('cart.view') }}">View Cart</a>

@endsection