<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\Dashboard\CreateDriverRequest;
use App\Http\Requests\Dashboard\UpdateDriverRequest;

class CarOwnerController extends Controller
{
    protected $mainRedirect = 'dashboard.carOwners.';

    public function index()
    {
        $carOwners =User::doesntHave('roles')->where('account_type',1)->paginate(10);

        return view($this->mainRedirect . 'index')->with('carOwners', $carOwners);
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
        $data['account_type'] = 1;

        $user=User::create($data);


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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $carOwner = User::findOrFail($id);

        return view($this->mainRedirect . 'edit')->with(['carOwner'=>$carOwner]);
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
        $carOwner = User::findOrFail($id);

        $carOwner->delete();
        return redirect()->route($this->mainRedirect . 'index');
    }
}
