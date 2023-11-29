<?php

namespace MoviePlugin;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'description', 'release_date'];
}
