<x-guest-layout>
    <div class="container mt-5">
        <!-- Welcome Section -->
        <div class="section mb-5">
            <div class="col-md-8">
                <h1 class="header mb-4">Laipni lūdzam One Piece Wiki!</h1>
                <img src="{{ asset('image/one-piece-world.png') }}" class="img-fluid rounded mb-4" alt="One Piece World">
                <p class="sub-header mb-4">Lūdzu, reģistrējieties vai piesakieties, lai uzsāktu</p>

                <a href="{{ route('login')}}" class="btn btn-primary me-5">Pieslēgties</a>
                <a href="{{ route('register')}}" class="btn btn-primary">Reģistrēties</a>
            </div>
        </div>
    </div>
</x-guest-layout>
