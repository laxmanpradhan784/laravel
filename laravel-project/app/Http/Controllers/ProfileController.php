<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('profile', compact('user')); // Pass the user to the view
    }

    public function edit()
    {
        $user = Auth::user(); // Get the authenticated user
        return view('edit-profile', compact('user')); // Return the edit view with user data
    }

    public function update(Request $request)
    {
        $user = Auth::user(); // Get the authenticated user

        // Validate the incoming request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user->id), // Ignore current user's email
            ],
            'mobile' => 'required|string|max:15',
            'dob' => 'required|date',
            'gender' => 'required|in:male,female,other',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput(); // Redirect back with errors
        }

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        $user->dob = $request->dob;
        $user->gender = $request->gender;

        // Handle the image upload if a new image is provided
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($user->image) {
                Storage::delete($user->image);
            }
            // Store the new image
            $path = $request->file('image')->store('profile_images', 'public');
            $user->image = $path; // Save the path to the user's record
        }

        $user->save(); // Save the updated user data

        return redirect()->route('profile')->with('success', 'Profile updated successfully.'); // Redirect to profile with success message
    }
}
