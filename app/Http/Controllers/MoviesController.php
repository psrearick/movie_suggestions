<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        $movieProfiles = $movie->profiles()->get()->map(function ($movieProfile) {
            $movieProfile['watch_list'] = $movieProfile->pivot->watch_list;
            $movieProfile['favorite'] = $movieProfile->pivot->favorite;
            $movieProfile['seen'] = $movieProfile->pivot->seen;
            $movieProfile['rating'] = $movieProfile->pivot->rating;
            return $movieProfile;
        }) ?: null;

        $profile = Auth::check()
            ? Auth::user()->activeProfile()
            : null;

        $thisMovieProfile = '';

        if ($profile) {
            $movieProfileRelationship = $movie->profiles->find($profile->id);
            $thisMovieProfile = $movieProfileRelationship ? $movieProfileRelationship->pivot : '';
        }

        return view('movies.show', compact('movie', 'profile', 'thisMovieProfile', 'movieProfiles'));
    }

    public function store()
    {

        $attributes = request()->validate(['title' => 'required', 'description' => 'required']);

        Movie::create($attributes);

        return redirect('/movies');
    }
}
