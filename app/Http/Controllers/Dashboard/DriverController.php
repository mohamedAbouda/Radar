<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Car;
use App\Http\Requests\Dashboard\CreateDriverRequest;
use App\Http\Requests\Dashboard\UpdateDriverRequest;


class DriverController extends Controller
{
    
    protected $mainRedirect = 'dashboard.drivers.';

    public function index()
    {
        $drivers =User::doesntHave('roles')->where('account_type',0)->paginate(10);

        return view($this->mainRedirect . 'index')->with('drivers', $drivers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->mainRedirect . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateDriverRequest $request)
    {
        $data=$request->all();
        $data['password'] =  bcrypt($data['password']);
        $data['confirmed'] = 1;
        $data['account_type'] = 0;
        if($request->input('car_id')){
            $check = Car::where('registration_code',$request->input('car_id'))->first();
            if(empty($check)){
                return view($this->mainRedirect . 'create')->with(['error'=>'No car with this registration code found.','password'=>$request->input('password'),'full_name'=>$request->input('full_name'),'phone_number'=>$request->input('phone_number'),'email'=>$request->input('email')]);
            }
        }

            $user=User::create($data);
            $update = Car::where('registration_code',$request->input('car_id'))->update([
                'driver_id'=>$user->id,
            ]);
        

        return redirect()->route($this->mainRedirect . 'index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $driver = User::with('car')->where('id',$id)->first();;

        return view($this->mainRedirect . 'show')->with(['driver'=>$driver]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $driver = User::findOrFail($id);

        return view($this->mainRedirect . 'edit')->with(['driver'=>$driver]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDriverRequest $request, $id)
    {
        
        $data = $request->all();

        $driver = User::findOrFail($id);
        if($request->input('password')){
            $data['password'] =  bcrypt($data['password']);
        }

        if($request->input('car_id')){
            $check = Car::where('registration_code',$request->input('car_id'))->first();
            if(empty($check)){
                return view($this->mainRedirect . 'edit')->with(['error'=>'No car with this registration code found.','password'=>$request->input('password'),'full_name'=>$request->input('full_name'),'phone_number'=>$request->input('phone_number'),'email'=>$request->input('email'),'driver'=>$driver]);
            }
        }

        $driver->update($data);

        return redirect()->route($this->mainRedirect . 'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $driver = User::findOrFail($id);

        $driver->delete();
        return redirect()->route($this->mainRedirect . 'index');
    }
}
