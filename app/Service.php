<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    //
    protected $guarded = ['id'];

    public function users()
    {
        return $this->belongsToMany('App\Service', 'user_service', 'service_id', 'user_id')->withTimestamps();
    }

    public function membership(){
        return $this->belongsTo('App\Membership');
    }
    public function coupons(){
        return $this->hasMany('App\Coupon');
    }
}
