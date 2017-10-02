<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PusherController;
use App\Http\Requests\Apis\HelpRequestCreateRequest;
use App\Models\Location;
use App\Models\Accedent;
use App\Models\TowTruck;
use App\Models\GroupUser;
use App\Models\TowTruckAccident;
use App\Models\HelpRequest;
use App\Models\Car;
use App\Models\Group;
use App\Transformers\TowTruckTransformer;
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
        $user = $request->user();
        $radius = 20;
        $data = $request->all();
        $location = new Location;
        $addresses = $location->getByDistance($data['latitude'],$data['longitude'],$radius);
        $addressId = array();
        foreach ($addresses as $address) {
            $addressId[] = $address->id;
        }

        $member_groups_ids = GroupUser::where('user_id',$user->id)->where('confirmed',1)->groupBy('group_id')->pluck('group_id')->toArray();
        $admin_groups_ids = Group::where('admin_id',$user->id)->pluck('id')->toArray();
        $groups_ids = array_unique(array_merge($member_groups_ids, $admin_groups_ids));

        $other_members_ids = GroupUser::whereIn('group_id',$groups_ids)->where('confirmed',1)->groupBy('user_id')->pluck('user_id')->toArray();
        $other_admin_ids = Group::whereIn('id',$groups_ids)->groupBy('admin_id')->pluck('admin_id')->toArray();
        $member_ids = array_unique(array_merge($other_admin_ids,$other_members_ids));

        $helprequests = HelpRequest::whereHas('location',function ($query) use($addressId,$member_ids,$groups_ids) {
            $query->whereIn('id',$addressId)->where(function($inner_query) use($member_ids,$groups_ids){
                $inner_query->where(function($query) use($member_ids,$groups_ids){
                    $query->whereIn('driver_id',$member_ids)->where('group_id',NULL);
                })->orWhere(function($query) use($member_ids,$groups_ids){
                    $query->where('group_id','<>',NULL)->whereIn('group_id',$groups_ids);
                });
            });
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

        $car = Car::where('registration_code',$input['code'])->first();
        if (!$car) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Car not found!'
            ],404);
        }

        $input['driver_id'] = $request->user()->id;
        $input['car_id'] = $car->id;

        $location = Location::create([
            'latitude' => $input['latitude'],
            'longitude' => $input['longitude'],
        ]);

        $input['location_id'] = $location->id;

        if ($accident = Accedent::create($input)) {
            $occupied_trucks = TowTruckAccident::where('state',0)->pluck('tow_truck_id')
            ->toArray();
            $trucks = TowTruck::whereNotIn('id',$occupied_trucks)->get();
            return response()->json([
                'accident_id' => $accident->id,
                'data' => fractal()
                ->collection($trucks)
                ->transformWith(new TowTruckTransformer)
                ->serializeWith(new \Spatie\Fractal\ArraySerializer())
                ->toArray()
            ],200);
        }
        return response()->json([
            'statusCode' => 500,
            'message' => 'Something went wrong.'
        ],500);
    }

    /**
     * To confirm that the accident was answered and the tow truck is now available.
     */
    public function releaseTowTruck(Request $request)
    {
        $input = $request->all();
        $accident = $input['accident_id'];
        $tow_truck_id = $input['tow_truck_id'];

        $tow_truck_accident = TowTruckAccident::where('accident_id',$accident)
        ->where('tow_truck_id',$tow_truck_id)->first();

        if (!$tow_truck_accident) {
            return response()->json([
                'statusCode' => 404,
                'message' => 'Not found.'
            ],404);
        }
        $tow_truck_accident->state = 1;
        $tow_truck_accident->save();
        return response()->json([
            'statusCode' => 200,
            'message' => 'Operation completed.'
        ]);
    }
}
