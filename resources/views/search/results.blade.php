<x-app-layout>
    <div class="container">
        <h1 class="header">Meklēšanas rezultāti "{{ $query }}"</h1>

        @if($results->isEmpty())
            <p class="sub-header">Nav atrasti rezultāti.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nosaukums</th>
                        <th>Tips</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $type => $data)
                        @foreach ($data['items'] as $item)
                            <tr>
                                <td>
                                    <a href="{{ route($data['route'] . '.show', $item->id) }}">
                                        {{ $item->name }}
                                    </a>
                                </td>
                                <td>{{ $type }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>