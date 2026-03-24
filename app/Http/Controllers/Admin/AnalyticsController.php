<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {

        // ✅ FIX 1: Date logic (no override)
        if ($request->range === 'today') {
            $start = now()->startOfDay();
            $end = now()->endOfDay();
        } elseif ($request->range === 'week') {
            $start = now()->subDays(7);
            $end = now();
        } elseif ($request->range === 'month') {
            $start = now()->startOfMonth();
            $end = now()->endOfMonth();
        } else {
            $start = $request->start_date
                ? Carbon::parse($request->start_date)->startOfDay()
                : now()->startOfMonth();

            $end = $request->end_date
                ? Carbon::parse($request->end_date)->endOfDay()
                : now()->endOfMonth();
        }

        // Total Revenue
        $totalRevenue = DB::table('order_items')
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('SUM(price * quantity) as total')
            ->value('total') ?? 0;

        // Total Orders
        $totalOrders = DB::table('orders')
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $avgOrderValue = $totalOrders ? $totalRevenue / $totalOrders : 0;

        // Revenue Trend
        $revenueTrend = DB::table('order_items')
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, SUM(price * quantity) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $chartLabels = $revenueTrend->pluck('date');
        $chartData = $revenueTrend->pluck('total');

        // Order Status
        $orderStatus = DB::table('orders')
            ->whereBetween('created_at', [$start, $end])
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();

        // Peak Day
        $peakDay = DB::table('orders')
            ->whereBetween('created_at', [$start, $end])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as total')
            ->groupBy('date')
            ->orderByDesc('total')
            ->first();

        // ✅ FIX 2: Top Customers JOIN (so name/mobile works)
        $topCustomers = DB::table('orders')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->select(
                'customers.name',
                'customers.mobile',
                DB::raw('COUNT(*) as total_orders')
            )
            ->groupBy('customers.id', 'customers.name', 'customers.mobile')
            ->orderByDesc('total_orders')
            ->limit(5)
            ->get();

        // Top Spender (kept same)
        $topSpender = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.created_at', [$start, $end])
            ->select('customer_id', DB::raw('SUM(price * quantity) as total_spent'))
            ->groupBy('customer_id')
            ->orderByDesc('total_spent')
            ->first();

        $newCustomers = DB::table('customers')
            ->whereBetween('created_at', [$start, $end])
            ->count();

        $returningCustomers = DB::table('orders')
            ->select('customer_id')
            ->groupBy('customer_id')
            ->havingRaw('COUNT(*) > 1')
            ->count();

        // ✅ FIX 3: Top Items JOIN (to get item name)
        $topItems = DB::table('order_items')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->whereBetween('order_items.created_at', [$start, $end])
            ->select(
                'menu_items.name',
                DB::raw('SUM(quantity) as total')
            )
            ->groupBy('menu_items.id', 'menu_items.name')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // Least Items (kept same)
        $leastItems = DB::table('order_items')
            ->whereBetween('created_at', [$start, $end])
            ->select('menu_item_id', DB::raw('SUM(quantity) as total'))
            ->groupBy('menu_item_id')
            ->orderBy('total')
            ->limit(5)
            ->get();

        // ✅ FIX 4: Removed duplicate query
        $categoryRevenue = DB::table('order_items')
            ->join('menu_items', 'order_items.menu_item_id', '=', 'menu_items.id')
            ->join('categories', 'menu_items.category_id', '=', 'categories.id')
            ->whereBetween('order_items.created_at', [$start, $end])
            ->select(
                'categories.name',
                DB::raw('SUM(order_items.price * order_items.quantity) as total')
            )
            ->groupBy('categories.name')
            ->orderByDesc('total')
            ->get();

        // Top Tables
        $topTables = DB::table('orders')
            ->whereBetween('created_at', [$start, $end])
            ->select('table_id', DB::raw('COUNT(*) as total'))
            ->groupBy('table_id')
            ->orderByDesc('total')
            ->limit(5)
            ->get();

        // =========================
        // ✅ FIX 5: Removed undefined ordersByHour
        // =========================
        return view('admin.analytics.analytics', compact(
            'totalRevenue',
            'totalOrders',
            'avgOrderValue',
            'revenueTrend',
            'chartLabels',
            'chartData',
            'orderStatus',
            'peakDay',
            'topCustomers',
            'topSpender',
            'newCustomers',
            'returningCustomers',
            'topItems',
            'leastItems',
            'categoryRevenue',
            'topTables',
            'start',
            'end'
        ));
    }
}