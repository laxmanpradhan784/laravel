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
        .product-image {
            width: 100%; /* Full width */
            height: 200px; /* Fixed height */
            object-fit: cover; /* Crop the image to fit the container */
            transition: transform 0.2s; /* Smooth zoom effect */
        }
        .card {
            overflow: hidden; /* Ensure no overflow */
            border: 1px solid #e0e0e0; /* Light border for cards */
            border-radius: 5px; /* Rounded corners */
        }
        .card:hover .product-image {
            transform: scale(1.05); /* Zoom in on image hover */
        }
        .text-muted {
            font-size: 0.9em; /* Slightly smaller text for better readability */
        }
    </style>

    <div class="container mt-5">
        <h1 class="text-center mb-4">Available Products</h1>

        @if ($products->isEmpty())
            <p class="text-center text-danger">No products available.</p>
        @else
            <div class="row mt-4">
                @foreach ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm">
                            @if ($product->Image) <!-- Check if the product has an image -->
                                <a href="{{ route('products.show', $product->ProductID) }}">
                                    <img src="{{ asset('adminside/storage/app/public/' . $product->Image) }}" class="card-img-top product-image" alt="{{ $product->Name }}">
                                </a>
                            @else
                                <div class="card-img-top product-image bg-secondary d-flex justify-content-center align-items-center">
                                    <span class="text-white">Image Not Available</span>
                                </div>
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->Name }}</h5>
                                <p class="card-text">{{ Str::limit($product->Description, 100) }}</p>
                                <p class="text-muted">Price: ${{ number_format($product->Price, 2) }}</p>
                                <a href="{{ route('products.show', $product->ProductID) }}" class="btn btn-primary mt-2">View Details</a>
                                <form action="{{ route('cart.add', $product->ProductID) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Add to Cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
