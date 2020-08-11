<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stamp extends Model
{
    protected $fillable = ['type', 'description', 'price'];

    public function visits()
    {
        return $this->belongsToMany("App\Visit");
    }
}
