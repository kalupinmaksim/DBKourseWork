<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CarModel extends Model
{

    public $timestamps = false;
    protected $table = 'models';
    protected $fillable = ['name','id_mark'];
}
