<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lagna extends Model
{
    protected $table = 'lagnas';
    protected $fillable = ['location_id'];


    public function location()
    {
        return $this->belongsTo('App\Models\Location');
    }

    public function reports()
    {
        return $this->hasMany('App\Models\LagnaReport');
    }
}
