<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = ['design', 'translation', 'programming', 'writing', 'marketing', 'consulting'];
        $categoriesDesc = ['Design and works', 'Translation and languages', 'Programming and development', 'Writing and editing', 'Sales and marketing', 'Consulting and training'];

        for ($i = 0; $i < count($categories); $i++) {
            App\Category::create(array(
                'name' => $categories[$i],
                'desc' => $categoriesDesc[$i]
            ));
        }
    }
}
