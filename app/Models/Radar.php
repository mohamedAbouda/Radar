<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Radar extends Model
{
    protected $table = 'radars';
    protected $fillable = ['location_id','radius'];


    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

     public function reports()
    {
        return $this->hasMany('App\Models\RadarReport');
    }
}
