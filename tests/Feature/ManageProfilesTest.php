<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProfilesTest extends TestCase
{

    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_profile()
    {
        $this->withoutExceptionHandling();
        $this->authenticate();
        $attributes = [
            'profile_name' => $this->faker->word,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
        ];
        $this->post('/profiles', $attributes)->assertRedirect('/profiles');
        $this->assertDatabaseHas('profiles', $attributes);

        $this->get('/profiles')->assertSee($attributes['profile_name']);
    }

    /** @test */
    public function a_user_can_view_their_profile()
    {
        $this->authenticate();
        $this->withoutExceptionHandling();
        $profile = factory('App\Profile')->create(['user_id' => auth()->id()]);

        $this->get($profile->path())
            ->assertSee($profile->first_name)
            ->assertSee($profile->last_name);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_profiles_of_others()
    {
        $this->authenticate();
        $profile = factory('App\Profile')->create();
        $this->get($profile->path())->assertStatus(403);
    }

    /** @test */
    public function a_profile_requires_a_profile_name()
    {
        $this->authenticate();
        $attributes = factory('App\Profile')->raw(['profile_name' => '']);
        $this->post('/profiles', $attributes)->assertSessionHasErrors('profile_name');
    }

    /** @test */
    public function a_profile_requires_a_first_name()
    {
        $this->authenticate();
        $attributes = factory('App\Profile')->raw(['first_name' => '']);
        $this->post('/profiles', $attributes)->assertSessionHasErrors('first_name');
    }

    /** @test */
    public function a_profile_requires_a_last_name()
    {
        $this->authenticate();
        $attributes = factory('App\Profile')->raw(['last_name' => '']);
        $this->post('/profiles', $attributes)->assertSessionHasErrors('last_name');
    }

    /** @test */
    public function a_profile_requires_a_date_of_birth()
    {
        $this->authenticate();
        $attributes = factory('App\Profile')->raw(['date_of_birth' => '']);
        $this->post('/profiles', $attributes)->assertSessionHasErrors('date_of_birth');
    }

    /** @test */
    public function guests_cannot_view_create_profiles_page()
    {
        $attributes = factory('App\Profile')->raw();
        $this->get('/profiles/create')->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_create_profiles()
    {
        $attributes = factory('App\Profile')->raw();
        $this->post('/profiles', $attributes)->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_a_single_profile()
    {
        $profile = factory('App\Profile')->create();
        $this->get($profile->path())->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_profiles()
    {
        $this->get('/profiles')->assertRedirect('login');
    }
}
