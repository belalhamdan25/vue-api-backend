<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            // return App\User::where('role_name', 'client')->pluck('id')->random();
            return App\User::all()->random()->id;
        },
        'title' => $faker->sentence,
        'desc' => $faker->text($maxNbChars = 1000),
        'budget' => $faker->numberBetween(1000,10000),
        'time_line' => $faker->randomDigitNot(0),
        'category_id' => function(){
            return App\Category::all()->random()->id;
        },
    ];
});
