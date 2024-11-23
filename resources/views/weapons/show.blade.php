<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Weapon Details: {{ $weapon->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Name:</span> {{ $weapon->name }}</p>
                        <p><span>Type:</span> {{ $weapon->type }}</p>
                        @if ($weapon->image)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $weapon->image) }}" alt="{{ $weapon->name }}" class="weapon-image">
                            </div>
                        @endif
                    </div>

                    <div class= "details-right">
                        <p><span>Description:</span> {{ $weapon->description }}</p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                @if(in_array($race->id, $favoriteRaceIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'races', 'id' => $race->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Remove from Favorites</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'races']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $race->id }}">
                                <button type="submit" class="btn btn-success ">Add to Favorites</button>
                            </form>
                        @endif

                    <a href="{{ route('weapons.index') }}" class="btn btn-primary">Back to the List</a>
                    
                    @can('upd-del-weapon', $weapon)
                        <a href="{{ route('weapons.edit', $weapon->id) }}" class="btn btn-secondary">Edit Weapon</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>