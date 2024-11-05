<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

// helpers
use Illuminate\Support\Facades\Schema;

// model
use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::withoutForeignKeyConstraints(function(){
            Project::truncate();
        });
        
        for($i=0; $i<10; $i++) {

            
            $title = fake()->words(5, true);
            $slug = str()->slug($title);

            $randomType= Type::inRandomOrder()->first();

            $project = Project::create([

                'title' => $title,
                'slug' => $slug,
                'description' => fake()->paragraph(),
                'cover' => fake()->optional()->imageUrl(),
                'client' => fake()->words(2, true),
                'sector' => fake()->word(),
                'published' => fake()->boolean(70),

                'type_id' => $randomType->id,
            ]);

            $technologyIds = [];

            for ($j=0; $j < rand(0, Technology::count()) ; $j++) { 
                $randomTechnology = Technology::inRandomOrder()->first();

                if (!in_array($randomTechnology->id, $technologyIds)) {
                    $technologyIds[] = $randomTechnology->id;
                }
            }

            $project->technologies()->sync($technologyIds);
        }
    }
}
