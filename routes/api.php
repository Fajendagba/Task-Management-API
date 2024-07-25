<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware('auth:sanctum')->group(function () {
    // List all tasks
    Route::get('/list-tasks', [TaskController::class, 'index']);

    // Create a new task
    Route::post('/create-task', [TaskController::class, 'store']);

    // Get a specific task
    Route::get('/get-task/{id}', [TaskController::class, 'show']);

    // Update a task
    Route::put('/update-task/{id}', [TaskController::class, 'update']);

    // Delete a task
    Route::delete('/delete-task/{id}', [TaskController::class, 'destroy']);


    Route::post('/logout', [AuthController::class, 'logout']);
});

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('tasks', TaskController::class);
// });

