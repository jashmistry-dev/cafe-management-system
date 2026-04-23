<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
</head>
<body>
    <h1>Payment</h1>

    <form method="POST" action="{{route('razorpay.payment')}}">
        @csrf
        Amount
        <input type="text" name="amount"/>

        <button type="submit">Pay</button>
    </form>
</body>
</html>