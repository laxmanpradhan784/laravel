<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slider Management</title>
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
        <h1 class="mb-4 text-center">Slider Management</h1>

        <!-- Navigation Buttons -->
        <div class="text-right mb-3">
            <a href="{{ route('blogs.index') }}" class="btn btn-primary">Go to Blog</a>
            <a href="{{ route('products.index') }}" class="btn btn-primary">Go to Product</a>
            <a href="{{ route('categories.index') }}" class="btn btn-primary">Go to Category</a>
        </div>

        <div class="text-right mb-3">
            <button class="btn btn-primary" data-toggle="modal" data-target="#sliderModal" onclick="showCreateForm()">
                <i class="fas fa-plus"></i> Add Slider
            </button>
        </div>

        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>SR. NO</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sliders as $index => $slider)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $slider->title }}</td>
                    <td>
                        <img src="{{ asset('storage/app/public/' . $slider->image) }}" alt="{{ $slider->title }}" width="100" class="img-fluid rounded">
                    </td>
                    <td>
                        <button class="btn btn-warning" onclick='showEditForm(@json($slider))'>
                            <i class="fas fa-edit"></i> Edit
                        </button>
                        <form action="{{ route('sliders.destroy', $slider->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                        <form action="{{ route('sliders.toggleStatus', $slider->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn {{ $slider->status === 'active' ? 'btn-secondary' : 'btn-success' }}">
                                {{ $slider->status === 'active' ? 'Deactivate' : 'Activate' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Slider Modal -->
    <div class="modal fade" id="sliderModal" tabindex="-1" role="dialog" aria-labelledby="sliderModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="form-title">Add Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="form" action="{{ route('sliders.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="slider-id">
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
                            <label for="title">Title</label>
                            <input type="text" class="form-control" name="title" id="title">
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" class="form-control" name="image" id="image">
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" name="status" id="status">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
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
        const sliderIdInput = document.getElementById('slider-id');
        const titleInput = document.getElementById('title');
        const statusInput = document.getElementById('status');

        function showCreateForm() {
            form.reset();
            formTitle.innerText = 'Add Slider';
            form.action = "{{ route('sliders.store') }}";
            submitBtn.innerText = 'Create';
            removeMethodField();
            $('#sliderModal').modal('show');
        }

        function showEditForm(slider) {
            formTitle.innerText = 'Edit Slider';
            form.action = "{{ url('sliders') }}/" + slider.id;
            submitBtn.innerText = 'Update';

            sliderIdInput.value = slider.id;
            titleInput.value = slider.title;
            statusInput.value = slider.status;

            removeMethodField();

            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'PATCH';
            form.appendChild(methodField);

            $('#sliderModal').modal('show');
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