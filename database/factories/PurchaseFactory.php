<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Purchase;
use Faker\Generator as Faker;

$factory->define(Purchase::class, function (Faker $faker) {
    return [
        'project_id' => function(){
            return App\Project::all()->random()->id;
        },
        'user_id' => function(){
            return App\User::all()->random()->id;
        },
    ];
});
