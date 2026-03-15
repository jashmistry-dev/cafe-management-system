@extends('staff.layout')

@section('content')

    <h2 class="text-3xl font-bold mb-8">
        Customer's Menu 
    </h2>

    <div class="grid md:grid-cols-3 gap-8">

        @foreach($menuItems as $item)

            <div class="bg-white rounded-xl shadow-md overflow-hidden">

                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-48 object-cover">

                <div class="p-4">

                    <h3 class="text-lg font-semibold">
                        {{ $item->name }}
                    </h3>

                    <p class="text-orange-500 font-bold">
                        ₹ {{ $item->price }}
                    </p>

                   

                </div>

            </div>

        @endforeach

    </div>

@endsection