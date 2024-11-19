<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>One Piece Characters</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body class="font-sans antialiased">
        
@include('layouts.navigation')

<!-- Page Heading -->
@isset($header)
    <header>
        <div>
            {{ $header }}
        </div>
    </header>
@endisset

<!-- Page Content -->
<main>
    {{ $slot }}
</main>