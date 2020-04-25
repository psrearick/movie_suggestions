<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies App</title>
</head>
<body>
    <h1>Profile</h1>

    <ul>
        @forelse ($profiles as $profile)
            <li>
                <a href="{{ $profile->path() }}">{{ $profile->profile_name }}</a>
            </li>

               @empty

               <p>No Profiles Yet</p>
        @endforelse
    </ul>
</body>
</html>
