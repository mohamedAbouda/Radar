<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $fillable = ['model','plate_number','maintenance_date','mile_age','registration_code','driver_id','owner_id'];


   	public function driver()
    {
        return $this->belongsTo('App\Models\User');
    }
}
