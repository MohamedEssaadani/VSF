<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'matricule';

    public $incrementing = false;

    protected $keyType = 'string';

}
