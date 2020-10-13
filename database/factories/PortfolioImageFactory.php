<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PortfolioImage;
use Faker\Generator as Faker;

$factory->define(PortfolioImage::class, function (Faker $faker) {
    return [
        'name' => $faker->imageUrl($width = 640, $height = 480),
        'portfolio_id' => function(){
            return App\Portfolio::pluck('id')->random();
        },
    ];
});
