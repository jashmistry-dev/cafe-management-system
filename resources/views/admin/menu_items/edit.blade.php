
@extends('admin.layout')

@section('content')

<h2 class="text-2xl font-bold">Edit Menu Item</h2>

<form method="POST" action="{{ route('menu-items.update', $menuItem->id) }}">
    @csrf
    @method('PUT')

    <label>Name</label>
    <input type="text" name="name" value="{{ $menuItem->name }}">

    <br><br>

    <label>Price</label>
    <input type="number" name="price" value="{{ $menuItem->price }}">

    <br><br>

    <label>Category</label>
    <select name="category_id">

        @foreach($categories as $category)
            <option value="{{ $category->id }}"
                {{ $menuItem->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach

    </select>

    <br><br>

    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg" type="submit">Update Item</button>

</form>


@endsection