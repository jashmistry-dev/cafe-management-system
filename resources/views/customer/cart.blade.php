@extends('customer.layout')

@section('content')

    <h2>Your Cart</h2>

    @if(empty($cart))

        <p>No items in cart</p>

    @endif
    <div>
        @foreach($cart as $index => $item)


            {{ $item['name'] }}
            ₹{{ $item['price'] }}

            Quantity: {{ $item['quantity'] }}

            Total: ₹{{ $item['price'] * $item['quantity'] }}

            <form method="POST" action="{{ route('cart.remove') }}">
                @csrf
                <input type="hidden" name="index" value="{{ $index }}">
                <button type="submit">Remove</button>
            </form>


        @endforeach
        <form method="POST" action="{{ route('order.place') }}">
            @csrf

            <button type="submit">Place Order</button>

        </form>
    </div>


@endsection