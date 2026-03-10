@extends('admin.layout')

@section('content')

    <div class="bg-white shadow rounded-xl p-8 max-w-lg">

        <h2 class="text-2xl font-bold mb-6">

            Create Category

        </h2>

        <form method="POST" action="{{ route('categories.store') }}">

            @csrf

            <label class="block mb-2 font-medium">

                Category Name

            </label>

            <input type="text" name="name" class="border rounded-lg w-full p-2 mb-4">

            <button class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium" >

                Save Category

            </button>

        </form>

    </div>

@endsection