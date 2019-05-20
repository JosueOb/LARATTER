<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Response;
use Faker\Generator as Faker;

$factory->define(Response::class, function (Faker $faker) {
    return [
        'message' => $faker->words(3, true),
        'created_at' => $faker->dateTimeThisYear,
        'updated_at' => $faker->dateTimeThisYear,
    ];
});
