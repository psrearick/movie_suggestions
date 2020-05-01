<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_a_user_has_profiles()
    {
        $user = factory('App\User')->create();
        $this->assertInstanceOf(Collection::class, $user->profiles);
    }

    /** @test */
    public function a_profile_can_be_stored_in_a_session()
    {
        $user = factory('App\User')->create();
        $profile1 = factory('App\Profile')->create(['user_id' => $user->id]);
        $profile2 = factory('App\Profile')->create(['user_id' => $user->id]);
        $key = 'profile';
        $this->get('/')->assertSessionMissing($key);
        $profile1->setActive();
        $this->get('/')->assertSessionHas($key, $profile1->id);
        $profile2->setActive();
        $this->get('/')->assertSessionHas($key, $profile2->id);
        $this->assertEquals(true, $profile2->isActive());
        $this->assertEquals(false, $profile1->isActive());
        $this->assertEquals($profile2->id, $user->activeProfile()->id);
    }
}
