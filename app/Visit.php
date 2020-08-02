<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    protected $fillable = ['type', 'price', 'tva'];

    public function stamps()
    {
        return $this->hasMany("App/Stamp");
    }

    public function customers()
    {
        return $this->belongsToMany("App/Customer");
    }
}
