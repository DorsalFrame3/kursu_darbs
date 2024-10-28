<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Character Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('image/one-piece-background.jpg') }}');
            background-size: cover;
            font-family: 'Treasure Map', sans-serif;
        }
        .character-details-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
        }
        .character-details-title {
            text-align: center;
            color: #F7D716;
            text-shadow: 2px 2px 4px #000000;
        }
        .character-details-info {
            margin-top: 20px;
            font-size: 18px;
            color: #333;
        }
        .character-details-info span {
            font-weight: bold;
        }
       
        .image-container img {
            text-align: center;
            max-width: 100%; /* Ensure the image fits within the container */
            height: auto; /* Maintain aspect ratio */
        }

    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 character-details-container">
                <h1 class="character-details-title">Character Details: {{ $character->name }}</h1>

                <div class="pirate-details-info">
                    <p><span>Name:</span> {{ $character->name }}</p>
                    <p><span>Description:</span> {{ $character->description }}</p>
                    <p><span>Bounty:</span> {{ number_format($character->bounty) }} Berries</p>
                </div>

                <!-- You can optionally add an image of the character if available -->
                @if ($character->image)
                    <div class="image-container">
                    <img src="{{ asset('storage/' . $character->image) }}" alt="{{ $character->name }}" class="character-image">
                    </div>
                @endif
                <div class="mt-4 text-center">
                    <a href="{{ route('characters.index') }}" class="btn btn-secondary">Back to Crew List</a>
                    <a href="{{ route('characters.edit', $character->id) }}" class="btn btn-primary">Edit character</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
