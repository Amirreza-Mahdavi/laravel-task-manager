<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AssignmentController;
 

Route::get('/', function () {
    return view('welcome');
});

// authentication
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// task
Route::post('/tasks', [TaskController::class, 'addTask']);
Route::post('/taks/{id}/subtasks', [TaskController::class, 'addSubtask']);
Route::put('/tasks/{id}', [TaskController::class, 'updateTask']);
Route::delete('tasks/{id}/delete', [TaskController::class, 'deleteTask']);

 // assignment
Route::post('/tasks/{userId}/assign/{taskId}', [AssignmentController::class, 'assignTask']);

