@extends('admin.layout')

@section('content')
    <div class="bg-white shadow rounded-xl p-8 max-w-2xl">
        <div class="p-4 sm:p-6 opacity-0 animate-fadeIn">

            <h2 class="text-2xl font-bold mb-6">Edit Menu Item</h2>

            <form method="POST" action="{{ route('menu-items.update', $menuItem->id) }}">
                @csrf
                @method('PUT')

                <label class="block mb-2 font-medium">Name</label>
                <input class="border rounded-lg w-full p-2 mb-4" type="text" name="name" value="{{ $menuItem->name }}">

                <br><br>

                <label class="block mb-2 font-medium">Price</label>
                <input class="border rounded-lg w-full p-2 mb-4" type="number" name="price" value="{{ $menuItem->price }}">

                <br><br>

                <label class="block mb-2 font-medium">Category</label>
                <select class="border rounded-lg w-full p-2 mb-4" name="category_id">

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $menuItem->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>

                <br><br>

                <button class="bg-primary hover:bg-success text-white px-4 py-2 rounded-lg font-medium"
                    type="submit">Update Item</button>

            </form>


@endsection