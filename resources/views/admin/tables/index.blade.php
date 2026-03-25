@extends('admin.layout')

@section('content')

    <div class="p-4 sm:p-6 opacity-0 animate-fadeIn">

        <h2 class="text-2xl font-bold">Tables</h2>
        <br>
        <a class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-bold"
            href="{{ route('tables.create') }}">Add Table</a>
        <br>
        <br>

        <div class="grid md:grid-cols-4 gap-6">

            @foreach($tables as $table)

                <div class="bg-white shadow rounded-xl p-6 text-center">

                    <h3 class="text-xl font-bold">

                        Table {{ $table->table_number }}

                    </h3>



                    <br>
                    <a class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium"
                        href="{{ url('/table/' . $table->id) }}" target="_blank">Open Link</a>
                    <br>
                    <br>
                    <div class="flex items-center justify-center">

                        {!! QrCode::size(100)->generate(url('/table/' . $table->table_number)) !!}

                    </div>
                    <br>
                    <a href="{{ route('tables.qr', $table->id) }}"
                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded">
                        Download QR
                    </a>
                    <br>
                    <br>
                    <form method="POST" action="{{ route('tables.destroy', $table->id) }}">
                        @csrf
                        @method('DELETE')

                        <a class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded"
                            href="{{ route('tables.edit', $table->id) }}">Edit</a>
                        <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded" type="submit">Delete</button>




                    </form>

                </div>

            @endforeach

        </div>

    </div>

@endsection