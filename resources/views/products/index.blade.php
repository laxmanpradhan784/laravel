<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }

        h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .fade-in {
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>
    <div class="container mt-5 fade-in">
        <h1 class="mb-4 text-center">Product Management</h1>

         <!-- Navigation Buttons -->
         <div class="text-right mb-3">
            <a href="{{ route('sliders.index') }}" class="btn btn-primary">Go to Slider</a>
            <a href="{{ route('blogs.index') }}" class="btn btn-primary">Go to Blog</a>
            <a href="{{ route('categories.index') }}" class="btn btn-primary">Go to Category</a>
        </div>

        <div class="text-right mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#productModal" onclick="showCreateForm()">
                <i class="fas fa-plus"></i> Add Product
            </button>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>SR. NO</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Stock Quantity</th>
                    <th>Size</th>
                    <th>Color</th>
                    <th>Rating</th>
                    <th>Discount %</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $index => $product)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $product->Name }}</td>
                    <td>{{ Str::limit($product->Description, 50) }}</td>
                    <td>
                        @if($product->Image)
                            <img src="{{ asset('storage/app/public/' . $product->Image) }}" alt="{{ $product->Name }}" style="width: 50px; height: auto;">
                        @endif
                    </td>
                    <td>${{ number_format($product->Price, 2) }}</td>
                    <td>{{ $product->Status }}</td>
                    <td>{{ $product->StockQuantity }}</td>
                    <td>{{ $product->Size }}</td>
                    <td>{{ $product->Color }}</td>
                    <td>{{ $product->Rating }}</td>
                    <td>{{ $product->DiscountPercentage }}%</td>
                    <td>{{ $product->category->CategoryName ?? 'N/A' }}</td>
                    <td>
                        <button class="btn btn-warning " onclick='showEditForm(@json($product))'>
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('products.destroy', $product->ProductID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger m-1" onclick="return confirm('Are you sure you want to delete this product?');">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                        <form action="{{ route('products.toggleStatus', $product->ProductID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn {{ $product->Status === 'active' ? 'btn-secondary' : 'btn-success' }}">
                                {{ $product->Status === 'active' ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Product Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form-title">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="ProductID" id="product-id">
                    <div class="modal-body">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="Name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea class="form-control" name="Description" id="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="Image" id="image" >
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" class="form-control" name="Price" id="price" step="0.01" >
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="Status" id="status" >
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select class="form-control" name="CategoryID" id="category">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->CategoryID }}">{{ $category->CategoryName }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="stock-quantity">Stock Quantity</label>
                            <input type="number" class="form-control" name="StockQuantity" id="stock-quantity" min="0">
                        </div>
                        <div class="form-group">
                            <label for="size">Size</label>
                            <input type="text" class="form-control" name="Size" id="size">
                        </div>
                        <div class="form-group">
                            <label for="color">Color</label>
                            <input type="text" class="form-control" name="Color" id="color">
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <input type="number" class="form-control" name="Rating" id="rating" min="0" max="5" step="0.1">
                        </div>
                        <div class="form-group">
                            <label for="discount-percentage">Discount Percentage</label>
                            <input type="number" class="form-control" name="DiscountPercentage" id="discount-percentage" min="0" max="100">
                        </div>
                        <div class="form-group">
                            <label for="meta-description">Meta Description</label>
                            <textarea class="form-control" name="MetaDescription" id="meta-description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="meta-keywords">Meta Keywords</label>
                            <textarea class="form-control" name="MetaKeywords" id="meta-keywords"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="is-featured">Is Featured</label>
                            <input type="checkbox" name="IsFeatured" id="is-featured" value="1">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submit-btn">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const form = document.getElementById('form');
        const formTitle = document.getElementById('form-title');
        const submitBtn = document.getElementById('submit-btn');
        const productIdInput = document.getElementById('product-id');
        const nameInput = document.getElementById('name');
        const descriptionInput = document.getElementById('description');
        const priceInput = document.getElementById('price');
        const statusInput = document.getElementById('status');
        const categoryInput = document.getElementById('category');
        const stockQuantityInput = document.getElementById('stock-quantity');
        const sizeInput = document.getElementById('size');
        const colorInput = document.getElementById('color');
        const ratingInput = document.getElementById('rating');
        const discountPercentageInput = document.getElementById('discount-percentage');

        function showCreateForm() {
            form.reset();
            formTitle.innerText = 'Add Product';
            form.action = "{{ route('products.store') }}";
            submitBtn.innerText = 'Create';
            removeMethodField();
            $('#productModal').modal('show');
        }

        function showEditForm(product) {
            formTitle.innerText = 'Edit Product';
            form.action = "{{ url('products') }}/" + product.ProductID;
            submitBtn.innerText = 'Update';

            productIdInput.value = product.ProductID;
            nameInput.value = product.Name;
            descriptionInput.value = product.Description;
            priceInput.value = product.Price;
            statusInput.value = product.Status;
            stockQuantityInput.value = product.StockQuantity;
            sizeInput.value = product.Size;
            colorInput.value = product.Color;
            ratingInput.value = product.Rating;
            discountPercentageInput.value = product.DiscountPercentage;
            categoryInput.value = product.CategoryID;

            removeMethodField();

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PATCH';
            form.appendChild(methodField);

            $('#productModal').modal('show');
        }

        function removeMethodField() {
            const methodField = document.querySelector('input[name="_method"]');
            if (methodField) {
                methodField.remove();
            }
        }
    </script>
</body>

</html>
