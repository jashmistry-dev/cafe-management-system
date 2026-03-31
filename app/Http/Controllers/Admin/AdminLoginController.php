<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminLoginController extends Controller
{
    // show login page
    public function showLogin()
    {
        return view('auth.login');
    }

    // login logic
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        // check user exists + password match
        if ($user && Hash::check($request->password, $user->password)) {

            Auth::login($user);

            // role redirect
            if ($user->role === 'admin') {
                return redirect('/admin/tables');
            } else {
                return redirect('/staff/orders');
            }
        }

        return back()->with('error', 'Invalid credentials');
    }

    // logout
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}