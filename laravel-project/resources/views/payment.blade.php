@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Light background */
        font-family: 'Montserrat', sans-serif; /* Font style */
    }

    .container {
        margin-top: 100px; /* Space above the content */
        margin-bottom: 50px; /* Space below the content for footer */
    }

    .order-summary {
        margin-bottom: 20px;
        padding: 15px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .order-item img {
        width: 70px;
        height: auto;
        margin-right: 15px;
        border-radius: 5px;
    }
</style>

<div class="container">
    <h2>Payment Page</h2>

    @if ($order)
        <h3>Order Summary</h3>
        <div class="order-summary">
            <h5>Items:</h5>
            @foreach ($order->cartItems as $item)
                <div class="order-item">
                    <img src="{{ asset('adminside/storage/app/public/' . $item->product_image) }}" alt="{{ $item->product_name }}">
                    <div>
                        <strong>{{ $item->product_name }}</strong><br>
                        Quantity: {{ $item->quantity }}<br>
                        Subtotal: ${{ number_format($item->subtotal, 2) }}
                    </div>
                </div>
            @endforeach

            <div>
                <strong>Total: ${{ number_format($order->cartItems->sum('subtotal'), 2) }}</strong>
            </div>
        </div>

        <h4>Select Payment Method</h4>
        <form action="{{ route('payment.process', $order->id) }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="payment_method">Payment Method:</label>
                <select id="payment_method" name="payment_method" required class="form-control">
                    <option value="" disabled selected>Select your payment method</option>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="bank_transfer">Bank Transfer</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Proceed to Payment</button>
        </form>

    @else
        <p>No order details found.</p>
    @endif
</div>
@endsection
