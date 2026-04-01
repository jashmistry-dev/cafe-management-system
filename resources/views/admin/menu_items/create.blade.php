@extends('admin.layout')

@section('content')
    <div class="bg-white shadow rounded-xl p-8 max-w-2xl">
        <div class="p-4 sm:p-6 opacity-0 animate-fadeIn">


            <h2 class="text-2xl font-bold mb-6">Add Menu Item</h2>

            <form method="POST" action="{{ route('menu-items.store') }}" enctype="multipart/form-data">
                @csrf

                <label class="block mb-2 font-medium">Name</label>
                <input class="border rounded-lg w-full p-2 mb-4" type="text" name="name" placeholder="Pizza">

                <div class="mb-4">

                    <label class="block mb-2 font-medium">Food Image</label>

                    <input class="border rounded-lg w-full p-2 mb-4" type="file" name="image">

                </div>


                <label class="block mb-2 font-medium">Price</label>
                <input class="border rounded-lg w-full p-2 mb-4" type="number" name="price" placeholder="899">

                <br><br>

                <label class="block mb-2 font-medium">Category</label>
                <select class="border rounded-lg w-full p-2 mb-4" name="category_id">

                    @foreach($categories as $category)
                        @if ($category->status === 1)

                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endif
                    @endforeach

                </select>

                <br><br>

                <button class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium"
                    type="submit">Save Item</button>

            </form>
        </div>
    </div>


@endsection