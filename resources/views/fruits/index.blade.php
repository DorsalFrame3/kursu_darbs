<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Fruits</h1>
        <div class="text-end create-btn">
            @can('create')
                <a href="{{ route('fruits.create') }}" class="btn btn-primary">New Fruit</a>
            @endcan
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Power</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fruits as $fruit)
                <tr>
                    <td>{{ $fruit->name }}</td>
                    <td>{{ $fruit->type }}</td>
                    <td>{{ $fruit->power }}</td>
                    <td class="actions">
                        
                        @if(in_array($fruit->id, $favoriteFruitIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'fruits', 'id' => $fruit->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Remove from Favorites</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'fruits']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $fruit->id }}">
                                <button type="submit" class="btn btn-success ">Add to Favorites</button>
                            </form>
                        @endif

                        <a href="{{ route('fruits.show', $fruit->id) }}" class="btn btn-info">Details</a>

                        @can('upd-del-fruit', $fruit)
                            <a href="{{ route('fruits.edit', $fruit->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('fruits.destroy', $fruit->id) }}" method="POST" style="display:inline;">
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