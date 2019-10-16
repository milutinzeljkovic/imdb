<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $guarded = ['id'];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function reactions()
    {
        return $this->hasMany('App\Reaction', 'movie_id', 'id');
    }

}
