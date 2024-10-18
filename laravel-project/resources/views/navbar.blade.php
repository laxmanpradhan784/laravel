<nav class="navbar navbar-expand-lg navbar-light bg-transparent fixed-top">
    <a class="navbar-brand text-dark" href="{{ route('profile') }}">Profile</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('sliders.show') }}">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('products.index') }}">Products</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('cart.view') }}">Cart</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('blogs.index') }}">Blogs</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('contact') }}">Contact</a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="nav-link btn btn-link text-dark">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<style>
    .navbar {
        width: 100%;
        backdrop-filter: blur(10px);
        z-index: 1000;
        transition: background-color 0.3s;
    }

    .navbar.scrolled {
        background-color: rgba(255, 255, 255, 0.8);
    }

    .navbar-nav .nav-link {
        transition: color 0.3s, background-color 0.3s;
        padding: 10px 15px;
        border-radius: 5px;
        color: black;
    }

    .navbar-nav .nav-link:hover {
        color: #ffc107;
        background-color: rgba(255, 255, 255, 0.1);
    }

    .navbar-toggler {
        border-color: rgba(0, 0, 0, 0.5);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3E%3Cpath stroke='rgba(0, 0, 0, 1)' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
</style>

<script>
    // Change navbar background on scroll
    window.onscroll = function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    };
</script>
