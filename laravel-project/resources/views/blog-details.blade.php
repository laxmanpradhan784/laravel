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
        .card-img-top {
            height: 500px; /* Fixed height for images */
            object-fit: cover; /* Crop the image to fit */
            cursor: pointer; /* Change cursor to pointer for clickable images */
        }
    </style>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    @if ($blog->image)
                        <img src="{{ asset('adminside/storage/app/public/' . $blog->image) }}" class="card-img-top" alt="{{ $blog->title }}" data-toggle="modal" data-target="#imageModal">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <p class="card-text">{{ $blog->content }}</p> <!-- Full content -->
                        <small class="text-muted">Published on {{ $blog->created_at->format('M d, Y') }}</small>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <h5 class="mb-4">Other Blogs</h5>
                <div class="list-group">
                    @foreach ($otherBlogs as $otherBlog)
                        <a href="{{ route('blogs.show', $otherBlog->id) }}" class="list-group-item list-group-item-action">
                            @if ($otherBlog->image)
                                <img src="{{ asset('adminside/storage/app/public/' . $otherBlog->image) }}" class="img-thumbnail" alt="{{ $otherBlog->title }}" style="width: 100%; height: 200px; object-fit: cover;">
                            @endif
                            <h6 class="mb-1">{{ $otherBlog->title }}</h6>
                            <small class="text-muted">Published on {{ $otherBlog->created_at->format('M d, Y') }}</small>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Image Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">{{ $blog->title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($blog->image)
                        <img src="{{ asset('adminside/storage/app/public/' . $blog->image) }}" class="img-fluid" alt="{{ $blog->title }}">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
