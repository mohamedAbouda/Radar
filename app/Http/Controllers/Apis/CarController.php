<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;

class CarController extends Controller
{
    public function setRegistrationCode(Request $request)
    {
    	$carCode = $request->input('car_registration_code');
    	if($carCode){
    		$checkCar = Car::where('registration_code',$carCode)->first();
    		if($checkCar){
    			$updateCar = Car::where('registration_code',$carCode)->update([
    				'driver_id'=>$request->user()->id,
    			]);

    			return response()->json([
	      			'message'=>'You have upated this car successfuly',
	      		],200 );

    		}else{
	    		return response()->json([
	      			'message'=>'No car for this code',
	      		],400 );	
    		}
    	}else{
    		return response()->json([
      			'message'=>'No registration code submited',
      		],400 );
    	}
    }
}
