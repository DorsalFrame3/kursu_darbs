<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Piece Characters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('image/one-piece-background.jpg') }}');
            background-size: cover;
            font-family: 'Treasure Map', sans-serif;
        }
        
        .character-header {
            text-align: center;
            margin-top: 30px;
            font-size: 3rem;
            color: #F7D716;
            text-shadow: 2px 2px 4px #000000;
        }
        .character-table {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .character-actions {
            display: flex;
            justify-content: space-around;
        }
        .create-btn {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="character-header">Characters</h1>
        <div class="text-end create-btn">
            <a href="{{ route('characters.create') }}" class="btn btn-primary">Recruit New Character</a>
        </div>
        <table class="table table-striped character-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Bounty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($characters as $character)
                <tr>
                    <td>{{ $character->id }}</td>
                    <td>{{ $character->name }}</td>
                    <td>{{ $character->bounty }} Berries</td>
                    <td class="character-actions">
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
