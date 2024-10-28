<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Piece Characters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@include('layouts.navigation')
    <div class="container">
        <h1 class="header">Characters</h1>
        <div class="text-end create-btn">
            <a href="{{ route('characters.create') }}" class="btn btn-primary">New Character</a>
        </div>
        <table class="table table-striped table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Bounty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($characters as $character)
                <tr>
                    <td>{{ $character->name }}</td>
                    <td>{{ $character->bounty }} Berries</td>
                    <td class="actions">
                        <a href="{{ route('characters.show', $character->id) }}" class="btn btn-info">Details</a>
                        <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('characters.destroy', $character->id) }}" method="POST" style="display:inline;">
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
</html>
