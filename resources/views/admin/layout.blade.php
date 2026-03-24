<!DOCTYPE html>
<html>

<head>

    <title>CafeOS Admin</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#C67C4E",
                        primarydark: "#8B5E3C",
                        accent: "#F8F5F2",
                        success: "#22C55E",
                        danger: "#EF4444"
                    }
                }
            }
        }
    </script>

</head>

<body class="bg-accent min-h-screen">

    <!-- Navbar -->

    <nav class="bg-white shadow-md">

        <div class="max-w-7xl mx-auto px-6">

            <div class="flex justify-between items-center h-16">

                <div class="flex items-center gap-3">

                    <span class="text-2xl">☕</span>

                    <h1 class="font-bold text-lg">
                        CafeOS Admin
                    </h1>

                </div>

                <div class="flex gap-6 text-gray-600 font-medium">

                    <a href="/admin/categories"
                        class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium">Categories</a>

                    <a href="/admin/menu-items"
                        class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium">Menu
                        Items</a>

                    <a href="/admin/tables"
                        class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium">Tables</a>

                    <a href="/admin/staff"
                        class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium">Staff</a>


                    <a href="/admin/analytics"
                        class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium">Analytics</a>


                    <form class="px-4 py-2" method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a class="bg-danger hover:bg-dangerdark text-white px-4 py-2 rounded-lg font-medium"
                            href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">{{ __('Log Out') }}</a>
                        <!-- <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link> -->
                    </form>

                </div>

            </div>

        </div>

    </nav>

    <div class="max-w-7xl mx-auto p-8">

        @yield('content')

    </div>

</body>

</html>