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
            background-color: #f8f9fa;
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
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .btn-primary {
            background-color: #314572 !important;
            border-color: #314572 !important;
            color: #fff !important;
        }

        h2 {
            font-size: 1.75rem;
        }

        .form-control.is-invalid {
            border-color: red;
        }

        .invalid-feedback {
            display: block;
            color: red;
            font-size: 0.875rem;
        }

        @media (max-width: 576px) {
            .auth-inner {
                padding: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="auth-wrapper">
        <div class="auth-inner">
            <h2 class="text-center fw-bold mb-3">Welcome to Bull Magneto! 👋 <br>Create Your Account</h2>
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


            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name</label>
                    <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" placeholder="Enter Your Name" value="{{ old('name') }}" />
                    @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" id="email" type="email" name="email" placeholder="Enter Your Email" value="{{ old('email') }}" autofocus />
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input class="form-control @error('mobile') is-invalid @enderror" id="mobile" type="tel" name="mobile" placeholder="Enter Your Mobile Number" value="{{ old('mobile') }}" />
                    @error('mobile')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="dob">Birth Date</label>
                    <input class="form-control @error('dob') is-invalid @enderror" id="dob" type="date" name="dob" value="{{ old('dob') }}" />
                    @error('dob')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Gender</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }} />
                        <label class="form-check-label" for="gender_male">Male</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }} />
                        <label class="form-check-label" for="gender_female">Female</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender_other" value="other" {{ old('gender') == 'other' ? 'checked' : '' }} />
                        <label class="form-check-label" for="gender_other">Other</label>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control @error('password') is-invalid @enderror" id="password" type="password" name="password" placeholder="Password" />
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm Password" />
                    @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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