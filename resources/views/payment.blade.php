<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Page</title>
</head>

<body style="display:flex;justify-content:center;align-items:center;height:100vh;font-family:sans-serif;">



    <div style="text-align:center">
        <h2>Redirecting to Payment...</h2>
        <p>Please do not refresh</p>
    </div>





    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}",
            "amount": {{ $amount }}, 
            "currency": "INR",
            "name": "Cafe Management System",
            "order_id": "{{ $orderId }}", 

            handler: function (response) {

                fetch("{{ route('razorpay.callback') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        razorpay_payment_id: response.razorpay_payment_id,
                        razorpay_order_id: response.razorpay_order_id,
                        razorpay_signature: response.razorpay_signature,
                        order_id: "{{ $localOrderId }}" 
                    })
                })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            window.location.href = data.redirect;
                        } else {
                            alert("Payment Failed: " + data.error);
                        }
                    });

            }
        };

        var rzp1 = new Razorpay(options);
        rzp1.open();

        rzp1.on('payment.failed', function (response) {
            alert("❌ Payment Failed");
            console.log(response.error);
        });
    </script>
</body>

</html>