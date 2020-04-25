<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MovieProfile;
use Faker\Generator as Faker;

$factory->define(MovieProfile::class, function (Faker $faker) {
    return [
        'watch_list' => $faker->boolean,
        'favorite' => $faker->boolean,
        'seen' => $faker->numberBetween(0, 99),
        'rating' => $faker->numberBetween(1, 10),
        'profile_id' => function () {
            return factory(App\Profile::class)->create()->id;
        },
        'movie_id' => function () {
            return factory(App\Movie::class)->create()->id;
        }
    ];
});
