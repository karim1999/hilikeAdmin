<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $with= ['features', 'permissions', 'services'];

    //
    public function features(){
        return $this->hasMany('App\Feature');
    }

    public function permissions(){
        return $this->belongsToMany('App\Permission', 'membership_permission');
    }

    public function services(){
        return $this->hasMany('App\Service');
    }
}
