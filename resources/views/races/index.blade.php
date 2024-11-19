<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Races</h1>
        <div class="text-end create-btn">
            <a href="{{ route('races.create') }}" class="btn btn-primary">New Race</a>
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Name</th>   
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($races as $race)
                <tr>
                    <td>{{ $race->name }}</td>
                    <td class="actions">
                        <a href="{{ route('races.show', $race->id) }}" class="btn btn-info">Details</a>
                        <a href="{{ route('races.edit', $race->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('races.destroy', $race->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</x-app-layout>
