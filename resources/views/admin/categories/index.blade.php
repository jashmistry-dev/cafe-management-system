@extends('admin.layout')

@section('content')

    <div class="p-4 sm:p-6 opacity-0 animate-fadeIn">


        <div class="flex justify-between mb-6">

            <h2 class="text-2xl font-bold">Categories</h2>


        </div>

        <a href="{{ route('categories.create') }}" class="bg-primary text-white font-bold px-4 py-2 rounded-lg">

            Add Category

        </a>
        <br>
        <br>
        <div class="bg-white rounded-xl shadow overflow-hidden">

            <table class="w-full">

                <thead class="bg-gray-200">

                    <tr>

                        <th class="p-4 text-left text-xl">ID</th>
                        <th class="p-4 text-left text-xl">Name</th>
                        <th class="p-4 text-left text-xl">Status</th>
                        <th class="p-4 text-left text-xl">Actions</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($categories as $category)

                                <tr class="border-t">

                                    <td class="p-4 text-m"><b>{{ $category->id }}</b></td>

                                    <td class="p-4 text-m"><b>{{ $category->name }}</b></td>

                                    <td class="p-4 text-m">
                                        <form method="POST" action="{{ route('categories.toggle', $category->id) }}">
                                            @csrf

                                            <button class="px-4 py-1 rounded font-bold text-m transition 
                                                {{ $category->status
                                                ? 'bg-green-500 text-white hover:bg-green-600'
                                                : 'bg-red-500 text-white hover:bg-red-600' }}">

                                                {{ $category->status ? 'Active' : 'In-Active' }}

                                            </button>
                                        </form>
                                    </td>
                                    <td class="p-4 text-m flex gap-3">

                                        <a href="{{ route('categories.edit', $category->id) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded">Edit </a>

                                        <form method="POST" action="{{ route('categories.destroy', $category->id) }}">

                                            @csrf
                                            @method('DELETE')

                                            <button class="bg-red-500 text-white px-3 py-1 rounded">

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