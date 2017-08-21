<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\CarTransformer;
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

    public function viewCarDetails(Request $request)
    {
        $carId = $request->input('car_id');
        $registration_code = $request->input('registration_code');
        if($carId){
            $car = Car::where('id',$carId)->first();
            if($car){
                return response()->json([
                    'data'=>fractal()
                    ->item($car)
                    ->transformWith(new CarTransformer)
                    ->serializeWith(new \Spatie\Fractal\ArraySerializer())
                    ->toArray(),
                ],200);
            }else{
               return response()->json([
                    'message'=>'No Car has been found with this id.',
                ],400);
            }
        }elseif($registration_code){
            $car = Car::where('registration_code',$registration_code)->first();
            if($car){
                return response()->json([
                    'data'=>fractal()
                    ->item($car)
                    ->transformWith(new CarTransformer)
                    ->serializeWith(new \Spatie\Fractal\ArraySerializer())
                    ->toArray(),
                ],200);
            }else{
               return response()->json([
                    'message'=>'No Car has been found with this id.',
                ],400);
            }
        }else{
            return response()->json([
                'message'=>'No Car id has submited.',
            ],400 );
        }
    }

    public function viewAllCars(Request $request)
    {
        $cars = Car::all();

         return response()->json([
            'data'=>fractal()
            ->collection($cars)
            ->transformWith(new CarTransformer)
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function updateCarDetails(Request $request)
    {
        $id = $request->input('car_id');
        $data = $request->all();
        if($id){
            $update = Car::findOrFail($id);
            $update->update($data);

            return response()->json([
                'message'=>'The car details has been updated.',
            ],200 );

        }else{
            return response()->json([
                'message'=>'No Car id has submited.',
            ],400 );
        }
    }
}
