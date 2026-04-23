<!DOCTYPE html>

<html>

<head>
    <title>Cafe Ordering</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <!-- 🔝 TOP BAR -->


    <nav class="bg-white shadow fixed top-0 left-0 right-0 z-50">

        <div class="flex justify-between items-center px-4 py-3">

            <h1 class="text-lg font-bold">
                ☕ Cafe
            </h1>

            <!-- Desktop Menu -->
            <div class="hidden md:flex space-x-6">
                <a href="{{ url('/table/' . session('table_id')) }}" class="text-gray-600 hover:text-primary">
                    Menu
                </a>

                <a href="/cart" class="text-gray-600 hover:text-primary">
                    Cart
                </a>
            </div>

        </div>

    </nav>

    <!-- 📦 CONTENT -->
    <div class="pt-16 px-3 md:px-6 max-w-6xl mx-auto  pb-24 md:pb-0">

        @yield('content')

    </div>

    <!-- 📱 MOBILE BOTTOM NAV -->
    <div class="fixed bottom-0 left-0 right-0 bg-white shadow-md border-t md:hidden">

        <div class="flex justify-around py-3">

            <a href="{{ url('/table/' . session('table_id')) }}"
                class="flex flex-col items-center text-sm text-gray-600">
                🍽
                <span>Menu</span>
            </a>

            <a href="/cart" class="flex flex-col items-center text-sm text-gray-600">
                🛒
                <span>Cart</span>
            </a>


            @if(session('last_order_id'))

                <a href="{{ route('order.invoice', session('last_order_id')) }}"
                    class="flex flex-col items-center text-sm text-gray-600">
                    📦
                    <span>My Order</span>
                </a>
            @endif

        </div>

    </div>


</body>

</html>