<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\Project;
use App\Models\TaskGroup;
use App\Models\User;
use App\Models\Label;
use App\Enums\PricingType;
use Illuminate\Database\Seeder;

class TasksSeeder extends Seeder
{
    public function run(): void
    {
        $developers = User::role('developer')->get();
        $admin = User::role('admin')->first();
        $projects = Project::all();

        foreach ($projects as $project) {
            $taskGroups = $project->taskGroups;

            // Requirement Phase Tasks
            $reqGroup = $taskGroups->where('name', 'Requirements & Analysis')->first();
            Task::create([
                'project_id' => $project->id,
                'group_id' => $reqGroup->id,
                'name' => 'Gather client requirements',
                'number' => $project->id . '-001',
                'description' => 'Schedule and conduct meetings with stakeholders to understand project requirements',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers->first()->id,
                'due_on' => now()->addDays(5),
                'estimation' => 8,
                'priority_id' => 1,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
                'completed_at' => now()->subDays(10),
                'assigned_at' => now()->subDays(15),
            ]);

            Task::create([
                'project_id' => $project->id,
                'group_id' => $reqGroup->id,
                'name' => 'Create project documentation',
                'number' => $project->id . '-002',
                'description' => 'Document all requirements and create technical specifications',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers[1]->id,
                'due_on' => now()->addDays(10),
                'estimation' => 12,
                'priority_id' => TaskPriority::where('name', 'High')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
                'completed_at' => now()->subDays(5),
                'assigned_at' => now()->subDays(12),
            ]);

            // Design Phase Tasks
            $designGroup = $taskGroups->where('name', 'Design Phase')->first();
            Task::create([
                'project_id' => $project->id,
                'group_id' => $designGroup->id,
                'name' => 'Create wireframes',
                'number' => $project->id . '-003',
                'description' => 'Design wireframes for all main pages and user flows',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers[1]->id,
                'due_on' => now()->addDays(15),
                'estimation' => 16,
                'priority_id' => TaskPriority::where('name', 'High')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            Task::create([
                'project_id' => $project->id,
                'group_id' => $designGroup->id,
                'name' => 'Design visual mockups',
                'number' => $project->id . '-004',
                'description' => 'Create high-fidelity visual mockups with branding and styling',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers[1]->id,
                'due_on' => now()->addDays(20),
                'estimation' => 20,
                'priority_id' => TaskPriority::where('name', 'Medium')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            // Development Tasks
            $devGroup = $taskGroups->where('name', 'Development')->first();
            Task::create([
                'project_id' => $project->id,
                'group_id' => $devGroup->id,
                'name' => 'Setup project infrastructure',
                'number' => $project->id . '-005',
                'description' => 'Configure servers, databases, and development environment',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers->first()->id,
                'due_on' => now()->addDays(25),
                'estimation' => 12,
                'priority_id' => TaskPriority::where('name', 'High')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            Task::create([
                'project_id' => $project->id,
                'group_id' => $devGroup->id,
                'name' => 'Implement authentication system',
                'number' => $project->id . '-006',
                'description' => 'Build user authentication and authorization system with OAuth integration',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers->first()->id,
                'due_on' => now()->addDays(30),
                'estimation' => 24,
                'priority_id' => TaskPriority::where('name', 'High')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            Task::create([
                'project_id' => $project->id,
                'group_id' => $devGroup->id,
                'name' => 'Develop main feature modules',
                'number' => $project->id . '-007',
                'description' => 'Implement core features and functionality',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers[1]->id,
                'due_on' => now()->addDays(40),
                'estimation' => 40,
                'priority_id' => TaskPriority::where('name', 'High')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            Task::create([
                'project_id' => $project->id,
                'group_id' => $devGroup->id,
                'name' => 'API Integration',
                'number' => $project->id . '-008',
                'description' => 'Integrate with third-party APIs and external services',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers[1]->id,
                'due_on' => now()->addDays(35),
                'estimation' => 16,
                'priority_id' => TaskPriority::where('name', 'Medium')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            // QA Tasks
            $qaGroup = $taskGroups->where('name', 'Testing & QA')->first();
            Task::create([
                'project_id' => $project->id,
                'group_id' => $qaGroup->id,
                'name' => 'Unit testing',
                'number' => $project->id . '-009',
                'description' => 'Write and run unit tests for all code modules',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers[2]->id,
                'due_on' => now()->addDays(45),
                'estimation' => 20,
                'priority_id' => TaskPriority::where('name', 'High')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            Task::create([
                'project_id' => $project->id,
                'group_id' => $qaGroup->id,
                'name' => 'Integration testing',
                'number' => $project->id . '-010',
                'description' => 'Test integration between different modules and services',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers[2]->id,
                'due_on' => now()->addDays(48),
                'estimation' => 16,
                'priority_id' => TaskPriority::where('name', 'High')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            Task::create([
                'project_id' => $project->id,
                'group_id' => $qaGroup->id,
                'name' => 'Performance testing',
                'number' => $project->id . '-011',
                'description' => 'Conduct load testing and performance optimization',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers[2]->id,
                'due_on' => now()->addDays(50),
                'estimation' => 12,
                'priority_id' => TaskPriority::where('name', 'Medium')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            // Deployment Tasks
            $deployGroup = $taskGroups->where('name', 'Deployment')->first();
            Task::create([
                'project_id' => $project->id,
                'group_id' => $deployGroup->id,
                'name' => 'Prepare production environment',
                'number' => $project->id . '-012',
                'description' => 'Configure production servers and deployment pipeline',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers->first()->id,
                'due_on' => now()->addDays(52),
                'estimation' => 8,
                'priority_id' => TaskPriority::where('name', 'High')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            Task::create([
                'project_id' => $project->id,
                'group_id' => $deployGroup->id,
                'name' => 'Deploy to production',
                'number' => $project->id . '-013',
                'description' => 'Deploy application to production environment',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers->first()->id,
                'due_on' => now()->addDays(55),
                'estimation' => 4,
                'priority_id' => TaskPriority::where('name', 'Critical')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);

            Task::create([
                'project_id' => $project->id,
                'group_id' => $deployGroup->id,
                'name' => 'Post-deployment monitoring',
                'number' => $project->id . '-014',
                'description' => 'Monitor application performance and fix any issues',
                'created_by_user_id' => $admin->id,
                'assigned_to_user_id' => $developers->first()->id,
                'due_on' => now()->addDays(60),
                'estimation' => 8,
                'priority_id' => TaskPriority::where('name', 'Medium')->first()->id,
                'pricing_type' => PricingType::HOURLY,
                'billable' => true,
            ]);
        }

        // Create time logs for some tasks
        $tasks = Task::whereNotNull('assigned_to_user_id')->limit(10)->get();
        foreach ($tasks as $task) {
            \App\Models\TimeLog::create([
                'task_id' => $task->id,
                'user_id' => $task->assigned_to_user_id,
                'hours' => rand(2, 8),
                'note' => 'Working on ' . $task->name,
                'logged_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}
