<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $skills = ['Photoshop', 'Illustrator', 'Graphic design', 'Logo design', 'Microsoft word', 'Microsoft excel', 'Translation', 'HTML 5', 'CSS 3', 'PHP', 'Online marketing', 'Web development', 'After effect', 'Android', 'Javascript', 'Bootstrap', 'Vuejs', 'Reactjs', 'Jquery', 'Data Analysis', 'Website Design', 'Mobile App Development', 'Writing', 'Editing', 'Video Editing', 'Search Engine Optimization', 'Social Media Marketing', 'MYSQL', '3D Design', 'Laravel', 'ASP', 'Microsoft .NET', 'Node js', 'Git', 'Swift', 'Wordpress', 'UX design', 'UI design', 'Responsive design', 'User modeling', 'Independent Sales', 'Training', 'Consulting', 'Voice-Over Acting', 'Career Coaching', 'Research', 'TypeScript', 'Technical recruiter', 'Education', 'Advertising', 'Electronic', 'design', 'E-books', 'Landing pages', 'Sketch', 'Microsoft office', 'Adobe', 'Interior design', 'Ruby on rails'];

        for ($i = 0; $i < count($skills); $i++) {
            App\Tag::create(array(
                'name' => $skills[$i],
            ));
        }
    }
}
