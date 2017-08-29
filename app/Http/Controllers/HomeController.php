<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Src\notifier;
use App\Models\Car;
use App\Models\Location;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $notifier;

    public function __construct()
    {
        $this->notifier= new notifier;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            return view('home');
        } else {
            return view('welcome');
        }
        
    }
    public function updateLocation()
    {
       return  $update =$this->notifier->updateLocationSocket(1,1236.556,5.65965,365,120);
    }
    public function listenLocation()
    {
        return view('dashboard.listen');
    }

    public function getLocation($id)
    {
        $carId = Car::where('driver_id',$id)->pluck('id')->first();
        $location = Location::where('car_id',$carId)->first();
         return response()->json($location);
    }
}
