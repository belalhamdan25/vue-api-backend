<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class portfolio_tagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
