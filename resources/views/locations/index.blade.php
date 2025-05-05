<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Atrašanās vietas</h1>
        <div class="text-end create-btn">
            @can('create')    
                <a href="{{ route('locations.create') }}" class="btn btn-primary">Jauna atrašanās vieta</a>
            @endcan
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Nosaukums</th>
                    <th>Reģions</th>   
                    <th>Darbības</th>
                </tr>
            </thead>
            <tbody>
                @foreach($locations as $location)
                <tr>
                    <td>{{ $location->name }}</td>
                    <td>{{ $location->region }}</td>
                    <td class="actions">

                        @if(in_array($location->id, $favoriteLocationIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'locations', 'id' => $location->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Noņemt no izlases</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'locations']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $location->id }}">
                                <button type="submit" class="btn btn-success ">Pievienot izlasē</button>
                            </form>
                        @endif

                        <a href="{{ route('locations.show', $location->id) }}" class="btn btn-info">Detaļas</a>

                        @can('upd-del-location', $location)
                            <a href="{{ route('locations.edit', $location->id) }}" class="btn btn-warning">Rediģēt</a>

                            <form action="{{ route('locations.destroy', $location->id) }}" method="POST" style="display:inline;">
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
