<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">location Details: {{ $location->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Name:</span> {{ $location->name }}</p>
                        <p><span>Region:</span> {{ $location->region }}</p>
                        @if ($location->image)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $location->image) }}" alt="{{ $location->name }}" class="location-image">
                            </div>
                        @endif
                    </div>

                    <div class= "details-right">
                        <p><span>Description:</span> {{ $location->description }}</p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                    @if(in_array($location->id, $favoriteLocationIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'locations', 'id' => $location->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Remove from Favorites</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'locations']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $location->id }}">
                                <button type="submit" class="btn btn-success ">Add to Favorites</button>
                            </form>
                        @endif

                    <a href="{{ route('locations.index') }}" class="btn btn-primary">Back to the List</a>
                    
                    @can('upd-del-location', $location)
                        <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-secondary">Edit Location</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
