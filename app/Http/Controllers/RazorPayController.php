<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use Razorpay\Api\Api;

class RazorPayController extends Controller
{
    //
    public function index()
    {
        return view('razorpay');
    }


    public function payment(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        $amount = $request->amount; 

        $razorpayOrder = $api->order->create([
            'receipt' => 'order_' . rand(1000, 9999),
            'amount' => $amount,
            'currency' => 'INR'
        ]);

        return view('payment', [
            'amount' => $amount,
            'orderId' => $razorpayOrder['id'], 
            'localOrderId' => $request->order_id
        ]);
    }

    public function callback(Request $request)
    {
        $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));

        try {

            $attributes = [
                'razorpay_order_id' => $request->razorpay_order_id,
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'razorpay_signature' => $request->razorpay_signature
            ];

            $api->utility->verifyPaymentSignature($attributes);

            $order = Order::find($request->order_id);

            if (!$order) {
                return response()->json([
                    'success' => false,
                    'error' => 'Order not found'
                ]);
            }

            $order->payment_status = 'paid';
            $order->status = 'pending';
            $order->payment_id = $request->razorpay_payment_id;
            $order->save();

            return response()->json([
                'success' => true,
                'redirect' => route('order.invoice', $order->id)
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
