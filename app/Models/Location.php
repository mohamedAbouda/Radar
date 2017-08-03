<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Location extends Model
{
    protected $table = 'locations';
    protected $fillable = ['latitude','longitude','bearing','speed','type','merge_count','car_id'];

      public function getByDistance($lat, $lng, $distance)
    {
        $results = DB::select(DB::raw('SELECT id, ( 3959 * acos( cos( radians(' . $lat . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $lng . ') ) + sin( radians(' . $lat .') ) * sin( radians(latitude) ) ) ) AS distance FROM locations HAVING distance < ' . $distance . ' ORDER BY distance') );

        return $results;
    }
}
