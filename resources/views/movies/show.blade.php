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
            <div class="mb-5">
                <p class="text-4xl">{{ $movie->title }}
                    <span class="ml-2 text-2xl text-gray-700 font-thin">2020</span>
                </p>
            </div>
            <div class="w-full my-10">
                @auth
                <div>
                    @if ($profile)
                    <form action="{{
                        $movie->path() . '/profiles/' . $profile->id
                    }}" method="POST" id="favorite-form">
                        @method('PATCH')
                        @csrf
                        @if ($thisMovieProfile && $thisMovieProfile->favorite > 0)
                        <input type="hidden" value="0" name="favorite" id="favorite">
                        <a class="btn-outline my-3" onclick="document.getElementById('favorite-form').submit()">
                            <i class="fa fa-heart"></i>
                            Remove from Favorites</a>
                        @else
                        <input type="hidden" value="1" name="favorite" id="favorite">
                        <a class="btn-outline my-3" onclick="document.getElementById('favorite-form').submit()">
                            <i class="far fa-heart"></i>
                            Add to Favorites</a>
                        @endif
                    </form>
                    @endif
                </div>
                @endauth
                <div>
                    <p>

                        @if ($movieProfiles->where('favorite', true)->count() == 1)
                        {{ $movieProfiles->where('favorite', true)->count() }} person has favorited this movie.
                        @else
                        {{ $movieProfiles->where('favorite', true)->count() }} people have favorited this movie.
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 my-5">
                <div class="w-1/4 px-3">
                    <p class="text-lg">9/10<i class="fa fa-star text-yellow-500 pl-1"></i></p>

                </div>
                @auth
                <div class="w-3/4 px-3">
                    <label>Rate This Movie</label>
                    <br>
                    <i class="far fa-star"></i>
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
                @endauth
            </div>

        </div>
        <div>
            <span class="block font-bold">Description</span>
            {{ $movie->description }}
        </div>

    </div>
</div>
@endsection
