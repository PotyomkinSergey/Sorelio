<?php

use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', fn() => view('user.login'));
Route::post('/login', [UserController::class, 'login']);
Route::get('/logout', [UserController::class, 'logout']);

Route::get('/register', fn() => view('user.register'));
Route::post('/register', [UserController::class, 'register']);

Route::middleware('auth')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::get('/task/create', [TaskController::class, 'create']);
    Route::post('/task/store', [TaskController::class, 'store']);
    Route::delete('/task/{task}/destroy', [TaskController::class, 'destroy']);
    Route::get('/task/{task}/edit', [TaskController::class, 'edit']);
    Route::post('/task/{task}/update', [TaskController::class, 'update']);
});
