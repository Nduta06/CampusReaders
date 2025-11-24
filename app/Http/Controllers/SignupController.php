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
            'role' => 'required|string|in:student,staff,admin', // Validate the role
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();

        // 2. Get the selected role from the database
        $selectedRole = Role::where('name', ucfirst($data['role']))->first();
        
        // If the specific role doesn't exist, fall back to Student
        if (!$selectedRole) {
            $selectedRole = Role::where('name', 'Student')->first();
        }
        
        // Safety check: if no roles exist at all
        if (!$selectedRole) {
            return redirect()->back()->withErrors(['error' => 'System Error: No roles exist in the database. Please run seeders.'])->withInput();
        }

        // 3. Create the user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'roleId' => $selectedRole->id, // camelCase 'roleId' matches your DB column
        ]);

        // 4. Log the user in
        Auth::login($user);

        // 5. Redirect based on role
        if ($data['role'] === 'admin') {
            return redirect()->route('admin.dashboard');
        } else {
            // For student and staff, redirect to catalogue
            return redirect()->route('catalogue');
        }
    }
}