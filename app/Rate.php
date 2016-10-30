<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'id_user', 'id_modification', 'rate',
    ];
}
