<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{

    protected $fillable = ['type', 'price', 'tva', 'narfa', 'kitonse', 'local'];
    
    public function customers()
    {

        return $this->belongsToMany('App\Customer')
        ->withTimestamps();
    }
}
