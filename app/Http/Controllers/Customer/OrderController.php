<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Customer;


class OrderController extends Controller
{
    public function place(Request $request)
    {
        $tableId = session('table_id');

        $cart = session()->get('cart_' . $tableId, []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty');
        }


        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'payment_method' => 'required'
        ]);

        $customer = Customer::firstOrCreate(
            ['mobile' => $request->mobile],
            ['name' => $request->name]
        );

        $tableId = $cart[0]['table_id'];

        // 🔥 CALCULATE TOTAL
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'table_id' => $tableId,
            'customer_id' => $customer->id,
            'status' => 'waiting_payment',   
            'payment_status' => 'pending',
            'payment_method' => $request->payment_method,
            'total_amount' => $total
        ]);

        session(['last_order_id' => $order->id]);

        // 🔥 SAVE ITEMS
        foreach ($cart as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);
        }



        // 🔥 FLOW CONTROL
        if ($request->payment_method === 'online') {

            return redirect()->route('razorpay.payment', [
                'amount' => $total * 100,
                'order_id' => $order->id
            ]);

        } else {
            // clear cart
            session()->forget('cart_' . $tableId);
            // CASH FLOW
            return redirect()->route('order.status', $order->id)
                ->with('success', 'Please pay cash at counter');

        }
    }
    public function status(Order $order)
    {
        return view('customer.order-status', compact('order'));
    }

    public function checkStatus($id)
    {
        $order = Order::find($id);

        return response()->json([
            'status' => $order->status,
            'payment_status' => $order->payment_status
        ]);
    }

    public function invoice(Order $order)
    {
        $order->load('items.menuItem', 'customer', 'table');

        return view('customer.invoice', compact('order'));
    }
}