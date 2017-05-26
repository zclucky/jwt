<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    protected $fillable = ['city','city_id','temp1','temp2','weather'];

    protected $hidden = ['id','created_at','updated_at'];
}
