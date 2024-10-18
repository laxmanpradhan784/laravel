@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Montserrat', sans-serif;
    }

    .container {
        margin-top: 100px;
        margin-bottom: 50px;
    }

    .product-image {
        width: 70px; /* Adjust the width as necessary */
        height: auto;
        border-radius: 5px;
    }

    .btn-custom {
        margin-top: 20px;
        background-color: #007bff;
        color: white;
    }
</style>
<div class="container">
    <h2 class="my-4">Order Confirmation</h2>

    <p class="lead">Thank you for your order!</p>

    <h4 class="mt-4">Order Details</h4>
    <table class="table table-bordered">
        <tbody>
            <tr>
                <th>Order ID</th>
                <td>{{ $order->id }}</td>
            </tr>
            <tr>
                <th>Status</th>
                <td>{{ $order->status }}</td>
            </tr>
            <tr>
                <th>Payment Method</th>
                <td>{{ $order->payment_method }}</td>
            </tr>
        </tbody>
    </table>

    <h5 class="mt-4">Items:</h5>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->cartItems as $item)
            <tr>
                <td>
                    <img src="{{ asset('adminside/storage/app/public/' . $item->product_image) }}" alt="{{ $item->product_name }}" class="product-image">
                </td>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>${{ number_format($item->subtotal, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="mt-4">Total: ${{ number_format($order->cartItems->sum('subtotal'), 2) }}</h4>
    
    <a href="{{ route('products.index') }}" class="btn btn-custom">Continue Shopping</a>
</div>
@endsection
