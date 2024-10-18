@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Montserrat', sans-serif;
    }

    .container {
        margin-top: 100px;
        margin-bottom: 170px;
    }

    .cart-table {
        margin-top: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        overflow: hidden;
    }

    .cart-table thead {
        background-color: #f8f9fa;
    }

    .cart-table th,
    .cart-table td {
        vertical-align: middle;
        text-align: center;
        padding: 15px;
    }

    .cart-table img {
        border-radius: 5px;
        width: 70px;
        height: auto;
    }

    .checkout-btn {
        margin-top: 20px;
    }

    .total-price {
        font-weight: bold;
        font-size: 1.2em;
        color: #28a745;
    }

    .quantity-controls {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .quantity-controls button {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        width: 30px;
        height: 30px;
        cursor: pointer;
    }

    .quantity-controls input {
        width: 50px;
        text-align: center;
        border: 1px solid #e0e0e0;
        border-radius: 5px;
        margin: 0 5px;
    }

    .quantity-controls button:hover {
        background-color: #0056b3;
    }

    .remove-btn {
        background-color: #dc3545;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        cursor: pointer;
    }

    .remove-btn:hover {
        background-color: #c82333;
    }
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4">Your Cart</h1>

    @if (empty($cart))
        <p class="text-center">Your cart is empty.</p>
    @else
        <table class="table table-bordered cart-table">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
                @php $subtotal = 0; @endphp
                @foreach ($cart as $id => $item)
                    @php 
                        $total = $item['price'] * $item['quantity'];
                        $subtotal += $total; 
                    @endphp
                    <tr>
                        <td><img src="{{ asset('adminside/storage/app/public/' . $item['image']) }}" alt="{{ $item['name'] }}"></td>
                        <td>{{ $item['name'] }}</td>
                        <td>${{ number_format($item['price'], 2) }}</td>
                        <td>
                            <div class="quantity-controls">
                                <form action="{{ route('cart.update', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" name="action" value="decrease">-</button>
                                    <input type="text" name="quantity" value="{{ $item['quantity'] }}" readonly>
                                    <button type="submit" name="action" value="increase">+</button>
                                </form>
                            </div>
                        </td>
                        <td>${{ number_format($total, 2) }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="remove-btn">Remove</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" class="text-right">Subtotal:</td>
                    <td class="total-price">${{ number_format($subtotal, 2) }}</td>
                    <td></td>
                </tr>
            </tbody>
        </table>

        <form action="{{ route('order.summary') }}" method="GET" class="text-center checkout-btn">
            @csrf
            <button type="submit" class="btn btn-success btn-lg">Proceed to Checkout</button>
        </form>
    @endif
</div>
@endsection
