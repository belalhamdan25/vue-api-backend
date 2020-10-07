<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Portfolio;
use Faker\Generator as Faker;

$factory->define(Portfolio::class, function (Faker $faker) {
    return [
        'user_id' => function(){
            return App\User::where('role_name', 'freelancer')->pluck('id')->random();
        },
        'title' => $faker->sentence,
        'desc' => $faker->paragraph,
        'link' => $faker->url,
        'date' => $faker->monthName($max = 'now'),
        // 'skills' => $faker->randomElement(['["Photoshop,Illustrator"]', '["Graphic design,Logo design"]','["Microsoft word,Microsoft excel"]','["Translation,HTML 5"]','["CSS 3,PHP"]','["Online marketing,Web development"]','["After effect,Android"]','["Javascript,Bootstrap"]','["Vuejs,Reactjs"]','["Jquery,Data Analysis"]','["Website Design,Mobile App Development"]','["Writing,Editing"]','["Video Editing,Search Engine Optimization"]','["Social Media Marketing,MYSQL"]','["3D Design,Laravel"]','["ASP,Microsoft .NET"]','["Node js,Git"]','["Swift,Wordpress"]','["UX design,UI design"]','["Responsive design,User modeling"]','["Independent Sales,Training"]','["Consulting,Voice-Over Acting"]','["Career Coaching,Research"]','["TypeScript,Technical recruiter"]','["Education,Advertising"]','["Electronic design,E-books"]','["Landing pages,Sketch"]','["Microsoft office,Adobe"]','["Interior design,Ruby on rails"]']),
        'category_id' => function(){
            return App\Category::all()->random()->id;
        },
        // 'img' => 'https://mrkzgulfup.com/uploads/160086388051051.png',
        // 'img' => 'https://g.top4top.io/p_17412g65a1.png',
        'img'=>$faker->imageUrl($width = 640, $height = 480,'technics')

    ];
});
