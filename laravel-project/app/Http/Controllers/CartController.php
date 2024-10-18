<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller as BaseController;

class CartController extends BaseController
{
    public function __construct()
    {
        // Apply the auth middleware to the relevant methods
        $this->middleware('auth')->only(['view', 'checkout', 'update', 'remove']);
    }

    public function add($id)
    {
        $product = Product::findOrFail($id);
        $cart = Session::get('cart', []);

        // Check if product is already in cart
        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name' => $product->Name,
                'price' => $product->Price,
                'quantity' => 1,
                'image' => $product->Image,
            ];
        }

        Session::put('cart', $cart);
        return redirect()->route('cart.view')->with('success', 'Product added to cart!');
    }

    public function view()
    {
        $cart = Session::get('cart', []);
        return view('cart', compact('cart'));
    }

    public function update(Request $request, $id)
    {
        $cart = Session::get('cart', []);

        // Check if the item exists in the cart
        if (isset($cart[$id])) {
            // Update the quantity based on the action
            if ($request->action === 'increase') {
                $cart[$id]['quantity']++;
            } elseif ($request->action === 'decrease' && $cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            }
        }

        // Save the updated cart back to the session
        Session::put('cart', $cart);

        // Redirect back to the cart view
        return redirect()->route('cart.view')->with('success', 'Cart updated successfully!');
    }

    public function remove($id)
    {
        $cart = Session::get('cart', []);

        // Remove the item from the cart if it exists
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        // Save the updated cart back to the session
        Session::put('cart', $cart);

        // Redirect back to the cart view
        return redirect()->route('cart.view')->with('success', 'Product removed from cart!');
    }

    public function checkout()
    {
        // Ensure the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to log in to checkout.');
        }

        $cart = Session::get('cart', []);
        $user_Id = Auth::id();

        // Save each item in the cart to the database
        foreach ($cart as $id => $item) {
            CartItem::create([
                'user_id' => $user_Id, // Use the logged-in user's ID
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'product_name' => $item['name'],
                'product_image' => $item['image'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // Clear the cart after saving
        Session::forget('cart');

        return redirect()->route('products.index')->with('success', 'Checkout successful!');
    }
}
