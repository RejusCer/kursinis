<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Models\Users_Projects;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function create(){
        return view('projectCreate');
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:64'
        ]);

        $project = Project::create([
            'name' => $request->name
        ]);

        $user_project = Users_Projects::create([
            'user_id' => Auth::user()->id,
            'project_id' => $project->id,
            'role' => 'admin'
        ]);

        return view('main')->with('status', 'naujas projektas pridėtas');
    }
}
