<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $guarded = ['id'];

    //
    public function membership(){
        return $this->belongsToMany('App\Membership', 'membership_permission');
    }
}
