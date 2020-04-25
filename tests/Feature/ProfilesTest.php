<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilesTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_a_user_can_create_a_profile()
    {
        $this->withoutExceptionHandling();
        $attributes = [
            'profile_name' => $this->faker->word,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date
        ];
        $this->post('/profiles', $attributes)->assertRedirect('/profiles');
        $this->assertDatabaseHas('profiles', $attributes);

        $this->get('/profiles')->assertSee($attributes['profile_name']);
    }

    public function test_a_user_can_view_a_profile()
    {
        $this->withoutExceptionHandling();
        $profile = factory('App\Profile')->create();

        $this->get($profile->path())
            ->assertSee($profile->first_name)
            ->assertSee($profile->last_name);
    }

    public function test_a_movie_requires_a_profile_name()
    {
        $attributes = factory('App\Profile')->raw(['profile_name' => '']);
        $this->post('/profiles', $attributes)->assertSessionHasErrors('profile_name');
    }

    public function test_a_movie_requires_a_first_name()
    {
        $attributes = factory('App\Profile')->raw(['first_name' => '']);
        $this->post('/profiles', $attributes)->assertSessionHasErrors('first_name');
    }

    public function test_a_movie_requires_a_last_name()
    {
        $attributes = factory('App\Profile')->raw(['last_name' => '']);
        $this->post('/profiles', $attributes)->assertSessionHasErrors('last_name');
    }

    public function test_a_movie_requires_a_date_of_birth()
    {
        $attributes = factory('App\Profile')->raw(['date_of_birth' => '']);
        $this->post('/profiles', $attributes)->assertSessionHasErrors('date_of_birth');
    }
}
