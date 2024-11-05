<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
// Models
use App\Models\Project;
use App\Models\Type;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Project::truncate();

        $title = fake()->words(5, true);
        $slug = str()->slug($title);

        $randomType= Type::inRandomOrder()->first();

        for ($i=0; $i < 10; $i++) { 
            $title = $fake()->sentence();

            Project::create([
                'title' => $title,
                'slug' => $slug,
                'content' => fake()->paragraph(),
                'cover' => fake()->optional()->imageUrl(),
                'client' => fake()->words(2, true),
                'sector' => fake()->word(),
                'published' => fake()->boolean(70),

                'type_id' => $randomType->id,
            ]);
        }
    }
}
