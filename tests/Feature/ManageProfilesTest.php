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
        $this->authenticate();
        $attributes = [
            'profile_name' => $this->faker->word,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'date_of_birth' => $this->faker->date,
        ];
        $this->post('/profiles', $attributes)->assertRedirect('/profiles');
        $this->assertDatabaseHas('profiles', $attributes);
        $this->get('/profiles/change-profile')->assertSee($attributes['profile_name']);
        $this->get('/profiles')->assertSee($attributes['first_name']);
    }

    /** @test */
    public function a_user_cannot_view_their_profile_if_none_is_active()
    {
        $this->authenticate();
        $profile = factory('App\Profile')->create(['user_id' => auth()->id()]);
        $this->get('/profiles')->assertRedirect('profiles/change-profile');
    }

    /** @test */
    public function a_user_can_view_their_active_profile()
    {
        $this->authenticate();
        $profile = factory('App\Profile')->create(['user_id' => auth()->id()]);
        $profile->setActive();
        $this->get('/profiles')
            ->assertSee($profile->first_name)
            ->assertSee($profile->last_name);
    }

    /** @test */
    public function a_user_can_change_their_active_profile()
    {
        $this->withoutExceptionHandling();
        $this->authenticate();
        $profile = factory('App\Profile')->create(['user_id' => auth()->id()]);
        $this->post('/profiles/change-profile', ['profile' => $profile->id])->assertRedirect('/profiles');
        $this->get('/profiles')
            ->assertSee($profile->first_name)
            ->assertSee($profile->last_name);
    }

    /** @test */
    public function an_authenticated_user_cannot_view_the_profiles_of_others()
    {
        $this->withoutExceptionHandling();
        $this->authenticate();
        $profile = factory('App\Profile')->create();
        $profile->setActive();
        $this->get('/profiles')->assertStatus(403);
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
        factory('App\Profile')->raw();
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
        factory('App\Profile')->create();
        $this->get('/profiles')->assertRedirect('login');
    }

    /** @test */
    public function guests_cannot_view_profiles()
    {
        $this->get('/profiles/change-profile')->assertRedirect('login');
    }
}
