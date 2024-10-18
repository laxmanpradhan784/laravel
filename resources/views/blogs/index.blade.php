<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Management</title>
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
        <h1 class="mb-4 text-center">Blog Management</h1>

        <!-- Navigation Buttons -->
        <div class="text-right mb-3">
            <a href="{{ route('sliders.index') }}" class="btn btn-primary">Go to Slider</a>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Product</a>
            <a href="{{ route('categories.index') }}" class="btn btn-primary">Go to Category</a>
        </div>

        <div class="text-right mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#blogModal" onclick="showCreateForm()">
                <i class="fas fa-plus"></i> Add Blog
            </button>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>SR. NO</th>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $index => $blog)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->author }}</td>
                        <td>{{ ucfirst($blog->status) }}</td>
                        <td>
                            @if ($blog->image)
                                <img src="{{ asset('storage/app/public/' . $blog->image) }}" alt="{{ $blog->title }}" width="50">
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-warning" onclick='showEditForm(@json($blog))'>
                                <i class="fas fa-edit"></i> Edit
                            </button>
                            <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                            <form action="{{ route('blogs.toggleStatus', $blog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn {{ $blog->status === 'published' ? 'btn-secondary' : 'btn-success' }}">
                                    {{ $blog->status === 'published' ? 'Set as Draft' : 'Publish' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Blog Modal -->
    <div class="modal fade" id="blogModal" tabindex="-1" role="dialog" aria-labelledby="blogModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form-title">Add Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="blog-id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title" required>
                        </div>
                        <div class="form-group">
                            <label for="author">Author</label>
                            <input type="text" class="form-control" name="author" id="author" required>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="form-group">
                            <label for="content">Content</label>
                            <textarea class="form-control" name="content" id="content" rows="5" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status" required>
                                <option value="published">Published</option>
                                <option value="draft">Draft</option>
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

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        const form = document.getElementById('form');
        const formTitle = document.getElementById('form-title');
        const submitBtn = document.getElementById('submit-btn');
        const blogIdInput = document.getElementById('blog-id');
        const titleInput = document.getElementById('title');
        const authorInput = document.getElementById('author');
        const contentInput = document.getElementById('content');
        const statusInput = document.getElementById('status');

        function showCreateForm() {
            form.reset();
            formTitle.innerText = 'Add Blog';
            form.action = "{{ route('blogs.store') }}";
            submitBtn.innerText = 'Create';
            removeMethodField();
            $('#blogModal').modal('show');
        }

        function showEditForm(blog) {
            formTitle.innerText = 'Edit Blog';
            form.action = "{{ url('blogs') }}/" + blog.id;
            submitBtn.innerText = 'Update';

            blogIdInput.value = blog.id;
            titleInput.value = blog.title;
            authorInput.value = blog.author;
            contentInput.value = blog.content;
            statusInput.value = blog.status;

            removeMethodField();

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PATCH';
            form.appendChild(methodField);

            $('#blogModal').modal('show');
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
