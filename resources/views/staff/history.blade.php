@extends('staff.layout')

@section('content')


    <!-- ✅ ONLY ONE CONTAINER -->

    <h2 class="text-2xl font-bold mb-6">Order History</h2>
    <form method="GET" class="mb-6 bg-white p-4 rounded-xl shadow flex flex-wrap gap-4 items-end">

        <!-- SEARCH -->
        <div>
            <label class="text-sm">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Order ID / Name / Mobile"
                class="border rounded px-3 py-2">
        </div>

        <!-- DATE -->
        <div>
            <label class="text-sm">From</label>
            <input type="date" name="from_date" value="{{ request('from_date') }}" class="border rounded px-3 py-2">
        </div>

        <div>
            <label class="text-sm">To</label>
            <input type="date" name="to_date" value="{{ request('to_date') }}" class="border rounded px-3 py-2">
        </div>

        <!-- AMOUNT -->
        <div>
            <label class="text-sm">Min ₹</label>
            <input type="number" name="min_amount" value="{{ request('min_amount') }}"
                class="border rounded px-3 py-2 w-28">
        </div>

        <div>
            <label class="text-sm">Max ₹</label>
            <input type="number" name="max_amount" value="{{ request('max_amount') }}"
                class="border rounded px-3 py-2 w-28">
        </div>

        <!-- BUTTON -->
        <div>
            <button class="bg-primary text-white px-4 py-2 rounded-lg">
                Apply
            </button>
        </div>

        <!-- RESET -->
        <div>
            <a href="{{ route('orders.history') }}" class="bg-gray-200 px-4 py-2 rounded-lg">
                Reset
            </a>
        </div>

    </form>
    <div class="overflow-x-auto bg-white rounded-xl shadow">


        <table class="w-full text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Order #</th>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Mobile</th>
                    <th class="p-3">Items</th>
                    <th class="p-3">Total Amount</th>
                    <th class="p-3">Action</th>
                </tr>

            </thead>

            <tbody>

                @foreach($orders as $order)

                    <style>
                        #details-{{ $order->id }} {
                            transition: all 0.3s ease;
                        }
                    </style>

                    <tr onclick="toggleDetails({{ $order->id }})" class="border-b hover:bg-gray-50 cursor-pointer">

                        <td class="p-3 font-bold">
                            #{{ $order->id }}
                        </td>

                        <td class="p-3">
                            {{ $order->customer->name ?? 'N/A' }}
                        </td>

                        <td class="p-3">
                            {{ $order->customer->mobile ?? 'N/A' }}
                        </td>

                        <td class="p-3">
                            {{ $order->total_items ?? 0 }}
                        </td>

                        <td class="p-3 font-semibold text-green-600">
                            ₹{{ $order->total_amount ?? 0 }}
                        </td>
                        <td class="p-3 font-bold">
                            ⬇️
                        </td>

                    </tr>
                    <tr id="details-{{ $order->id }}" class="hidden bg-gray-50">
                        <td colspan="6">

                            <div id="content-{{ $order->id }}" class="mx-auto max-w-3xl bg-white rounded-2xl shadow-md p-5 border border-gray-100
                                                    transform transition-all duration-300 ease-in-out scale-95 opacity-0">
                                <div class="flex justify-between items-center mb-4">
                                    <h3 class="text-lg font-semibold text-gray-800">
                                        Order #{{ $order->id }}
                                    </h3>
                                    <span class="text-sm text-gray-500">
                                        {{ $order->created_at->format('d M Y, h:i A') }}
                                    </span>
                                </div>

                                <!-- CUSTOMER -->
                                <div class="mb-4 text-sm text-gray-700">
                                    <p><span class="font-semibold">Customer:</span> {{ $order->customer->name }}</p>
                                    <p><span class="font-semibold">Mobile:</span> {{ $order->customer->mobile }}</p>
                                </div>

                                <!-- ITEMS -->
                                <div class="mb-4">
                                    <p class="font-semibold text-gray-800 mb-2">Items</p>

                                    <div class="space-y-2">

                                        @foreach($order->items as $item)
                                            <div class="flex justify-between items-center bg-gray-50 px-3 py-2 rounded-lg">

                                                <div class="text-sm text-gray-700">
                                                    {{ $item->menuItem->name }}
                                                    <span class="text-gray-500">× {{ $item->quantity }}</span>
                                                </div>

                                                <div class="font-medium text-gray-800">
                                                    ₹ {{ $item->price * $item->quantity }}
                                                </div>

                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <!-- TOTAL -->
                                <div class="flex justify-between items-center border-t pt-3 mt-3">

                                    <span class="text-lg font-semibold text-gray-800">
                                        Total
                                    </span>

                                    <span class="text-xl font-bold text-green-600">
                                        ₹ {{ $order->total_amount }}
                                    </span>

                                </div>

                            </div>

                        </td>
                    </tr>

                @endforeach

            </tbody>

        </table>


    </div>






    <script>
        document.querySelector('input[name="search"]').addEventListener('input', function () {
            this.form.submit();
        });

        let timer;
        document.querySelector('input[name="search"]').addEventListener('input', function () {
            clearTimeout(timer);
            timer = setTimeout(() => {
                this.form.submit();
            }, 500);
        });

        function toggleDetails(id) {

            document.querySelectorAll('[id^="details-"]').forEach(el => {
                if (el.id !== 'details-' + id) {
                    el.classList.add('hidden');
                }
            });

            document.querySelectorAll('[id^="content-"]').forEach(el => {
                if (el.id !== 'content-' + id) {
                    el.classList.remove('scale-100', 'opacity-100');
                    el.classList.add('scale-95', 'opacity-0');
                }
            });

            let row = document.getElementById('details-' + id);
            let content = document.getElementById('content-' + id);

            if (row.classList.contains('hidden')) {
                row.classList.remove('hidden');

                setTimeout(() => {
                    content.classList.remove('scale-95', 'opacity-0');
                    content.classList.add('scale-100', 'opacity-100');
                }, 10);

            } else {
                content.classList.remove('scale-100', 'opacity-100');
                content.classList.add('scale-95', 'opacity-0');

                setTimeout(() => {
                    row.classList.add('hidden');
                }, 300);
            }
        }
    </script>
@endsection