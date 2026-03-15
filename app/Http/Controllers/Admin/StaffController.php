<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class StaffController extends Controller
{
    //
    // 
    public function create()
    {
        return view('admin.staff.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'staff'
        ]);

        return redirect('/admin/staff')->with('success', 'Staff created successfully');
    }

    public function index()
    {
        $staff = User::where('role', 'staff')->get();

        return view('admin.staff.index', compact('staff'));
    }

    public function edit($id)
    {
        $staff = User::findOrFail($id);

        return view('admin.staff.edit', compact('staff'));
    }

    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'mobile' => 'required'
        ]);
        
        if ($request->filled('password')) {
            $staff->password = Hash::make($request->password);
        }
        $staff->update([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile
        ]);

        $staff->save();

        return redirect()->route('staff.index')
            ->with('success', 'Staff updated successfully');
    }

    public function destroy($id)
    {
        $staff = User::findOrFail($id);

        $staff->delete();

        return redirect()->route('staff.index')
            ->with('success', 'Staff deleted successfully');
    }
}
