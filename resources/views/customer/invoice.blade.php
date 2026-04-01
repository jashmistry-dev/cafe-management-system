@extends('customer.layout')

@section('content')
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
    <div class="max-w-3xl mx-auto bg-white shadow-xl rounded-xl p-8 print:shadow-none print:p-0">

       
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="text-3xl font-bold text-primary">Coffe Culture</h1>
            <p class="text-gray-500 text-sm">Delicious Food & Drinks</p>
        </div>

        <hr class="mb-6">

        <!-- Order Info -->
        <div class="grid grid-cols-2 gap-4 text-sm mb-6">

            <div>
                <p><span class="font-semibold">Order ID:</span> #{{ $order->id }}</p>
                <p><span class="font-semibold">Table:</span> {{ $order->table->table_number }}</p>
                <p><span class="font-semibold">Date:</span> {{ $order->created_at->format('d M Y, h:i A') }}</p>
            </div>

            <div class="text-right">
                <p><span class="font-semibold">Customer:</span> {{ $order->customer->name }}</p>
                <p><span class="font-semibold">Mobile:</span> {{ $order->customer->mobile }}</p>
            </div>

        </div>

        <!-- Table -->
        <div class="overflow-hidden rounded-lg border">

            <table class="w-full text-sm">

                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3 text-left">Item</th>
                        <th class="p-3 text-center">Qty</th>
                        <th class="p-3 text-right">Price</th>
                        <th class="p-3 text-right">Total</th>
                    </tr>
                </thead>

                <tbody>

                    @php $grandTotal = 0; @endphp

                    @foreach($order->items as $item)

                        @php
                            $total = $item->price * $item->quantity;
                            $grandTotal += $total;
                        @endphp

                        <tr class="border-t">
                            <td class="p-3">{{ $item->menuItem->name }}</td>
                            <td class="p-3 text-center">{{ $item->quantity }}</td>
                            <td class="p-3 text-right">₹ {{ $item->price }}</td>
                            <td class="p-3 text-right font-medium">₹ {{ $total }}</td>
                        </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- Total -->
        <div class="mt-6 flex justify-end">
            <div class="text-right">
                <p class="text-gray-500">Grand Total</p>
                <p class="text-2xl font-bold text-green-600">₹ {{ $grandTotal }}</p>
            </div>
        </div>

        <!-- Footer -->
        <div class="mt-10 text-center text-gray-500 text-sm">
            <p>Thank you for visiting ☕</p>
            <p>Visit again!</p>
        </div>

        <!-- Buttons (Hidden in print) -->
        <div class="mt-6 flex justify-center gap-4 print:hidden">

            <button onclick="window.print()" class="bg-primary hover:bg-primarydark text-white px-6 py-2 rounded-lg">
                Print Invoice
            </button>

            <a href="{{ route('order.status', $order->id) }}">
                <button class="bg-gray-800 text-white px-6 py-2 rounded-lg">
                    Track Order
                </button>
            </a>

        </div>
        

    </div>

@endsection