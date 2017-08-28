<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PusherController;
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

    public function panic(Request $request)
    {
        $id = $request->get('driver_id');
        $car = Car::where('driver_id',$id)->first();
        if (!$car) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Car not found.',
            ],404);
        }
        $owner = $car->owner;
        if (!$owner) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Car owener not found or deleted.',
            ],404);
        }
        //change car's state
        $car->state = 1;
        $car->save();
        //notify owner
        $title = 'There is a problem';
        $body = 'A serious problem !';
        $data = [];
        $token = $owner->registeration_id()->first();
        try {
            if ($token) {
                $pusher = new PusherController($title, $body, $data, $token->device_id);
                $pusher->send();
            }else{
                return response()->json([
                    'statusCode' => 500,
                    'message' => 'Notification wasn\'t sent please try again.',
                ],500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'statusCode' => 500,
                'message' => 'Something went wrong.',
            ],500);
        }
        return response()->json([
            'statusCode' => 200,
            'message' => 'Success.',
        ],200);
    }
}
