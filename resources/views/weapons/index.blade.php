<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Ieroči</h1>
        <div class="text-end create-btn">
            @can('create')
                <a href="{{ route('weapons.create') }}" class="btn btn-primary">Jauns ierocis</a>
            @endcan
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Nosaukums</th>
                    <th>Tips</th>   
                    <th>Darbības</th>
                </tr>
            </thead>
            <tbody>
                @foreach($weapons as $weapon)
                <tr>
                    <td>{{ $weapon->name }}</td>
                    <td>{{ $weapon->type }}</td>
                    <td class="actions">

                        @if(in_array($weapon->id, $favoriteWeaponIds))
                            <form method="POST" action="{{ route('favorites.remove', ['type' => 'weapons', 'id' => $weapon->id]) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-secondary">Noņemt no izlases</button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('favorites.add', ['type' => 'weapons']) }}" style="display:inline;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $weapon->id }}">
                                <button type="submit" class="btn btn-success ">Pievienot izlasē</button>
                            </form>
                        @endif

                        <a href="{{ route('weapons.show', $weapon->id) }}" class="btn btn-info">Detalizēti</a>

                        @can('upd-del-weapon', $weapon)
                            <a href="{{ route('weapons.edit', $weapon->id) }}" class="btn btn-warning">Rediģēt</a>
                            
                            <form action="{{ route('weapons.destroy', $weapon->id) }}" method="POST" style="display:inline;">
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
