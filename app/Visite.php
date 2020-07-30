<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{

    public function customers()
    {

        return $this->belongsToMany('App\Customer')
        ->withTimestamps();
    }
}
