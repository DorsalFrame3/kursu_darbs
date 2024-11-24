<x-app-layout>
    <div class="container">
        <h1 class="header">Search Results for "{{ $query }}"</h1>

        @if($characters->isEmpty() && $fruits->isEmpty() && $weapons->isEmpty() && $locations->isEmpty() && $organizations->isEmpty() && $races->isEmpty())
            <p class= sub-header>No results found.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Characters -->
                    @foreach($characters as $character)
                        <tr>
                            <td><a href="{{ route('characters.show', $character->id) }}">{{ $character->name }}</a></td>
                            <td>Character</td>
                            <td>
                        </tr>
                    @endforeach

                    <!-- Fruits -->
                    @foreach($fruits as $fruit)
                        <tr>
                            <td><a href="{{ route('fruits.show', $fruit->id) }}">{{ $fruit->name }}</a></td>
                            <td>Fruit</td>
                        </tr>
                    @endforeach

                    <!-- Weapon -->
                    @foreach($weapons as $weapon)
                        <tr>
                            <td><a href="{{ route('weapons.show', $weapon->id) }}">{{ $weapon->name }}</a></td>
                            <td>Weapon</td>
                        </tr>
                    @endforeach

                    <!-- Locations -->
                    @foreach($locations as $location)
                        <tr>
                            <td><a href="{{ route('locations.show', $location->id) }}">{{ $location->name }}</a></td>
                            <td>Location</td>
                        </tr>
                    @endforeach

                    <!-- Organizations -->
                    @foreach($organizations as $organization)
                        <tr>
                            <td><a href="{{ route('organizations.show', $organization->id) }}">{{ $organization->name }}</a></td>
                            <td>Organization</td>
                        </tr>
                    @endforeach

                    <!-- Races -->
                    @foreach($races as $race)
                        <tr>
                            <td><a href="{{ route('races.show', $race->id) }}">{{ $race->name }}</a></td>
                            <td>Race</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
