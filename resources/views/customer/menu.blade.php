@extends('customer.layout')

@section('content')

    <h2 class="text-3xl font-bold mb-8">
        Menu
    </h2>

    <div class="grid md:grid-cols-3 gap-8">

        @foreach($menuItems as $item)
            @if ($item->status === 1)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">

                    <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-48 object-cover">

                    <div class="p-4">

                        <h3 class="text-lg font-semibold">
                            {{ $item->name }}
                        </h3>

                        <p class="text-orange-500 font-bold">
                            ₹ {{ $item->price }}
                        </p>

                        <form method="POST" action="/cart/add">

                            @csrf

                            <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                            <input type="hidden" name="table_id" value="{{ $table->id }}">

                            <button class="mt-3 bg-orange-500 text-white px-4 py-2 rounded-lg w-full">

                                Add to Cart

                            </button>

                        </form>

                    </div>

                </div>
            @endif
        @endforeach

    </div>

@endsection