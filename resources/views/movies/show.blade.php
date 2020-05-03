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
                        <a class="text-red-500 hover:text-red-700 mt-3"
                            onclick="document.getElementById('favorite-form').submit()">
                            <i class="fa fa-heart pr-2"></i>
                            Remove from Favorites</a>
                        @else
                        <input type="hidden" value="1" name="favorite" id="favorite">
                        <a class="text-red-500 hover:text-red-700 mt-3 border-none"
                            onclick="document.getElementById('favorite-form').submit()">
                            <i class="far fa-heart pr-2"></i>
                            Add to Favorites</a>
                        @endif
                    </form>
                    @endif
                </div>
                @endauth
                <div>
                    <p class="text-sm text-gray-600">

                        @if ($movieProfiles->where('favorite', true)->count() == 1)
                        {{ $movieProfiles->where('favorite', true)->count() }} person has favorited this movie.
                        @else
                        {{ $movieProfiles->where('favorite', true)->count() }} people have favorited this movie.
                        @endif
                    </p>
                </div>
            </div>
            <div class="flex flex-wrap -mx-3 my-5 border-solid border-gray-600 border-t border-b">
                <div class="w-1/4 px-3 py-3 border-r border-gray-600 border-solid">
                    <div class="flex">
                        <p class="text-4xl">
                            <i class="fa fa-star text-yellow-500 px-2"></i>
                        </p>
                        <div>
                            <p class="text-sm text-gray-600">
                                <span
                                    class="text-lg text-white">{{ round($movieProfiles->where('rating', '>', 0)->average('rating'), 1) }}</span>
                                <span class="align-top">/10</span>
                            </p>
                            <p class="text-sm text-gray-600">
                                {{ $movieProfiles->where('rating', '>', 0)->count() }} Ratings
                            </p>
                        </div>
                    </div>

                </div>
                @auth
                <div class="w-3/4 px-3 py-3">
                    @if ($profile)
                    <p>Rate This Movie</p>
                    <form id="rating-form" action="{{
                        $movie->path() . '/profiles/' . $profile->id
                    }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <input type="hidden" value="" name="rating" id="rating">
                        @foreach(range(1,10) as $i)
                        <button
                            onclick="document.getElementById('rating').setAttribute('value', {{ $i }}); document.getElementById('rating-form').submit()">
                            @if($thisMovieProfile ? $thisMovieProfile->rating - $i >= 0 : false )
                            <i class="fas fa-star text-xl text-yellow-500 hover:text-yellow-700"></i>
                            @else
                            <i class="far fa-star text-xl text-yellow-500 hover:text-yellow-700"></i>
                            @endif
                        </button>
                        @endforeach

                    </form>
                    @endif
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
