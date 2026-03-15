<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }
    public function login(Request $request, )
    {

        // Checks:
        // email must exist
        // email must be valid format
        // password must exist
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);



        $user = User::where('email', $request->email)->first();


        if (!$user) {
            return back()->with('error', 'User not found');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password incorrect');
        }


        // if (!$user || Hash::check($request->password, $user->password)) {
        //     return back()->with('error', 'Invalid Credentials');
        // }

        if ($user->role !== 'admin') {
            return back()->with('error', 'Unauthorized access');
        }

        Auth::login($user);

        return redirect('/admin/categories');
        // dd($request->all());
    }
    public function logout()
    {
        Auth::logout();
        return redirect("/login");
    }
}
