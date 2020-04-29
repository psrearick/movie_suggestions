@extends('layouts.account')

@section('account-content')
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
    <input type="submit">
</form>
<a href="/profiles"><button>Cancel</button></a>
@endsection
