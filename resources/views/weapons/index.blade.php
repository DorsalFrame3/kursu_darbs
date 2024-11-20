<x-app-layout>
<body>
    <div class="container">
        <h1 class="header">Weapons</h1>
        <div class="text-end create-btn">
            @can('create')
                <a href="{{ route('weapons.create') }}" class="btn btn-primary">New Weapon</a>
            @endcan
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Type</th>   
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($weapons as $weapon)
                <tr>
                    <td>{{ $weapon->name }}</td>
                    <td>{{ $weapon->type }}</td>
                    <td class="actions">
                        <a href="{{ route('weapons.show', $weapon->id) }}" class="btn btn-info">Details</a>
                        @can('upd-del-weapon', $weapon)
                            <a href="{{ route('weapons.edit', $weapon->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('weapons.destroy', $weapon->id) }}" method="POST" style="display:inline;">
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
