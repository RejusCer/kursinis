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

    public function top_level_tasks(){
        return $this->hasMany(Task::class)->where('parent_id', null);
    }
}
