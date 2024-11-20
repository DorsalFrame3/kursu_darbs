<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Locations</h1>
        <div class="text-end create-btn">
            @can('create')    
                <a href="{{ route('locations.create') }}" class="btn btn-primary">New Location</a>
            @endcan
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Region</th>   
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                <tr>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->region }}</td>
                    <td class="actions">
                        <a href="{{ route('locations.show', $location->id) }}" class="btn btn-info">Details</a>
                        @can('upd-del-location', $location)
                            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline;">
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

