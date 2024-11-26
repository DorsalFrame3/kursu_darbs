<x-app-layout>
    <div class="container mt-5">
        <!-- Welcome Section -->
        <div class="section mb-5">
            <div class="col-md-8">
                <h1 class="header mb-4">Welcome to the One Piece Wiki!</h1>
                <p class="lead mb-4">Embark on an exciting adventure through the world of One Piece! Explore characters, fruits, locations, and more in this interactive collection of all things One Piece.</p>
                <img src="{{ asset('image/one-piece-world.png') }}" class="img-fluid rounded mb-4" alt="One Piece World">
            </div>
        </div>

        <!-- Main Sections -->
        <div class="section">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/characters.png') }}" class="card-img" alt="Characters">
                    <div class="card-body">
                        <h5 class="card-title">Characters</h5>
                        <p class="card-text">Explore the incredible characters of the One Piece universe!</p>
                        <a href="{{ route('characters.index') }}" class="btn btn-primary">Browse Characters</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/fruits.png') }}"class="card-img" alt="Fruits">
                    <div class="card-body">
                        <h5 class="card-title">Fruits</h5>
                        <p class="card-text">Learn about the powerful Devil Fruits in the One Piece world!</p>
                        <a href="{{ route('fruits.index') }}" class="btn btn-primary">Explore Fruits</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/locations.png') }}" class="card-img" alt="Locations">
                    <div class="card-body">
                        <h5 class="card-title">Locations</h5>
                        <p class="card-text">Discover the iconic locations across the One Piece universe!</p>
                        <a href="{{ route('locations.index') }}" class="btn btn-primary">View Locations</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/weapons.png') }}" class="card-img" alt="Weapons">
                    <div class="card-body">
                        <h5 class="card-title">Weapons</h5>
                        <p class="card-text">Discover the legendary weapons from the One Piece universe!</p>
                        <a href="{{ route('weapons.index') }}" class="btn btn-primary">View Weapons</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/organizations.png') }}" class="card-img" alt="Organizations">
                    <div class="card-body">
                        <h5 class="card-title">Organizations</h5>
                        <p class="card-text">Learn about the major organizations and their roles in One Piece!</p>
                        <a href="{{ route('organizations.index') }}" class="btn btn-primary">Explore Organizations</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/races.png') }}" class="card-img" alt="Races">
                    <div class="card-body">
                        <h5 class="card-title">Races</h5>
                        <p class="card-text">Explore the diverse races and their differences in the One Piece world!</p>
                        <a href="{{ route('races.index') }}" class="btn btn-primary">Discover Races</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div class="section mt-5">
            <div class="col-md-8">
                <h2 class="header mb-4">About the Project</h2>
                <p class="lead">This project aims to provide an interactive and visually appealing platform where fans can explore characters, fruits, weapons, locations, organizations, and races from the One Piece universe.</p>
            </div>
        </div>
    </div>
</x-app-layout>

