<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReactionType extends Model
{
    public function reactions()
    {
        return $this->hasMany('App\Reaction', 'reaction', 'id');
    }

}
