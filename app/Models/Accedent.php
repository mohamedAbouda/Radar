<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accedent extends Model
{
    protected $fillable = [
        'driver_id' , 'car_id' , 'location_id' , 'reporter_id'
    ];
    /**
     * Relations
     */
    public function driver()
    {
        $this->belongsTo(User::class,'driver_id');
    }
    public function reporter()
    {
        $this->belongsTo(User::class,'reporter_id');
    }
    public function car()
    {
        $this->belongsTo(Car::class,'car_id');
    }
    public function location()
    {
        $this->belongsTo(Location::class,'location_id');
    }
}
