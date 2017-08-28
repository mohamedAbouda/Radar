<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\HelpRequestCreateRequest;
use App\Models\Location;
use App\Models\HelpRequest;

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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
