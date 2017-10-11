<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $fillable = ['model','plate_number','maintenance_date','mile_age','registration_code','driver_id','owner_id','oil_change_date','tyre_replacement_date','oil_change_mileage','state'];


   	public function drivers()
    {
        return $this->belongsToMany(User::class, 'car_drivers', 'car_id', 'driver_id');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User');
    }
}
