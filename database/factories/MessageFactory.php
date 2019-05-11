<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'content'=> $faker->realText(random_int(20,160)),
        'image' => $faker->imageUrl(600,330)
    ];
});
