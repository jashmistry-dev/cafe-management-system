@extends('admin.layout')

@section('content')

<h2 class="text-2xl font-bold">Add Table</h2>

<form method="POST" action="{{ route('tables.store') }}">
    @csrf

    <label>Table Number</label>

    <input type="text" name="table_number">

    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg" type="submit">Save</button>

</form>

@endsection