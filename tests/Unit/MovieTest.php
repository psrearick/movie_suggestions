<?php

namespace Tests\Unit;

use App\Movie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_has_a_path()
    {
        $movie = factory('App\Movie')->create();
        $this->assertEquals('/movies/' . $movie->id, $movie->path());
    }
}
