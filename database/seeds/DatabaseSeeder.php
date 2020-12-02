<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Category;
use App\Role;
use App\PortfolioImage;
use App\ProjectAttachment;
use App\Project;
use App\ProjectOffer;
// use Faker\Generator as Faker;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'freelancer', 'client'];

        for ($i = 0; $i < count($roles); $i++) {
            Role::create(array(
                'name' => $roles[$i],
            ));
        }

        $categories = ['design', 'translation', 'programming', 'writing', 'marketing', 'consulting'];
        $categoriesDesc = ['Design and works', 'Translation and languages', 'Programming and development', 'Writing and editing', 'Sales and marketing', 'Consulting and training'];

        for ($i = 0; $i < count($categories); $i++) {
            Category::create(array(
                'name' => $categories[$i],
                'desc' => $categoriesDesc[$i]
            ));
        }
        factory(App\User::class, 150)->create();


        factory(App\Portfolio::class, 150)->create();
        factory(App\Project::class, 150)->create();
        // factory(App\Balance::class, 150)->create();
        // factory(App\PortfolioImage::class,1000)->create();


        $skills = ['Photoshop', 'Illustrator', 'Graphic design', 'Logo design', 'Microsoft word', 'Microsoft excel', 'Translation', 'HTML 5', 'CSS 3', 'PHP', 'Online marketing', 'Web development', 'After effect', 'Android', 'Javascript', 'Bootstrap', 'Vuejs', 'Reactjs', 'Jquery', 'Data Analysis', 'Website Design', 'Mobile App Development', 'Writing', 'Editing', 'Video Editing', 'Search Engine Optimization', 'Social Media Marketing', 'MYSQL', '3D Design', 'Laravel', 'ASP', 'Microsoft .NET', 'Node js', 'Git', 'Swift', 'Wordpress', 'UX design', 'UI design', 'Responsive design', 'User modeling', 'Independent Sales', 'Training', 'Consulting', 'Voice-Over Acting', 'Career Coaching', 'Research', 'TypeScript', 'Technical recruiter', 'Education', 'Advertising', 'Electronic', 'design', 'E-books', 'Landing pages', 'Sketch', 'Microsoft office', 'Adobe', 'Interior design', 'Ruby on rails'];

        for ($i = 0; $i < count($skills); $i++) {
            Tag::create(array(
                'name' => $skills[$i],
            ));
        }

        $j = 1;
        $x = 1;
        //$i must be equal to Portfolio::class seed //tags table
        for ($i = 0; $i < 450; $i++) {
            DB::table('portfolio_tag')->insert([
                'tag_id' => App\Tag::find($j)->id,
                'portfolio_id' => App\Portfolio::find($x)->id,
            ]);
            $x++;
            $j++;
            if ($j == 58) {
                $j = 1;
            }
            if ($x == 151) {
                $x = 1;
            }
        }



        $ju = 1;
        $xu = 1;
        //$i must be equal to Portfolio::class seed //tags table
        for ($i = 0; $i < 450; $i++) {
            DB::table('tag_user')->insert([
                'tag_id' => App\Tag::find($ju)->id,
                'user_id' => App\User::find($xu)->id,
            ]);
            $xu++;
            $ju++;
            if ($ju == 58) {
                $ju = 1;
            }
            if ($xu == 151) {
                $xu = 1;
            }
        }

        $faker = Faker::create();
        $z = 1;
        // $u=1;
        for ($i = 0; $i < 450; $i++) {
            PortfolioImage::create(array(
                'name' => $faker->imageUrl($width = 640, $height = 480),
                // 'name' => "https://loremflickr.com/640/480",
                // 'name' => "https://loremflickr.com/640/480?lock=$u",
                // 'name' => "https://picsum.photos/id/$u/640/480",
                'portfolio_id' => App\Portfolio::find($z)->id,
            ));
            $z++;
            // $u++;
            if ($z == 151) {
                $z = 1;
            }
        }

        $b = 1;
        for ($i = 0; $i < 450; $i++) {
            ProjectAttachment::create(array(
                'name' => $faker->sentence,
                'link' => $faker->url,
                'project_id' => Project::find($b)->id,
            ));
            $b++;
            if ($b == 151) {
                $b = 1;
            }
        }

        $l = 1;
        for ($i = 0; $i < 450; $i++) {
            ProjectOffer::create(array(
                'timeline' => $faker->randomDigitNot(0),
                'coast' => $faker->numberBetween(1000,10000),
                'desc' => $faker->paragraph,
                'project_id' => Project::find($l)->id,
                'user_id' => App\User::find($l)->id,
            ));
            $l++;
            if ($l == 151) {
                $l = 1;
            }
        }


        $jb = 1;
        $xb = 1;
        //$i must be equal to Portfolio::class seed //tags table
        for ($i = 0; $i < 450; $i++) {
            DB::table('project_tag')->insert([
                'tag_id' => App\Tag::find($jb)->id,
                'project_id' => App\Project::find($xb)->id,
            ]);
            $xb++;
            $jb++;
            if ($jb == 58) {
                $jb = 1;
            }
            if ($xb == 151) {
                $xb = 1;
            }
        }


        $bxxx = 1;
        for ($i = 0; $i < 150; $i++) {
            App\Balance::create(array(
                'user_id' => App\User::find($bxxx)->id,
                'outstanding' => $faker->numberBetween(0,500),
                'under_review' => $faker->numberBetween(0,400),
                'total' => $faker->numberBetween(0,1000),
                'withdrawable' => $faker->numberBetween(0,100),
            ));
            $bxxx++;
        }


    }
}
