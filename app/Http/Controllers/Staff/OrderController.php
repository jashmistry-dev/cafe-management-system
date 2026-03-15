<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

use App\Models\MenuItem;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.menuItem')
            ->where('status', '!=', 'completed')
            ->latest()
            ->get();

        return view('staff.orders', compact('orders'));
    }
    public function showMenu()
    {
        $menuItems = MenuItem::where('is_available', 1)->get();

        return view('staff.menu',compact('menuItems'));
    }


    public function updateStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        $order->save();

        return back()->with('success', 'Status updated');
    }
}