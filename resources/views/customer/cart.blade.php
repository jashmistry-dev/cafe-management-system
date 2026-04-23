@extends('customer.layout')

@section('content')
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.6.2/dist/countUp.umd.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#C67C4E",
                        primarydark: "#8B5E3C",
                        accent: "#F8F5F2",
                        success: "#22C55E",
                        danger: "#EF4444"
                    }
                }
            }
        }
    </script>
    <div class="max-w-4xl mx-auto p-4">


        <h2 class="text-2xl md:text-3xl font-bold mb-6">
            Your Cart
        </h2>

        <div class="bg-white rounded-2xl shadow p-6">

            @if(count($cart) == 0)

                <div class="text-center py-10">
                    <p class="text-4xl mb-2">🛒</p>
                    <p class="text-gray-500">Your cart is empty</p>
                </div>

            @else

                @php $total = 0; @endphp

                <div class="space-y-4 mb-6">

                    @foreach($cart as $index => $item)

                        @php
                            $subtotal = $item['price'] * $item['quantity'];
                            $total += $subtotal;
                        @endphp

                        <div class="flex items-center gap-4 border-b pb-4">

                            <img src="{{ isset($item['image']) ? asset('storage/' . $item['image']) : 'https://via.placeholder.com/60' }}"
                                class="w-16 h-16 rounded-lg object-cover">

                            <div class="flex-1">
                                <h3 class="font-semibold">{{ $item['name'] }}</h3>
                                <p class="text-sm text-gray-500">
                                    ₹ {{ $item['price'] }}
                                </p>
                            </div>

                            <div class="flex items-center gap-2">

                                <form method="POST" action="{{ route('cart.decrease') }}">
                                    @csrf
                                    <input type="hidden" name="index" value="{{ $index }}">
                                    <button class="bg-gray-200 px-3 py-1 rounded">-</button>
                                </form>

                                <span class="font-bold w-6 text-center">{{ $item['quantity'] }}</span>

                                <form method="POST" action="{{ route('cart.increase') }}">
                                    @csrf
                                    <input type="hidden" name="index" value="{{ $index }}">
                                    <button class="bg-primary text-white px-3 py-1 rounded">+</button>
                                </form>

                            </div>

                            <div class="text-right">

                                <p class="font-semibold text-primary">
                                    ₹ {{ $subtotal }}
                                </p>

                                <!-- DELETE -->
                                <form method="POST" action="{{ route('cart.remove') }}">
                                    @csrf
                                    <input type="hidden" name="index" value="{{ $index }}">
                                    <button class="text-red-500 text-sm mt-1">Remove</button>
                                </form>

                            </div>

                        </div>

                    @endforeach

                </div>

                <div class="flex justify-between items-center border-t pt-4 mb-6">

                    <span class="text-lg font-semibold">Total</span>

                    <span class="text-xl font-bold text-green-600">
                        ₹ {{ $total }}
                    </span>

                </div>

                <form method="POST" action="{{ route('order.place') }}" class="space-y-4">

                    @csrf

                    <input type="text" name="name" placeholder="Your Name"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary outline-none" required>

                    <input type="text" name="mobile" placeholder="Mobile Number"
                        class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-primary outline-none" required>
                    <div class="mb-4">
                        <label class="font-semibold">Payment Method</label>

                        <div class="flex gap-4 mt-2">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="payment_method" value="online" checked>
                                Online
                            </label>

                            <label class="flex items-center gap-2">
                                <input type="radio" name="payment_method" value="cash">
                                Cash
                            </label>
                        </div>
                    </div>
                    <button class="w-full bg-primary hover:bg-primarydark text-white py-3 rounded-lg font-semibold">
                        Place Order
                    </button>

                </form>

            @endif

        </div>


    </div>

@endsection