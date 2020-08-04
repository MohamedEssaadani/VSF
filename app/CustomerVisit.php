<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerVisit extends Model
{
    protected $fillable = ['customer', 'visit', 'total'];
}
