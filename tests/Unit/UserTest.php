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
}
