<?php

namespace App\Models;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function users(){
        return $this->belongsToMany(User::class)->withPivot('role');
    }

    public function free_users($project_id){
        return User::whereDoesntHave('projects', function($query) use($project_id){
            $query->where('project_id', $project_id);
        })->get();
    }

    public function tasks(){
        return $this->hasMany(Task::class);
    }

    // gets all users that belong to this project but doesn't belong to specified task
    public function users_not_in_task($task_id){
        return User::whereHas('projects', function ($query) {
            $query->where('projects.id', $this->id);
        })
        ->where(function ($query) use ($task_id) {
            $query->orWhereDoesntHave('tasks', function ($subQuery) use ($task_id) {
                $subQuery->where('tasks.id', $task_id);
            });
        })
        ->get();
    }

    public function top_level_tasks(){
        return $this->hasMany(Task::class)->where('parent_id', null);
    }
}
