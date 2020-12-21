<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class PortfolioImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $z = 1;
        // $u=1;
        for ($i = 0; $i < 450; $i++) {
            App\PortfolioImage::create(array(
                // 'name' => $faker->imageUrl($width = 640, $height = 480),
                // 'name' => "https://loremflickr.com/640/480",
                // 'name' => "https://loremflickr.com/640/480?lock=$u",
                // 'name' => "https://picsum.photos/id/$u/640/480",
                'name' => "https://via.placeholder.com/640x480",
                'portfolio_id' => App\Portfolio::find($z)->id,
            ));
            $z++;
            // $u++;
            if ($z == 151) {
                $z = 1;
            }
        }
    }
}
