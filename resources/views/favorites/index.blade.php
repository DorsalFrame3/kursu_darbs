<x-app-layout>
    <body>
        <div class="container">
            <h1 class="header">Izlase</h1>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nosaukums</th>
                        <th>Tips</th>
                        <th>Darbības</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($favorites as $favorite)
                        <tr>
                            <td>{{ $favorite->name }}</td>
                            <td>{{ $favorite->type_lv }}</td>
                            <td class="actions">
                                <a href="{{ url($favorite->type . '/' . $favorite->id) }}" class="btn btn-primary">Informācija</a>

                                <form method="POST" action="{{ route('favorites.remove', ['type' => $favorite->type, 'id' => $favorite->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Noņemt</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </body>
</x-app-layout>
