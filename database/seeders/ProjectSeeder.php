<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Models\Project;
use App\Functions\Helper;
use App\Models\Type;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 200; $i++) {
            $new_project = new Project();
            $new_project->type_id = Type::inRandomOrder()->first()->id;
            $new_project->title = $faker->sentence(1);
            $new_project->slug = Helper::generateSlug($new_project->title, Project::class);
            $new_project->description = $faker->paragraph;
            $new_project->start_date =  $faker->date;
            $new_project->end_date = $faker->optional()->date;
            $new_project->status = $faker->randomElement(['in progress', 'completed', 'on hold']);
            $new_project->project_url = $faker->optional()->url;

            $new_project->save();
        }
    }
}

