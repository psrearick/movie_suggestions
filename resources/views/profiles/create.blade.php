<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create a Profile</title>
</head>
<body>
    <h1>Create a Profile</h1>

    <form method="POST" action="/profiles">
        @csrf
        <input type="text" name="profile_name" id="profile_name" placeholder="Profile Name">
        <br>
        <input type="text" name="first_name" id="first_name" placeholder="First Name">
        <br>
        <input type="text" name="last_name" id="last_name" placeholder="Last Name">
        <br>
        <input type="date" name="date_of_birth" id="date_of_birth">
        <br>
        <input type="submit" value="submit">
    </form>

</body>
</html>
