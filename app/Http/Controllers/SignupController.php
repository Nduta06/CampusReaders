<?php

namespace App\Http\Controllers;

use App\Models\Role; 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SignupController extends Controller
{
    public function showSignupForm()
    {
        return view('signup');
    }

    public function signup(Request $request)
    {
        // 1. Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        $guestRole = Role::where('name', 'Student')->first();
        
        if (!$guestRole) {
            $guestRole = Role::where('name', 'Guest')->first();
        }
        
        // Safety check: if no roles exist at all
        if (!$guestRole) {
            return redirect()->back()->withErrors(['error' => 'System Error: The "Student" role does not exist in the database. Please run seeders.']);
        }

        // 3. Create the user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roleId' => $guestRole->id, // camelCase 'roleId' matches your DB column
        ]);

        // 4. Log the user in and redirect
        Auth::login($user);

        return redirect()->route('catalogue');
    }
}