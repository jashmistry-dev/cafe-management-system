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
`
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
                <div class="p-6 text-gray-900">
                    @if($role === 'admin')
                        <a class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium"
                            href="/admin/categories" target="_blank">Admin Section</a>

                    @elseif($role === 'staff')
                        <a class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium"
                            href="/staff/orders" target="_blank">Kitchen Section</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>