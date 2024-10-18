<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display a listing of categories
    public function index()
    {
        $categories = Category::with('children')->get();
        return view('categories.index', compact('categories'));
    }

    // Show the form for creating a new category
    public function create()
    {
        $categories = Category::all(); // For dropdown of parent categories
        return view('categories.create', compact('categories'));
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'CategoryName' => 'required|string|max:255',
            'ParentCategoryID' => 'nullable|integer|exists:categories,CategoryID',
        ]);

        Category::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    // Show a specific category
    public function show($id)
    {
        $category = Category::with('children')->findOrFail($id);
        return view('categories.show', compact('category'));
    }

    // Show the form for editing a specific category
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::all(); // For dropdown of parent categories
        return view('categories.edit', compact('category', 'categories'));
    }

    // Update a specific category
    public function update(Request $request, $id)
    {
        $request->validate([
            'CategoryName' => 'required|string|max:255',
            'ParentCategoryID' => 'nullable|integer|exists:categories,CategoryID',
        ]);

        $category = Category::findOrFail($id);
        $category->update($request->all());

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete a specific category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete child categories first, if any
        if ($category->children()->count() > 0) {
            // Optionally, you can choose to delete child categories
            // $category->children()->delete();

            return redirect()->route('categories.index')->with('error', 'Cannot delete this category because it has child categories.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully.');
    }
}
