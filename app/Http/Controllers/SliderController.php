<?php

namespace App\Http\Controllers;

use App\Models\Slider; 
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::orderBy('created_at', 'desc')->get();
        return view('sliders.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request for title, image, and status
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'required|image|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        // Store the uploaded image in the public/images directory
        $imagePath = $request->file('image')->store('images', 'public');

        // Create a new slider record in the database
        Slider::create([
            'title' => $request->title,
            'image' => $imagePath,
            'status' => $request->status,
        ]);

        // Redirect back with a success message
        return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
    } // Commit: Validate request and create a new slider with image upload.

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'status' => 'required|in:active,inactive',
        ]);

        try {
            if ($request->hasFile('image')) {
                if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                    Storage::disk('public')->delete($slider->image);
                }
                $slider->image = $request->file('image')->store('images', 'public');
            }

            $slider->title = $request->title;
            $slider->status = $request->status;
            $slider->save();

            return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
        } catch (\Exception $e) {
            \Log::error('Slider update failed: ' . $e->getMessage());
            return back()->withErrors(['update' => 'Slider update failed.']);
        }
    }

    public function destroy(Slider $slider)
    {
        if ($slider->image && Storage::disk('public')->exists($slider->image)) {
            Storage::disk('public')->delete($slider->image);
        }
        $slider->delete();

        return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
    }

    public function toggleStatus(Slider $slider)
    {
        $slider->status = ($slider->status === 'active') ? 'inactive' : 'active';
        $slider->save();

        return redirect()->route('sliders.index')->with('success', 'Slider status updated successfully!');
    }
}
