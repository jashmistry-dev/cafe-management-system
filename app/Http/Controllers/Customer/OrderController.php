<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function place(Request $request)
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty');
        }

        $tableId = $cart[0]['table_id'];

        $order = Order::create([
            'table_id' => $tableId,
            'status' => 'pending'
        ]);

        foreach ($cart as $item) {

            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);

        }

        session()->forget('cart');

        return redirect()->route('order.status', $order->id);

        // return redirect('/table/' . $tableId)
        //     ->with('success', 'Order placed successfully');
    }

    public function status(Order $order)
    {
        return view('customer.order-status', compact('order'));
    }
}