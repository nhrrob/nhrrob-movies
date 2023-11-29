<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
</head>
<body>
    <h1>Movies</h1>
    
    @foreach ($movies as $movie)
        <div>
            <h2>{{ $movie->title }}</h2>
            <p>{{ $movie->description }}</p>
            <p>Release Date: {{ $movie->release_date }}</p>
        </div>
    @endforeach
</body>
</html>
