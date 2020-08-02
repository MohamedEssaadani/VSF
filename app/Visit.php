<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    public function stamps()
    {
        return $this->hasMany("App/Stamp");
    }

    public function customers()
    {
        return $this->belongsToMany("App/Customer");
    }
}
