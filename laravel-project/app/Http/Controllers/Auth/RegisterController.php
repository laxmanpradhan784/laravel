<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        // Check if the user is already logged in
        if (Auth::check()) {
            return redirect()->route('profile')->with('success', 'You are already logged in.'); // Redirect to profile if logged in
        }

        return view('register'); // Return the registration view if not logged in
    }

    public function register(Request $request)
    {
        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'mobile' => 'required|string|max:15',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'password' => 'required|string|min:3|confirmed',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Handle the image upload
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('profile_images', 'public'); // Store image in public storage
        }

        // Create the user using the model's password hashing
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'dob' => $request->dob,
            'gender' => $request->gender,
            'password' => $request->password, // Password will be hashed in the model
            'image' => $imagePath, // Save the image path
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! You can now log in.');
    }
}
