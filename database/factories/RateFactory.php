<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Rate;
use Faker\Generator as Faker;

$factory->define(Rate::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return App\User::all()->random()->id;
        },
        'desc' => $faker->sentence,
        'value' => $faker->numberBetween(0,5),
    ];
});
