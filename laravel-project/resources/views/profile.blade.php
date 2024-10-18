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

    .card {
        border: none; /* No border */
        border-radius: 15px; /* Rounded corners */
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1); /* Soft shadow */
        background-color: #ffffff; /* White background */
        padding: 20px; /* Padding inside card */
    }

    .card-header {
        background-color: #6a11cb; /* Header color */
        color: white; /* Text color */
        border-radius: 15px 15px 0 0; /* Rounded corners at the top */
    }

    .form-label {
        font-weight: bold; /* Bold labels */
    }

    .btn-primary {
        background-color: #314572; /* Primary button color */
        border: none; /* No border */
        transition: background-color 0.3s; /* Smooth transition */
    }

    .btn-primary:hover {
        background-color: #253a58; /* Darker shade on hover */
    }

    .gender-label {
        margin-right: 20px; /* Space between gender options */
    }

    footer {
        margin-top: 50px; /* Space above footer */
        padding: 20px; /* Padding for footer */
        background-color: #6a11cb; /* Footer background color */
        color: white; /* Footer text color */
        text-align: center; /* Centered text */
    }

    .image-wrapper {
        width: 120px; /* Set desired width */
        height: 120px; /* Set desired height */
        border-radius: 50%; /* Make it round */
        background: linear-gradient(135deg, rgba(106, 17, 203, 0.7), rgba(49, 69, 114, 0.7)); /* Gradient background */
        display: flex; /* Center the image */
        justify-content: center; /* Center horizontally */
        align-items: center; /* Center vertically */
        margin: 0 auto 20px; /* Centered margin below */
    }

    .uploadedAvatar {
        width: 100px; /* Set desired width for the image */
        height: 100px; /* Set desired height for the image */
        border-radius: 50%; /* Make it round */
        object-fit: cover; /* Cover the area without distortion */
    }

    @media (max-width: 576px) {
        .uploadedAvatar {
            width: 80px; /* Responsive size for small screens */
            height: 80px;
        }
    }
</style>

<div class="container">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Personal Information</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="validate-form mt-2 pt-50" id="profileForm" name="profileForm">
                @csrf

                <div class="row">
                    <div class="col-12 mb-1 text-center">
                        <div class="image-wrapper">
                            @if($user->image)
                                <img src="{{ asset('storage/app/public/' . $user->image) }}" alt="Profile Image" class="uploadedAvatar" />
                            @endif
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name', $user->name) }}" required />
                    </div>
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email', $user->email) }}" required />
                    </div>
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="mobile">Mobile Number</label>
                        <input type="tel" class="form-control" id="mobile" name="mobile" placeholder="Phone Number" value="{{ old('mobile', $user->mobile) }}" required />
                    </div>
                    <div class="col-12 col-sm-6 mb-1">
                        <label class="form-label" for="dob">Birth Date</label>
                        <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', $user->dob ? $user->dob->format('Y-m-d') : '') }}" required />
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label">Gender</label><br>
                        <label class="gender-label">
                            <input type="radio" name="gender" value="male" {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }} /> Male
                        </label>
                        <label class="gender-label">
                            <input type="radio" name="gender" value="female" {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }} /> Female
                        </label>
                        <label class="gender-label">
                            <input type="radio" name="gender" value="other" {{ old('gender', $user->gender) == 'other' ? 'checked' : '' }} /> Other
                        </label>
                    </div>

                    <div class="col-12 mb-1">
                        <label class="form-label" for="image">Profile Image (optional)</label>
                        <input type="file" class="form-control-file" id="image" name="image" accept="image/*" />
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-1">Save Changes</button>
                    </div>
                </div>
            </form>

            <div class="text-center mt-3">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-danger">Logout</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
