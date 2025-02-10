<nav class="navbar">
    <div class="nav-container">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" width="70" height="70" class="logo">
            One Piece Wiki
        </a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('characters.index') ? 'active' : '' }}" href="{{ route('characters.index') }}">Characters</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('fruits.index') ? 'active' : '' }}" href="{{ route('fruits.index') }}">Fruits</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('weapons.index') ? 'active' : '' }}" href="{{ route('weapons.index') }}">Weapons</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('locations.index') ? 'active' : '' }}" href="{{ route('locations.index') }}">Locations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('organizations.index') ? 'active' : '' }}" href="{{ route('organizations.index') }}">Organizations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('races.index') ? 'active' : '' }}" href="{{ route('races.index') }}">Races</a>
            </li>
        </ul>

        <div class= "search">
        <form method="GET" action="{{ route('search') }}" class="d-flex search">
            <input type="text" name="query" placeholder="Search..." value="{{ request('query') }}" class="search-input">
            <button type="submit" style="background: none; border: none; padding: 0;">
                <img src="{{ asset('image/search.png') }}" alt="Submit" width="25" class="search-icon">
            </button>
        </form>
        </div>

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
    </div>
</nav>
