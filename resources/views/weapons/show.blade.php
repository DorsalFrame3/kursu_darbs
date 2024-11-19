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
                    <a href="{{ route('weapons.index') }}" class="btn btn-secondary">Back to the List</a>
                    <a href="{{ route('weapons.edit', $weapon->id) }}" class="btn btn-primary">Edit Weapon</a>
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>