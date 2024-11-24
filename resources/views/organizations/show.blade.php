<x-app-layout>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Organization Details: {{ $organization->name }}</h1>

                <div class="details-info d-flex">
                    <div class="details-left">
                        <p><span>Name:</span> {{ $organization->name }}</p>
                        <p><span>Type:</span> {{ $organization->type }}</p>
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
                        @if(in_array($organization->id, $favoriteOrganizationIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'organizations', 'id' => $organization->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Remove from Favorites</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'organizations']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $organization->id }}">
                                <button type="submit" class="btn btn-success ">Add to Favorites</button>
                            </form>
                        @endif

                    <a href="{{ route('organizations.index') }}" class="btn btn-primary">Back to the List</a>
                    
                    @can('upd-del-organization', $organization)
                        <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-secondary">Edit Organization</a>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</body>
</x-app-layout>
