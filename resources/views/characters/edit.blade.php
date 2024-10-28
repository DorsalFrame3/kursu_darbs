<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Character Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('image/one-piece-background.jpg') }}');
            background-size: cover;
            font-family: 'Treasure Map', sans-serif;
        }
        .form-container {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 30px;
            margin-top: 50px;
        }
        .form-title {
            text-align: center;
            color: #F7D716;
            text-shadow: 2px 2px 4px #000000;
        }
        .form-btn {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 form-container">
                <h1 class="form-title">Edit characters Details</h1>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('characters.update', $character->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 

                    <div class="mb-3">
                        <label for="name" class="form-label">Characters Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $character->name) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description" id="description">{{$character->description}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="bounty" class="form-label">Bounty (in Berries)</label>
                        <input type="number" class="form-control" id="bounty" name="bounty" value="{{ old('bounty', $character->bounty) }}" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary form-btn">Update Characters</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

