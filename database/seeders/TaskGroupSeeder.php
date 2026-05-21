<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\TaskGroup;
use Illuminate\Database\Seeder;

class TaskGroupSeeder extends Seeder
{
    public function run(): void
    {
        $projects = Project::all();

        foreach ($projects as $project) {
            // Task Group 1
            TaskGroup::create([
                'project_id' => $project->id,
                'name' => 'Requirements & Analysis',
                'color' => '#FF6B6B',
            ]);

            // Task Group 2
            TaskGroup::create([
                'project_id' => $project->id,
                'name' => 'Design Phase',
                'color' => '#4ECDC4',
            ]);

            // Task Group 3
            TaskGroup::create([
                'project_id' => $project->id,
                'name' => 'Development',
                'color' => '#45B7D1',
            ]);

            // Task Group 4
            TaskGroup::create([
                'project_id' => $project->id,
                'name' => 'Testing & QA',
                'color' => '#FFA502',
            ]);

            // Task Group 5
            TaskGroup::create([
                'project_id' => $project->id,
                'name' => 'Deployment',
                'color' => '#95E1D3',
            ]);
        }
    }
}
