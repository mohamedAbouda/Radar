<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\OwnerCarTransformer;
use App\Models\Car;
use App\Models\User;
use DB;

class OwnerCarController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $owner = $request->user();
        $cars = Car::where('owner_id',$owner->id)->get();
        return response()->json([
            'data'=>fractal()
            ->collection($cars)
            ->transformWith(new OwnerCarTransformer)
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray(),
        ],200);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $owner = $request->user();
        $input = $request->all();
        $input['owner_id'] = $owner->id;
        $input['registration_code'] = str_random(5);
        $car = Car::create($input);
        if (!$car) {//return with error
            return response()->json([
                'status' => 'false',
                'error' => 'Something went wrong please try again'
            ],500);
        }
        return response()->json(fractal()
        ->item($car)
        ->transformWith(new OwnerCarTransformer)
        ->toArray(),200);
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Car $car)
    {
        return response()->json(['data' => fractal()
        ->item($car)
        ->transformWith(new OwnerCarTransformer)
        ->serializeWith(new \Spatie\Fractal\ArraySerializer())
        ->toArray()],200);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        //
    }

    public function addDriver(Request $request)
    {
        $user = $request->user();
        $drivers = $request->get('drivers');
        $car = Car::where('owner_id',$user->id)->where('id',$request->get('car_id'))->first();
        if (!$car) {
            return response()->json([
                'status' => 'false',
                'error' => 'Car not found'
            ],404);
        }

        $car_drivers = [];

        foreach ($drivers as $id) {
            $driver = User::where('id',$id)->first();
            if ($driver) {
                $car_drivers[] = [
                    'driver_id' => $driver->id,
                    'car_id' => $car->id
                ];
            }
        }

        $car->drivers()->sync($car_drivers);

        return response()->json([
            'status' => 'true',
            'message' => 'Drivers added successfully.'
        ]);
    }
}
