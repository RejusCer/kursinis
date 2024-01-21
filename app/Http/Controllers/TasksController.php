<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\State;
use App\Models\Comment;
use App\Models\Project;
use App\Models\Task_User;
use App\Rules\TimeFormat;
use App\Models\Project_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

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
            'time_estimation' => ['required', 'max:64', new TimeFormat],
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
        $userRole = Auth::user()->projects->find($project->id)->pivot->role;


        $totalTimeSpent = 0;
        foreach ($task->users as $user) {
            // Convert the "time_spent" format (e.g., "4:54") to minutes
            if (strpos($user->pivot->time_spent, ':') !== false) {
                list($hours, $minutes) = explode(':', $user->pivot->time_spent);
                $totalTimeSpent += $hours * 60 + $minutes;
            }
        }

        // Now $totalTimeSpent contains the sum of all 'time_spent' values for the specified task in minutes
        // Convert it back to hours and minutes if needed
        $totalHours = floor($totalTimeSpent / 60);
        $totalMinutes = $totalTimeSpent % 60;

        $totalMinutes_string = $totalMinutes;
        if ($totalMinutes < 10) $totalMinutes_string = '0' . $totalMinutes;

        $totalString = $totalHours . ":" . $totalMinutes_string;


        $states = State::all();

        $comments = Comment::where('task_id', $task->id)->orderBy('created_at', 'desc')->get();


        return view('task_inner', [
            'project' => $project,
            'task' => $task,
            'states' => $states,
            'comments' => $comments,
            'userRole' => $userRole,
            'totalString' => $totalString
        ]);
    }

    public function destroy(Project $project, Task $task){
        $task->delete();

        return redirect()->route('project_inner', $project)->with('status', "Užduotis ištrinta");
    }

    public function add_users(Request $request, Task $task){
        $user_ids = array_map('intval', $request->users);

        $task->users()->attach($user_ids, ['time_spent' => '0']);

        return back()->with('status', "Nauji vartotojai pridėti prie užduotis");
    }

    public function update_state(Task $task, Request $request){
        $request->validate([
            'state' => 'required|exists:states,id',
        ], [
            'state.exists' => 'Pasirinkta būsena neegzistuoja.',
        ]);

        $newStateId = $request->state;
        $newState = State::findOrFail($newStateId);

        $task->current_state()->associate($newState);
        $task->save();

        return back()->with('status', "Užduoties būsena atnaujinta");
    }

    public function track_time(Task $task){
        $currentTime = Carbon::now();

        $task->users()->updateExistingPivot(Auth::user()->id, ['activatedOn' => $currentTime]);

        return back()->with('status', "Laikas sekamas");
    }

    public function stop_time(Task $task){
        $activatedTime = $task->users()->wherePivot('user_id', Auth::user()->id)->value('activatedOn');
        $activatedOn = Carbon::parse($activatedTime);
        $currentTime = Carbon::now();
        $difference = $currentTime->diff($activatedOn)->format('%H:%I');

        // difference + old time_spent
        $oldTimeSpentByUser = $task->users()->wherePivot('user_id', Auth::user()->id)->value('time_spent');

        if ($oldTimeSpentByUser != '0'){
            $difference = Carbon::createFromFormat('H:i', $difference);

            $hours_minutes = explode(':', $oldTimeSpentByUser);
            $difference = $difference->copy()->addHours((int)$hours_minutes[0]);
            $difference = $difference->copy()->addMinutes((int)$hours_minutes[1]);

            $difference = $difference->format('H:i');
        }

        //save new time
        $task->users()->updateExistingPivot(Auth::user()->id, ['time_spent' => $difference]);
        $task->users()->updateExistingPivot(Auth::user()->id, ['activatedOn' => null]);

        return back()->with('status', "Laiko sekimas sustabdytas");
    }
}
