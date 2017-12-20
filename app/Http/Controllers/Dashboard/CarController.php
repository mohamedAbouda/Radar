<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Car;
use App\Models\CarModel;
use App\Http\Requests\Dashboard\CreateCarRequest;

class CarController extends Controller
{
    protected $mainRedirect = 'dashboard.cars.';

    public function index()
    {
        $cars = Car::paginate(10);

        return view($this->mainRedirect . 'index')->with('cars', $cars);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['models'] = CarModel::pluck('name','id')->toArray();
        return view($this->mainRedirect . 'create',$data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCarRequest $request)
    {
        $data = $request->all();

        $data['registration_code'] = str_random(5);

        $createCar = Car::create($data);

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
        $car = Car::with('drivers','owner')->where('id',$id)->first();;

        return view($this->mainRedirect . 'show')->with(['car'=>$car]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['car'] = Car::findOrFail($id);
        $data['models'] = CarModel::pluck('name','id')->toArray();
        return view($this->mainRedirect . 'edit' , $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateCarRequest $request, $id)
    {
        $data = $request->all();
        $car = Car::findOrFail($id);
        $car->update($data);

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
        $car = Car::findOrFail($id);

        $car->delete();
        return redirect()->route($this->mainRedirect . 'index');
    }
}
