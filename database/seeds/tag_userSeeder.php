<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tag_userSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
