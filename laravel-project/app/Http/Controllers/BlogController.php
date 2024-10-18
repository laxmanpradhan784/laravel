<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

class BlogController extends BaseController
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth'); // Apply the auth middleware to all methods
    }

    public function showBlogs()
    {
        $blogs = Blog::where('status', 'published')->orderBy('created_at', 'desc')->get(); // Get all published blogs
        return view('blogs', compact('blogs')); // Ensure it points to the right view
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id); // Get the specific blog by ID
        $otherBlogs = Blog::where('id', '!=', $id)->take(3)->get(); // Get other blogs

        return view('blog-details', compact('blog', 'otherBlogs'));
    }
}
