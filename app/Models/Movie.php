<?php

namespace Nhrrob\Movies\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model {
    protected $table = 'nhrrob_movies';
    protected $fillable = ['title', 'description', 'release_date'];
}
