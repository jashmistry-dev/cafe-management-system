
@extends('admin.layout')

@section('content')

<h2 class="text-2xl font-bold">Edit Staff</h2>

<form method="POST" action="{{ route('staff.update',$staff->id) }}">
    @csrf
    @method('PUT')

    <label>Name</label>
    <input type="text" name="name" value="{{ $staff->name }}">

    <br><br>
    <label>Mobile Number</label>
    <input type="text" name="mobile" value="{{ $staff->mobile }}">

    <br><br>

    <label>Email</label>
    <input type="email" name="email" value="{{ old('email,',$staff->email )}}">


    <br><br>
    <label>New Password (optional)</label>

  

    <input type="password" name="password">

    <br><br>

    

    <br><br>

    <button class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg" type="submit">Update Staff</button>

</form>


@endsection



