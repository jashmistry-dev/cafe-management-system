@extends('staff.layout')

@section('content')

    <audio id="orderSound" preload="auto">
        <source src="https://www.soundjay.com/buttons/sounds/beep-01a.mp3" type="audio/mpeg">
    </audio>
    <h2 class="text-3xl font-bold text-gray-800 mb-6">
        Kitchen Orders
    </h2>

    <button onclick="enableSound()" class="bg-green-500 text-white px-3 py-1 rounded mb-6">
        Enable Sound 🔊
    </button>

    <script>
        let soundEnabled = false;

        function enableSound() {
            const audio = document.getElementById('orderSound');

            // FORCE LOAD
            audio.load();

            // play silently first
            audio.volume = 0;

            audio.play().then(() => {
                audio.pause();
                audio.currentTime = 0;
                audio.volume = 1;

                soundEnabled = true;

                alert("🔊 Sound Enabled Successfully!");
            }).catch((e) => {
                console.log(e);
                alert("Still blocked. Click once more.");
            });
        }
    </script>

    <!-- ✅ ONLY ONE CONTAINER -->
    <div id="ordersContainer" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">

        @foreach($orders as $order)

            <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">

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
                    <span class="px-3 py-1 rounded-full text-sm
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
                        <option value="pending">Pending</option>
                        <option value="preparing">Preparing</option>
                        <option value="ready">Ready</option>
                        <option value="completed">Completed</option>
                    </select>

                    <button class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg">
                        Update
                    </button>
                </form>

            </div>

        @endforeach

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

                    // 🔔 PLAY SOUND ONLY IF ENABLED
                    if (soundEnabled) {
                        const audio = document.getElementById('orderSound');
                        audio.currentTime = 0;
                        audio.play();
                    }

                    // reload page
                    location.reload();

                    lastOrderId = data.id;
                }

            } catch (e) {
                console.log(e);
            }
        }

        // faster refresh
        setInterval(checkNewOrder, 3000);
    </script>

@endsection