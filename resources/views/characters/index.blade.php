<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Piece Pirates Index</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('image/one-piece-background.jpg') }}');
            background-size: cover;
            font-family: 'Treasure Map', sans-serif;
        }
        .pirate-header {
            text-align: center;
            margin-top: 30px;
            font-size: 3rem;
            color: #F7D716;
            text-shadow: 2px 2px 4px #000000;
        }
        .pirate-table {
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
        }
        .table th, .table td {
            vertical-align: middle;
        }
        .pirate-actions {
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
        <h1 class="pirate-header">Characters</h1>
        <div class="text-end create-btn">
            <a href="{{ route('pirates.create') }}" class="btn btn-primary">Recruit New Pirate</a>
        </div>
        <table class="table table-striped pirate-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Bounty</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pirates as $pirate)
                <tr>
                    <td>{{ $pirate->id }}</td>
                    <td>{{ $pirate->name }}</td>
                    <td>{{ $pirate->role }}</td>
                    <td>{{ $pirate->bounty }} Berries</td>
                    <td class="pirate-actions">
                        <a href="{{ route('pirates.show', $pirate->id) }}" class="btn btn-info">Details</a>
                        <a href="{{ route('pirates.edit', $pirate->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('pirates.destroy', $pirate->id) }}" method="POST" style="display:inline;">
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