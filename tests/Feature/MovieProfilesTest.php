<?php

namespace Tests\Feature;

use App\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfileMoviesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_profile_can_have_movies()
    {
        $this->withoutExceptionHandling();
        $this->authenticate();

        $profile = factory(Profile::class)->create(['user_id' => auth()->id()]);
        $movie = factory('App\Movie')->create();

        $this->post($profile->path() . '/movies', [
            'movie_id' => $movie->id,
            'favorite' => true
        ]);

        $this->assertEquals(1, $profile->movies()->find($movie->id)->pivot->favorite);
    }
}
