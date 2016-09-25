<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Generation extends Model
{
    protected $fillable = ['name','id_model','year_start','year_end'];
    public $timestamps = false;
}
