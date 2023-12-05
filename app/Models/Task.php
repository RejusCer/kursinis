<?php

namespace App\Models;

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
        return $this->belongsToMany(User::class)->withPivot('time_spent');
    }

    public function parent()
    {
        return $this->belongsTo(Task::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Task::class, 'parent_id');
    }

//     // Retrieve a task with its parent and children
// $task = Task::with('parent', 'children')->find($taskId);

// // Access parent task
// $parentTask = $task->parent;

// // Access children tasks
// $childTasks = $task->children;

    public function current_state(){
        return $this->belongsTo(State::class, 'state');
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
}
