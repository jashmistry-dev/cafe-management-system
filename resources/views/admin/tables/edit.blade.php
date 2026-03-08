
@extends('admin.layout')

@section('content')
<h2>Edit Table</h2>

<form method="POST" action="{{ route('tables.update', $table->id) }}">
    @csrf
    @method('PUT')

    <input type="text" name="table_number" value="{{ $table->table_number }}">

    <button type="submit">Update</button>

</form>

@endsection