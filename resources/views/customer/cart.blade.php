@extends('customer.layout')

@section('content')
    @php
        $total = 0;
    @endphp
    <h2 class="text-3xl font-bold mb-8">
        Your Cart
    </h2>

    <div class="bg-white rounded-2xl shadow-lg p-8">

        @if(count($cart) == 0)

            <p class="text-gray-500">
                Your cart is empty
            </p>

        @else

            <div class="space-y-4 mb-6">

                @foreach($cart as $item)

                    @php
                        $subtotal = $item['price'] * $item['quantity'];
                        $total += $subtotal;
                    @endphp




                    <div>

                        <span>

                            <!-- <div class="flex items-center gap-4 mb-4 border-b pb-3"> -->

                            <img src="{{ isset($item['image']) ? asset('storage/' . $item['image']) : 'https://via.placeholder.com/60' }}"
                                class="w-14 h-14 rounded object-cover">
                            <!-- <div> -->
                        </span>
                        <span>{{ $item['name'] }}</span>

                        <span class="font-semibold">

                            ₹ {{ $item['price'] }} × {{ $item['quantity'] }}
                        </span>

                        <span> = ₹ {{ $subtotal }}</span>

                @endforeach
                    <br>
                    <span>
                        <strong>

                            Grand Total: ₹ {{ $total }}

                        </strong>
                    </span>
                </div>
            </div>

            <form method="POST" action="{{ route('order.place') }}">

                @csrf

                <div class="grid md:grid-cols-2 gap-4 mb-4">

                    <input type="text" name="name" placeholder="Customer Name" class="border rounded-lg px-3 py-2 w-full"
                        required>

                    <input type="text" name="mobile" placeholder="Mobile Number" class="border rounded-lg px-3 py-2 w-full"
                        required>

                </div>

                <button class="bg-primary hover:bg-primarydark text-white px-6 py-2 rounded-lg">

                    Place Order

                </button>

            </form>

        @endif

    </div>

@endsection