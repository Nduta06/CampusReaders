<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // FIXED: Check role using the relationship and redirect to existing routes
            if ($user->role->name === 'admin') {
                return redirect()->route('admin'); // Goes to /admin
            } elseif ($user->role->name === 'staff') {
                return redirect()->route('catalogue'); // Goes to /bookcatalogue
            }

            // Regular users (guest role) go to book catalogue
            return redirect()->route('catalogue'); // Goes to /bookcatalogue
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}