@extends('staff.layout')

@section('content')







    <!-- ✅ ONLY ONE CONTAINER -->


    <h2 class="text-2xl font-bold mb-6">Order History</h2>

    <div class="overflow-x-auto bg-white rounded-xl shadow">


        <table class="w-full text-left">

            <thead class="bg-gray-100">
                <tr>
                    <th class="p-3">Order #</th>
                    <th class="p-3">Customer</th>
                    <th class="p-3">Mobile</th>
                    <th class="p-3">Items</th>
                    <th class="p-3">Total Amount</th>
                </tr>
            </thead>

            <tbody>

                @foreach($orders as $order)

                    <tr class="border-b hover:bg-gray-50">

                        <td class="p-3 font-bold">
                            #{{ $order->id }}
                        </td>

                        <td class="p-3">
                            {{ $order->customer->name ?? 'N/A' }}
                        </td>

                        <td class="p-3">
                            {{ $order->customer->mobile ?? 'N/A' }}
                        </td>

                        <td class="p-3">
                            {{ $order->total_items ?? 0 }}
                        </td>

                        <td class="p-3 font-semibold text-green-600">
                            ₹{{ $order->total_amount ?? 0 }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>


    </div>







@endsection