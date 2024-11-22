<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Organizations</h1>
        <div class="text-end create-btn">
            @can('create')
                <a href="{{ route('organizations.create') }}" class="btn btn-primary">New Organization</a>
            @endcan
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>   
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($organizations as $organization)
                <tr>
                    <td>{{ $organization->name }}</td>
                    <td>{{ $organization->type }}</td>
                    <td class="actions">

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

                        <a href="{{ route('organizations.show', $organization->id) }}" class="btn btn-info">Details</a>

                        @can('upd-del-organization', $organization)
                            <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Remove</button>
                            </form>
                        @endcan

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</x-app-layout>
