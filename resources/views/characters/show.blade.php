<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
@include('layouts.navigation')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 details-container">
                <h1 class="details-title">Character Details: {{ $character->name }}</h1>

                <div class="details-info">
                    <p><span>Name:</span> {{ $character->name }}</p>
                    <p><span>Description:</span> {{ $character->description }}</p>
                    <p><span>Bounty:</span> {{ number_format($character->bounty) }} Berries</p>
                </div>

                @if ($character->image)
                    <div class="image-container">
                    <img src="{{ asset('storage/' . $character->image) }}" alt="{{ $character->name }}" class="character-image">
                    </div>+
                @endif
                <div class="mt-4 text-center">
                    <a href="{{ route('characters.index') }}" class="btn btn-secondary">Back to the List</a>
                    <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-primary">Edit Character</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
