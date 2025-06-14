<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{


    // Show registration form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Register User
    public function register(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'telephone' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // Create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'alamat' => $request->alamat,
            'role' => 'User',
            'password' => Hash::make($request->password),
        ]);

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    // Show registration form Admin
    public function showRegistrationAdminForm()
    {
        return view('auth.register-admin');
    }

    // Register Admin
    public function registerAdmin(Request $request)
    {
        // Validate input
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'telephone' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:255'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // Create user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'alamat' => $request->alamat,
            'role' => 'Admin',
            'password' => Hash::make($request->password),
        ]);

        // Redirect to login page with success message
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }

    // Show login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle login request
    public function login(Request $request)
    {
        // Validate input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek role
            if ($user->role === 'Admin') {
                return redirect()->intended('/admin');
            } elseif ($user->role === 'User') {
                return redirect()->intended('/');
            } else {
                Auth::logout();
                return redirect()->route('login')->withErrors(['email' => 'Unauthorized role.']);
            }
        }

        // Login gagal
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
