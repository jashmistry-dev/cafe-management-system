@extends('admin.layout')

@section('content')

<h2 class="text-2xl font-bold">Edit Category</h2>
<hr>
<br>
<form method="POST" action="{{ route('categories.update', $category->id) }}">
    @csrf
    @method('PUT')
    <label for="name"><b>Category Name :</b></label>
    <input type="text" name="name" value="{{ $category->name }}">
    <br>
    <br>
    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg" type="submit">Update</button>
</form>


@endsection