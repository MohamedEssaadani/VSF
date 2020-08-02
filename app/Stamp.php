<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    public function visits()
    {
        return $this->belongsToMany('App/Visit');
    }
}
