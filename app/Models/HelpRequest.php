<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpRequest extends Model
{
    protected $table = 'help_requests';
    protected $fillable = [
        'location_id','driver_id','note','is_accepted'
    ];

    /**
    * Relations
    */
    public function driver()
    {
        return $this->belongsTo(User::class,'driver_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class,'location_id');
    }
}
