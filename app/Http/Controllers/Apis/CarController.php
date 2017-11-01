<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PusherController;
use App\Transformers\CarTransformer;
use App\Models\Car;
use App\Models\CarDriver;
use DB;
use Carbon\Carbon;

class CarController extends Controller
{
    public function setRegistrationCode(Request $request)
    {
    	$carCode = $request->input('car_registration_code');
    	if($carCode){
    		$checkCar = Car::where(DB::raw('BINARY `registration_code`'),$carCode)->first();
    		if($checkCar){
    			// $updateCar = Car::where(DB::raw('BINARY `registration_code`'),$carCode)->update([
    			// 	'driver_id'=>$request->user()->id,
    			// ]);

                $check = DB::table('car_drivers')->select('id')->where('driver_id',$request->user()->id)->where('car_id',$checkCar->id)->first();
                if (!$check) {
                    CarDriver::create([
                        'car_id' => $checkCar->id,
                        'driver_id' => $request->user()->id
                    ]);
                }

    			return response()->json([
	      			'message'=>'You have upated this car successfuly',
	      		],200 );

    		}else{
	    		return response()->json([
	      			'message'=>'No car for this code',
	      		],404);
    		}
    	}else{
    		return response()->json([
      			'message'=>'No registration code submited',
      		],400);
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
                ],404);
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
                ],404);
            }
        }else{
            return response()->json([
                'message'=>'No Car id has submited.',
            ],400);
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
            if (isset($data['maintenance_date'])) {
                $data['maintenance_date'] = Carbon::createFromFormat('d M. Y',$data['maintenance_date'])->format('Y/m/d');
            }
            $update->update($data);
            return response()->json([
                'message'=>'The car details has been updated.',
            ],200 );

        }else{
            return response()->json([
                'message'=>'No Car id has submited.',
            ],400);
        }
    }

    public function panic(Request $request)
    {
        $id = $request->get('driver_id');
        $car_driver = CarDriver::where('driver_id',$id)->orderBy('id','DESC')->first();
        if (!$car_driver) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'You have no car.',
            ],404);
        }
        $car = Car::where('id',$car_driver->car_id)->first();
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

    public function incMilage(Request $request,Car $car)
    {
        $car->mile_age = floatval($car->mile_age) + floatval($request->get('mileage',0));
        $car->save();
        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->item($car)
            ->transformWith(new CarTransformer)
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray(),
        ],200);
    }
}
