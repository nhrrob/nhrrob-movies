<?php

namespace NHRRob\Movies\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
    protected $table = 'movies';
    protected $fillable = ['title', 'description', 'release_date'];
}
