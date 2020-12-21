<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            RoleSeeder::class,
            CategoriesSeeder::class
        ]);

        factory(App\User::class, 150)->create();
        factory(App\Portfolio::class, 150)->create();
        factory(App\Project::class, 150)->create();
        factory(App\Transaction::class, 1000)->create();

        $this->call([
            SkillsSeeder::class,
            portfolio_tagSeeder::class,
            tag_userSeeder::class,
            PortfolioImageSeeder::class,
            ProjectAttachmentSeeder::class,
            ProjectOfferSeeder::class,
            project_tagSeeder::class,
            adminUserSeeder::class
        ]);


    }
}
