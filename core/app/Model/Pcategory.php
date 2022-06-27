<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Pcategory extends Model
{
    protected $guarded = [];

    public function products(){
        return $this->hasMany('App\Model\Product');
    }

    public function slider(){
        return $this->hasOne('App\Model\Slider');
    }
}
