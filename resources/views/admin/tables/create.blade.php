@extends('admin.layout')

@section('content')

    <div class="bg-white shadow rounded-xl p-8 max-w-2xl">


        <div class="p-4 sm:p-6 opacity-0 animate-fadeIn">

            <h2 class="text-2xl font-bold mb-6">Add Table</h2>
            <br>

            <form method="POST" action="{{ route('tables.store') }}">
                @csrf

                <label class="block mb-2 font-medium">Table Number</label>

                <input class="border rounded-lg w-full p-2 mb-4" type="text" name="table_number" placeholder="101">
                <br>
                <br>
                <button class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium"
                    type="submit">Save</button>

            </form>

        </div>
    </div>
@endsection