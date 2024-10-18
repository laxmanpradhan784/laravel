<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bull Magneto - Register Page</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Montserrat', sans-serif;
            overflow-x: hidden;
        }

        .auth-wrapper {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .auth-inner {
            max-width: 600px;
            width: 100%;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            transform: translateY(-30px);
            opacity: 0;
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .auth-inner.show {
            transform: translateY(0);
            opacity: 1;
        }

        .btn-primary {
            background-color: #2e5c95 !important;
            border-color: #2e5c95 !important;
            color: #fff !important;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #1d3a69 !important;
            border-color: #1d3a69 !important;
        }

        h2 {
            font-size: 1.75rem;
            color: #2e5c95;
        }

        .alert {
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        @media (min-width: 768px) {
            .auth-wrapper {
                flex-direction: row;
            }

            .auth-inner {
                margin-left: 20px;
            }

            .img-fluid {
                display: block;
                width: 50%;
            }
        }

        @media (max-width: 576px) {
            .auth-inner {
                padding: 20px;
            }
        }

        @media (max-width: 400px) {
            .auth-inner {
                padding: 15px;
            }

            h2 {
                font-size: 1.5rem;
            }

            .form-group label {
                font-size: 0.9rem;
            }

            .form-control {
                font-size: 0.9rem;
            }

            .btn-primary {
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <img class="img-fluid" src="http://localhost/public_html/admin/app-assets/images/pages/login-v2.svg" alt="Register Image" />
        <div class="auth-inner" id="registerForm">
            <h2 class="text-center fw-bold mb-4">Welcome to Bull Magneto! 👋 <br>Create Your Account</h2>
            <p class="text-center mb-4">Please fill in the details to register</p>

            @if ($errors->any())
                <div class="alert alert-danger text-left">
                    <strong>There were some problems with your registration:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" type="text" name="name" placeholder="Enter Your Name" value="{{ old('name') }}" required />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input class="form-control" id="email" type="email" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" required autofocus />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="mobile">Mobile Number</label>
                        <input class="form-control" id="mobile" type="tel" name="mobile" placeholder="Enter Your Mobile Number" value="{{ old('mobile') }}" required />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="dob">Birth Date</label>
                        <input class="form-control" id="dob" type="date" name="dob" value="{{ old('dob') }}" required />
                    </div>
                </div>
                <div class="form-group">
                    <label>Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} required />
                        <label class="form-check-label" for="gender_male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} required />
                        <label class="form-check-label" for="gender_female">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_other" value="other" {{ old('gender') == 'other' ? 'checked' : '' }} required />
                        <label class="form-check-label" for="gender_other">Other</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="password">Password</label>
                        <input class="form-control" id="password" type="password" name="password" placeholder="Password" required />
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input class="form-control" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" required />
                    </div>
                </div>
                <div class="form-group">
                    <label for="image">Profile Image (optional)</label>
                    <input class="form-control-file" id="image" type="file" name="image" accept="image/*" />
                </div>
                <button class="btn btn-primary w-100">Register</button>
            </form>

            <div class="text-center mt-3">
                <p>Already have an account? <a href="{{ route('login') }}" class="btn btn-link">Login here</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#registerForm').addClass('show'); // Trigger the sliding animation on page load
        });
    </script>
</body>

</html>
