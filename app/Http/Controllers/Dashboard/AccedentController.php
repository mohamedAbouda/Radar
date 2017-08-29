<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use App\Http\Request\Dashboard\AccedentCreateRequest;
// use App\Http\Request\Dashboard\AccedentUpdateRequest;
use App\Models\Accedent;

class AccedentController extends Controller
{
    protected $view = 'dashboard.accedents.';
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $limit = 20;
        $data['resources'] = Accedent::paginate($limit);
        $data['counter_offset'] = ($request->get('page',1) * $limit) - $limit;
        return view($this->view.'index',$data);
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Accedent $accident)
    {
        $accident->delete();
        return redirect()->back()->with('success' , 'Deleted successfully');
    }
}
