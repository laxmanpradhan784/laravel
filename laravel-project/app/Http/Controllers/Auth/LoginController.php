<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        // Check if the user is already logged in
        if (Auth::check()) {
            return redirect()->route('profile')->with('success', 'You are already logged in.'); // Redirect to profile if logged in
        }

        return view('login'); // Return the login view if not logged in
    }

    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        // Attempt to log the user in
        if (Auth::attempt($request->only('email', 'password'))) {
            // Authentication passed
            return redirect()->intended('/profile')->with('success', 'Welcome back!');
        }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logged out successfully.');
    }
}
