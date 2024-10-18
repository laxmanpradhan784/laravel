<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bull Magneto - Login Page</title>
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
        <img class="img-fluid" src="{{ asset('http://localhost/public_html/admin/app-assets/images/pages/login-v2.svg') }}" alt="Login Image" />
        <div class="auth-inner" id="loginForm">
            <h2 class="text-center fw-bold mb-4">Welcome Back to Bull Magneto! 👋 <br>Log In to Your Account</h2>
            <p class="text-center mb-4">Please enter your credentials to continue</p>

            @if ($errors->any())
                <div class="alert alert-danger text-left">
                    <strong>There were some problems with your login:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" id="email" type="email" name="email" placeholder="Enter Your Email" required autofocus />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input class="form-control" id="password" type="password" name="password" placeholder="Password" required />
                </div>
                <button class="btn btn-primary w-100">Login</button>
            </form>

            <div class="text-center mt-3">
                <p>Don't have an account? <a href="{{ route('register') }}" class="btn btn-link">Register here</a></p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('#loginForm').addClass('show'); // Trigger the sliding animation on page load
        });
    </script>
</body>

</html>