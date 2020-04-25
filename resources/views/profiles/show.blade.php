
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movies App</title>
</head>
<body>
    <h1>{{ $profile->profile_name }}</h1>
    <div>{{ $profile->first_name }}</div>
    <div>{{ $profile->last_name }}</div>
    <div>{{ $profile->date_of_birth }}</div>
</body>
</html>
