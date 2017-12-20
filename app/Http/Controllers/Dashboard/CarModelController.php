<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CarModelCreateRequest;
use App\Http\Requests\Dashboard\CarModelUpdateRequest;
use App\Models\CarModel;

class CarModelController extends Controller
{
    private $base_view_path = 'dashboard.carmodels.';
    private $paginate_by = 20;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['resources'] = CarModel::paginate($this->paginate_by);
        return view($this->base_view_path.'index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->base_view_path.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CarModelCreateRequest $request)
    {
        $resource = CarModel::create($request->all());
        if (!$resource) {
            return redirect()->back()->withErrors(['error' => 'Something went wrong please try again.']);
        }
        return redirect()->back()->with('success' ,'Car model added successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(CarModel $carmodel)
    {
        $data['resource'] = $carmodel;
        return view($this->base_view_path.'edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarModelUpdateRequest $request, CarModel $carmodel)
    {
        $input = $request->all();
        //remove profile picture if it will be updated and exists
        if (isset($input['pic']) && $input['pic'] && $carmodel->pic && file_exists(public_path($carmodel->upload_distination.$carmodel->pic))) {
            unlink(public_path($carmodel->upload_distination.$carmodel->pic));
        }

        if (!$carmodel->update($input)) {
            return redirect()->back()->withErrors(['error' => 'Something went wrong please try again.']);
        }
        return redirect()->back()->with('success' ,'Car model updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarModel $carmodel)
    {
        if ($carmodel->pic && file_exists(public_path($carmodel->upload_distination.$carmodel->pic))) {
            unlink(public_path($carmodel->upload_distination.$carmodel->pic));
        }
        $carmodel->delete();
        return redirect()->route('dashboard.carmodels.index')->with('success' , 'Deleted successfully');
    }
}
