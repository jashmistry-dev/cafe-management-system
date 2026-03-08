@extends('customer.layout')

@section('content')

    <h2>Your Order Status</h2>

    <p>Order ID: {{ $order->id }}</p>

    <p>Table: {{ $order->table_id }}</p>

    <h3>Status: {{ strtoupper($order->status) }}</h3>

    @if($order->status == 'pending')
        <p>Your order has been received.</p>
    @endif

    @if($order->status == 'preparing')
        <p>Your food is being prepared.</p>
    @endif

    @if($order->status == 'ready')
        <p>Your order is ready!</p>
    @endif

    @if($order->status == 'completed')
        <p>Order completed. Enjoy your meal!</p>
    @endif

@endsection