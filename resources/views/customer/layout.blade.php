<!DOCTYPE html>
<html>

<head>
    <title>Cafe Ordering</title>

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body class="bg-gray-100">

    <nav class="bg-white shadow">

        <div class="max-w-6xl mx-auto px-6 py-4 flex justify-between">

            <h1 class="text-xl font-bold text-gray-800">
                ☕ Cafe Ordering
            </h1>

            <div class="space-x-6">

                <a href="/table/1" class="text-gray-600 hover:text-blue-600">
                    Menu
                </a>

                <a href="/cart" class="text-gray-600 hover:text-blue-600">
                    Cart
                </a>

            </div>

        </div>

    </nav>

    <div class="max-w-6xl mx-auto mt-8">

        @yield('content')

    </div>

</body>

</html>