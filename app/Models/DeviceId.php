<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeviceId extends Model
{
    protected $table = 'device_id';
    protected $fillable = ['device_id','user_id'];

     public function users()
    {
    	return $this->belongsTo('App\Models\User','user_id','id');
    }
}
