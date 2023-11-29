<?php

use MoviePlugin\Http\Controllers\MovieController;

// Define movie routes
Route::get('/movies', [MovieController::class, 'index']);
Route::get('/movies/create', [MovieController::class, 'create']);
// Add other routes as needed
