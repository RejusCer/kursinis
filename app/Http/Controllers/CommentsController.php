<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, User $user, Task $task){
        $request->validate([
            'content' => 'required'
        ]);

        Comment::create([
            'user_id' => $user->id,
            'task_id' => $task->id,
            'content' => $request->content,
        ]);

        return back()->with('status', "Komentaras pridėtas");
    }

    public function destroy(Comment $comment){
        $comment->delete();

        return back()->with('status', "Komentaras ištrintas");
    }
}
