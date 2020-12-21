<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class project_tagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


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
    }
}
