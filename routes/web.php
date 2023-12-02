<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectsController;
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

Route::get('/', function () {
    return view('auth');
});

Route::post('/signin', [AuthController::class, 'signin'])->name('signin');

Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/main', [ProjectsController::class, 'main'])->name('main');

Route::get('/create-project', [ProjectsController::class, 'create'])->name('create');

Route::post('/create-project', [ProjectsController::class, 'store'])->name('create');
