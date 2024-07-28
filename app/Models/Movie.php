<?php

namespace NHRRob\Movies\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
    protected $table = 'movies';

    // Add your fillable properties here
    protected $fillable = ['title', 'description', 'release_date'];
}
