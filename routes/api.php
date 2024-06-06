<?php

use App\Http\Controllers\TaskTrackerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Get tasks
Route::get('/v1/tasks', [TaskTrackerController::class, 'index']);

// Insert new task
Route::post('/v1/tasks/store', [TaskTrackerController::class, 'store']);

// Search task
Route::get('/v1/tasks/show', [TaskTrackerController::class, 'show']);

// Edit task
Route::get('/v1/tasks/edit/{taskTracker}', [TaskTrackerController::class, 'edit']);

// Updating task
Route::post('/v1/tasks/update/{taskTracker}', [TaskTrackerController::class, 'update']);

// Updating task status
Route::post('/v1/tasks/updateStatus/{taskTracker}', [TaskTrackerController::class, 'updateStatus']);

// destroying task
Route::delete('/v1/tasks/destroy/{taskTracker}', [TaskTrackerController::class, 'destroy']);
