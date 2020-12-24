<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Transaction;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Transaction::class, function (Faker $faker) {
    static $password;
    return [
        'desc' =>  $faker->randomElement(['Transfer','Pay','Charge']),
        'amount' => $faker->numberBetween(100,5000),
        'user_id' => function(){
            return App\User::all()->random()->id;
        },
    ];
});
