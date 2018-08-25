<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $with= ['membership'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded= ['id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // Rest omitted for brevity

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function payments(){
        return $this->hasMany('App\Payment');
    }

    public function tickets(){
        return $this->hasMany('App\Ticket');
    }

    public function services()
    {
        return $this->belongsToMany('App\Service', 'user_service', 'user_id', 'service_id')->withTimestamps();
    }

    public function coupons()
    {
        return $this->belongsToMany('App\Coupon', 'user_coupon', 'user_id', 'coupon_id')->withTimestamps();
    }

    public function membership()
    {
        return $this->services();
    }
}
