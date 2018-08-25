<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    protected $guarded = ['id'];
    //
    public function membership(){
        return $this->belongsTo('App\Membership');
    }
}
