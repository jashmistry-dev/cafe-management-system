@extends('staff.layout')

@section('content')

    <h2>Kitchen Orders</h2>

    @foreach($orders as $order)

        <div style="border:1px solid black; padding:10px; margin:10px;">

            <h3>Table {{ $order->table_id }}</h3>

            <ul>

                @foreach($order->items as $item)

                    <li>
                        {{ $item->menuItem->name }}
                        × {{ $item->quantity }}
                    </li>

                @endforeach

            </ul>

            <p>Status: {{ $order->status }}</p>

            <form method="POST" action="{{ route('staff.order.status', $order->id) }}">
                @csrf

                <select name="status">

                    <option value="pending">Pending</option>
                    <option value="preparing">Preparing</option>
                    <option value="ready">Ready</option>
                    <option value="completed">Completed</option>

                </select>

                <button type="submit">Update</button>

            </form>



        </div>

    @endforeach


@endsection