<x-app-layout>
    <body>
        <div class="container">
            <h1 class="header">Favorites</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($favorites as $favorite)
                        <tr>
                            <td>{{ $favorite->name }}</td>
                            <td>{{ ucfirst($favorite->type) }}</td>
                            <td class="actions">
                                
                                <a href="{{ url($favorite->type . '/' . $favorite->id) }}" class="btn btn-primary">Details</a>

                                <form method="POST" action="{{ route('favorites.remove', ['type' => $favorite->type, 'id' => $favorite->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</x-app-layout>

