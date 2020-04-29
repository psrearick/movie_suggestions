<?php

namespace Tests\Feature;

use App\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MovieProfilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_profile_can_have_movies()
    {
        $this->withoutExceptionHandling();
        $this->authenticate();

        $profile = factory(Profile::class)->create(['user_id' => auth()->id()]);
        $movie = factory('App\Movie')->create();

        $this->post($movie->path() . '/profiles/' . $profile->id, [
            'favorite' => true
        ]);

        $this->assertEquals(1, $movie->profiles()->find($profile->id)->pivot->favorite);

        $this->assertDatabaseHas('movie_profile', [
            'movie_id' => $movie->id,
            'profile_id' => $profile->id
        ]);
    }

    /** @test */
    public function only_the_owner_of_a_profile_may_add_movies()
    {
        $this->withoutExceptionHandling();
        $this->authenticate();

        $profile = factory(Profile::class)->create();
        $movie = factory('App\Movie')->create();

        $this->post($movie->path() . '/profiles/' . $profile->id, [
            'favorite' => true
        ])->assertStatus(403);

        $this->assertDatabaseMissing('movie_profile', [
            'movie_id' => $movie->id,
            'profile_id' => $profile->id
        ]);
    }

    /** @test */
    public function a_profile_movie_can_be_updated()
    {
        $this->withoutExceptionHandling();
        $this->authenticate();

        $profile = factory(Profile::class)->create(['user_id' => auth()->id()]);
        $movie = factory('App\Movie')->create();

        $this->post($movie->path() . '/profiles/' . $profile->id, [
            'favorite' => true
        ]);

        $this->patch($movie->path() . '/profiles/' . $profile->id, ['favorite' => false]);

        $this->assertDatabaseHas('movie_profile', [
            'movie_id' => $movie->id,
            'profile_id' => $profile->id,
            'favorite' => 0
        ]);
    }
}
