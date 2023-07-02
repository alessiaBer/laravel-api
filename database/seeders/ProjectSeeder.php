<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $projects = config('projects');
        foreach ($projects as $project) {
            $newProject = new Project();
            $newProject->user_id = 1;
            $newProject->type_id = $project['type_id'];
            $newProject->title = $project['title'];
            $newProject->slug = Str::slug($newProject->title, '-');
            $newProject->description = $project['description'];
            $newProject->project_image = $project['project_image'];
            $newProject->second_img = $project['second_img'];
            /* $newProject->project_image = 'placeholders/' . $faker->image('storage/app/public/placeholders/', fullPath: false, category: 'Projects', format: 'jpg', word: $newProject->title); */
            $newProject->project_live_url = $project['project_live_url'];
            $newProject->project_source_code = $project['project_source_code'];
            $newProject->save();
        }

    }
}
