@extends('admin.layout')

@section('content')

<h1>Categories Page</h1>

<a href="{{ route('categories.create') }}">Add Category</a>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Actions</th>
    </tr>

    @foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>
        <td>{{ $category->name }}</td>

        <td>
            <a href="{{ route('categories.edit', $category->id) }}">Edit</a>
            

            <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
                @csrf
                @method('DELETE')

                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection