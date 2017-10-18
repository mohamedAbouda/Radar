<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarDriver extends Model
{
    protected $table = 'car_drivers';
    protected $fillable = ['car_id','driver_id'];
}
