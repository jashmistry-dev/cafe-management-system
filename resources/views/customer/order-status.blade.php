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
    <div class="max-w-xl mx-auto p-4">


        <h2 class="text-2xl font-bold mb-6">
            Order Status
        </h2>

        <div class="bg-white rounded-2xl shadow p-6 text-center">

            <p class="text-gray-500 mb-2">Order ID</p>
            <h3 class="text-xl font-bold mb-4">#{{ $order->id }}</h3>

            <p class="text-gray-500">Table</p>
            <p class="font-semibold mb-6">Table {{ $order->table_id }}</p>

            <div id="statusBadge" class="inline-block px-4 py-2 rounded-full text-white font-semibold mb-4">
                {{ strtoupper($order->status) }}
            </div>

            <p id="statusMessage" class="text-gray-600"></p>

        </div>


    </div>

    <script>

        function updateStatusUI(status, paymentStatus) {

            let badge = document.getElementById('statusBadge');
            let message = "";

            badge.className = "inline-block px-4 py-2 rounded-full text-white font-semibold mb-4";

            if (paymentStatus === "pending") {

                badge.classList.add("bg-red-500");
                badge.innerText = "WAITING PAYMENT";

                message = "💰 Please complete your payment to start order.";
                document.getElementById('statusMessage').innerText = message;
                return;
            }
            if (status === "pending") {
                badge.classList.add("bg-yellow-500");
                message = "🕐 Order received.";
            }

            if (status === "preparing") {
                badge.classList.add("bg-orange-500");
                message = "👨‍🍳 Food is being prepared.";
            }

            if (status === "ready") {
                badge.classList.add("bg-green-500");
                message = "✅ Order is ready!";
            }

            if (status === "completed") {
                badge.classList.add("bg-gray-700");
                message = "🍽️ Order completed.";
            }

            badge.innerText = status.toUpperCase();
            document.getElementById('statusMessage').innerText = message;
        }

            function checkOrderStatus() {

                fetch('/order/{{ $order->id }}/status?time=' + new Date().getTime())
                    .then(res => res.json())
                    .then(data => {
                        console.log("LIVE DATA:", data); // debug
                        updateStatusUI(data.status, data.payment_status);
                    })
                    .catch(err => console.error(err));

    }


    updateStatusUI("{{ $order->status }}", "{{ $order->payment_status }}");

    setInterval(checkOrderStatus, 5000);

    </script>

@endsection