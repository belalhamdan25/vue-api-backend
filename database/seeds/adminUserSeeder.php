<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class adminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => 'Admin',
            'last_name' => 'Meu',
            'email' => 'admin@admin.com',
            'phone_number' => '0890825604',
            'password' => Hash::make('belal123456'),
            'location' => 'Jordan',
            'category_id' => 3,
            'role_name' => 'admin',
        ]);
    }
}
