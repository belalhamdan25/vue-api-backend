<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProjectOfferSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $l = 1;
        for ($i = 0; $i < 450; $i++) {
            App\ProjectOffer::create(array(
                'timeline' => $faker->randomDigitNot(0),
                'coast' => $faker->numberBetween(1000,10000),
                'profit' => $faker->numberBetween(1000,10000),
                'desc' => $faker->paragraph,
                'status' => $faker->randomElement(['awaiting approval','in proccess','finished']),
                'project_id' => App\Project::find($l)->id,
                'user_id' => App\User::find($l)->id,
            ));
            $l++;
            if ($l == 151) {
                $l = 1;
            }
        }
    }
}
