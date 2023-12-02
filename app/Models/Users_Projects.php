<?php

namespace App\Models;

use App\Models\User;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Users_Projects extends Model
{
    use HasFactory;

    protected $table = 'users_projects';

    protected $fillable = [
        'user_id',
        'project_id',
        'role'
    ];

    public function User(){
        return $this->belongsTo(User::class);
    }

    public function Project(){
        return $this->belongsTo(Project::class);
    }
}
