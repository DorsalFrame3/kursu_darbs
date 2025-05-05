<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Varoņi</h1>
        <div class="text-end create-btn">
            @can('create')
                <a href="{{ route('characters.create') }}" class="btn btn-primary">Pievienot varoni</a>
            @endcan
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Vārds</th>
                    <th>Balva</th>
                    <th>Darbības</th>
                </tr>
            </thead>
            <tbody>
                @foreach($characters as $character)
                <tr>
                    <td>{{ $character->name }}</td>
                    <td>{{ $character->bounty }} Berriji</td>
                    <td class="actions">

                        @if(in_array($character->id, $favoriteCharacterIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'characters', 'id' => $character->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Noņemt no izlases</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'characters']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $character->id }}">
                                <button type="submit" class="btn btn-success">Pievienot izlasē</button>
                            </form>
                        @endif

                        <a href="{{ route('characters.show', $character->id) }}" class="btn btn-info">Detalizēti</a>

                        @can('upd-del-character', $character)
                            <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-warning">Rediģēt</a>

                            <form action="{{ route('characters.destroy', $character->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Dzēst</button>
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
