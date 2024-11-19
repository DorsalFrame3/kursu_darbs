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
                    <a href="{{ route('characters.index') }}" class="btn btn-secondary">Back to the List</a>
                    <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-primary">Edit Character</a>
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
