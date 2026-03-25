@extends('admin.layout')

@section('content')

    <div class="p-4 sm:p-6 opacity-0 animate-fadeIn">   
        <h2 class="text-2xl font-bold mb-6">Staff Management</h2>

        <a class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-bold"
            href="{{ route('staff.create') }}">
            Add Staff </a>

        <h2 class="text-gray-500 text-2xl mb-6 text-center">
            Total Staff: {{ $staff->count() }}
        </h2>
        <div class="mt-6 bg-white shadow rounded-xl overflow-hidden">


            <table class="min-w-full text-left">

                <thead class="bg-gray-100">
                    <!-- <tr >
                               <th class="px-6 py-3 text-l font-semibold">Total Staff: {{ $staff->count() }}</th> 

                            </tr> -->
                    <tr>
                        <th class="px-6 py-3 text-sm fontbold">Staff ID</th>
                        <th class="px-6 py-3 text-sm font-bold">Staff Name</th>
                        <th class="px-6 py-3 text-sm font-bold">Staff Email</th>
                        <th class="px-6 py-3 text-sm font-bold">Staff Mobile No.</th>
                        <th class="px-6 py-3 text-sm font-bold text-center">Staff Actions</th>
                    </tr>
                </thead>

                <tbody>


                    @foreach($staff as $user)

                        <tr class="border-t hover:bg-gray-50">

                            <td class="px-6 py-3">{{ $user->id }}</td>
                            <td class="px-6 py-3 font-medium">{{ $user->name }}</td>
                            <td class="px-6 py-3">{{ $user->email }}</td>
                            <td class="px-6 py-3">{{ $user->mobile }}</td>

                            <td class="px-6 py-3 text-center space-x-2">

                                <a href="{{ route('staff.edit', $user->id) }}"
                                    class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">
                                    Edit
                                </a>

                                <form action="{{ route('staff.destroy', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')

                                    <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">
                                        Delete
                                    </button>
                                </form>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>


        </div>
    </div>

@endsection