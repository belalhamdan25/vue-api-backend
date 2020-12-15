<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        // 'user_img' => $faker->randomElement([null,'https://platforms.tqnee.com/ta3ref/wp-content/uploads/2019/05/74sByqd.jpg','https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcQey3S6VQ4qIppedXehx8CQYDshaMBwU1UwpQ&usqp=CAU']),
            'user_img' => null,
            'first_name' => $faker->firstNameMale,
            'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phone_number' => $faker->phoneNumber,
        'location' => $faker->countryCode,
        'balance' => $faker->numberBetween(0,1000),
        'gender' => $faker->randomElement(['Male','Female']),
        'about' => $faker->text($maxNbChars = 1000),
        'password' => $password ?: $password=bcrypt('belal123456'), // password
        'role_name' => $faker->randomElement(['freelancer','client']),
        'remember_token' => Str::random(10),
        'rate'=>$faker->numberBetween(0,5),
        'category_id' => function(){
            return App\Category::all()->random()->id;
        },
    ];
});
