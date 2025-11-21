<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SignupController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        // Validate user data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // AUTHORIZATION: Assign 'guest' role by default to new users
        $guestRole = Role::where('name', 'guest')->first();

        // Create user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $guestRole->id,
        ]);

        // AUTHENTICATION: Automatically log the user in after signup
        Auth::login($user);

        // Redirect to book catalogue (guest users)
        return redirect()->route('bookcatalogue');
    }
}