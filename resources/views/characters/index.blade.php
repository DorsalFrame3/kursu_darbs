<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Characters</h1>
        <div class="text-end create-btn">
            @can('create')
                <a href="{{ route('characters.create') }}" class="btn btn-primary">New Character</a>
            @endcan
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Bounty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($characters as $character)
                <tr>
                    <td>{{ $character->name }}</td>
                    <td>{{ $character->bounty }} Berries</td>
                    <td class="actions">
     
                        @if(in_array($character->id, $favoriteCharacterIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'characters', 'id' => $character->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Remove from Favorites</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'characters']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $character->id }}">
                                <button type="submit" class="btn btn-success ">Add to Favorites</button>
                            </form>
                        @endif

                        <a href="{{ route('characters.show', $character->id) }}" class="btn btn-info">Details</a>

                        @can('upd-del-character', $character)
                            <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-warning">Edit</a>

                            <form action="{{ route('characters.destroy', $character->id) }}" method="POST" style="display:inline;">
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
