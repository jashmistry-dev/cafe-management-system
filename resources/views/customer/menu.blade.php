@extends('customer.layout')

@section('content')

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>

    <h2 class="text-2xl md:text-3xl font-bold mb-6">
        Menu
    </h2>

    <div class="sticky top-0 bg-white z-50 shadow-sm mb-4">
        <div class="flex overflow-x-auto md:justify-center gap-3 p-3">
            @foreach($categories as $category)
                <button onclick="scrollToCategory(event, {{ $category->id }})"
                    class="px-4 py-2 bg-gray-100 rounded-full text-sm whitespace-nowrap hover:bg-primary hover:text-white hover:bg-black transition">
                    {{ $category->name }}
                </button>
            @endforeach

        </div>
    </div>

    <div class="block md:hidden space-y-8">

        @foreach($categories as $category)

            <div id="cat-{{ $category->id }}">

                <h3 class="text-lg font-bold mb-3">
                    {{ $category->name }}
                </h3>

                @foreach($category->menuItems as $item)

                    <div class="flex justify-between gap-4 border-b pb-5">

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

                @endforeach

            </div>

        @endforeach

    </div>

    <!-- 💻 DESKTOP VIEW -->
    <div class="hidden md:block max-w-6xl mx-auto space-y-12">

        @foreach($categories as $category)

            @if(count($category->menuItems) > 0)

                <div id="cat-{{ $category->id }}" class="mb-12 scroll-mt-32">
                    <hr class="mb-6 border-gray-200">
                    <!-- CATEGORY TITLE -->
                    <h3 class="text-2xl font-bold mb-6">
                        {{ $category->name }}
                    </h3>

                    <!-- GRID -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                        @foreach($category->menuItems as $item)

                            <div class="bg-white rounded-xl shadow-md overflow-hidden w-full hover:shadow-xl transition duration-300">
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-44 object-cover">

                                <div class="p-4 space-y-2">

                                    <h3 class="text-lg font-semibold mb-1">
                                        {{ $item->name }}
                                    </h3>

                                    <p class="text-orange-500 font-bold mb-2">
                                        ₹ {{ $item->price }}
                                    </p>

                                    <form id="cart-form-{{ $item->id }}" method="POST" action="/cart/add">
                                        @csrf
                                        <input type="hidden" name="menu_item_id" value="{{ $item->id }}">
                                        <input type="hidden" name="table_id" value="{{ $table->id }}">

                                        <button type="button" onclick="addToCart(this, {{ $item->id }})"
                                            class="bg-orange-500 text-white px-4 py-2 rounded-lg w-full transition active:scale-90">
                                            Add to Cart
                                        </button>
                                    </form>

                                </div>

                            </div>

                        @endforeach

                    </div>

                </div>

            @endif

        @endforeach

    </div>

    <script>


        function scrollToCategory(e, id) {
            if (e) e.preventDefault();

            const el = document.getElementById('cat-' + id);
            if (!el) return;

            const rect = el.getBoundingClientRect();
            const absoluteTop = rect.top + window.pageYOffset;

            const HEADER_OFFSET = 120;

            window.scrollTo({
                top: absoluteTop - HEADER_OFFSET,
                behavior: 'smooth'
            });
        }


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