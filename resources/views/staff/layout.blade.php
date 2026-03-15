<!DOCTYPE html>
<html>

<head>

    <title>CafeOS | Kitchen</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#C67C4E",
                        primarydark: "#8B5E3C",
                        accent: "#F3E9DC"
                    }
                }
            }
        }
    </script>

</head>

<body class="bg-accent min-h-screen">

    <!-- NAVBAR -->

    <nav class="bg-white shadow-lg">

        <div class="max-w-7xl mx-auto px-8">

            <div class="flex justify-between items-center h-16">

                <div class="flex items-center gap-3">

                    <div class="text-2xl">☕</div>

                    <h1 class="text-xl font-bold text-gray-800">
                        CafeOS
                    </h1>

                </div>

                <div class="flex gap-8 text-gray-600 font-medium">

                    <a href="/staff/orders" class="hover:text-primary">
                        Kitchen
                    </a>

                    <!-- <a href="/admin/categories" class="hover:text-primary">
                        Admin
                    </a> -->

                    <a href="/staff/menu" class="hover:text-primary">
                        Customer Menu
                    </a>

                </div>

            </div>

        </div>

    </nav>

    <!-- PAGE CONTENT -->

    <div class="max-w-7xl mx-auto p-10">

        @yield('content')

    </div>

</body>

</html>