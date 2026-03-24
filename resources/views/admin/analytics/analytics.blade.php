@extends('admin.layout')

@section('content')

<div class="p-4 sm:p-6">


<!-- Header -->
<h2 class="text-2xl font-bold mb-6">📊 Analytics Dashboard</h2>

<!-- Filters -->
<div class="flex flex-col sm:flex-row justify-between mb-6 gap-3">

    <div class="flex gap-2">
        <a href="?range=today" class="px-3 py-1 bg-gray-200 rounded-lg text-sm">Today</a>
        <a href="?range=week" class="px-3 py-1 bg-gray-200 rounded-lg text-sm">7 Days</a>
        <a href="?range=month" class="px-3 py-1 bg-gray-200 rounded-lg text-sm">This Month</a>
    </div>

    <form method="GET" class="flex gap-2">
        <input type="date" name="start_date" value="{{ $start->format('Y-m-d') }}"
            class="border p-2 rounded-lg text-sm">
        <input type="date" name="end_date" value="{{ $end->format('Y-m-d') }}"
            class="border p-2 rounded-lg text-sm">
        <button class="bg-blue-500 text-white px-4 rounded-lg text-sm">Apply</button>
    </form>

</div>

<!-- Cards -->
<div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-8">

    <div class="bg-white p-4 rounded-xl shadow">
        <p class="text-gray-500 text-sm">Revenue</p>
        <h3 class="text-xl font-bold text-green-600">₹{{ $totalRevenue }}</h3>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <p class="text-gray-500 text-sm">Orders</p>
        <h3 class="text-xl font-bold">{{ $totalOrders }}</h3>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <p class="text-gray-500 text-sm">Avg Order</p>
        <h3 class="text-xl font-bold">₹{{ number_format($avgOrderValue, 2) }}</h3>
    </div>

    <div class="bg-white p-4 rounded-xl shadow">
        <p class="text-gray-500 text-sm">Tables Active</p>
        <h3 class="text-xl font-bold">{{ count($topTables) }}</h3>
    </div>

</div>

<!-- Chart -->
<div class="bg-white p-6 rounded-xl shadow mb-8">
    <h3 class="text-lg font-bold mb-4">📈 Revenue Trend</h3>
    <canvas id="revenueChart"></canvas>
</div>

<!-- Sections -->
<div class="grid lg:grid-cols-2 gap-6">

    <!-- Customers -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-bold text-lg mb-4">👥 Top Customers</h3>

        @foreach($topCustomers as $c)
            <div class="flex justify-between border-b py-2">
                <span>{{ $c->name }}</span>
                <span class="font-semibold">{{ $c->total_orders }} orders</span>
            </div>
        @endforeach
    </div>

    <!-- Items -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-bold text-lg mb-4">🔥 Top Items</h3>

        @foreach($topItems as $item)
            <div class="flex justify-between border-b py-2">
                <span>{{ $item->name }}</span>
                <span class="font-semibold">{{ $item->total }}</span>
            </div>
        @endforeach
    </div>

    <!-- Categories -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-bold text-lg mb-4">📂 Category Revenue</h3>

        @foreach($categoryRevenue as $cat)
            <div class="flex justify-between border-b py-2">
                <span>{{ $cat->name }}</span>
                <span class="font-semibold">₹{{ $cat->total }}</span>
            </div>
        @endforeach
    </div>

    <!-- Tables -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-bold text-lg mb-4">🪑 Top Tables</h3>

        @foreach($topTables as $t)
            <div class="flex justify-between border-b py-2">
                <span>Table {{ $t->table_id }}</span>
                <span class="font-semibold">{{ $t->total }} orders</span>
            </div>
        @endforeach
    </div>

</div>


</div>

@endsection

@push('scripts')

<script>
document.addEventListener("DOMContentLoaded", function () {

    const ctx = document.getElementById('revenueChart');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [{
                label: 'Revenue',
                data: @json($chartData),
                borderWidth: 2,
                tension: 0.3
            }]
        },
        options: {
            responsive: true
        }
    });

});
</script>

@endpush
