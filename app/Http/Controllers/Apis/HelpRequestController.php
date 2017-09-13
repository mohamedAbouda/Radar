<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PusherController;
use App\Http\Requests\Apis\HelpRequestCreateRequest;
use App\Models\Location;
use App\Models\Accedent;
use App\Models\HelpRequest;
use App\Transformers\HelpRequestTransformer;

class HelpRequestController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(HelpRequestCreateRequest $request)
    {
        $input = $request->all();
        if (!$request->user()) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Driver not found!'
            ],404);
        }
        $input['driver_id'] = $request->user()->id;
        $location = Location::create([
            'latitude' => $input['latitude'],
            'longitude' => $input['longitude'],
        ]);

        $input['location_id'] = $location->id;

        if (HelpRequest::create($input)) {
            return response()->json([
                'statusCode' => 200,
                'message' => 'Help request sent successfully.'
            ]);
        }
        return response()->json([
            'statusCode' => 500,
            'message' => 'Something went wrong.'
        ],500);
    }

    /**
    * Answer help request
    * @param  Request $request
    * @return Json response
    */
    public function answer(Request $request)
    {
        $id = $request->get('id');
        $helprequest = HelpRequest::find($id);
        if (!$helprequest) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Help-request not found!'
            ],404);
        }
        $helprequest->is_accepted = 1;
        $helprequest->save();

        $driver = $helprequest->deriver;
        if ($driver) {
            $title = 'Help is on the way';
            $body = 'Hang on there !';
            $data = [];
            $token = $driver->registeration_id()->first();
            try {
                if ($token) {
                    $pusher = new PusherController($title, $body, $data, $token->device_id);
                    $pusher->send();
                }
            } catch (\Exception $e) {
                return response()->json([
                    'statusCode' => 500,
                    'message' => 'Something went wrong.',
                ],500);
            }
        }

        return response()->json([
            'statusCode' => 200,
            'message' => 'Help request answered successfully.'
        ]);
    }

    public function nearby(Request $request)
    {
        $radius = 20;
        $data = $request->all();
        $location = new Location;
        $addresses = $location->getByDistance($data['latitude'],$data['longitude'],$radius);
        $addressId = array();
        foreach ($addresses as $address) {
            $addressId[] = $address->id;
        }

        $helprequests = HelpRequest::whereHas('location',function ($query) use($addressId) {
            $query->whereIn('id',$addressId);
        })->get();

        return response()->json([
            'data'=>fractal()
            ->collection($helprequests)
            ->transformWith(new HelpRequestTransformer)
            ->serializeWith(new \Spatie\Fractal\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function accident(Request $request)
    {
        $input = $request->all();
        if (!$request->user()) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Driver not found!'
            ],404);
        }
        $input['driver_id'] = $request->user()->id;

        $location = Location::create([
            'latitude' => $input['latitude'],
            'longitude' => $input['longitude'],
        ]);

        $input['location_id'] = $location->id;

        if (Accedent::create($input)) {
            return response()->json([
                'statusCode' => 200,
                'message' => 'Accident reported successfully.'
            ]);
        }
        return response()->json([
            'statusCode' => 500,
            'message' => 'Something went wrong.'
        ],500);
    }
}
