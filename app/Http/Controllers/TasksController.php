<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use App\Models\Project_User;
use App\Models\Task_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function create(Project $project){
        return view('taskCreate', [
            'project' => $project
        ]);
    }

    public function store(Request $request, Project $project){
        $request->validate([
            'name' => 'required|max:64',
            'time_estimation' => 'required|max:64',
            'dead_line' => 'required|max:64|date_format:Y-m-d|after:today',
            'description' => 'required|max:255'
        ]);

        $task = Task::create([
            'name' => $request->name,
            'state' => 1, // 1 - not-started
            'project_id' => $project->id,
            'parent_id' => null,
            'time_estimation' => $request->time_estimation,
            'dead_line' => $request->dead_line,
            'description' => $request->description
        ]);

        Task_User::create([
            'user_id' => Auth::user()->id,
            'task_id' => $task->id,
            'time_spent' => '0'
        ]);

        return redirect()->route('project_inner', $project)->with('status', 'Užduotis sukurta');
    }

    public function child_task_create(Project $project, Task $task){
        return view('childTaskCreate', [
            'project' => $project,
            'task' => $task
        ]);
    }

    public function child_task_store(Request $request, Project $project, Task $task){
        $request->validate([
            'name' => 'required|max:64',
            'time_estimation' => 'required|max:64',
            'dead_line' => 'required|max:64|date_format:Y-m-d|after:today',
            'description' => 'required|max:255'
        ]);

        $task = Task::create([
            'name' => $request->name,
            'state' => 1, // 1 - not-started
            'project_id' => $project->id,
            'parent_id' => $task->id,
            'time_estimation' => $request->time_estimation,
            'dead_line' => $request->dead_line,
            'description' => $request->description
        ]);

        Task_User::create([
            'user_id' => Auth::user()->id,
            'task_id' => $task->id,
            'time_spent' => '0'
        ]);

        return redirect()->route('task_inner', [$project, $task])->with('status', 'Skaidoma užduotis sukurta');
    }


    public function task_inner(Project $project, Task $task){
        return view('task_inner', [
            'project' => $project,
            'task' => $task
        ]);
    }

    public function destroy(Project $project, Task $task){
        $task->delete();

        return redirect()->route('project_inner', $project)->with('status', "Užduotis ištrinta");
    }
}