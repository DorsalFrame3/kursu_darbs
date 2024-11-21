<nav class="navbar">
    <div class="nav-container">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" width="70" height="70" class="logo">
            One Piece Wiki
        </a>
        <!-- <div class="navbar-collapse" id="navbarNav"> -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('characters.index') }}">Characters</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('fruits.index') }}">Fruits</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('weapons.index') }}">Weapons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('locations.index') }}">Locations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('organizations.index') }}">Organizations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('races.index') }}">Races</a>
                </li>
            </ul>
            <ul class="navbar-nav navbar-right"> 
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('favorites.index') }}">Favorites</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}" 
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log Out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        <!-- </div> -->
    </div>
</nav>
