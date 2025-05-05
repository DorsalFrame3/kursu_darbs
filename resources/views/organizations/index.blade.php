<x-app-layout>
    <body>
    <div class="container">
        <h1 class="header">Organizācijas</h1>
        <div class="text-end create-btn">
            @can('create')
                <a href="{{ route('organizations.create') }}" class="btn btn-primary">Jauna organizācija</a>
            @endcan
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Nosaukums</th>
                    <th>Veids</th>   
                    <th>Darbības</th>
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
                                <button type="submit" class="btn btn-secondary">Noņemt no izlases</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'organizations']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $organization->id }}">
                                <button type="submit" class="btn btn-success ">Pievienot izlasē</button>
                            </form>
                        @endif

                        <a href="{{ route('organizations.show', $organization->id) }}" class="btn btn-info">Detaļas</a>

                        @can('upd-del-organization', $organization)
                            <a href="{{ route('organizations.edit', $organization->id) }}" class="btn btn-warning">Rediģēt</a>

                            <form action="{{ route('organizations.destroy', $organization->id) }}" method="POST" style="display:inline;">
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
