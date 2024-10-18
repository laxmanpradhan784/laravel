<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        // Validate the incoming request
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:1000',
        ]);

        // Create the review
        Review::create([
            'product_id' => $productId,
            'user_id' => Auth::id(), // Get the authenticated user's ID
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirect back to the product page with a success message
        return redirect()->route('products.show', $productId)->with('success', 'Review submitted successfully!');
    }
}
