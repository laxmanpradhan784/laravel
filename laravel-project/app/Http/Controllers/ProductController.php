<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review; // Import the Review model
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller as BaseController;

class ProductController extends BaseController
{
    use AuthorizesRequests;

    public function index()
    {
        // Fetch only active products with their categories
        $products = Product::where('Status', 'active')->with('category')->get();
        return view('products', compact('products'));
    }

    public function show($id)
    {
        // Fetch the specific product with its category and reviews
        $product = Product::with(['category', 'reviews.user'])->findOrFail($id);

        // Fetch related products from the same category
        $relatedProducts = Product::where('CategoryID', $product->CategoryID)
            ->where('ProductID', '!=', $product->ProductID)
            ->where('Status', 'active')
            ->get();

        // Pass the product, related products, and reviews to the view
        return view('product-details', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'reviews' => $product->reviews // Pass reviews here
        ]);
    }
}
