<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Portfolio;
use Faker\Generator as Faker;

$factory->define(Portfolio::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return App\User::all()->random()->id;
        },
        'title' => $faker->sentence,
        'desc' => $faker->text($maxNbChars = 450),
        'link' => $faker->url,
        'date' => $faker->monthName($max = 'now'),
        'category_id' => function(){
            return App\Category::all()->random()->id;
        },
    ];
});
