<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Balance;
use Faker\Generator as Faker;

$factory->define(Balance::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            // return App\User::where('role_name', 'client')->pluck('id')->random();
            return App\User::all()->random()->id;
        },
        'outstanding' => $faker->numberBetween(0,500),
        'under_review' => $faker->numberBetween(0,400),
        'total' => $faker->numberBetween(0,1000),
        'withdrawable' => $faker->numberBetween(0,100),

    ];
});
