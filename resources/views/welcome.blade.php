<x-guest-layout>
    <div class="container mt-5">
        <!-- Welcome Section -->
        <div class="section mb-5">
            <div class="col-md-8">
                <h1 class="header mb-4">Welcome to the One Piece Wiki!</h1>
                <img src="{{ asset('image/one-piece-world.png') }}" class="img-fluid rounded mb-4" alt="One Piece World">
                <p class="sub-header mb-4">Please Register or Log In to get started</p>

                <a href="{{ route('login')}}" class="btn btn-primary me-5">Log In</a>
                <a href="{{ route('register')}}" class="btn btn-primary">Register</a>
            </div>
        </div>
    </div>
</x-guest-layout>

