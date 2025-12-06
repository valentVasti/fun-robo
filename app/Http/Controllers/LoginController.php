<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('backend.login');
    }

    public function login(Request $request)
    {

        $credentials = [
            'username' => $request->username,
            'password' => $request->password,
        ];


        if (Auth::attempt($credentials)) {
            return redirect()->intended('admin/dashboard'); // Redirect to a specific page after successful login
        }

        return back()->withInput()->withErrors(['email' => 'Invalid credentials']); // Redirect back with an error message

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login'); // Redirect to the login page after logout
    }
}
