<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Slider;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

class SliderController extends BaseController// Ensure this extends the base Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->middleware('auth'); // Apply the auth middleware to all methods
    }

    public function showSliders()
    {
        // Fetch active sliders
        $sliders = Slider::where('status', 'active')->orderBy('created_at', 'desc')->get();

        $blogs = Blog::where('status', 'published')->orderBy('created_at', 'desc')->paginate(10);

        $products = Product::where('Status', 'active')->with('category')->get();


        return view('sliders', compact('sliders','blogs','products'));
    }
}
