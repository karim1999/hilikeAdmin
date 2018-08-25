<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $guarded = ['id'];

    //
    public function users()
    {
        return $this->belongsToMany('App\Coupon', 'user_coupon', 'coupon_id', 'user_id')->withTimestamps();
    }

    public function service()
    {
        return $this->belongsTo('App\Service');
    }
}
