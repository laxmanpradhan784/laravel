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
        .related-product-img {
            width: 100%; /* Full width for related product images */
            height: 150px; /* Fixed height */
            object-fit: cover; /* Crop to fit */
        }
        .related-product-card {
            border: 1px solid #e0e0e0; /* Light border for a subtle separation */
            border-radius: 5px; /* Slightly rounded corners */
            overflow: hidden; /* Ensure images are contained */
            margin-bottom: 10px; /* Space between related product items */
            transition: transform 0.2s; /* Smooth hover effect */
        }
        .related-product-card:hover {
            transform: scale(1.05); /* Scale up on hover */
        }
    </style>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    @if ($product->Image)
                        <img src="{{ asset('adminside/storage/app/public/' . $product->Image) }}" class="card-img-top" alt="{{ $product->Name }}" data-toggle="modal" data-target="#imageModal">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->Name }}</h5>
                        <p class="card-text">{{ $product->Description }}</p>
                        <p class="card-text"><strong>Price:</strong> ${{ number_format($product->Price, 2) }}</p>
                        <p class="card-text"><strong>Status:</strong> {{ ucfirst($product->Status) }}</p>
                        <p class="card-text"><strong>Size:</strong> {{ $product->Size }}</p>
                        <p class="card-text"><strong>Color:</strong> {{ $product->Color }}</p>
                        <p class="card-text"><strong>Rating:</strong> {{ $product->Rating }} / 5</p>
                        <p class="card-text"><strong>Discount:</strong> {{ $product->DiscountPercentage }}%</p>
                        <p class="card-text"><strong>Stock Quantity:</strong> {{ $product->StockQuantity }}</p>
                        <p class="card-text"><strong>Meta Description:</strong> {{ $product->MetaDescription }}</p>
                        <p class="card-text"><strong>Meta Keywords:</strong> {{ $product->MetaKeywords }}</p>
                        <small class="text-muted">Added on {{ $product->created_at->format('M d, Y') }}</small>

                        <!-- Add to Cart Form -->
                        <form action="{{ route('cart.add', $product->ProductID) }}" method="POST" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-success">Add to Cart</button>
                        </form>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="mb-4">
                    <h5>Product Reviews</h5>
                    <div class="list-group">
                        @forelse ($reviews as $review)
                            <div class="list-group-item">
                                <h6 class="mb-1">{{ $review->user->name }} <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small></h6>
                                <p class="mb-1"><strong>Rating:</strong> {{ $review->rating }} / 5</p>
                                <p>{{ $review->comment }}</p>
                            </div>
                        @empty
                            <div class="list-group-item">No reviews yet.</div>
                        @endforelse
                    </div>
                </div>

                <!-- Review Form -->
                <h5>Leave a Review</h5>
                <form action="{{ route('reviews.store', $product->ProductID) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="rating">Rating</label>
                        <select name="rating" id="rating" class="form-control" required>
                            <option value="">Select a rating</option>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="comment">Comment</label>
                        <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Review</button>
                </form>
            </div>

            <div class="col-md-4">
                <h5 class="mb-4">Related Products</h5>
                <div class="list-group">
                    @foreach ($relatedProducts as $relatedProduct)
                        <a href="{{ route('products.show', $relatedProduct->ProductID) }}" class="list-group-item list-group-item-action d-flex align-items-center related-product-card">
                            @if ($relatedProduct->Image)
                                <img src="{{ asset('adminside/storage/app/public/' . $relatedProduct->Image) }}" class="related-product-img" alt="{{ $relatedProduct->Name }}">
                            @else
                                <div class="related-product-img bg-secondary d-flex justify-content-center align-items-center">
                                    <span class="text-white">Image Not Available</span>
                                </div>
                            @endif
                            <div class="ml-3">
                                <h6 class="mb-1">{{ $relatedProduct->Name }}</h6>
                                <small class="text-muted">Price: ${{ number_format($relatedProduct->Price, 2) }}</small>
                            </div>
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
                    <h5 class="modal-title" id="imageModalLabel">{{ $product->Name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if ($product->Image)
                        <img src="{{ asset('adminside/storage/app/public/' . $product->Image) }}" class="img-fluid" alt="{{ $product->Name }}">
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
