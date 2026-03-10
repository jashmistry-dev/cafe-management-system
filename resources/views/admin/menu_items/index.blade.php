@extends('admin.layout')

@section('content')

    <h1 class="text-2xl font-bold"> Menu Items</h1>

    <br>
    <a class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium" href="{{ route('menu-items.create') }}">Add Menu Item</a>
    <br>
    <br>


    <div class="grid md:grid-cols-3 gap-6">

        @foreach($menuItems as $item)

            <div class="bg-white shadow rounded-xl overflow-hidden">

                @if($item->image)

                    <img src="{{ asset('storage/' . $item->image) }}" class="h-40 w-full object-cover">

                @endif

                <div class="p-4">

                    <h3 class="font-bold">
                        {{ $item->name }}
                    </h3>

                    <p class="text-primary font-semibold">
                        ₹ {{ $item->price }}
                    </p>

                    <br>

                    
                    
                    
                    <form action="{{ route('menu-items.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        
                        <a class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg" href="{{ route('menu-items.edit', $item->id) }}">Edit</a>
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg"
                            type="submit">Delete</button>
                    </form>

                </div>

            </div>

        @endforeach

    </div>


@endsection