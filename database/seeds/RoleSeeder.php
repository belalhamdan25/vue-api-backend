<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['admin', 'freelancer', 'client'];

        for ($i = 0; $i < count($roles); $i++) {
            App\Role::create(array(
                'name' => $roles[$i],
            ));
        }
    }
}
