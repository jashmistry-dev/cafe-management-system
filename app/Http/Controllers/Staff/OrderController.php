<?php

namespace App\Http\Controllers\Staff;

use Illuminate\Support\Facades\DB;
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

        return view('staff.menu', compact('menuItems'));
    }


    public function updateStatus(Request $request, Order $order)
    {
        $order->status = $request->status;
        if ($request->status === 'pending') {
            $order->payment_status = 'paid';
        }
        $order->save();

        return back()->with('success', 'Status updated');
    }
    public function history(Request $request)
    {
        $query = Order::with(['customer', 'items.menuItem']);

        // 🔍 SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('id', $request->search)
                    ->orWhereHas('customer', function ($q2) use ($request) {
                        $q2->where('name', 'like', '%' . $request->search . '%')
                            ->orWhere('mobile', 'like', '%' . $request->search . '%');
                    });
            });
        }

        // 📅 DATE FILTER
        if ($request->from_date && $request->to_date) {
            $query->whereBetween('created_at', [
                $request->from_date,
                $request->to_date
            ]);
        }

        $orders = $query->latest()->get();

        // 🔥 MANUAL FILTER (IMPORTANT FIX)
        $orders = $orders->map(function ($order) {

            $order->total_items = $order->items->sum('quantity');
            $order->total_amount = $order->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            return $order;
        });

        // 💰 AMOUNT FILTER (AFTER CALCULATION)
        if ($request->min_amount) {
            $orders = $orders->where('total_amount', '>=', $request->min_amount);
        }

        if ($request->max_amount) {
            $orders = $orders->where('total_amount', '<=', $request->max_amount);
        }

        return view('staff.history', compact('orders'));
    }

    public function markPaid($id)
    {
        $order = Order::findOrFail($id);

        $order->payment_status = 'paid';
        $order->status = 'pending';
        $order->save();

        return back()->with('success', 'Payment confirmed');
    }
}