<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Fruits</h1>
        <div class="text-end create-btn">
            <a href="{{ route('fruits.create') }}" class="btn btn-primary">New Fruit</a>
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
                        <a href="{{ route('fruits.show', $fruit->id) }}" class="btn btn-info">Details</a>
                        <a href="{{ route('fruits.edit', $fruit->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('fruits.destroy', $fruit->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</x-app-layout>