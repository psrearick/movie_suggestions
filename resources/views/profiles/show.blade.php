@extends('layouts.app')

@section('content')
    <h1>{{ $profile->profile_name }}</h1>
    <div>{{ $profile->first_name }}</div>
    <div>{{ $profile->last_name }}</div>
    <div>{{ $profile->date_of_birth }}</div>

    <a href="/profiles">Go Back</a>
@endsection
