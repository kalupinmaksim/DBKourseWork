<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modification extends Model
{
    public $timestamps = false;
    protected $fillable = ['name','id_series','id_model','year_start_production','year_end_production'];
}
