<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Profile;
use Illuminate\Http\Request;

class MovieProfilesController extends Controller
{
    private function is_not_null($val)
    {
        return !is_null($val);
    }

    public function store(Movie $movie, Profile $profile)
    {
        if (auth()->user()->isNot($profile->user)) {
            return response(null, 403);
        }

        $this->handleMovieProfile($movie, $profile);


        return redirect($profile->path());
    }

    public function update(Movie $movie, Profile $profile)
    {

        if (auth()->user()->isNot($profile->user)) {
            return response(null, 403);
        }

        $this->handleMovieProfile($movie, $profile);

        return redirect($movie->path());
    }

    public function handleMovieProfile($movie, $profile)
    {
        $attributes = array_filter([
            'watch_list' => request('watch_list'),
            'favorite' => request('favorite'),
            'seen' => request('seen'),
            'rating' => request('rating')
        ], [$this, 'is_not_null']);

        return $movie->profiles()->syncWithoutDetaching([$profile->id => $attributes]);
    }
}
