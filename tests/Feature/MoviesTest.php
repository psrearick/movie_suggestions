<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MoviesTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_create_a_movie()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph
        ];
        $this->post('/movies', $attributes)->assertRedirect('/movies');
        $this->assertDatabaseHas('movies', $attributes);

        $this->get('/movies')->assertSee($attributes['title']);
    }

    public function test_a_user_can_view_a_movie()
    {
        $this->authenticate();
        $this->withoutExceptionHandling();
        $movie = factory('App\Movie')->create();

        $this->get($movie->path())
            ->assertSee($movie->title)
            ->assertSee($movie->description);
    }

    public function test_a_movie_requires_a_title()
    {
        $attributes = factory('App\Movie')->raw(['title' => '']);
        $this->post('/movies', $attributes)->assertSessionHasErrors('title');
    }

    public function test_a_movie_requires_a_description()
    {
        $attributes = factory('App\Movie')->raw(['description' => '']);
        $this->post('/movies', $attributes)->assertSessionHasErrors('description');
    }
}
