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

    .slider-image {
        width: 100%; /* Full width */
        height: 600px; /* Fixed height */
        object-fit: cover; /* Crop the image to fit the container */
    }

    .carousel {
        margin-bottom: 30px; /* Adds space below the carousel */
        background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent black background */
        border-radius: 8px; /* Rounded corners */
    }

    .carousel-caption {
        background-color: rgba(255, 255, 255, 0.7); /* White background with transparency */
        padding: 20px; /* Padding around text */
        border-radius: 5px; /* Rounded corners for caption */
    }

    .carousel-caption h5 {
        color: #333; /* Dark text for better readability */
        font-weight: bold; /* Bold title */
    }

    .carousel-caption p {
        color: #666; /* Lighter text for status */
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
        transition: box-shadow 0.2s; /* Smooth shadow effect */
    }

    .card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Add shadow on hover */
    }

    .card:hover .product-image {
        transform: scale(1.05); /* Zoom in on image hover */
    }

    .text-muted {
        font-size: 0.9em; /* Slightly smaller text for better readability */
    }

    .blog-image {
        width: 100%; /* Full width */
        height: 200px; /* Fixed height */
        object-fit: cover; /* Crop the image to fit the container */
    }

    /* Button styles */
    .btn-primary {
        background-color: #007bff; /* Custom primary color */
        border: none; /* Remove border */
        transition: background-color 0.2s; /* Smooth transition */
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Darker shade on hover */
    }

    /* Pagination */
    .pagination {
        justify-content: center; /* Center pagination links */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .slider-image {
            height: 400px; /* Reduce height on smaller screens */
        }
    }
</style>

<!-- Carousel -->
<div class="container-fluid mt-5">
    <div id="sliderCarousel" class="carousel slide" data-ride="carousel" data-interval="2000">
        <div class="carousel-inner">
            @foreach ($sliders as $index => $slider)
                @if ($slider->status === 'active')
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ asset('adminside/storage/app/public/' . $slider->image) }}" class="d-block slider-image" alt="{{ $slider->title }}">
                        <div class="carousel-caption d-none d-md-block">
                            <h5>{{ $slider->title }}</h5>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#sliderCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#sliderCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<!-- Products -->
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
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- Blogs -->
<div class="container mt-5">
    <h1 class="text-center">Published Blogs</h1>

    @if ($blogs->isEmpty())
        <p class="text-center">No blogs available.</p>
    @else
        <div class="row mt-4">
            @foreach ($blogs as $blog)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($blog->image) <!-- Check if the blog has an image -->
                            <a href="{{ route('blogs.show', $blog->id) }}">
                                <img src="{{ asset('adminside/storage/app/public/' . $blog->image) }}" class="card-img-top blog-image" alt="{{ $blog->title }}">
                            </a>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog->title }}</h5>
                            <p class="card-text">{{ Str::limit($blog->content, 100) }}</p>
                            <small class="text-muted">Published on {{ $blog->created_at->format('M d, Y') }}</small>
                            <a href="{{ route('blogs.show', $blog->id) }}" class="btn btn-primary mt-2">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="mt-3">
            {{ $blogs->links() }} <!-- Pagination links -->
        </div>
    @endif
</div>

@endsection
