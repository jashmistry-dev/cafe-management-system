@extends('admin.layout')

@section('content')

<h1>Menu Items</h1>

<a href="{{ route('menu-items.create') }}">Add Menu Item</a>

<table border="1">
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Price</th>
    <th>Category</th>
    <th>Actions</th>
</tr>

@foreach($menuItems as $item)
<tr>
    <td>{{ $item->id }}</td>
    <td>{{ $item->name }}</td>
    <td>{{ $item->price }}</td>
    <td>{{ $item->category->name ?? 'None' }}</td>

    <td>
        <a href="{{ route('menu-items.edit',$item->id) }}">Edit</a>

        <form action="{{ route('menu-items.destroy',$item->id) }}" method="POST">
            @csrf
            @method('DELETE')

            <button type="submit">Delete</button>
        </form>
    </td>
</tr>
@endforeach

</table>


@endsection