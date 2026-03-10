@extends('customer.layout')

@section('content')

    <h2 class="text-2xl font-bold">Cafe Invoice</h2>

    <hr>

    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Table:</strong> {{ $order->table->table_number }}</p>
    <p><strong>Customer:</strong> {{ $order->customer->name }}</p>
    <p><strong>Mobile:</strong> {{ $order->customer->mobile }}</p>
    <p><strong>Date:</strong> {{ $order->created_at }}</p>

    <hr>

    <table border="1" width="100%" cellpadding="10">

        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>

        @php
            $grandTotal = 0;
        @endphp

        @foreach($order->items as $item)

            <tr>

                <td>{{ $item->menuItem->name }}</td>

                <td>{{ $item->quantity }}</td>

                <td>₹ {{ $item->price }}</td>

                <td>₹ {{ $item->price * $item->quantity }}</td>

            </tr>

            @php
                $grandTotal += $item->price * $item->quantity;
            @endphp

        @endforeach

    </table>

    <h3>Total Bill: ₹ {{ $grandTotal }}</h3>

    <br>

    <button onclick="window.print()">Print Invoice</button>

    <br><br>

    <a href="{{ route('order.status', $order->id) }}">
        <button>Track Order Status</button>
    </a>

@endsection