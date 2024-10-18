<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact; // Include the Contact model
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContactController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth'); // Apply the auth middleware to all methods
    }

    // Method to show the contact form
    public function show()
    {
        return view('contact'); // Return the contact view
    }

    // Method to handle form submission
    public function submit(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Create a new Contact instance and save to the database
        Contact::create($validated); // Save the validated data

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}
