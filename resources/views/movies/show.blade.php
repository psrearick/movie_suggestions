@extends('layouts.app')

@section('content')
    <h1>{{ $movie->title }}</h1>
    <div>{{ $movie->description }}</div>
@endsection
