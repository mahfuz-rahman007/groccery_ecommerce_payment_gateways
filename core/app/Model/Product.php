<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];

    public function pcategory(){

        return $this->belongsTo('App\Model\Pcategory');
    }
}
