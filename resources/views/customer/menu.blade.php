@extends('customer.layout')

@section('content')

    <head>
        <style>
            .line-clamp-2 {
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }
        </style>
    </head>
    <h2 class="text-2xl md:text-3xl font-bold mb-6">
        Menu
    </h2>

    <!-- 📱 MOBILE VIEW -->

    <div class="block md:hidden space-y-6">


        @foreach($menuItems as $item)
            @if ($item->status === 1)

                <div class="flex justify-between gap-4 border-b pb-5">

                    <!-- LEFT -->
                    <div class="flex-1">

                        <h3 class="font-semibold text-lg">
                            {{ $item->name }}
                        </h3>

                        <p class="text-orange-500 font-bold">
                            ₹ {{ $item->price }}
                        </p>

                        <p class="text-sm text-gray-500">
                            Delicious item from our cafe
                        </p>

                    </div>

                    <!-- RIGHT -->
                    <div class="relative w-24">

                        <img src="{{ asset('storage/' . $item->image) }}" class="w-24 h-24 object-cover rounded-xl">
                        <form id="cart-form-{{ $item->id }}" method="POST" action="/cart/add">
                            @csrf
                            <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                            <input type="hidden" name="table_id" value="{{ $table->id }}">

                            <button type="button" onclick="addToCart(this, {{ $item->id }})"
                                class="absolute -bottom-2 left-1/2 -translate-x-1/2 bg-white border shadow px-3 py-1 rounded-lg text-green-600 font-semibold transition active:scale-90">
                                ADD
                            </button>
                        </form>

                    </div>

                </div>

            @endif
        @endforeach


    </div>

    <!-- 💻 DESKTOP VIEW -->

    <div class="hidden md:grid md:grid-cols-3 gap-8">


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

                        <form id="cart-form-{{ $item->id }}" method="POST" action="/cart/add"> @csrf

                            <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                            <input type="hidden" name="table_id" value="{{ $table->id }}">

                            <button type="button" onclick="addToCart(this, {{ $item->id }})"
                                class="mt-3 bg-orange-500 text-white px-4 py-2 rounded-lg w-full transition transform active:scale-90">
                                Add to Cart
                            </button>
                        </form>

                    </div>

                </div>

            @endif
        @endforeach


    </div>
    <script>
        function addToCart(btn, id) {

            let originalText = btn.innerText;

            btn.innerText = "Added ✓";

            btn.classList.remove("bg-orange-500", "text-white");
            btn.classList.add("bg-green-500", "text-white");

            btn.classList.add("scale-110");

            setTimeout(() => {
                btn.classList.remove("scale-110");
            }, 200);

            showToast("Item added to cart 🛒");

            setTimeout(() => {
                document.getElementById('cart-form-' + id).submit();
            }, 400);
        }


        function showToast(message) {

            let toast = document.createElement("div");
            toast.innerText = message;

            toast.className = `
            fixed bottom-5 left-1/2 -translate-x-1/2
            bg-black text-white px-4 py-2 rounded-lg
            shadow-lg text-sm opacity-0
            transition-all duration-300 z-50
        `;

            document.body.appendChild(toast);

            setTimeout(() => {
                toast.classList.add("opacity-100", "bottom-10");
            }, 10);

            setTimeout(() => {
                toast.classList.remove("opacity-100");
                toast.classList.add("opacity-0");

                setTimeout(() => toast.remove(), 300);
            }, 1500);
        }
    </script>

@endsection