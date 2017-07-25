<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RadarReport extends Model
{
    protected $table = 'radar_report';
    protected $fillable = ['note','speed_limit','radar_id'];
}
