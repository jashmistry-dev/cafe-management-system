@extends('admin.layout')

@section('content')

<h2>Add Table</h2>

<form method="POST" action="{{ route('tables.store') }}">
    @csrf

    <label>Table Number</label>

    <input type="text" name="table_number">

    <button type="submit">Save</button>

</form>

@endsection