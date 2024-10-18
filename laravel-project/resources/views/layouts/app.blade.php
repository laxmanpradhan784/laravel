<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Ensure body takes at least full height of the viewport */
        }

        .content {
            flex: 1; /* Allow content to grow and take up available space */
        }

        .footer {
            background: #343a40; /* Dark background for footer */
            color: white; /* White text color */
            padding: 20px 0; /* Vertical padding */
            position: relative; /* Ensure footer stays at the bottom */
        }

        .footer a {
            color: white; /* White link color */
            transition: color 0.3s; /* Smooth transition for hover effect */
        }

        .footer a:hover {
            color: #ffc107; /* Change color on hover */
        }

        .list-inline-item {
            margin-right: 15px; /* Space between social icons */
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!-- Navbar -->
        @include('navbar')

        <div class="container content">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container text-center">
                <p class="mb-3">&copy; {{ date('Y') }} Your Company. All Rights Reserved.</p>
                <ul class="list-inline">
                    <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-facebook"></i> Facebook</a></li>
                    <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-twitter"></i> Twitter</a></li>
                    <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-instagram"></i> Instagram</a></li>
                    <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                    <li class="list-inline-item"><a href="#" class="text-white"><i class="fab fa-youtube"></i> YouTube</a></li>
                </ul>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
