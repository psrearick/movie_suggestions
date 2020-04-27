<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $profile = factory('App\Profile')->create();
        $this->assertEquals('/profiles/' . $profile->id, $profile->path());
    }

    /** @test */
    public function it_belongs_to_a_user()
    {
        $profile = factory('App\Profile')->create();

        $this->assertInstanceOf('App\User', $profile->user);
    }

    /** @test */
    public function it_can_add_a_movie()
    {
        $profile = factory('App\Profile')->create();
        $movie = factory('App\Movie')->create();

        $profile->addMovie($movie->id, ['favorite' => true]);

        $this->assertCount(1, $profile->movies);
        $this->assertTrue($profile->movies->contains($movie->id));
    }
}
