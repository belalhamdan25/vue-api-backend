<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class ProjectAttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $b = 1;
        for ($i = 0; $i < 450; $i++) {
            App\ProjectAttachment::create(array(
                'name' => $faker->sentence,
                'link' => $faker->url,
                'project_id' => App\Project::find($b)->id,
            ));
            $b++;
            if ($b == 151) {
                $b = 1;
            }
        }
    }
}
