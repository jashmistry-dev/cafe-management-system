@extends('admin.layout')

@section('content')
    <div class="bg-white shadow rounded-xl p-8 max-w-2xl">

        <div class="p-4 sm:p-6 opacity-0 animate-fadeIn">

            <h2 class="text-2xl font-bold mb-6">Edit Staff</h2>

            <form method="POST" action="{{ route('staff.update', $staff->id) }}">
                @csrf
                @method('PUT')

                <label class="block mb-2 font-medium" >Name</label>
                <input class="border rounded-lg w-full p-2 mb-4" type="text" name="name" value="{{ $staff->name }}">

                <br><br>
                <label class="block mb-2 font-medium" >Mobile Number</label>
                <input class="border rounded-lg w-full p-2 mb-4" type="text" name="mobile" value="{{ $staff->mobile }}">

                <br><br>

                <label class="block mb-2 font-medium" >Email</label>
                <input class="border rounded-lg w-full p-2 mb-4" type="email" name="email" value="{{ old('email,', $staff->email)}}">


                <br><br>
                <label class="block mb-2 font-medium" >New Password (optional)</label>



                <input class="border rounded-lg w-full p-2 mb-4" type="password" name="password">

                <br><br>




                <button class="bg-primary hover:bg-success text-white px-4 py-2 rounded-lg font-medium" type="submit">Update
                    Staff</button>

            </form>

        </div>
    </div>
@endsection