<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Task;
use App\Models\Project;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function projects(){
        return $this->belongsToMany(Project::class)->withPivot('role');
    }

    public function tasks(){
        return $this->belongsToMany(Task::class)->withPivot('time_spent');
    }

    public function belongsToTask($task_id){
        return User::whereHas('tasks', function ($query) use ($task_id) {
            $query->where('tasks.id', $task_id);
        })->find($this->id);
    }

    // get project task count asigned to this user
    public function getTaskCount($projectId){
        return Task::where('project_id', $projectId)->whereHas('users', function ($query) {
            $query->where('user_id', $this->id);
        })
        ->count();
    }
}
