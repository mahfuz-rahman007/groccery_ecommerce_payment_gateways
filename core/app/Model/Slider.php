<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $guarded = [];

    public function pcategory(){
        return $this->belongsTo('App\Model\Pcategory');
    }

}
