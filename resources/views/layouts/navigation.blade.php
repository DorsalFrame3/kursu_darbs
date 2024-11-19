<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/dashboard') }}">
            <img src="{{ asset('image/logo.png') }}" alt="Logo" width="30" height="30" class="d-inline-block align-text-top">
            One Piece Wiki
        </a>
        <div class="collapse navbar-collapse  " id="navbarNav">
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
            </ul>
            <ul class="navbar-nav ms-auto"> 
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
    </div>
</nav>
