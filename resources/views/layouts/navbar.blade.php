<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand me-5" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav me-auto">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
                <a class="nav-link" href="#">Features</a>
                {{-- <a class="nav-link" href="#">Pricing</a>
                <a class="nav-link disabled" aria-disabled="true">Disabled</a> --}}
            </div>
            <div class="navbar-nav">
                @if (auth()->user())
                    <a href="{{ route('login') }}" class="nav-link">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="nav-link">Login</a>
                @endif
                <span class="d-none d-lg-block nav-link">|</span>
                <a href="{{ route('register') }}" class="nav-link">Register</a>
            </div>
        </div>
    </div>
</nav>
