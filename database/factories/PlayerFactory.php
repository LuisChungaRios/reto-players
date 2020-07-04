<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(\App\Player::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'position' => Str::random(10),
        'goals' => rand(1,20)
    ];
});
