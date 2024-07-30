<?php

use NHRRob\Movies\Controllers\MovieController;

// Define the routes
return [
    'nhrrob-movies/index' => [MovieController::class, 'index'],
    'nhrrob-movies/create' => [MovieController::class, 'create'],
    'nhrrob-movies/store' => [MovieController::class, 'store'],
    'nhrrob-movies/edit' => [MovieController::class, 'edit'],
    'nhrrob-movies/update' => [MovieController::class, 'update'],
    'nhrrob-movies/delete' => [MovieController::class, 'destroy'],
];