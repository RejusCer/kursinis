<?php

namespace App\Models;

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


    // public function Users_Projects(){
    //     return $this->hasMany(Users_Projects::class);
    // }

    // public function users(): BelongsToMany{
    //     return $this->belongsToMany(User::class)
    //         ->using(Users_Projects::class)
    //         ->withPivot('role')
    //         ->withTimestamps();
    // }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
