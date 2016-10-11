<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userauto extends Model
{
    protected $fillable = ['id_user','id_mark','id_model','id_generation','id_serie','id_modification'];
}
