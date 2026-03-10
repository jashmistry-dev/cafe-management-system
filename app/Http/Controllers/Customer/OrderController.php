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
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return back()->with('error', 'Cart is empty');
        }

        $request->validate([
            'name' => 'required',
            'mobile' => 'required'
        ]);

        // Find existing customer or create new
        $customer = \App\Models\Customer::firstOrCreate(
            ['mobile' => $request->mobile],
            ['name' => $request->name]
        );

        $tableId = $cart[0]['table_id'];

        $order = \App\Models\Order::create([
            'table_id' => $tableId,
            'customer_id' => $customer->id,
            'status' => 'pending'
        ]);

        foreach ($cart as $item) {

            \App\Models\OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item['id'],
                'price' => $item['price'],
                'quantity' => $item['quantity']
            ]);

        }

        session()->forget('cart');

        return redirect()->route('order.invoice', $order->id);
    }

    public function status(Order $order)
    {
        return view('customer.order-status', compact('order'));
    }

    public function checkStatus(Order $order)
    {
        return response()->json([
            'status' => $order->status
        ]);
    }

    public function invoice(Order $order)
    {
        $order->load('items.menuItem', 'customer', 'table');

        return view('customer.invoice', compact('order'));
    }
}