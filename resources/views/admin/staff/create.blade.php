@extends('admin.layout')

@section('content')

    <div class="bg-white shadow rounded-xl p-8 max-w-2xl">

        <h2 class="text-2xl font-bold mb-6">

            Staff Creation

        </h2>


       
        <form method="POST" action="{{ route('staff.store') }}">

            @csrf

            <label class="block mb-2 font-medium">

                Staff Name :

            </label>

            <input type="text" name="name" class="border rounded-lg w-full p-2 mb-4">

            <label class="block mb-2 font-medium">

                Staff Mobile Number :

            </label>

            <input type="number" name="mobile" class="border rounded-lg w-full p-2 mb-4">

             <label class="block mb-2 font-medium">

                Staff Email :

            </label>

             <input type="email" name="email" class="border rounded-lg w-full p-2 mb-4" placeholder="Email">


              <label class="block mb-2 font-medium">

                Staff Password :

            </label>
            <input type="password" name="password" class="border rounded-lg w-full p-2 mb-4" placeholder="Password">


            <button class="bg-primary hover:bg-primarydark text-white px-4 py-2 rounded-lg font-medium" >

                Create Staff

            </button>

        </form>

    </div>

@endsection