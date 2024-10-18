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

        .blog-image {
            width: 100%; /* Full width */
            height: 200px; /* Fixed height */
            object-fit: cover; /* Crop the image to fit the container */
        }
    </style>

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
        @endif
    </div>
@endsection
