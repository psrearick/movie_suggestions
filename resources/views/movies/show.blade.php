@extends('layouts.app')

@section('content')
<div class="flex">
</div>

<div class="flex">
    <div class="cover">
        <img src="https://via.placeholder.com/340x500">
    </div>

    <div class="movie pl-6">
        <div class="movie-header">
            <div class="mb-5 flex items-center">
                <p class="text-4xl">{{ $movie->title }}</p>
                <p class="ml-2 text-2xl text-gray-500">2020</p>
            </div>
            <div class="w-full my-10">
                @auth
                <div>
                    @if (auth()->user()->profile())
                    <form action="{{
                        $movie->path() . '/profiles/' . auth()->user()->profile()->id
                    }}" method="POST">
                        @method('PATCH')
                        @csrf
                        @if ($movie->profiles()
                        ->where('favorite', true)
                        ->where('profile_id', auth()->user()->profile()->id)->count() > 0)
                        <input type="hidden" value="0" name="favorite" id="favorite">
                        <input class="btn" type="submit" value="Remove from Favorites">
                        @else
                        <input type="hidden" value="1" name="favorite" id="favorite">
                        <input class="btn" type="submit" value="Add to Favorites">
                        @endif
                    </form>
                    @endif
                </div>
                @endauth
                <div>
                    <p>{{ $movie->profiles()->where('favorite', true)->count() }} people have favorited this movie.</p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 my-5">
                <div class="w-1/4 px-3">
                    9/10
                </div>
                <div class="w-3/4 px-3">
                    <label>Rate This Movie</label>
                    <br>
                    <select name="rating" id="movie-rating" class="text-black">
                        <option value="">--Select a Rating--</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </div>
            </div>

        </div>
        <div>
            <span class="block font-bold">Description</span>
            {{ $movie->description }}
        </div>

    </div>
</div>
@endsection
