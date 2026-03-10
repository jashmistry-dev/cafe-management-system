@extends('admin.layout')

@section('content')

    <h2 class="text-2xl font-bold">Add Menu Item</h2>

    <form method="POST" action="{{ route('menu-items.store') }}" enctype="multipart/form-data">
        @csrf

        <label>Name</label>
        <input type="text" name="name">

        <div class="mb-4">

            <label class="block mb-1 font-semibold">Food Image</label>

            <input type="file" name="image" class="border p-2 w-full rounded">

        </div>

        <br><br>

        <label>Price</label>
        <input type="number" name="price">

        <br><br>

        <label>Category</label>
        <select name="category_id">

            @foreach($categories as $category)
                <option value="{{ $category->id }}">
                    {{ $category->name }}
                </option>
            @endforeach

        </select>

        <br><br>

        <button class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium" type="submit">Save Item</button>

    </form>


@endsection