<x-app-layout>
    <div class="container mt-5">
        <!-- Welcome Section -->
        <div class="section mb-5">
            <div class="col-md-8">
                <h1 class="header mb-4">Laipni lūdzam One Piece Wiki!</h1>
                <p class="lead mb-4">Izmēģiniet aizraujošu piedzīvojumu caur One Piece pasauli! Iepazīstieties ar varoņiem, augļiem, vietām un daudz ko citu šajā interaktīvajā kolekcijā par visu, kas saistīts ar One Piece.</p>
                <img src="{{ asset('image/one-piece-world.png') }}" class="img-fluid rounded mb-4" alt="One Piece World">
            </div>
        </div>

        <!-- Main Sections -->
        <div class="section">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/characters.png') }}" class="card-img" alt="Characters">
                    <div class="card-body">
                        <h5 class="card-title">Varoņi</h5>
                        <p class="card-text">Izpētiet One Piece visuma neticamos varoņus!</p>
                        <a href="{{ route('characters.index') }}" class="btn btn-primary">Pārlūkot varoņus</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/fruits.png') }}" class="card-img" alt="Fruits">
                    <div class="card-body">
                        <h5 class="card-title">Augļi</h5>
                        <p class="card-text">Uzziniet par varošo vēlnu augļiem One Piece pasaulē!</p>
                        <a href="{{ route('fruits.index') }}" class="btn btn-primary">Izpētīt augļus</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/locations.png') }}" class="card-img" alt="Locations">
                    <div class="card-body">
                        <h5 class="card-title">Vietas</h5>
                        <p class="card-text">Iepazīstiet ikoniskās vietas One Piece!</p>
                        <a href="{{ route('locations.index') }}" class="btn btn-primary">Skatīt vietas</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="section">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/weapons.png') }}" class="card-img" alt="Weapons">
                    <div class="card-body">
                        <h5 class="card-title">Ieroči</h5>
                        <p class="card-text">Iepazīstiet leģendāros un neaizmirstamos ieročus no One Piece pasaules!</p>
                        <a href="{{ route('weapons.index') }}" class="btn btn-primary">Skatīt ieročus</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/organizations.png') }}" class="card-img" alt="Organizations">
                    <div class="card-body">
                        <h5 class="card-title">Organizācijas</h5>
                        <p class="card-text">Uzziniet par galvenajām organizācijām un to lomām One Piece!</p>
                        <a href="{{ route('organizations.index') }}" class="btn btn-primary">Izpētīt organizācijas</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('image/races.png') }}" class="card-img" alt="Races">
                    <div class="card-body">
                        <h5 class="card-title">Rases</h5>
                        <p class="card-text">Izpētiet dažādās rases un to atšķirības One Piece pasaulē!</p>
                        <a href="{{ route('races.index') }}" class="btn btn-primary">Atklājiet rases</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section -->
        <div class="section mt-5">
            <div class="col-md-8">
                <h2 class="header mb-4">Par projektu</h2>
                <p class="lead">Šis projekts ir paredzēts, lai nodrošinātu interaktīvu un vizuāli pievilcīgu platformu, kur fani var izpētīt varoņus, augļus, ieročus, vietas, organizācijas un rases no One Piece pasaules.</p>
            </div>
        </div>
    </div>
</x-app-layout>
