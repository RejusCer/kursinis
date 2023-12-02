<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Project_User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    public function main(){

        $projects = Auth::user()->projects;

        return view('main', [
            'projects' => $projects
        ]);
    }

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

        Project_User::create([
            'user_id' => Auth::user()->id,
            'project_id' => $project->id,
            'role' => 'admin'
        ]);

        return redirect()->route('main')->with('status', 'naujas projektas pridėtas');
    }
}
