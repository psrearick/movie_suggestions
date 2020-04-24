<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{
    public function index()
    {
        $movies = Movie::all();

        return view('movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function store()
    {

        $attributes = request()->validate(['title' => 'required', 'description' => 'required']);

        Movie::create($attributes);

        return redirect('/movies');
    }
}
