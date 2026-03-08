@extends('customer.layout')

@section('content')

<h2>Your Order Status</h2>

<p>Order ID: {{ $order->id }}</p>

<p>Table: {{ $order->table_id }}</p>

<h3>Status: <span id="orderStatus">{{ strtoupper($order->status) }}</span></h3>

<p id="statusMessage"></p>

<script>

function checkOrderStatus(){

    fetch('/order/{{ $order->id }}/status')
        .then(response => response.json())
        .then(data => {

            let status = data.status;

            document.getElementById('orderStatus').innerText = status.toUpperCase();

            let message = "";

            if(status === "pending"){
                message = "Your order has been received.";
            }

            if(status === "preparing"){
                message = "Your food is being prepared.";
            }

            if(status === "ready"){
                message = "Your order is ready!";
            }

            if(status === "completed"){
                message = "Order completed. Enjoy your meal!";
            }

            document.getElementById('statusMessage').innerText = message;

        });

}

setInterval(checkOrderStatus, 5000); // check every 5 seconds

</script>

@endsection