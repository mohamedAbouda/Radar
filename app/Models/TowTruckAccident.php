<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TowTruckAccident extends Model
{
    protected $table = 'tow_truck_accidents';
    protected $fillable = [
        'tow_truck_id' , 'accident_id', 'state'
    ];
}
