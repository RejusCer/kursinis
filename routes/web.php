<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\TasksController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => ['guest']], function(){
    Route::get('/', function () {
        return view('auth');
    })->name('login');

    Route::post('/signin', [AuthController::class, 'signin'])->name('signin');

    Route::post('/register', [AuthController::class, 'register'])->name('register');
});

Route::group(['middleware' => ['auth']], function(){
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('/user/edit/{user}', [AuthController::class, 'edit_form'])->name('user.edit.form');
    Route::post('/user/edit/{user}', [AuthController::class, 'edit'])->name('user.edit.form');

    // Projects
    Route::get('/main', [ProjectsController::class, 'main'])->name('main');

    Route::get('/create-project', [ProjectsController::class, 'create'])->name('create');
    Route::post('/create-project', [ProjectsController::class, 'store'])->name('create');

    Route::delete('/create-project/{project:name}', [ProjectsController::class, 'destroy'])->name('destroy-project');

    Route::get('/{project:name}', [ProjectsController::class, 'project_inner'])->name('project_inner');

    Route::post('/{project:name}/add-users', [ProjectsController::class, 'add_users'])->name('add-users');

    // Tasks
    Route::get('{project:name}/create-task', [TasksController::class, 'create'])->name('create-task');
    Route::post('{project:name}/create-task', [TasksController::class, 'store'])->name('create-task');

    Route::delete('{project:name}/destroy-task/{task}', [TasksController::class, 'destroy'])->name('destroy-task');

    Route::get('{project:name}/{task}/create-child-task', [TasksController::class, 'child_task_create'])->name('create-child-task');
    Route::post('{project:name}/{task}/create-child-task', [TasksController::class, 'child_task_store'])->name('create-child-task');

    Route::get('{project:name}/task/{task}', [TasksController::class, 'task_inner'])->name('task_inner');

    Route::post('/task/{task}/add-users', [TasksController::class, 'add_users'])->name('task.add_users');

    Route::post('/task/{task}/track-time', [TasksController::class, 'track_time'])->name('task.track_time');
    Route::post('/task/{task}/stop_time', [TasksController::class, 'stop_time'])->name('task.stop_time');

    Route::post('/task/{task}/update-state', [TasksController::class, 'update_state'])->name('task.update.state');

    // Comments
    Route::post('comment/post/user/{user}/task/{task}', [CommentsController::class, 'store'])->name('comment.store');
    Route::delete('comment/destroy/{comment}', [CommentsController::class, 'destroy'])->name('comment.destroy');
});
