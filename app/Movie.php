<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';
    public $timestamps = false;
    protected $fillable = ['name','sipnosis','iframe','launching','state','file','category_id'];
}
