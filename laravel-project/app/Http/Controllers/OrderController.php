<?php

namespace App\Http\Controllers;

use App\Models\OrderSummary; // Ensure this model is correctly imported
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Routing\Controller as BaseController;


class OrderController extends BaseController
{
    public function __construct()
    {
        // Apply the auth middleware to the relevant methods
        $this->middleware('auth')->only(['showSummary', 'placeOrder', 'showPaymentPage', 'processPayment', 'confirmation']);
    }

    public function showSummary()
    {
        $user = Auth::user(); // Get the logged-in user
        $cartItems = Session::get('cart', []); // Retrieve cart items from the session

        return view('order-summary', compact('user', 'cartItems')); // Return the order summary view
    }

    public function placeOrder(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
        ]);

        $userId = Auth::id(); // Get the logged-in user ID
        $cartItems = Session::get('cart', []); // Retrieve cart items from the session
        $address = $request->input('address');
        $city = $request->input('city');
        $postalCode = $request->input('postal_code');

        // Create a new order summary
        $order = OrderSummary::create([
            'user_id' => $userId,
            'address' => $address,
            'city' => $city,
            'postal_code' => $postalCode,
            'status' => 'pending', // Set initial status
        ]);

        // Save each cart item to the order summary
        foreach ($cartItems as $id => $item) {
            $order->cartItems()->create([ // Assuming you have a relationship in OrderSummary model
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'product_name' => $item['name'],
                'product_image' => $item['image'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        // Clear the cart after saving
        Session::forget('cart');

        // Redirect to payment page with order details
        return redirect()->route('payment.page', ['order' => $order->id])->with('success', 'Your order has been placed successfully!'); // Redirect with a success message
    }

    public function showPaymentPage($orderId)
    {
        $order = OrderSummary::findOrFail($orderId); // Get the order details
        return view('payment', compact('order')); // Pass the order to the payment view
    }

    public function processPayment(Request $request, $orderId)
    {
        // Validate payment method selection
        $request->validate([
            'payment_method' => 'required|string',
        ]);

        $order = OrderSummary::findOrFail($orderId); // Retrieve the order
        $order->payment_method = $request->input('payment_method'); // Set payment method
        $order->status = 'paid'; // Update status to paid
        $order->save(); // Save order with payment details

        // Here you would handle integration with your payment gateway

        return redirect()->route('order.confirmation', $order->id); // Redirect to order confirmation page
    }

    public function confirmation($orderId)
    {
        $order = OrderSummary::findOrFail($orderId); // Retrieve the order details
        return view('order.confirmation', compact('order')); // Pass the order to the confirmation view
    }
}
