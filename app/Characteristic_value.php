<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Characteristic_value extends Model
{
    protected $table = 'characteristic_values';
    public $timestamps = false;
    protected $fillable = ['id_characteristic','id_modification','value','unit'];

}
