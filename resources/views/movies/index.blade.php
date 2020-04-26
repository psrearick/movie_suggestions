@extends('layouts.app')

@section('content')
    <h1 style="margin-right:auto;">Movies App</h1>

    <ul>
        @forelse ($movies as $movie)
            <li>
                <a href="{{ $movie->path() }}">{{ $movie->title }}</a>
            </li>

               @empty

               <p>No Movies Yet</p>
        @endforelse
    </ul>
@endsection
