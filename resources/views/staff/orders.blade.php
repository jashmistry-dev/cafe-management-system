@extends('staff.layout')

@section('content')

    <h2 class="text-3xl font-bold text-gray-800 mb-10">
        Kitchen Orders
    </h2>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($orders as $order)

            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">

                <div class="flex justify-between items-center mb-4">

                    <h3 class="text-xl font-semibold text-gray-800">

                        Table {{ $order->table->table_number }}

                    </h3>

                    <span class="text-xs bg-gray-100 px-3 py-1 rounded-full">
                        #{{ $order->id }}
                    </span>

                </div>

                <div class="space-y-2 mb-4">

                    @foreach($order->items as $item)

                        <div class="flex justify-between text-gray-700">

                            <span>{{ $item->menuItem->name }}</span>

                            <span class="font-semibold">
                                × {{ $item->quantity }}
                            </span>

                        </div>

                    @endforeach

                </div>

                <div class="mb-4">

                    @if($order->status == 'pending')

                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                            Pending
                        </span>

                    @elseif($order->status == 'preparing')

                        <span class="bg-orange-100 text-orange-700 px-3 py-1 rounded-full text-sm">
                            Preparing
                        </span>

                    @elseif($order->status == 'ready')

                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                            Ready
                        </span>

                    @else

                        <span class="bg-gray-200 text-gray-700 px-3 py-1 rounded-full text-sm">
                            Completed
                        </span>

                    @endif

                </div>

                <form method="POST" action="{{ route('staff.order.status', $order->id) }}" class="flex gap-3">

                    @csrf

                    <select name="status" class="flex-1 border border-gray-300 rounded-lg px-3 py-2">

                        <option value="pending">Pending</option>
                        <option value="preparing">Preparing</option>
                        <option value="ready">Ready</option>
                        <option value="completed">Completed</option>

                    </select>

                    <button class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium">

                        Update

                    </button>

                </form>

            </div>

        @endforeach

    </div>

@endsection