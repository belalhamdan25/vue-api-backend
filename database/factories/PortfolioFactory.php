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
            $first_name= App\User::all()->random()->first_name;
            $last_name= App\User::all()->random()->last_name;
            return $first_name ." ". $last_name;
        },
        'user_img' => 'https://mrkzgulfup.com/uploads/160086343374581.png',
        'title' => $faker->sentence,
        'desc' => $faker->paragraph,
        'link' => $faker->url,
        'date' => $faker->monthName($max = 'now'),
        'skills' => $faker->sentence,
        'category' => $faker->randomElement(['design', 'translation','programming','writing','marketing','consulting']),
        'img' => 'https://mrkzgulfup.com/uploads/160086388051051.png',
    ];
});
