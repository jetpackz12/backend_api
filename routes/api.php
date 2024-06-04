<?php

use App\Http\Controllers\TaskTrackerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Get tasks
Route::get('/v1/tasks', [TaskTrackerController::class, 'index']);

// Insert new task
Route::post('/v1/tasks/store', [TaskTrackerController::class, 'store']);

// Updating task
Route::post('/v1/tasks/update/{taskTracker}', [TaskTrackerController::class, 'update']);

// destroying task
Route::post('/v1/tasks/destroy/{taskTracker}', [TaskTrackerController::class, 'destroy']);
