@extends('admin.layout')

@section('content')
    <div class="bg-white shadow rounded-xl p-8 max-w-2xl">
        <div class="p-4 sm:p-6 opacity-0 animate-fadeIn">


            <h2 class="text-2xl font-bold mb-6">Edit Category</h2>
            <br>
            <form method="POST" action="{{ route('categories.update', $category->id) }}">
                @csrf
                @method('PUT')
                <label class="block mb-2 font-medium" for="name"><b>Category Name :</b></label>
                <input class="border rounded-lg w-full p-2 mb-4" type="text" name="name" value="{{ $category->name }}">
                <br>
                <br>
                <button class="bg-primary hover:bg-success text-white px-4 py-2 rounded-lg font-medium"
                    type="submit">Update</button>
            </form>
        </div>
    </div>

@endsection