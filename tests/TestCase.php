<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function authenticate($user = null)
    {
        return $this->actingAs($user ?: factory('App\User')->create());
    }
}
