@extends('admin.layout')

@section('content')

<h2>Tables</h2>

<a href="{{ route('tables.create') }}">Add Table</a>

<table border="1">

    <tr>
        <th>ID</th>
        <th>Table Number</th>
        <th>Actions</th>
    </tr>

    @foreach($tables as $table)

        <tr>

            <td>{{ $table->id }}</td>

            <td>{{ $table->table_number }}</td>

            <td>

                <a href="{{ route('tables.edit', $table->id) }}">Edit</a>

                <form method="POST" action="{{ route('tables.destroy', $table->id) }}">
                    @csrf
                    @method('DELETE')

                    <button type="submit">Delete</button>

                </form>

            </td>

        </tr>

    @endforeach

</table>


@endsection