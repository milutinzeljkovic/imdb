<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReactionType extends Model
{
    public function likes()
    {
        return $this->hasMany('App\Likes', 'reaction', 'id');
    }

}
