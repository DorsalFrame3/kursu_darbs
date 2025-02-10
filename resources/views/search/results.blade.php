<x-app-layout>
    <div class="container">
        <h1 class="header">Search Results for "{{ $query }}"</h1>

        @if($results->flatten()->isEmpty())
            <p class="sub-header">No results found.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($results as $type => $items)
                        @foreach ($items as $item)
                            <tr>
                                <td><a href="{{ route(strtolower($type) . '.show', $item->id) }}">{{ $item->name }}</a></td>
                                <td>{{ $type }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</x-app-layout>
