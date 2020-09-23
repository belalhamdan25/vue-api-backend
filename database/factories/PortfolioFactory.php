<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Portfolio;
use Faker\Generator as Faker;

$factory->define(Portfolio::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return App\User::all()->random()->id;
        },
        'user_name' => function(){
            return App\User::all()->random()->first_name;

        },
        'user_img' => 'https://mrkzgulfup.com/uploads/160086343374581.png',
        'title' => $faker->sentence,
        'desc' => $faker->paragraph,
        'link' => $faker->url,
        'date' => $faker->monthName($max = 'now'),
        'skills' => $faker->sentence,
        'img' => 'https://mrkzgulfup.com/uploads/160086388051051.png',
    ];
});
