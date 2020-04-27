<?php

namespace App\Http\Controllers;

use App\Profile;
use Illuminate\Http\Request;

class MovieProfilesController extends Controller
{
    public function store(Profile $profile, Request $request)
    {
        $profile->addMovie(
            $request->movie_id,
            [
                'rating' => $request->rating,
                'watch_list' => $request->watch_list,
                'favorite' => $request->favorite,
                'seen' => $request->seen
            ]
        );

        return redirect($profile->path());
    }
}
