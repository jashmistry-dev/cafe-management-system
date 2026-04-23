@extends('staff.layout')

@section('content')


    <h2 class="text-3xl font-bold text-gray-800 mb-6">
        Kitchen Orders
    </h2>



    <div id="ordersContainer" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($orders as $order)



            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">


                @if($order->payment_method === 'cash' && $order->payment_status === 'pending')
                    <form method="POST" action="{{ route('staff.order.pay', $order->id) }}">
                        @csrf
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg">
                            Mark Paid
                        </button>
                    </form>
                @endif

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Table {{ $order->table->table_number }}
                    </h3>

                    <span class="text-2xl bg-gray-100 px-3 py-1 rounded-full">
                        <b>#{{ $order->id }}</b>
                    </span>
                </div>

                <div class="space-y-2 mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">
                        Ordered Items:
                    </h3>
                    @foreach($order->items as $item)
                        <div class="flex justify-between text-gray-700">
                            <span>{{ $item->menuItem->name }}</span>
                            <span class="font-semibold">× {{ $item->quantity }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="mb-4">
                    <span
                        class="px-3 py-1 rounded-full text-sm font-bold bg-orange-300
                                                                                                                                            @if($order->status == 'pending') bg-yellow-100 text-yellow-700
                                                                                                                                            @elseif($order->status == 'preparing') bg-orange-100 text-orange-700
                                                                                                                                            @elseif($order->status == 'ready') bg-green-100 text-green-700
                                                                                                                                            @else bg-gray-200 text-gray-700
                                                                                                                                            @endif
                                                                                                                                         ">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>


                <form method="POST" action="{{ route('staff.order.status', $order->id) }}" class="flex gap-3">
                    @csrf

                    <select name="status" class="flex-1 border border-gray-300 rounded-lg px-3 py-2">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="preparing" {{ $order->status == 'preparing' ? 'selected' : '' }}>Preparing</option>
                        <option value="ready" {{ $order->status == 'ready' ? 'selected' : '' }}>Ready</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>

                    <button class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg">
                        Update
                    </button>
                </form>

            </div>
        @empty

                <div class="flex flex-col items-center justify-center py-10 text-gray-500">
                    <svg xmlns="http://w3.org" class="h-12 w-12 mb-2 opacity-20" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="text-xl font-medium">No active orders</h3>
                    <p class="text-sm">This queue is currently empty.</p>
                </div>

            </div>

        @endforelse

    </div>


    <script>
        let lastOrderId = null;

        async function checkNewOrder() {
            try {
                let res = await fetch('/staff/orders/latest');
                let data = await res.json();

                if (!data) return;

                if (lastOrderId === null) {
                    lastOrderId = data.id;
                    return;
                }

                if (data.id > lastOrderId) {

                    location.reload();

                    lastOrderId = data.id;
                }

            } catch (e) {
                console.log(e);
            }
        }

        setInterval(checkNewOrder, 3000);
    </script>

@endsection