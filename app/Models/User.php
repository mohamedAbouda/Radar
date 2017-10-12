<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'full_name', 'email', 'password', 'phone_number', 'profile_pic',

        'social_type', 'social_id', 'account_type','is_on_duty','confirmed','activated','confirmation_code'
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token','pivot'
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function car()
    {
        return $this->hasOne('App\Models\Car','driver_id');
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function registeration_id()
    {
        return $this->hasMany('App\Models\DeviceId');
    }
}
