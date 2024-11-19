<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Race Details: {{ $race->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Name:</span> {{ $race->name }}</p>
                        @if ($race->image)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $race->image) }}" alt="{{ $race->name }}" class="race-image">
                            </div>
                        @endif
                    </div>

                    <div class= "details-right">
                        <p><span>Description:</span> {{ $race->description }}</p>
                    </div>
                </div>

                
                <div class="mt-4 text-center">
                    <a href="{{ route('races.index') }}" class="btn btn-secondary">Back to the List</a>
                    <a href="{{ route('races.edit', $race->id) }}" class="btn btn-primary">Edit Race</a>
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>

