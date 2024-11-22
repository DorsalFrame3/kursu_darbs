<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Race Details: {{ $race->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Name:</span> {{ $race->name }}</p>
                        <p><span>Feature:</span> {{ $race->feature }}</p>
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
                    <a href="{{ route('races.index') }}" class="btn btn-primary">Back to the List</a>
                    @can('upd-del-race', $race)
                        <a href="{{ route('races.edit', $race->id) }}" class="btn btn-secondary">Edit Race</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>

