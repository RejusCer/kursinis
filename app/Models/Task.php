<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state',
        'project_id',
        'parent_id',
        'time_estimation',
        'dead_line',
        'description'
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot(['time_spent', 'activatedOn']);
    }

    public function parent(){
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function children(){
        return $this->hasMany(Task::class, 'parent_id');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function childrenRecursive()
    {
        return $this->children()->with('current_state')->with('childrenRecursive.current_state');
    }

    public function countChildrenRecursive()
    {
        return $this->countDescendants($this);
    }
    private function countDescendants($task)
    {
        $count = 1; // Count the current task

        foreach ($task->children as $child) {
            $count += $this->countDescendants($child);
        }

        return $count;
    }

    public function countCompletedDescendants()
    {
        return $this->countDescendantsWithState($this, 'Baigta');
    }
    private function countDescendantsWithState($task, $stateName)
    {
        $count = $task->current_state && $task->current_state->state_name === $stateName ? 1 : 0;

        foreach ($task->children as $child) {
            $count += $this->countDescendantsWithState($child, $stateName);
        }

        return $count;
    }

    public function current_state(){
        return $this->belongsTo(State::class, 'state');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }



    public function total_time_spent(){
        $workingUsers = Task_User::where('task_id', $this->id)->get();
        $totalMinutes = 0;
        $totalHours = 0;

        foreach($workingUsers as $job){
            $time_worked = $job->time_spent;

            if ($time_worked != '0'){
                $hours_minutes = explode(':', $time_worked);
                $totalHours += (int)$hours_minutes[0]; // hours
                $totalMinutes += (int)$hours_minutes[1]; // minutes
            }
        }

        $totalMinutes_string = $totalMinutes;
        if ($totalMinutes < 10) $totalMinutes_string = '0' . $totalMinutes;

        return $totalHours . ':' . $totalMinutes_string;
    }

    public function is_user_assigned($userID){
        if($this->users()->find($userID)) { return true; }

        return false;
    }
}
