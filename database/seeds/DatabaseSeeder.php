<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\Category;
use App\Role;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'freelancer','client'];

        for ($i = 0; $i < count($roles); $i++) {
            Role::create(array(
                'name' => $roles[$i],
            ));
            }

        factory(App\User::class,150)->create();
        $categories = ['design', 'translation','programming','writing','marketing','consulting' ];
        $categoriesDesc = ['Design and works', 'Translation and languages','Programming and development','Writing and editing','Sales and marketing','Consulting and training'];

        for ($i = 0; $i < count($categories); $i++) {
            Category::create(array(
                'name' => $categories[$i],
                'desc' =>$categoriesDesc[$i]
            ));
            }


            factory(App\Portfolio::class,150)->create();
            factory(App\PortfolioImage::class,500)->create();


        $skills = ['Photoshop','Illustrator', 'Graphic design','Logo design','Microsoft word','Microsoft excel','Translation','HTML 5','CSS 3','PHP','Online marketing','Web development','After effect','Android','Javascript','Bootstrap','Vuejs','Reactjs','Jquery','Data Analysis','Website Design','Mobile App Development','Writing','Editing','Video Editing','Search Engine Optimization','Social Media Marketing','MYSQL','3D Design','Laravel','ASP','Microsoft .NET','Node js','Git','Swift','Wordpress','UX design','UI design','Responsive design','User modeling','Independent Sales','Training','Consulting','Voice-Over Acting','Career Coaching','Research','TypeScript','Technical recruiter','Education','Advertising','Electronic' ,'design','E-books','Landing pages','Sketch','Microsoft office','Adobe','Interior design','Ruby on rails'];

         for ($i = 0; $i < count($skills); $i++) {
            Tag::create(array(
                'name' => $skills[$i],
            ));
            }


                //$i must be equal to Portfolio::class seed //tags table
                for($i=0;$i<500;$i++){
                    DB::table('portfolio_tag')->insert([
                        'tag_id' => App\Tag::all()->random()->id,
                        'portfolio_id' => App\Portfolio::all()->random()->id,
                    ]);
                }


    }
}
