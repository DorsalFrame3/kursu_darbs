<!DOCTYPE html>
<html lang="lvap">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Piece Wiki</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="icon" href="favicon.ico" type="image/png">
</head>
    <main>
        {{ $slot }}
    </main>
    @include('layouts.footer')
</html>
