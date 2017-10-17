<?php
namespace App\Src;
use Auth;
use App\Models\Location;
use App\Models\Car;
use Illuminate\Support\Facades\Redis;


class notifier{

public function updateLocationSocket($driver_id,$lat,$lng,$bearing,$speed){


  Redis::publish('location-channel',json_encode([
  	
    'driver_id'=>$driver_id,
    'lat'=>$lat,
    'lng'=>$lng,
    'bearing'=>$bearing,
    'speed' =>$speed,
    ])
  );
}


}