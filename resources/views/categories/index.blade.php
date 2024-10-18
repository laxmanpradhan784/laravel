<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management</title>
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
        <h1 class="mb-4 text-center">Category Management</h1>


        <!-- Navigation Buttons -->
        <div class="text-right mb-3">
            <a href="{{ route('blogs.index') }}" class="btn btn-primary">Go to Blog</a>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Product</a>
            <a href="{{ route('sliders.index') }}" class="btn btn-primary">Go to Slider</a>
        </div>

        <div class="text-right mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#categoryModal" onclick="showCreateForm()">
                <i class="fas fa-plus"></i> Add Category
            </button>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>SR. NO</th>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->CategoryName }}</td>
                    <td>{{ optional($category->parent)->CategoryName }}</td>
                    <td>
                        <button class="btn btn-warning" onclick='showEditForm(@json($category))'>
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('categories.destroy', $category->CategoryID) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Category Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form-title">Add Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="CategoryID" id="category-id">
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
                            <label for="CategoryName">Category Name</label>
                            <input type="text" class="form-control" name="CategoryName" id="CategoryName" required>
                        </div>
                        <div class="form-group">
                            <label for="ParentCategoryID">Parent Category</label>
                            <select class="form-control" name="ParentCategoryID" id="ParentCategoryID">
                                <option value="">None</option>
                                @foreach ($categories as $parentCategory)
                                    <option value="{{ $parentCategory->CategoryID }}">{{ $parentCategory->CategoryName }}</option>
                                @endforeach
                            </select>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const form = document.getElementById('form');
        const formTitle = document.getElementById('form-title');
        const submitBtn = document.getElementById('submit-btn');
        const categoryIdInput = document.getElementById('category-id');
        const categoryNameInput = document.getElementById('CategoryName');
        const parentCategoryIdInput = document.getElementById('ParentCategoryID');

        function showCreateForm() {
            form.reset();
            formTitle.innerText = 'Add Category';
            form.action = "{{ route('categories.store') }}";
            submitBtn.innerText = 'Create';
            removeMethodField();
            $('#categoryModal').modal('show');
        }

        function showEditForm(category) {
            formTitle.innerText = 'Edit Category';
            form.action = "{{ url('categories') }}/" + category.CategoryID;
            submitBtn.innerText = 'Update';

            categoryIdInput.value = category.CategoryID;
            categoryNameInput.value = category.CategoryName;
            parentCategoryIdInput.value = category.ParentCategoryID || '';

            removeMethodField();

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PATCH';
            form.appendChild(methodField);

            $('#categoryModal').modal('show');
        }

        function removeMethodField() {
            const existingMethodField = form.querySelector('input[name="_method"]');
            if (existingMethodField) {
                existingMethodField.remove();
            }
        }
    </script>
</body>

</html>
