<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Character Details: {{ $character->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Name:</span> {{ $character->name }}</p>
                        <p><span>Bounty:</span> {{ number_format($character->bounty) }} Berries</p>
                        @if ($character->image)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $character->image) }}" alt="{{ $character->name }}" class="character-image">
                            </div>
                        @endif
                    </div>

                    <div class= "details-right">
                        <p><span>Description:</span> {{ $character->description }}</p>
                    </div>
                </div>
                <div class="mt-4 text-center">
                        @if(in_array($character->id, $favoriteCharacterIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'characters', 'id' => $character->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Remove from Favorites</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'characters']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $character->id }}">
                                <button type="submit" class="btn btn-success ">Add to Favorites</button>
                            </form>
                        @endif
                    <a href="{{ route('characters.index') }}" class="btn btn-primary">Back to the List</a>
                    @can('upd-del-character', $character)
                        <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-secondary">Edit Character</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
