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

                    <a href="/staff/orders" class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-bold">
                        Kitchen
                    </a>

                    <!-- <a href="/admin/categories" class="hover:text-primary">
                        Admin
                    </a> -->

                    <a href="/staff/menu" class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-bold">
                        Customer Menu
                    </a>

                    

                      <form class="px-4 py-2" method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a  class="bg-danger hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium" href="route('logout')"  onclick="event.preventDefault();
                                                this.closest('form').submit();">{{ __('Log Out') }}</a>
                         
                    </form>
                   

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