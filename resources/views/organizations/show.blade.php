<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Organization Details: {{ $organization->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Name:</span> {{ $organization->name }}</p>
                        @if ($organization->image)
                            <div class="image-container">
                                <img src="{{ asset('storage/' . $organization->image) }}" alt="{{ $organization->name }}" class="organization-image">
                            </div>
                        @endif
                    </div>

                    <div class= "details-right">
                        <p><span>Description:</span> {{ $organization->description }}</p>
                    </div>
                </div>

                
                <div class="mt-4 text-center">
                    <a href="{{ route('organizations.index') }}" class="btn btn-secondary">Back to the List</a>
                    <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-primary">Edit Organization</a>
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
