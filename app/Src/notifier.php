<?php
namespace App\Src;
use Auth;
use App\Models\Location;
use App\Models\Car;
use Illuminate\Support\Facades\Redis;


class notifier{
/*
function which handle every thing you just need to modify the attributes just if you want.
if you want to add one just make new object of insert and add to it.
for example i want to add notification section.
before $insert->save(); add this $insert->section(); and add to the notifications table in DB.
*/	
public function updateLocationSocket($user_id,$lat,$lng,$bearing,$speed){

/*	$carId = Car::where('driver_id',$driver_id)->pluck('id')->first();

	$updateLocation = Location::where('car_id',$carId)->update([

		'latitude'=>$lat,
		'latitude'=>$lng,
		'bearing'=>$bearing,
		'speed'=>$speed,
	]);*/

	//$id = Location::where('car_id',$carId)->pluck('id')->first();

  Redis::publish('location-channel',json_encode([
  	
    'user_id'=>$user_id,
    'lat'=>$lat,
    'lng'=>$lng,
    'bearing'=>$bearing,
    'speed' =>$speed,
    ])
  );
}


}