@extends('admin.layout')

@section('content')

    <div class="flex justify-between mb-6">

        <h2 class="text-2xl font-bold">Categories</h2>

        <a href="{{ route('categories.create') }}" class="bg-primary text-white px-4 py-2 rounded-lg">

            Add Category

        </a>

    </div>

    <div class="bg-white rounded-xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-gray-100">

                <tr>

                    <th class="p-4 text-left">ID</th>
                    <th class="p-4 text-left">Name</th>
                    <th class="p-4 text-left">Actions</th>

                </tr>

            </thead>

            <tbody>

                @foreach($categories as $category)

                    <tr class="border-t">

                        <td class="p-4">{{ $category->id }}</td>

                        <td class="p-4">{{ $category->name }}</td>

                        <td class="p-4 flex gap-3">

                            <a href="{{ route('categories.edit', $category->id) }}"
                                class="bg-blue-500 text-white px-3 py-1 rounded">

                                Edit

                            </a>

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

@endsection