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

    .order-summary-container {
        display: flex;
        justify-content: space-between;
        gap: 20px; /* Space between the address form and order summary */
    }

    .address-form, .order-summary {
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        flex: 1; /* Allow both sections to grow equally */
    }

    .address-form {
        min-width: 300px; /* Minimum width for the address form */
    }

    h2, h3 {
        color: #333;
    }

    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
        padding: 10px;
        border-bottom: 1px solid #eee;
    }

    .order-item img {
        width: 70px;
        height: auto;
        margin-right: 15px;
        border-radius: 5px;
    }

    .item-details {
        flex-grow: 1;
    }

    .item-details h5 {
        margin: 0;
        font-size: 16px;
        color: #007bff;
    }

    .item-details p {
        margin: 5px 0;
        color: #555;
    }

    .total {
        font-weight: bold;
        font-size: 20px;
        margin-top: 20px;
        color: #28a745;
    }

    .btn-success {
        margin-top: 20px;
    }

    .form-group {
        margin-bottom: 15px;
    }
</style>

<div class="container">
    <div class="order-summary-container">
        <div class="address-form">
            <h2>Address Details</h2>
            <form action="{{ route('order.place') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="user-name"><strong>User:</strong></label>
                    <input type="text" id="user-name" class="form-control" value="{{ $user->name }}" readonly>
                </div>

                <div class="form-group">
                    <label for="address"><strong>Address:</strong></label>
                    <input type="text" id="address" name="address" class="form-control" value="{{ old('address', $user->address) }}" required>
                </div>

                <div class="form-group">
                    <label for="city"><strong>City:</strong></label>
                    <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $user->city) }}" required>
                </div>

                <div class="form-group">
                    <label for="postal-code"><strong>Pin Code:</strong></label>
                    <input type="text" id="postal-code" name="postal_code" class="form-control" value="{{ old('postal_code', $user->postal_code) }}" required>
                </div>
        </div>

        <div class="order-summary">
            <h2>Order Summary</h2>
            <h3>Items:</h3>
            @foreach ($cartItems as $item)
                <div class="order-item">
                    <img src="{{ asset('adminside/storage/app/public/' . $item['image']) }}" alt="{{ $item['name'] }}">
                    <div class="item-details">
                        <h5>{{ $item['name'] }}</h5>
                        <p>Quantity: {{ $item['quantity'] }}</p>
                        <p>Subtotal: ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                    </div>
                </div>
            @endforeach

            <div class="total">
                Total: ${{ number_format(array_sum(array_map(function($item) {
                    return $item['price'] * $item['quantity'];
                }, $cartItems)), 2) }}
            </div>

            <button type="submit" class="btn btn-success btn-lg">Place Order</button>
            </form>
        </div>
    </div>
</div>
@endsection
