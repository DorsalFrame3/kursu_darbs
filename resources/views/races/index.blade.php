<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Rases</h1>
        <div class="text-end create-btn">
            @can('create')
                <a href="{{ route('races.create') }}" class="btn btn-primary">Jauna rase</a>
            @endcan
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Nosaukums</th>
                    <th>Īpašības</th>   
                    <th>Darbības</th>
                </tr>
            </thead>
            <tbody>
                @foreach($races as $race)
                <tr>
                    <td>{{ $race->name }}</td>
                    <td>{{ $race->feature }}</td>
                    <td class="actions">
                        @if(in_array($race->id, $favoriteRaceIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'races', 'id' => $race->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Noņemt no izlases</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'races']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $race->id }}">
                                <button type="submit" class="btn btn-success">Pievienot izlasē</button>
                            </form>
                        @endif

                        <a href="{{ route('races.show', $race->id) }}" class="btn btn-info">Detaļas</a>

                        @can('upd-del-race', $race)
                            <a href="{{ route('races.edit', $race->id) }}" class="btn btn-warning">Rediģēt</a>

                            <form action="{{ route('races.destroy', $race->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Noņemt</button>
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
