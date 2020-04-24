<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies App</title>
</head>
<body>
    <h1>Movies App</h1>

    <ul>
        @forelse ($movies as $movie)
            <li>
                <a href="{{ $movie->path() }}">{{ $movie->title }}</a>
            </li>

               @empty

               <p>No Movies Yet</p>
        @endforelse
    </ul>
</body>
</html>
