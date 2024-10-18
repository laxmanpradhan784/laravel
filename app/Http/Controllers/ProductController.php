<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->get();
        $categories = Category::all();

        return view('products.index', compact('products', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Name' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'Image' => 'required|image|max:2048',
            'Price' => 'required|numeric',
            'Status' => 'required|in:active,inactive',
            'CategoryID' => 'nullable|exists:categories,CategoryID',
            'StockQuantity' => 'integer|min:0',
            'Size' => 'nullable|string|max:50',
            'Color' => 'nullable|string|max:50',
            'Rating' => 'nullable|numeric|between:0,5',
            'DiscountPercentage' => 'nullable|numeric|between:0,100',
            'MetaDescription' => 'nullable|string',
            'MetaKeywords' => 'nullable|string',
            'IsFeatured' => 'sometimes|boolean',
        ]);

        $imagePath = $request->file('Image')->store('images/products', 'public');

        Product::create([
            'Name' => $request->Name,
            'Description' => $request->Description,
            'Image' => $imagePath,
            'Price' => $request->Price,
            'Status' => $request->Status,
            'CategoryID' => $request->CategoryID,
            'StockQuantity' => $request->StockQuantity,
            'Size' => $request->Size,
            'Color' => $request->Color,
            'Rating' => $request->Rating,
            'DiscountPercentage' => $request->DiscountPercentage,
            'MetaDescription' => $request->MetaDescription,
            'MetaKeywords' => $request->MetaKeywords,
            'IsFeatured' => $request->IsFeatured,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'Name' => 'sometimes|required|string|max:255',
            'Description' => 'nullable|string',
            'Image' => 'nullable|image|max:2048',
            'Price' => 'sometimes|required|numeric',
            'Status' => 'sometimes|required|in:active,inactive',
            'CategoryID' => 'nullable|exists:categories,CategoryID',
            'StockQuantity' => 'sometimes|integer|min:0',
            'Size' => 'nullable|string|max:50',
            'Color' => 'nullable|string|max:50',
            'Rating' => 'nullable|numeric|between:0,5',
            'DiscountPercentage' => 'nullable|numeric|between:0,100',
            'MetaDescription' => 'nullable|string',
            'MetaKeywords' => 'nullable|string',
            'IsFeatured' => 'sometimes|boolean',
        ]);

        $product = Product::findOrFail($id);

        if ($request->hasFile('Image')) {
            if ($product->Image && Storage::disk('public')->exists($product->Image)) {
                Storage::disk('public')->delete($product->Image);
            }
            $product->Image = $request->file('Image')->store('images/products', 'public');
        }

        $product->update($request->only([
            'Name', 'Description', 'Price', 'Status', 'CategoryID',
            'StockQuantity', 'Size', 'Color', 'Rating',
            'DiscountPercentage', 'MetaDescription', 'MetaKeywords',
            'IsFeatured'
        ]));

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->Image && Storage::disk('public')->exists($product->Image)) {
            Storage::disk('public')->delete($product->Image);
        }

        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    public function toggleStatus(Product $product)
    {
        $product->Status = ($product->Status === 'active') ? 'inactive' : 'active';
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product status updated successfully!');
    }
}
