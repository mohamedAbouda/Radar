<?php
namespace App\Src;
use Auth;
use App\Models\Location;
use Illuminate\Support\Facades\Redis;


class notifier{
/*
function which handle every thing you just need to modify the attributes just if you want.
if you want to add one just make new object of insert and add to it.
for example i want to add notification section.
before $insert->save(); add this $insert->section(); and add to the notifications table in DB.
*/	
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